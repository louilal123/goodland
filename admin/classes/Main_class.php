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

    public function fetchApprovedDocuments() {
        $stmt = $this->pdo->prepare("SELECT f.id, f.user_id, f.title, f.description, f.file_path, f.file_type, 
            f.upload_date, f.status, f.remarks, f.isDeleted, u.fullname AS uploader_fullname
            FROM files f
            INNER JOIN users u ON f.user_id = u.user_id
            WHERE f.status = 'Approved' AND f.isDeleted = 0");
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
    
    // for login
    public function login_user($email, $password) {
        session_start();
        
        $stmt = $this->pdo->prepare("SELECT admin_id, password FROM admin WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            if (password_verify($password, $user['password'])) {
                $_SESSION['admin_id'] = htmlentities($user['admin_id']);
                $_SESSION['email'] = htmlentities($user['email']);
                $_SESSION['status'] = "Login Successful!";
                $_SESSION['status_icon'] = "success";
                header("Location: ../dashboard.php");
                exit();
            } else {
                $_SESSION['error_message'] = "Invalid credentials! Please try again.";
            }
        } else {
            $_SESSION['error_message'] = "Invalid credentials! Please try again.";
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


public function count_all_files() {
    $stmt = $this->pdo->prepare("SELECT COUNT(*) AS total FROM files");
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result['total'];
}

public function count_all_pending_files() {
    $stmt = $this->pdo->prepare("SELECT COUNT(*) AS total FROM files WHERE status = 'Pending' ");
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result['total'];
}
public function count_all_declined_files() {
    $stmt = $this->pdo->prepare("SELECT COUNT(*) AS total FROM files WHERE status = 'Declined' ");
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result['total'];
}
public function count_approved_files() {
    $stmt = $this->pdo->prepare("SELECT COUNT(*) AS total FROM files WHERE status = 'Approved' ");
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result['total'];
}
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



public function count_user_files($userId) {
    try {
        $stmt = $this->pdo->prepare("
            SELECT 
                COUNT(*) AS user_total,
                SUM(status = 'Pending') AS user_pending,
                SUM(status = 'Approved') AS user_approved,
                SUM(status = 'Disapproved') AS user_declined
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




// public function insert_document($title, $cover, $author, $publication_date, $file_path, $description, $uploaded_by, $category, $status) {
//     $sql = "INSERT INTO documents (title, cover, author, publication_date, file_path, description, uploaded_by, uploaded_at, category, date_created, date_updated, isdeleted, status) 
//             VALUES (:title, :cover, :author, :publication_date, :file_path, :description, :uploaded_by, NOW(), :category, NOW(), NOW(), 0, :status)";
//     $stmt = $this->pdo->prepare($sql);

//     $stmt->bindParam(':title', $title);
//     $stmt->bindParam(':cover', $cover, PDO::PARAM_STR);
//     $stmt->bindParam(':author', $author);
//     $stmt->bindParam(':publication_date', $publication_date);
//     $stmt->bindParam(':file_path', $file_path);
//     $stmt->bindParam(':description', $description);
//     $stmt->bindParam(':uploaded_by', $uploaded_by);
//     $stmt->bindParam(':category', $category);
//     $stmt->bindParam(':status', $status);

//     return $stmt->execute();
// }

// public function add_document($title, $cover, $file_path) {
//     $sql = "INSERT INTO documents (title, cover, file_path, uploaded_at) 
//             VALUES (:title, :cover, :file_path, NOW())";
//     $stmt = $this->pdo->prepare($sql);

//     $stmt->bindParam(':title', $title);
//     $stmt->bindParam(':cover', $cover, PDO::PARAM_STR);
//     $stmt->bindParam(':file_path', $file_path, PDO::PARAM_STR);

//     return $stmt->execute();
// }





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

        public function user_login($email, $password) {
            try {
                $stmt = $this->pdo->prepare("SELECT * FROM users WHERE email = :email LIMIT 1");
                $stmt->execute([':email' => $email]);
                $user = $stmt->fetch(PDO::FETCH_ASSOC);
        
                if ($user && password_verify($password, $user['password'])) {
                    return $user;
                } else {
                    return false;
                }
            } catch (PDOException $e) {
                echo $e->getMessage();
                return false;
            }
        }

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

