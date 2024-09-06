<?php
require_once('geoplugin.class.php');
require 'connection.php';

class Main_class {

    private $server = DB_HOST;
    private $user   = DB_USERNAME;
    private $pass   = DB_PASSWORD;
    private $db     = DB_NAME;
    private $pdo; 

    public function __construct()
    {
        $this->db_connect();
    }

    public function db_connect() //connection oop
    {
        $this->pdo = null;
        try {
            $this->pdo = new PDO("mysql:host=".$this->server.";dbname=".$this->db, $this->user, $this->pass);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            if (!$this->pdo) {
                return false;
            }    
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
// line h=chart monthly visits website 
public function get_monthly_visitor_data() {
    try {
        $stmt = $this->pdo->prepare("
            SELECT
                DAY(visit_time) AS visit_day,
                SUM(CASE WHEN user_id IS NOT NULL THEN 1 ELSE 0 END) AS signed_up_visits,
                SUM(CASE WHEN user_id IS NULL THEN 1 ELSE 0 END) AS non_signed_up_visits
            FROM visitor_data
            WHERE MONTH(visit_time) = MONTH(CURDATE())
              AND YEAR(visit_time) = YEAR(CURDATE())
            GROUP BY visit_day
            ORDER BY visit_day;
        ");
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        $data = [];
        foreach ($results as $row) {
            $data[] = [
                'day' => (int)$row['visit_day'],
                'signed_up' => (int)$row['signed_up_visits'],
                'non_signed_up' => (int)$row['non_signed_up_visits']
            ];
        }
        return $data;
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        return [];
    }
}


public function get_visitor_data_for_current_month() {
    $stmt = $this->pdo->prepare("
        SELECT v.id, v.user_id, v.ip, v.city, v.region, v.country, v.latitude, v.longitude, v.visit_time, v.visit_count, u.fullname
        FROM visitor_data v
        LEFT JOIN users u ON v.user_id = u.user_id
        WHERE MONTH(v.visit_time) = MONTH(CURRENT_DATE())
        AND YEAR(v.visit_time) = YEAR(CURRENT_DATE())
        ORDER BY v.visit_time DESC
    ");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

public function get_download_data_for_current_month() {
    $stmt = $this->pdo->prepare("
        SELECT d.id, d.file_id, d.user_id, d.download_time, u.fullname, f.title
        FROM downloads d
        LEFT JOIN users u ON d.user_id = u.user_id
        LEFT JOIN files f ON d.file_id = f.id
        WHERE MONTH(d.download_time) = MONTH(CURRENT_DATE())
        AND YEAR(d.download_time) = YEAR(CURRENT_DATE())
        ORDER BY d.download_time DESC
    ");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


//this is for the horizontal bar chart signup and non signup
public function getDownloadData1() {
    $stmt = $this->pdo->prepare("
    SELECT 
        f.file_type, 
        IF(d.user_id IS NULL, 'Non-Signed-Up', 'Signed-Up') as user_type, 
        COUNT(d.id) as download_count
    FROM downloads d
    JOIN files f ON d.file_id = f.id
    GROUP BY f.file_type, user_type
");
$stmt->execute();
return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
    
    
    public function trackVisitor() {
        $geoplugin = new geoPlugin();
        
        $ip = $_SERVER['REMOTE_ADDR'];
    
        if ($ip == '127.0.0.1' || $ip == '::1') {
            $ip = '112.198.194.108';
        }
    
        $geoplugin->locate($ip);
    
        $city = $geoplugin->city;
        $region = $geoplugin->region;
        $country = $geoplugin->countryName;
        $latitude = $geoplugin->latitude;
        $longitude = $geoplugin->longitude;
    
        $stmt = $this->pdo->prepare("SELECT * FROM visitor_data WHERE ip = :ip AND DATE(visit_time) = CURDATE()");
        $stmt->execute([':ip' => $ip]);
        $existingVisit = $stmt->fetch(PDO::FETCH_ASSOC);
    
        if ($existingVisit) {
            $stmt = $this->pdo->prepare("UPDATE visitor_data SET visit_count = visit_count + 1 WHERE ip = :ip AND DATE(visit_time) = CURDATE()");
            $stmt->execute([':ip' => $ip]);
        } else {
            $sql = "INSERT INTO visitor_data (ip, city, region, country, latitude, longitude, visit_time, visit_count) 
                    VALUES (:ip, :city, :region, :country, :latitude, :longitude, NOW(), 1)";
    
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([
                ':ip' => $ip,
                ':city' => $city,
                ':region' => $region,
                ':country' => $country,
                ':latitude' => $latitude,
                ':longitude' => $longitude
            ]);
        }
    }
    //ADMIN DETAILS PROFILE INFO 
    public function updateAdminInfo($id, $fullname, $username, $email) {
        try {
            $stmt = $this->pdo->prepare("UPDATE admin SET fullname = :fullname, username = :username, email = :email WHERE admin_id = :id");
            $stmt->bindParam(':fullname', $fullname);
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':id', $id);
            return $stmt->execute();
        } catch (PDOException $e) {
            return false;
        }
    }

    public function updateAdminPassword($id, $newPassword) {
        try {
            $stmt = $this->pdo->prepare("UPDATE admin SET password = :password WHERE admin_id = :id");
            $stmt->bindParam(':password', password_hash($newPassword, PASSWORD_BCRYPT));
            $stmt->bindParam(':id', $id);
            return $stmt->execute();
        } catch (PDOException $e) {
            return false;
        }
    }

    public function updateAdminPhoto($id, $photoPath) {
        try {
            $stmt = $this->pdo->prepare("UPDATE admin SET admin_photo = :admin_photo WHERE admin_id = :id");
            $stmt->bindParam(':admin_photo', $photoPath);
            $stmt->bindParam(':id', $id);
            return $stmt->execute();
        } catch (PDOException $e) {
            return false;
        }
    }

    public function getAdminPassword($id) {
        try {
            $stmt = $this->pdo->prepare("SELECT password FROM admin WHERE admin_id = :id");
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            return $stmt->fetchColumn();
        } catch (PDOException $e) {
            return false;
        }
    }
    // END ADMIN DETAILS 
// downloads start 
public function getDownloadData($currentMonth, $currentYear, $isSignedIn) {
    $userCondition = $isSignedIn ? 'IS NOT NULL' : 'IS NULL';
    $stmt = $this->pdo->prepare("
        SELECT DAY(download_time) as download_day, COUNT(*) as download_count 
        FROM downloads 
        WHERE user_id $userCondition
        AND MONTH(download_time) = :currentMonth 
        AND YEAR(download_time) = :currentYear 
        GROUP BY DAY(download_time)
    ");
    $stmt->execute(['currentMonth' => $currentMonth, 'currentYear' => $currentYear]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// end 
    public function getVisitors() {
        $stmt = $this->pdo->prepare("
            SELECT  v.id, v.user_id, v.ip, v.city, v.region, v.country, v.latitude, v.longitude,  v.visit_time, v.visit_count, u.fullname
             FROM visitor_data v
            LEFT JOIN 
                users u ON v.user_id = u.user_id
            ORDER BY 
                v.visit_time DESC
        ");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function getDownloads() {
        $stmt = $this->pdo->prepare("
            SELECT d.id, d.file_id, d.user_id, d.download_time, 
                   u.fullname, f.title
            FROM downloads d
            LEFT JOIN users u ON d.user_id = u.user_id
            LEFT JOIN files f ON d.file_id = f.id
            ORDER BY d.download_time DESC
        ");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    
    
    
    public function getVisitorData() {
        $stmt = $this->pdo->prepare("SELECT MONTHNAME(visit_time) as Month, country, COUNT(*) as Visitors FROM visitor_data GROUP BY Month, country ORDER BY visit_time");
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
        // Transform data into the required format
        $data = [];
        $countries = [];
        $months = [];
        $monthlyTotals = [];
    
        foreach ($rows as $row) {
            $months[$row['Month']] = true;
            $countries[$row['country']] = true;
        }
    
        $header = array_merge(['Month'], array_keys($countries), ['Average']);
        $data[] = $header;
    
        foreach ($months as $month => $_) {
            $row = array_fill(0, count($header), 0);
            $row[0] = $month;
            $totalVisitors = 0;
            $countryCount = 0;
    
            foreach ($rows as $entry) {
                if ($entry['Month'] == $month) {
                    $countryIndex = array_search($entry['country'], $header);
                    if ($countryIndex !== false) {
                        $row[$countryIndex] = $entry['Visitors'];
                        $totalVisitors += $entry['Visitors'];
                        $countryCount++;
                    }
                }
            }
    
            // Calculate the average
            $average = $countryCount > 0 ? $totalVisitors / $countryCount : 0;
            $row[count($row) - 1] = $average;
            $data[] = $row;
        }
    
        return $data;
    }
   

//line cahrt end


    public function isDownloadRecorded($file_id, $user_id) {
        $stmt = $this->pdo->prepare("
            SELECT COUNT(*) FROM downloads 
            WHERE file_id = :file_id AND (user_id = :user_id OR :user_id IS NULL)
        ");
        $stmt->execute(['file_id' => $file_id, 'user_id' => $user_id]);
        return $stmt->fetchColumn() > 0;
    }
    
    public function recordDownload($file_id, $user_id) {
        // Insert the new record
        $stmt = $this->pdo->prepare("
            INSERT INTO downloads (file_id, user_id, download_time) 
            VALUES (:file_id, :user_id, NOW())
        ");
        return $stmt->execute(['file_id' => $file_id, 'user_id' => $user_id]);
    }
    
    
    
    public function getUserNotifications($user_id) {
        $stmt = $this->pdo->prepare("SELECT id, file_id, message, is_read, created_at FROM user_notifications WHERE user_id = ? ORDER BY created_at DESC");
        $stmt->execute([$user_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function getUnreadNotificationCount($user_id) {
        $stmt = $this->pdo->prepare("SELECT COUNT(*) FROM user_notifications WHERE user_id = ? AND is_read = 0");
        $stmt->execute([$user_id]);
        return $stmt->fetchColumn();
    }
    

    public function approveFile($file_id, $remarks) {
        try {
            $query = "UPDATE files SET status = 'Approved', remarks = ? WHERE id = ?";
            $stmt = $this->pdo->prepare($query);
            $stmt->execute([$remarks, $file_id]);
    
            $fileQuery = "SELECT user_id, title, upload_date FROM files WHERE id = ?";
            $fileStmt = $this->pdo->prepare($fileQuery);
            $fileStmt->execute([$file_id]);
            $file = $fileStmt->fetch();
    
            if ($file) {
                $message = "Your file <strong> ".$file['title']."</strong> has been approved 
                and successfully published to the website.";
                $notificationQuery = "INSERT INTO user_notifications (user_id, file_id, message) VALUES (?, ?, ?)";
                $notificationStmt = $this->pdo->prepare($notificationQuery);
                $notificationStmt->execute([$file['user_id'], $file_id, $message]);
            }
    
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    // recycle declined files 
    
    public function addToPending($file_id, $remarks) {
        try {
            $query = "UPDATE files SET status = 'Pending', remarks = ? WHERE id = ?";
            $stmt = $this->pdo->prepare($query);
            $stmt->execute([$remarks, $file_id]);
    
            $fileQuery = "SELECT user_id, title, upload_date FROM files WHERE id = ?";
            $fileStmt = $this->pdo->prepare($fileQuery);
            $fileStmt->execute([$file_id]);
            $file = $fileStmt->fetch();
    
            if ($file) {
                $message = "Your approvedfile <strong> ".$file['title']."</strong> is under investigation for upload agreement violations. 
                We have decided to take it down from the website temporarily.";
                $notificationQuery = "INSERT INTO user_notifications (user_id, file_id, message) VALUES (?, ?, ?)";
                $notificationStmt = $this->pdo->prepare($notificationQuery);
                $notificationStmt->execute([$file['user_id'], $file_id, $message]);
            }
    
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }
    // add to pending Btn from approved files
    public function addToPending1($file_id, $remarks) {
        try {
            $query = "UPDATE files SET status = 'Pending', remarks = ? WHERE id = ?";
            $stmt = $this->pdo->prepare($query);
            $stmt->execute([$remarks, $file_id]);
    
            $fileQuery = "SELECT user_id, title, upload_date FROM files WHERE id = ?";
            $fileStmt = $this->pdo->prepare($fileQuery);
            $fileStmt->execute([$file_id]);
            $file = $fileStmt->fetch();
    
            if ($file) {
                $message = "Your approvedfile <strong> ".$file['title']."</strong> is under investigation for upload agreement violations. 
                We have decided to take it down from the website temporarily.";
                $notificationQuery = "INSERT INTO user_notifications (user_id, file_id, message) VALUES (?, ?, ?)";
                $notificationStmt = $this->pdo->prepare($notificationQuery);
                $notificationStmt->execute([$file['user_id'], $file_id, $message]);
            }
    
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }
    //for recosndier buttons from declined files
    
    public function declineFile($file_id, $remarks) {
        try {
            $query = "UPDATE files SET status = 'Declined', remarks = ? WHERE id = ?";
            $stmt = $this->pdo->prepare($query);
            $stmt->execute([$remarks, $file_id]);
    
            $fileQuery = "SELECT user_id, title, upload_date FROM files WHERE id = ?";
            $fileStmt = $this->pdo->prepare($fileQuery);
            $fileStmt->execute([$file_id]);
            $file = $fileStmt->fetch();
    
            if ($file) {
                $message = "Your uploaded file (".$file['title'].") on (".$file['upload_date'].") has been declined.";
                $notificationQuery = "INSERT INTO user_notifications (user_id, file_id, message) VALUES (?, ?, ?)";
                $notificationStmt = $this->pdo->prepare($notificationQuery);
                $notificationStmt->execute([$file['user_id'], $file_id, $message]);
            }
    
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

      
    public function restoreFile($file_id) {
        try {
            $query = "UPDATE files SET status = 'Declined' WHERE id = ?";
            $stmt = $this->pdo->prepare($query);
            $stmt->execute([$file_id]);
    
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }
    public function recycleFile($file_id) {
        try {
            $query = "UPDATE files SET isDeleted = 1 WHERE id = ?";
            $stmt = $this->pdo->prepare($query);
            $stmt->execute([$file_id]);
    
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }



         
    public function deleteFile($file_id) {
        try {
            $query = "UPDATE files SET isDeleted = 2 WHERE id = ?";
            $stmt = $this->pdo->prepare($query);
            $stmt->execute([$file_id]);
    
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }
    

    public function fetchApprovedDocuments() {
        $stmt = $this->pdo->prepare("SELECT f.id, f.user_id, f.title, f.description, f.file_path, f.file_type, 
            f.upload_date, f.status, f.remarks, f.isDeleted, u.fullname AS uploader_fullname
            FROM files f
            INNER JOIN users u ON f.user_id = u.user_id
            WHERE f.status = 'Approved' AND f.isDeleted = 0 AND f.file_type ='Documents' ");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function fetchApprovedImages() {
        $stmt = $this->pdo->prepare("SELECT f.id, f.user_id, f.title, f.description, f.file_path, f.file_type, 
            f.upload_date, f.status, f.remarks, f.isDeleted, u.fullname AS uploader_fullname
            FROM files f
            INNER JOIN users u ON f.user_id = u.user_id
            WHERE f.status = 'Approved' AND f.isDeleted = 0 AND f.file_type ='Images' ");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

  
    public function  fetchApprovedMaps(){
        $stmt = $this->pdo->prepare("SELECT f.id, f.user_id, f.title, f.description, f.file_path, f.file_type, 
            f.upload_date, f.status, f.remarks, f.isDeleted, u.fullname AS uploader_fullname
            FROM files f
            INNER JOIN users u ON f.user_id = u.user_id
            WHERE f.status = 'Approved' AND f.isDeleted = 0 AND f.file_type ='Maps' ");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function  fetchApprovedAudio(){
        $stmt = $this->pdo->prepare("SELECT f.id, f.user_id, f.title, f.description, f.file_path, f.file_type, 
            f.upload_date, f.status, f.remarks, f.isDeleted, u.fullname AS uploader_fullname
            FROM files f
            INNER JOIN users u ON f.user_id = u.user_id
            WHERE f.status = 'Approved' AND f.isDeleted = 0 AND f.file_type ='Audio' ");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function  fetchApprovedArts(){
        $stmt = $this->pdo->prepare("SELECT f.id, f.user_id, f.title, f.description, f.file_path, f.file_type, 
            f.upload_date, f.status, f.remarks, f.isDeleted, u.fullname AS uploader_fullname
            FROM files f
            INNER JOIN users u ON f.user_id = u.user_id
            WHERE f.status = 'Approved' AND f.isDeleted = 0 AND f.file_type ='Arts' ");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    

public function getMediaCounts() {
    $stmt = $this->pdo->prepare("
        SELECT 
            file_type AS MediaType, COUNT(*) AS Count 
        FROM files
        WHERE isDeleted = 0
        GROUP BY file_type
    ");
    $stmt->execute();
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $rows;
}

    
    
    public function changePassword($userId, $currentPassword, $newPassword) {
        try {
            $stmt = $this->pdo->prepare("SELECT password FROM users WHERE user_id = :userId");
            $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetch();
    
            if ($result && password_verify($currentPassword, $result['password'])) {
                $newPasswordHash = password_hash($newPassword, PASSWORD_DEFAULT);
                $updateStmt = $this->pdo->prepare("UPDATE users SET password = :newPassword WHERE user_id = :userId");
                $updateStmt->bindParam(':newPassword', $newPasswordHash, PDO::PARAM_STR);
                $updateStmt->bindParam(':userId', $userId, PDO::PARAM_INT);
                $updateStmt->execute();
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    public function updateBio($userId, $bio) {
        try {
            $stmt = $this->pdo->prepare("UPDATE users SET bio = :bio, date_updated = NOW() WHERE user_id = :userId");
            $stmt->bindParam(':bio', $bio, PDO::PARAM_STR);
            $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }
    
    
    // for login
    public function login_user($emailOrUsername, $password) {
        $stmt = $this->pdo->prepare("SELECT admin_id, email, username, password FROM admin WHERE email = :emailOrUsername OR username = :emailOrUsername");
        $stmt->bindParam(':emailOrUsername', $emailOrUsername);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
        if ($user) {
            if (password_verify($password, $user['password'])) {
                $_SESSION['admin_id'] = htmlentities($user['admin_id']);
                $_SESSION['email'] = htmlentities($user['email']);
                $_SESSION['username'] = htmlentities($user['username']);
                $_SESSION['status'] = "Login Successful!";
                $_SESSION['status_icon'] = "success";
                header("Location: ../dashboard.php");
                exit();
            } else {
                $_SESSION['status'] = "Invalid credentials! Please try again.";
                $_SESSION['status_icon'] = "error";
            }
        } else {
            $_SESSION['status'] = "Invalid credentials! Please try again.";
            $_SESSION['status_icon'] = "error";
        }
    
        header("Location: ../index.php");
        exit();
    }
    
 //admin details currently login
 public function getAdminDetails($admin_id) {
    $stmt = $this->pdo->prepare("SELECT * FROM admin WHERE admin_id = :admin_id");
    $stmt->bindParam(':admin_id', $admin_id);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        return [
            'admin_photo' => !empty($user['admin_photo']) ? $user['admin_photo'] : 'uploads/default_photo.jpg',
            'fullname' => $user['fullname'],
            'role' => $user['role'],
            'username' => $user['username'],
            'date_created' => $user['date_created'],
            'date_updated' => $user['date_updated'],
            'email' => $user['email'],
            'status' => $user['status'],
            'last_signedin' => $user['last_signedin']
            
        ];
    } else {
        return [
            'admin_photo' => 'uploads/default_photo.jpg',
            'fullname' => '',
            'role' => ''
        ];
    }
}

public function insert_admin($fullname, $username, $email, $password, $photo) {
    $sql = "INSERT INTO admin (fullname, username, email, password, admin_photo, date_created, role, status) 
            VALUES (:fullname, :username, :email, :password, :admin_photo, NOW(), 'admin', 'Active')";
    $stmt = $this->pdo->prepare($sql);

    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

    $stmt->bindParam(':fullname', $fullname);
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':password', $hashedPassword);
    $stmt->bindParam(':admin_photo', $photo, PDO::PARAM_STR); 

    return $stmt->execute();
}



// end 
public function usernameExists($username) {
    $stmt = $this->pdo->prepare("SELECT COUNT(*) FROM admin WHERE username = ?");
    $stmt->execute([$username]);
    return $stmt->fetchColumn() > 0;
}
public function emailExists($email) {
    $stmt = $this->pdo->prepare("SELECT COUNT(*) FROM admin WHERE email = ?");
    $stmt->execute([$email]);
    return $stmt->fetchColumn() > 0;
}
// delete admin 
public function deleteAdmin($admin_id) {
    session_start();
    try {
        $stmt = $this->pdo->prepare("DELETE FROM admin WHERE admin_id = :admin_id");
        $stmt->bindParam(':admin_id', $admin_id, PDO::PARAM_INT);
        
        if ($stmt->execute()) {
            $_SESSION['status1'] = "Admin successfully deleted!";
            $_SESSION['status_icon1'] = "success";
        } else {
            $_SESSION['status1'] = "Error deleting admin.";
            $_SESSION['status_icon1'] = "error";
        }
    } catch (PDOException $e) {
        $_SESSION['status1'] = "Oops! Error: " . $e->getMessage();
        $_SESSION['status_icon1'] = "error";
    }
    header('Location: ../manageadmins.php');
    exit();
}


// get all admins table 
public function get_all_admins() {
    $stmt = $this->pdo->prepare("SELECT admin_id, fullname, username, email, admin_photo, date_created, status, date_updated FROM admin WHERE role = 'Admin' ");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
public function count_all_admins() {
    $stmt = $this->pdo->prepare("SELECT COUNT(*) AS total FROM admin WHERE role = 'Admin'");
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result['total'];
}

// end 
public function update_admin_status($username, $status) {
    try {
        $stmt = $this->pdo->prepare("UPDATE admin SET status = :status WHERE username = :username");
        $stmt->bindParam(':status', $status, PDO::PARAM_STR);
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        return $stmt->execute();
    } catch (PDOException $e) {
        return false;
    }
}
// end 

//USER STATUS
public function updateUserStatus($user_id, $status) {
    $stmt = $this->pdo->prepare("UPDATE users SET status = ? WHERE user_id = ?");
    return $stmt->execute([$status, $user_id]);
}

// USER STAUS END 


public function get_categories() {
    $stmt = $this->pdo->prepare("SELECT * FROM categories");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

public function get_all_events() {
    $stmt = $this->pdo->prepare("SELECT * FROM events ORDER BY created_at DESC");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

public function get_all_registeredUsers() {
    $stmt = $this->pdo->prepare("SELECT * FROM users");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


public function get_all_members() {
    $stmt = $this->pdo->prepare("SELECT * FROM members");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

public function count_all_members() {
    $stmt = $this->pdo->prepare("SELECT COUNT(*) AS total FROM members");
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result['total'];
}

public function count_registered_users(){
    $stmt = $this->pdo->prepare("SELECT COUNT(*) AS total FROM users");
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result['total'];
}


public function count_downloads(){
    $stmt = $this->pdo->prepare("SELECT COUNT(*) AS total FROM downloads");
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result['total'];
}



public function insert_member($member_name, $description, $photo) {
    $sql = "INSERT INTO members (member_name, description, member_photo, date_created) 
            VALUES (:member_name, :description, :member_photo, NOW())";
    $stmt = $this->pdo->prepare($sql);

    $stmt->bindParam(':member_name', $member_name);
    $stmt->bindParam(':description', $description);
    $stmt->bindParam(':member_photo', $photo, PDO::PARAM_STR); 

    return $stmt->execute();
}

public function insert_event($event_name, $description, $event_date, $location, $event_photo, $status, $category, $organizer) {
    $sql = "INSERT INTO events (event_name, description, event_date, location, created_at, updated_at, event_photo, category, organizer) 
            VALUES (:event_name, :description, :event_date, :location, NOW(), NOW(), :event_photo, :category, :organizer)";
    $stmt = $this->pdo->prepare($sql);

    $stmt->bindParam(':event_name', $event_name);
    $stmt->bindParam(':description', $description);
    $stmt->bindParam(':event_date', $event_date);
    $stmt->bindParam(':location', $location);
    $stmt->bindParam(':event_photo', $event_photo, PDO::PARAM_STR);
    // $stmt->bindParam(':status', $status);
    $stmt->bindParam(':category', $category);
    $stmt->bindParam(':organizer', $organizer);

    return $stmt->execute();
}
public function is_event_date_exists($event_date) {
    $sql = "SELECT COUNT(*) FROM events WHERE DATE(event_date) = DATE(:event_date)";
    $stmt = $this->pdo->prepare($sql);
    $stmt->bindParam(':event_date', $event_date);
    $stmt->execute();
    return $stmt->fetchColumn() > 0;
}

public function get_taken_event_dates() {
    $stmt = $this->pdo->prepare("SELECT event_date FROM events");
    $stmt->execute();
    $dates = $stmt->fetchAll(PDO::FETCH_COLUMN, 0); 
    return $dates;
}
// public function is_member_name_exists($member_name) {
//     $query = "SELECT COUNT(*) FROM members WHERE member_name = :member_name";
//     $stmt = $this->pdo->prepare($query);
//     $stmt->bindParam(':member_name', $member_name, PDO::PARAM_STR);
//     $stmt->execute();
//     $count = $stmt->fetchColumn();

//     return $count > 0;
// }

public function is_member_name_exists($member_name, $member_id = null) {
    if ($member_id) {
        $sql = "SELECT COUNT(*) FROM members WHERE member_name = :member_name AND member_id != :member_id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':member_name', $member_name);
        $stmt->bindParam(':member_id', $member_id);
    } else {
        $sql = "SELECT COUNT(*) FROM members WHERE member_name = :member_name";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':member_name', $member_name);
    }

    $stmt->execute();
    return $stmt->fetchColumn() > 0;
}


public function update_member($member_id, $member_name, $description, $photo) {
    $sql = "UPDATE members SET member_name = :member_name, description = :description, member_photo = :member_photo WHERE member_id = :member_id";
    $stmt = $this->pdo->prepare($sql);

    $stmt->bindParam(':member_id', $member_id);
    $stmt->bindParam(':member_name', $member_name);
    $stmt->bindParam(':description', $description);
    $stmt->bindParam(':member_photo', $photo, PDO::PARAM_STR); 

    return $stmt->execute();
}

public function delete_member($member_id) {
   
    try {
        $stmt = $this->pdo->prepare("DELETE FROM members WHERE member_id = :member_id");
        $stmt->bindParam(':member_id', $member_id, PDO::PARAM_INT);

        if ($stmt->execute()) {
            $_SESSION['status'] = "Mmber successfully deleted!";
            $_SESSION['status_icon'] = "success";
        } else {
            $_SESSION['status'] = "Error deleting Mmber.";
            $_SESSION['status_icon'] = "error";
        }
    } catch (PDOException $e) {
        $_SESSION['status'] = "Oops! Error: " . $e->getMessage();
        $_SESSION['status_icon'] = "error";
    }
    header('Location: ../managemembers.php');
    exit();
}

public function get_unique_visitor_count() {
    try {
        $stmt = $this->pdo->prepare("
            SELECT COUNT(*) AS unique_visitors
            FROM (
                SELECT DISTINCT user_id ip, city, region, country, latitude, longitude
                FROM visitor_data
            ) AS unique_visitors_data
        ");
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['unique_visitors'];
    } catch (PDOException $e) {
        // Handle error appropriately
        return 0;
    }
}

public function delete_user($user_id) {
    try {
        // First, delete related records from the files table
        $stmt = $this->pdo->prepare("DELETE FROM files WHERE user_id = :user_id");
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->execute();

        // Then, delete the user
        $stmt = $this->pdo->prepare("DELETE FROM users WHERE user_id = :user_id");
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);

        if ($stmt->execute()) {
            $_SESSION['status'] = "User successfully deleted!";
            $_SESSION['status_icon'] = "success";
        } else {
            $_SESSION['status'] = "Error deleting user.";
            $_SESSION['status_icon'] = "error";
        }
    } catch (PDOException $e) {
        $_SESSION['status'] = "Oops! Error: " . $e->getMessage();
        $_SESSION['status_icon'] = "error";
    }
    header('Location: ../manageusers.php');
    exit();
}


public function get_all_documents() {
    $stmt = $this->pdo->prepare("SELECT * FROM documents");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


public function get_all_approved_files() {
    $stmt = $this->pdo->prepare("
        SELECT files.*, users.fullname 
        FROM files 
        LEFT JOIN users ON files.user_id = users.user_id
        WHERE files.status = 'Approved' AND isDeleted = 0 
        ORDER BY files.upload_date DESC
    ");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

public function get_all_declined_files() {
    $stmt = $this->pdo->prepare("
        SELECT files.*, users.fullname 
        FROM files 
        LEFT JOIN users ON files.user_id = users.user_id
        WHERE files.status = 'Declined' AND isDeleted = 0 
        ORDER BY files.upload_date DESC
    ");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

public function get_all_pending_files() {
    $stmt = $this->pdo->prepare("
        SELECT files.*, users.fullname 
        FROM files 
        LEFT JOIN users ON files.user_id = users.user_id
        WHERE files.status = 'Pending' AND isDeleted = 0 
        ORDER BY files.upload_date DESC
    ");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

public function get_all_recycled_files() {
    $stmt = $this->pdo->prepare("
        SELECT files.*, users.fullname 
        FROM files 
        LEFT JOIN users ON files.user_id = users.user_id
        WHERE isDeleted = 1 
        ORDER BY files.upload_date DESC
    ");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


public function count_all_files() {
    $stmt = $this->pdo->prepare("SELECT COUNT(*) AS total FROM files WHERE isDeleted = 0 ");
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result['total'];
}

public function count_all_pending_files() {
    $stmt = $this->pdo->prepare("SELECT COUNT(*) AS total FROM files WHERE status = 'Pending' and isDeleted = 0 ");
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result['total'];
}
public function count_all_declined_files() {
    $stmt = $this->pdo->prepare("SELECT COUNT(*) AS total FROM files WHERE status = 'Declined'  and isDeleted = 0 ");
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result['total'];
}
public function count_all_approved_files() {
    $stmt = $this->pdo->prepare("SELECT COUNT(*) AS total FROM files WHERE status = 'Approved'  and isDeleted = 0 ");
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result['total'];
}

public function count_all_recycled_files() {
    $stmt = $this->pdo->prepare("SELECT COUNT(*) AS total FROM files WHERE isDeleted = 1 ");
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result['total'];
}
//ALL USER SIDES HERE
///user currently login files start 
public function get_user_documents($userId, $fileType = 'Documents', $status = null, $searchTerm = '') {
    try {
        $query = "SELECT * FROM files WHERE user_id = :user_id AND file_type = :file_type";
        if ($status && $status !== 'All') {
            $query .= " AND status = :status";
        }
        if ($searchTerm) {
            $query .= " AND (title LIKE :searchTerm OR description LIKE :searchTerm)";
        }
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
        $stmt->bindParam(':file_type', $fileType, PDO::PARAM_STR);
        if ($status && $status !== 'All') {
            $stmt->bindParam(':status', $status, PDO::PARAM_STR);
        }
        if ($searchTerm) {
            $searchTerm = '%' . $searchTerm . '%';
            $stmt->bindParam(':searchTerm', $searchTerm, PDO::PARAM_STR);
        }
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        error_log("Database error: " . $e->getMessage());
        return [];
    }
}
public function get_user_images($userId, $fileType = 'Images', $status = null, $searchTerm = '') {
    try {
        $query = "SELECT * FROM files WHERE user_id = :user_id AND file_type = :file_type";
        if ($status && $status !== 'All') {
            $query .= " AND status = :status";
        }
        if ($searchTerm) {
            $query .= " AND (title LIKE :searchTerm OR description LIKE :searchTerm)";
        }
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
        $stmt->bindParam(':file_type', $fileType, PDO::PARAM_STR);
        if ($status && $status !== 'All') {
            $stmt->bindParam(':status', $status, PDO::PARAM_STR);
        }
        if ($searchTerm) {
            $searchTerm = '%' . $searchTerm . '%';
            $stmt->bindParam(':searchTerm', $searchTerm, PDO::PARAM_STR);
        }
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        error_log("Database error: " . $e->getMessage());
        return [];
    }
}
public function get_user_arts($userId, $fileType = 'Arts', $status = null, $searchTerm = '') {
    try {
        $query = "SELECT * FROM files WHERE user_id = :user_id AND file_type = :file_type";
        if ($status && $status !== 'All') {
            $query .= " AND status = :status";
        }
        if ($searchTerm) {
            $query .= " AND (title LIKE :searchTerm OR description LIKE :searchTerm)";
        }
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
        $stmt->bindParam(':file_type', $fileType, PDO::PARAM_STR);
        if ($status && $status !== 'All') {
            $stmt->bindParam(':status', $status, PDO::PARAM_STR);
        }
        if ($searchTerm) {
            $searchTerm = '%' . $searchTerm . '%';
            $stmt->bindParam(':searchTerm', $searchTerm, PDO::PARAM_STR);
        }
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        error_log("Database error: " . $e->getMessage());
        return [];
    }
}

public function get_user_maps($userId, $fileType = 'Maps', $status = null, $searchTerm = '') {
    try {
        $query = "SELECT * FROM files WHERE user_id = :user_id AND file_type = :file_type";
        if ($status && $status !== 'All') {
            $query .= " AND status = :status";
        }
        if ($searchTerm) {
            $query .= " AND (title LIKE :searchTerm OR description LIKE :searchTerm)";
        }
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
        $stmt->bindParam(':file_type', $fileType, PDO::PARAM_STR);
        if ($status && $status !== 'All') {
            $stmt->bindParam(':status', $status, PDO::PARAM_STR);
        }
        if ($searchTerm) {
            $searchTerm = '%' . $searchTerm . '%';
            $stmt->bindParam(':searchTerm', $searchTerm, PDO::PARAM_STR);
        }
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        error_log("Database error: " . $e->getMessage());
        return [];
    }
}


public function count_user_files($userId) {
    try {
        $stmt = $this->pdo->prepare("
            SELECT 
                COUNT(*) AS user_total,
                SUM(status = 'Pending') AS user_pending,
                SUM(status = 'Approved') AS user_approved,
                SUM(status = 'Declined') AS user_declined
            FROM files
            WHERE user_id = :user_id 
        ");

        $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            return [
                'user_total' => $result['user_total'] ?? 0,
                'user_pending' => $result['user_pending'] ?? 0,
                'user_approved' => $result['user_approved'] ?? 0,
                'user_declined' => $result['user_declined'] ?? 0,
            ];
        } else {
            return [
                'user_total' => 0,
                'user_pending' => 0,
                'user_approved' => 0,
                'user_declined' => 0,
            ];
        }
    } catch (PDOException $e) {
        error_log("Database error: " . $e->getMessage());

        return [
            'user_total' => 0,
            'user_pending' => 0,
            'user_approved' => 0,
            'user_declined' => 0,
        ];
    }
}
//end count logged in user files



public function count_file_types() {
    $stmt = $this->pdo->prepare("SELECT COUNT(*) AS total FROM filetypes ");
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result['total'];
}
public function get_file_types() {
    $stmt = $this->pdo->prepare("SELECT * FROM filetypes");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}



public function add_document($title, $cover, $file_path, $author, $publication_date, $category, $description, $uploaded_by, $status) {
    $sql = "INSERT INTO documents (title, cover, file_path, author, publication_date, category, description, uploaded_by, status, uploaded_at) 
            VALUES (:title, :cover, :file_path, :author, :publication_date, :category, :description, :uploaded_by, :status, NOW())";
    $stmt = $this->pdo->prepare($sql);

    $stmt->bindParam(':title', $title);
    $stmt->bindParam(':cover', $cover, PDO::PARAM_STR);
    $stmt->bindParam(':file_path', $file_path, PDO::PARAM_STR);
    $stmt->bindParam(':author', $author, PDO::PARAM_STR);
    $stmt->bindParam(':publication_date', $publication_date, PDO::PARAM_STR);
    $stmt->bindParam(':category', $category, PDO::PARAM_STR);
    $stmt->bindParam(':description', $description, PDO::PARAM_STR);
    $stmt->bindParam(':uploaded_by', $uploaded_by, PDO::PARAM_INT);
    $stmt->bindParam(':status', $status, PDO::PARAM_STR);

    return $stmt->execute();
}

public function count_all_documents(){
    $stmt = $this->pdo->prepare("SELECT COUNT(*) AS total FROM documents");
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result['total'];
}


// end //////////////////////////////////
// here starts the codes for user side end
public function get_products() {
    try {
        $stmt = $this->pdo->prepare("SELECT * FROM products");
        $stmt->execute();
        return $stmt->fetchAll();
    } catch (PDOException $e) {
        error_log($e->getMessage(), 3, 'errors.log');
        return [];
    }
}
public function register_user($fullname, $email, $birthday, $username, $password) {
    try {
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);
        $date_created = date('Y-m-d H:i:s');
        $status = 'enabled';

        $stmt = $this->pdo->prepare("INSERT INTO users (fullname, email, birthday, username, password, date_created, date_updated, last_login, status) VALUES (:fullname, :email, :birthday, :username, :password, :date_created, :date_updated, :last_login, :status)");
        $stmt->execute([
            ':fullname' => $fullname,
            ':email' => $email,
            ':birthday' => $birthday,
            ':username' => $username,
            ':password' => $hashed_password,
            ':date_created' => $date_created,
            ':date_updated' => $date_created,
            ':last_login' => null,
            ':status' => $status
        ]);

        $_SESSION['status'] = "User successfully registered!";
        $_SESSION['status_icon'] = "success";
        return true;
    } catch (PDOException $e) {
        $_SESSION['status'] = "Error registering user: " . $e->getMessage();
        $_SESSION['status_icon'] = "error";
        return false;
    }
}


        public function is_email_exists($email) {
            $stmt = $this->pdo->prepare("SELECT COUNT(*) FROM users WHERE email = :email");
            $stmt->execute([':email' => $email]);
            return $stmt->fetchColumn() > 0;
        }

        public function is_username_exists($username) {
            $stmt = $this->pdo->prepare("SELECT COUNT(*) FROM users WHERE username = :username");
            $stmt->execute([':username' => $username]);
            return $stmt->fetchColumn() > 0;
        }

        // end regitser 
        // start updaitng 

        public function is_email_exists_except_user($email, $userId) {
            $stmt = $this->pdo->prepare("SELECT COUNT(*) FROM users WHERE email = :email AND user_id != :user_id");
            $stmt->execute([':email' => $email, ':user_id' => $userId]);
            return $stmt->fetchColumn() > 0;
        }
        
        public function is_username_exists_except_user($username, $userId) {
            $stmt = $this->pdo->prepare("SELECT COUNT(*) FROM users WHERE username = :username AND user_id != :user_id");
            $stmt->execute([':username' => $username, ':user_id' => $userId]);
            return $stmt->fetchColumn() > 0;
        }
        
        public function update_user_profile($userId, $fullname, $username, $email, $address, $birthday) {
            $date_updated = date('Y-m-d H:i:s');
            $stmt = $this->pdo->prepare("UPDATE users SET fullname = :fullname, username = :username, email = :email, 
             address = :address, birthday = :birthday, date_updated = :date_updated WHERE user_id = :user_id");
            return $stmt->execute([
                ':fullname' => $fullname,
                ':username' => $username,
                ':email' => $email,
               
                ':address' => $address,
                ':birthday' => $birthday,
                ':date_updated' => $date_updated,
                ':user_id' => $userId
            ]);
        }
        
        public function update_user_photo($userId, $photoPath) {
            try {
                $stmt = $this->pdo->prepare("UPDATE users SET user_photo = :photo WHERE user_id = :user_id");
                $stmt->execute([
                    ':photo' => $photoPath,
                    ':user_id' => $userId
                ]);
                return true;
            } catch (PDOException $e) {
                // Handle error
                return false;
            }
        }
        
       //login for users
       public function updateVisitorDataWithUserId($ip, $userId) {
        $geoplugin = new geoPlugin();
        $geoplugin->locate($ip);
        
        $city = $geoplugin->city;
        $region = $geoplugin->region;
        $country = $geoplugin->countryName;
        $latitude = $geoplugin->latitude;
        $longitude = $geoplugin->longitude;
    
        $stmt = $this->pdo->prepare("SELECT * FROM visitor_data WHERE ip = :ip AND visit_time >= NOW() - INTERVAL 1 DAY");
        $stmt->execute([':ip' => $ip]);
        $visitor = $stmt->fetch(PDO::FETCH_ASSOC);
    
        if ($visitor) {
            $updateVisitorStmt = $this->pdo->prepare("UPDATE visitor_data SET user_id = :user_id, city = :city, region = :region, country = :country, latitude = :latitude, longitude = :longitude WHERE id = :id");
            $updateVisitorStmt->execute([
                ':user_id' => $userId,
                ':city' => $city,
                ':region' => $region,
                ':country' => $country,
                ':latitude' => $latitude,
                ':longitude' => $longitude,
                ':id' => $visitor['id']
            ]);
        }
    }
    

    public function insertIpAddress($userId, $ip) {
        $insertIpStmt = $this->pdo->prepare("INSERT INTO ip_addresses (user_id, ip) VALUES (:user_id, :ip) ON DUPLICATE KEY UPDATE ip = :ip");
        $insertIpStmt->execute([':user_id' => $userId, ':ip' => $ip]);
    }
   
    public function user_login($emailOrUsername, $password) {
        try {
            $stmt = $this->pdo->prepare("SELECT * FROM users WHERE email = :emailOrUsername OR username = :emailOrUsername LIMIT 1");
            $stmt->execute([':emailOrUsername' => $emailOrUsername]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
            if ($user && password_verify($password, $user['password'])) {
                $updateStmt = $this->pdo->prepare("UPDATE users SET last_login = NOW() WHERE user_id = :user_id");
                $updateStmt->execute([':user_id' => $user['user_id']]);
    
                $geoplugin = new geoPlugin();
                $ip = $_SERVER['REMOTE_ADDR'];
    
                if ($ip == '127.0.0.1' || $ip == '::1') {
                    $ip = '112.198.194.108';
                }
    
                // Locate IP using geoPlugin
                $geoplugin->locate($ip);
    
                // Check if there is any recent visitor with the same user_id and ip
                $stmt = $this->pdo->prepare("SELECT * FROM visitor_data WHERE user_id = :user_id AND ip = :ip AND visit_time >= NOW() - INTERVAL 1 DAY");
                $stmt->execute([':user_id' => $user['user_id'], ':ip' => $ip]);
                $visitor = $stmt->fetch(PDO::FETCH_ASSOC);
    
                if ($visitor) {
                    // Update the visitor_data with the user_id only if user_id is currently NULL
                    if (is_null($visitor['user_id'])) {
                        $updateVisitorStmt = $this->pdo->prepare("UPDATE visitor_data SET user_id = :user_id WHERE id = :id");
                        $updateVisitorStmt->execute([':user_id' => $user['user_id'], ':id' => $visitor['id']]);
                    }
                } else {
                    // Insert new record if no matching user_id and ip for the current day
                    $insertVisitorStmt = $this->pdo->prepare("INSERT INTO visitor_data (user_id, ip, city, region, country, latitude, longitude, visit_time, visit_count) 
                                                             VALUES (:user_id, :ip, :city, :region, :country, :latitude, :longitude, NOW(), 1)");
                    $insertVisitorStmt->execute([
                        ':user_id' => $user['user_id'],
                        ':ip' => $ip,
                        ':city' => $geoplugin->city,
                        ':region' => $geoplugin->region,
                        ':country' => $geoplugin->countryName,
                        ':latitude' => $geoplugin->latitude,
                        ':longitude' => $geoplugin->longitude
                    ]);
                }
    
                // Check if there is already a record in user_ips with the same user_id and ip
                $stmt = $this->pdo->prepare("SELECT * FROM user_ips WHERE user_id = :user_id AND ip = :ip");
                $stmt->execute([':user_id' => $user['user_id'], ':ip' => $ip]);
                $existingIp = $stmt->fetch(PDO::FETCH_ASSOC);
    
                if (!$existingIp) {
                    // Insert into user_ips to associate the IP with the user only if no existing record is found
                    $insertIpStmt = $this->pdo->prepare("INSERT INTO user_ips (user_id, ip) VALUES (:user_id, :ip)");
                    $insertIpStmt->execute([':user_id' => $user['user_id'], ':ip' => $ip]);
                }
    
                return $user;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }
    
    
    
        // public function user_login($email, $password) {
        //     try {
        //         $stmt = $this->pdo->prepare("SELECT * FROM users WHERE email = :email LIMIT 1");
        //         $stmt->execute([':email' => $email]);
        //         $user = $stmt->fetch(PDO::FETCH_ASSOC);
        
        //         if ($user && password_verify($password, $user['password'])) {
                   
        //             $updateStmt = $this->pdo->prepare("UPDATE users SET last_login = NOW() WHERE user_id = :user_id");
        //             $updateStmt->execute([':user_id' => $user['user_id']]);
                    
                   
        //             return $user;
        //         } else {
        //             return false;
        //         }
        //     } catch (PDOException $e) {
        //         echo $e->getMessage();
        //         return false;
        //     }
        // }
        

        public function get_user_info() {
            if (isset($_SESSION['user_id'])) {
                $user_id = $_SESSION['user_id'];
                $stmt = $this->pdo->prepare("SELECT * FROM users WHERE user_id = :user_id");
                $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
                $stmt->execute();
                return $stmt->fetch(PDO::FETCH_ASSOC);
            }
            return null;
        }


        public function saveFileInfo($userId, $title, $description, $fileTypeId, $fileName, $filePath) {
            try {
                $stmt = $this->pdo->prepare("INSERT INTO files (user_id, title, description, file_type, file_path) VALUES
                 (:user_id, :title, :description, :file_type, :file_path)");
                $stmt->bindParam(':user_id', $userId);
                $stmt->bindParam(':title', $title);
                $stmt->bindParam(':description', $description);
                $stmt->bindParam(':file_type', $fileTypeId);
                $stmt->bindParam(':file_path', $filePath);
                $stmt->execute();
    
                $_SESSION['status'] = "File successfully uploaded!";
                $_SESSION['status_icon'] = "success";
                return true;
            } catch (PDOException $e) {
                $_SESSION['status'] = "Error uploading file: " . $e->getMessage();
                $_SESSION['status_icon'] = "error";
                return false;
            }
        }


        
        


}
?>

