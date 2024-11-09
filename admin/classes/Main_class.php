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
    
    // calendar 
    public function getFileRequestsByVisitor($visitor_id) {
        $stmt = $this->pdo->prepare("SELECT request_id, file_id, email, status, request_date FROM file_requests WHERE visitor_id = ?");
        $stmt->execute([$visitor_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    //
    public function getEvents()
    {
        $query = "SELECT event_id, event_name, event_photo, description, location, date_start, date_end FROM events WHERE status = 'active'";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    //passsowrd reset
    // Check if email exists
public function emailIsExists($email) {
    $stmt = $this->pdo->prepare("SELECT 1 FROM admin WHERE email = :email");
    $stmt->execute(['email' => $email]);
    return $stmt->fetchColumn() ? true : false;
}

    // public function initiatePasswordReset($email) {
    
    //     $stmt = $this->pdo->prepare("SELECT * FROM admin WHERE email = :email");
    //     $stmt->execute(['email' => $email]);
    //     $user = $stmt->fetch(PDO::FETCH_ASSOC);

    //     if ($user) {
    //         $otp = rand(100000, 999999);
    //         $expiry = date("Y-m-d H:i:s", strtotime("+1 day")); 

    //         $updateStmt = $this->pdo->prepare("UPDATE admin SET reset_otp = :otp, reset_expires = :expiry WHERE email = :email");
    //         $updateStmt->execute(['otp' => $otp, 'expiry' => $expiry, 'email' => $email]);

    //         return $otp;
    //     }

    //     return false; 
    // }
    public function initiatePasswordReset($email) {
        // Check if the email exists in the `admin` table
        $stmt = $this->pdo->prepare("SELECT admin_id FROM admin WHERE email = :email");
        $stmt->execute(['email' => $email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
        if ($user) {
            // Generate a 6-digit OTP and set expiration
            $otp = rand(100000, 999999);
            $expiry = date("Y-m-d H:i:s", strtotime("+1 day"));
            
            // Insert OTP and expiration into `password_resets` table
            $insertStmt = $this->pdo->prepare("
                INSERT INTO password_resets (admin_id, otp, expires_at, date_created) 
                VALUES (:admin_id, :otp, :expires_at, NOW())
                ON DUPLICATE KEY UPDATE otp = :otp, expires_at = :expires_at, date_created = NOW()
            ");
            $insertStmt->execute([
                'admin_id' => $user['admin_id'],
                'otp' => $otp,
                'expires_at' => $expiry,
            ]);
    
            return $otp; // Return OTP for email sending
        }
    
        return false; // Email not found
    }

    public function verifyOtp($email, $otp) {
        $stmt = $this->pdo->prepare("SELECT admin_id FROM admin WHERE email = :email");
        $stmt->execute(['email' => $email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
        if ($user) {
            $admin_id = $user['admin_id'];
            $stmt = $this->pdo->prepare("SELECT otp, expires_at FROM password_resets WHERE admin_id = :admin_id ORDER BY date_created DESC LIMIT 1");
            $stmt->execute(['admin_id' => $admin_id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }
    
        return false;
    }
    
    public function resetPassword($email, $new_password) {
        $hashed_password = password_hash($new_password, PASSWORD_BCRYPT);
        
        // Update the password in the admin table
        $stmt = $this->pdo->prepare("UPDATE admin SET password = :password WHERE email = :email");
        $passwordUpdated = $stmt->execute(['password' => $hashed_password, 'email' => $email]); // Returns true on success
    
        if ($passwordUpdated) {
            // Update the OTP in the password_resets table to NULL or delete the entry
            $updateOtpStmt = $this->pdo->prepare("UPDATE password_resets SET otp = NULL, expires_at = NULL WHERE admin_id = (SELECT admin_id FROM admin WHERE email = :email)");
            $updateOtpStmt->execute(['email' => $email]);
        }
    
        return $passwordUpdated; // Return true if the password was updated successfully
    }

    // events start 
    public function getScheduledEvents() {
        $sql = "SELECT * FROM events WHERE status = 'upcoming' ORDER BY event_date ASC";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function getOngoingEvents() {
        $sql = "SELECT * FROM events WHERE status = 'ongoing' ORDER BY event_date ASC";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function getFinishedEvents() {
        $sql = "SELECT * FROM events WHERE status = 'finished' ORDER BY event_date DESC";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    
    // end 

    public function getAllFileRequests() {
        $sql = "
            SELECT fr.request_id, fr.visitor_id, fr.email, fr.request_date, 
                   f.title, f.description, f.upload_date, f.status AS file_status
            FROM file_requests AS fr
            JOIN files AS f ON fr.file_id = f.id
            ORDER BY fr.request_date ASC
        ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    
    //count pending re  q
    public function getFileRequestsCount()  {
        $stmt = $this->pdo->prepare("SELECT COUNT(*) as count FROM file_requests ");
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
        return $result['count'];
    }
    // In Main_class.php
public function getFileById($fileId) {
    $stmt = $this->pdo->prepare("SELECT * FROM files WHERE id = :id AND isDeleted = 0");
    $stmt->execute([':id' => $fileId]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

    //water data 
    public function trackVisitor() {
        $geoplugin = new geoPlugin();
        
        $ip = $_SERVER['REMOTE_ADDR'];
    
        if ($ip == '127.0.0.1' || $ip == '::1') {
            $ip = '112.198.194.108';
        }
    
        $geoplugin->locate($ip);
    
        $user_agent = $_SERVER['HTTP_USER_AGENT'];
        $country = $geoplugin->countryName;
    
        // Check if the visitor exists in visitor_logs
        $stmt = $this->pdo->prepare("SELECT visitor_id FROM visitor_logs WHERE ip_address = :ip");
        $stmt->execute([':ip' => $ip]);
        $visitor = $stmt->fetch(PDO::FETCH_ASSOC);
    
        if (!$visitor) {
            // Visitor doesn't exist, insert into visitor_logs
            $sql = "INSERT INTO visitor_logs (ip_address, user_agent, country) 
                    VALUES (:ip, :user_agent, :country)";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([
                ':ip' => $ip,
                ':user_agent' => $user_agent,
                ':country' => $country
            ]);
    
            // Get the newly inserted visitor_id
            $visitor_id = $this->pdo->lastInsertId();
        } else {
            // Visitor exists, retrieve visitor_id
            $visitor_id = $visitor['visitor_id'];
        }
    
        // Check if there is a session entry for today based on visit_time
        $stmt = $this->pdo->prepare("SELECT session_id, visit_count FROM sessions WHERE visitor_id = :visitor_id AND DATE(visit_time) = CURDATE()");
        $stmt->execute([':visitor_id' => $visitor_id]);
    
        $session = $stmt->fetch(PDO::FETCH_ASSOC);
    
        if ($session) {
            // Update the existing session
            $sql = "UPDATE sessions 
                    SET last_visit = NOW(), visit_count = visit_count + 1 
                    WHERE session_id = :session_id";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([':session_id' => $session['session_id']]);
        } else {
            // Create a new session for today
            $sql = "INSERT INTO sessions (visitor_id, visit_time, last_visit, visit_count) 
                    VALUES (:visitor_id, NOW(), NOW(), 1)";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([
                ':visitor_id' => $visitor_id
            ]);
        }
    }
    public function countAllWebsiteVisitors()  {
        $stmt = $this->pdo->prepare("SELECT COUNT(*) as count FROM visitor_logs ");
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
        return $result['count'];
    }
    
    public function getAllVisitors() {
        $sql = "SELECT * FROM visitor_logs ORDER BY date_added asc";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    // <!-- SELECT `data_id`, `water_level`, `humidity`, `temperature`, `date_time` FROM `catchment_data` WHERE 1 -->
                   
    public function  getCatchmentData() {
        $sql = "SELECT * FROM catchment_data ORDER BY date_time asc";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    // getAllSubscribers
    public function  getAllSubscribers() {
        $sql = "SELECT * FROM subscriptions ORDER BY subscribed_at asc";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function storeDHT11Data($temperature, $humidity, $water_level)
    {
        try {
            // Prepare the SQL query for inserting data into the water_data table
            $sql = "INSERT INTO water_data (data_id, water_level, humidity, temperature, date_time)
                    VALUES (:data_id, :water_level, :humidity, :temperature, NOW())";
            $stmt = $this->pdo->prepare($sql);
            
            // Execute the query with the provided data
            $stmt->execute([
                ':data_id' => $data_id, // Default to 1 or pass data_id
                ':water_level' => $water_level,
                ':humidity' => $humidity,
                ':temperature' => $temperature
            ]);

            return "Data inserted successfully!";

        } catch (PDOException $e) {
            // Handle any errors
            return "Error: " . $e->getMessage();
        }
    }
    //PROJECTS
 
    public function addProject($title, $header, $image_path, $summary, $banner_quote, $youtube_link)
    {
        $sql = "INSERT INTO projects (title, header, project_image, summary, banner_quote, youtube_link, created_at)
                VALUES (:title, :header, :project_image, :summary, :banner_quote, :youtube_link, NOW())";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ':title' => $title,
            ':header' => $header,
            ':project_image' => $image_path,
            ':summary' => $summary,
            ':banner_quote' => $banner_quote,
            ':youtube_link' => $youtube_link
        ]);
        return $this->pdo->lastInsertId();
    }

    public function addProjectSection($project_id, $content_type, $content, $order)
    {
        $sql = "INSERT INTO project_sections (project_id, content_type, content, `order`, created_at)
                VALUES (:project_id, :content_type, :content, :order, NOW())";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ':project_id' => $project_id,
            ':content_type' => $content_type,
            ':content' => $content,
            ':order' => $order
        ]);
    }

    public function getPublishedFiles() {
        $sql = "SELECT f.`id`, f.`admin_id`, f.`title`, f.`cover_path`, f.`description`, f.`file_path`, f.`upload_date`, 
                       f.`status`,  u.`fullname` 
                FROM `files` f 
                JOIN `admin` u ON f.`admin_id` = u.`admin_id`
                WHERE f.`status` = 'published' AND f.`isDeleted` = 0";
        //  1 for published 
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    

    public function getAllProjects() {
        $sql = "SELECT * FROM projects ORDER BY created_at DESC";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getAllPublishedProjects() {
        $sql = "SELECT * FROM projects  ORDER BY created_at DESC ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
   public function countAllProjects()  {
    $stmt = $this->pdo->prepare("SELECT COUNT(*) as project_count FROM projects ");
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    return $result['project_count'];
}
   
public function getAllCatchments() {
    $sql = "SELECT * FROM catchment_locations ORDER BY date_added DESC";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
public function insert_catchment($catchment_name, $description, $location, $catchment_img) {
    $sql = "INSERT INTO catchment_locations (catchment_name, description, location, catchment_img, date_added) 
            VALUES (:catchment_name, :description, :location, :catchment_img, NOW())";
    $stmt = $this->pdo->prepare($sql);
    $stmt->bindParam(':catchment_name', $catchment_name);
    $stmt->bindParam(':description', $description);
    $stmt->bindParam(':location', $location);
    $stmt->bindParam(':catchment_img', $catchment_img);
    return $stmt->execute();
}
public function countAllCatchments()  {
    $stmt = $this->pdo->prepare("SELECT COUNT(*) as catchment_count FROM catchment_locations ");
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    return $result['catchment_count'];
}




public function delete_catchment($data_id) {
    $stmt = $this->pdo->prepare("DELETE FROM catchment_locations WHERE data_id = :data_id");
    $stmt->bindParam(':data_id', $data_id);
    return $stmt->execute();
}




public function getProjectById($projectId) {
    $sql = "
        SELECT 
            p.project_id, 
            p.banner_quote, 
            p.title, 
            p.header, 
            p.project_image, 
            p.summary, 
            p.created_at AS project_created_at, 
            p.updated_at AS project_updated_at, 
            p.youtube_link,
            ps.section_id, 
            ps.content_type, 
            ps.content, 
            ps.`order`, 
            ps.created_at AS section_created_at, 
            ps.updated_at AS section_updated_at
        FROM 
            projects p
        LEFT JOIN 
            project_sections ps ON p.project_id = ps.project_id
        WHERE 
            p.project_id = :project_id
        ORDER BY 
            ps.`order` ASC";
    
    $stmt = $this->pdo->prepare($sql);
    $stmt->bindParam(':project_id', $projectId, PDO::PARAM_INT);
    $stmt->execute();
    
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

public function getCatchmentById($data_id) {
    $sql = "
        SELECT 
            cl.data_id,
            cl.catchment_name,
            cl.description,
            cl.catchment_img,
            cl.location,
            cl.date_added,
            cl.date_updated,
            wd.data_id,
            wd.water_level,
            wd.humidity,
            wd.temperature,
            wd.date_time
        FROM 
            catchment_locations cl
        LEFT JOIN 
            water_data wd
        ON 
            cl.data_id = wd.data_id
        WHERE 
            cl.data_id = :data_id
    ";
    
    $stmt = $this->pdo->prepare($sql);
    $stmt->bindParam(':data_id', $data_id, PDO::PARAM_INT);
    $stmt->execute();
    
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


    

    // END PROJECTS

    public function delete_all_messages() {
        $sql = "DELETE FROM messages";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
    }
    
    public function delete_message($messageId) {
        $sql = "DELETE FROM messages WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $messageId, PDO::PARAM_INT);
        $stmt->execute();
    }
   
    
    public function saveFileRequest($file_id, $visitor_id, $email) {
        try {
            // Prepare the SQL query
            $stmt = $this->pdo->prepare("INSERT INTO file_requests (file_id, visitor_id, email) VALUES (:file_id, :visitor_id, :email)");
    
            // Bind parameters
            $stmt->bindParam(':file_id', $file_id);
            $stmt->bindParam(':visitor_id', $visitor_id);
            $stmt->bindParam(':email', $email);
    
            // Execute the query
            $stmt->execute();
        } catch (PDOException $e) {
            throw new Exception("Failed to save file request: " . $e->getMessage());
        }
    }
    
    
    public function save_contact_message($name, $email, $subject, $message) {
        $sql = "INSERT INTO messages (name, email, subject, message) VALUES (:name, :email, :subject, :message)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':subject', $subject, PDO::PARAM_STR);
        $stmt->bindParam(':message', $message, PDO::PARAM_STR);
        $stmt->execute();
    }
//notifications messages
    public function get_unread_messages() {
        $sql = "SELECT * FROM messages WHERE status = 'unread' ORDER BY date_sent DESC";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function get_unread_message_count() {
        $sql = "SELECT COUNT(*) FROM messages WHERE status = 'unread'";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchColumn();
    }
    
    // notifications messaeges end 
    
    // admin dashboard 
    public function getStatusTypeData()
    {
        $sql = "SELECT status, COUNT(*) as count 
                FROM files 
                WHERE isDeleted = 0 
                GROUP BY status";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
        // Calculate total count for percentage calculation
        $total = array_sum(array_column($result, 'count'));
    
        $data = [];
        foreach ($result as $row) {
            $percentage = $total ? ($row['count'] / $total) * 100 : 0;
            $data[] = [
                'name' => ucfirst($row['status']),
                'y' => (int) $row['count'],
                'percentage' => round($percentage, 2) // Rounded percentage
            ];
        }
    
        return $data;
    }
    
    // water level daata 
    public function getHourlyData()
    {
        $sqlHourly = "SELECT 
                        HOUR(date_time) AS hour, 
                        AVG(water_level) AS avg_water_level,
                        AVG(humidity) AS avg_humidity,
                        AVG(temperature) AS avg_temperature
                    FROM catchment_data
                    WHERE YEAR(date_time) = YEAR(CURDATE()) AND MONTH(date_time) = MONTH(CURDATE())
                    GROUP BY HOUR(date_time)";
        
        $stmtHourly = $this->pdo->prepare($sqlHourly);
        $stmtHourly->execute();
        $hourlyResult = $stmtHourly->fetchAll(PDO::FETCH_ASSOC);
    
        // Prepare data for Highcharts (hourly)
        $data = [
            'waterLevel' => array_fill(0, 24, 0), // Initialize with 0 for all 24 hours
            'temperature' => array_fill(0, 24, 0),
            'humidity' => array_fill(0, 24, 0),
            'hourly' => []
        ];
    
        // Fill hourly data (for 0 to 23 hours)
        foreach ($hourlyResult as $row) {
            $hourIndex = (int)$row['hour']; // Index for hour 0-23
            $data['waterLevel'][$hourIndex] = (float)$row['avg_water_level'];
            $data['temperature'][$hourIndex] = (float)$row['avg_temperature'];
            $data['humidity'][$hourIndex] = (float)$row['avg_humidity'];
        }
    
        return $data;
    }
    
    public function getDailyData()
    {
        $sqlDaily = "SELECT 
                        DAY(date_time) AS day, 
                        AVG(water_level) AS avg_water_level,
                        AVG(humidity) AS avg_humidity,
                        AVG(temperature) AS avg_temperature
                    FROM catchment_data
                    WHERE YEAR(date_time) = YEAR(CURDATE()) AND MONTH(date_time) = MONTH(CURDATE())
                    GROUP BY DAY(date_time)";
        
        $stmtDaily = $this->pdo->prepare($sqlDaily);
        $stmtDaily->execute();
        $dailyResult = $stmtDaily->fetchAll(PDO::FETCH_ASSOC);
    
        // Prepare data for Highcharts (daily)
        $data = [
            'waterLevel' => array_fill(0, 31, 0), // Initialize with 0 for all 31 days
            'temperature' => array_fill(0, 31, 0),
            'humidity' => array_fill(0, 31, 0),
            'daily' => []
        ];
    
        // Fill daily data (for 1 to 30/31 days)
        foreach ($dailyResult as $row) {
            $dayIndex = (int)$row['day'] - 1; // Convert to zero-based index
            $data['waterLevel'][$dayIndex] = (float)$row['avg_water_level'];
            $data['temperature'][$dayIndex] = (float)$row['avg_temperature'];
            $data['humidity'][$dayIndex] = (float)$row['avg_humidity'];
        }
    
        return $data;
    }
    

  public function getMonthlyData()
  {
      $sql = "SELECT 
                  MONTH(date_time) AS month, 
                  AVG(water_level) AS avg_water_level,
                  AVG(humidity) AS avg_humidity,
                  AVG(temperature) AS avg_temperature
              FROM catchment_data
              WHERE YEAR(date_time) = YEAR(CURDATE())
              GROUP BY MONTH(date_time)";
  
      $stmt = $this->pdo->prepare($sql);
      $stmt->execute();
      $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
  
      // Prepare data for Highcharts
      $data = [
          'waterLevel' => array_fill(0, 12, null), // Initialize with nulls for all 12 months
          'temperature' => array_fill(0, 12, null),
          'humidity' => array_fill(0, 12, null),
      ];
  
      // Fill the data arrays with averages for each month
      foreach ($result as $row) {
          // row['month'] will be between 1 (January) to 12 (December)
          $monthIndex = (int)$row['month'] - 1; // Convert to zero-based index
          $data['waterLevel'][$monthIndex] = (float)$row['avg_water_level'];
          $data['temperature'][$monthIndex] = (float)$row['avg_temperature'];
          $data['humidity'][$monthIndex] = (float)$row['avg_humidity'];
      }
  
      return $data;
  }
  
    // end 

    public function is_email_exists($email) {
        $stmt = $this->pdo->prepare("SELECT COUNT(*) FROM admin WHERE email = :email");
        $stmt->execute([':email' => $email]);
        return $stmt->fetchColumn() > 0;
    }
// line h=chart monthly visits website 
// public function get_monthly_visitor_data() {
//     try {
//         $stmt = $this->pdo->prepare("
//             SELECT
//                 DAY(visit_time) AS visit_day,
//                 SUM(CASE WHEN visitor_id IS NOT NULL THEN 1 ELSE 0 END) AS signed_up_visits,
//                 SUM(CASE WHEN admin_id IS NULL THEN 1 ELSE 0 END) AS non_signed_up_visits
//             FROM visitor_data
//             WHERE MONTH(visit_time) = MONTH(CURDATE())
//               AND YEAR(visit_time) = YEAR(CURDATE())
//             GROUP BY visit_day
//             ORDER BY visit_day;
//         ");
//         $stmt->execute();
//         $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
//         $data = [];
//         foreach ($results as $row) {
//             $data[] = [
//                 'day' => (int)$row['visit_day'],
//                 'signed_up' => (int)$row['signed_up_visits'],
//                 'non_signed_up' => (int)$row['non_signed_up_visits']
//             ];
//         }
//         return $data;
//     } catch (PDOException $e) {
//         echo "Error: " . $e->getMessage();
//         return [];
//     }
// }


// public function get_visitor_data_for_current_month() {
//     $stmt = $this->pdo->prepare("
//         SELECT v.id, v.admin_id, v.ip, v.city, v.region, v.country, v.latitude, v.longitude, v.visit_time, v.visit_count, u.fullname
//         FROM visitor_data v
//         LEFT JOIN admin u ON v.admin_id = u.admin_id
//         WHERE MONTH(v.visit_time) = MONTH(CURRENT_DATE())
//         AND YEAR(v.visit_time) = YEAR(CURRENT_DATE())
//         ORDER BY v.visit_time DESC
//     ");
//     $stmt->execute();
//     return $stmt->fetchAll(PDO::FETCH_ASSOC);
// }

// public function get_download_data_for_current_month() {
//     $stmt = $this->pdo->prepare("
//         SELECT d.id, d.file_id, d.admin_id, d.download_time, u.fullname, f.title
//         FROM downloads d
//         LEFT JOIN admin u ON d.admin_id = u.admin_id
//         LEFT JOIN files f ON d.file_id = f.id
//         WHERE MONTH(d.download_time) = MONTH(CURRENT_DATE())
//         AND YEAR(d.download_time) = YEAR(CURRENT_DATE())
//         ORDER BY d.download_time DESC
//     ");
//     $stmt->execute();
//     return $stmt->fetchAll(PDO::FETCH_ASSOC);
// }

    
    // public function trackVisitor() {
    //     $geoplugin = new geoPlugin();
        
    //     $ip = $_SERVER['REMOTE_ADDR'];
    
    //     if ($ip == '127.0.0.1' || $ip == '::1') {
    //         $ip = '112.198.194.108';
    //     }
    
    //     $geoplugin->locate($ip);
    
    //     $city = $geoplugin->city;
    //     $region = $geoplugin->region;
    //     $country = $geoplugin->countryName;
    //     $latitude = $geoplugin->latitude;
    //     $longitude = $geoplugin->longitude;
    
    //     $stmt = $this->pdo->prepare("SELECT * FROM visitor_data WHERE ip = :ip AND DATE(visit_time) = CURDATE()");
    //     $stmt->execute([':ip' => $ip]);
    //     $existingVisit = $stmt->fetch(PDO::FETCH_ASSOC);
    
    //     if ($existingVisit) {
    //         $stmt = $this->pdo->prepare("UPDATE visitor_data SET visit_count = visit_count + 1 WHERE ip = :ip AND DATE(visit_time) = CURDATE()");
    //         $stmt->execute([':ip' => $ip]);
    //     } else {
    //         $sql = "INSERT INTO visitor_data (ip, city, region, country, latitude, longitude, visit_time, visit_count) 
    //                 VALUES (:ip, :city, :region, :country, :latitude, :longitude, NOW(), 1)";
    
    //         $stmt = $this->pdo->prepare($sql);
    //         $stmt->execute([
    //             ':ip' => $ip,
    //             ':city' => $city,
    //             ':region' => $region,
    //             ':country' => $country,
    //             ':latitude' => $latitude,
    //             ':longitude' => $longitude
    //         ]);
    //     }
    // }
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
// public function getDownloadData($currentMonth, $currentYear, $isSignedIn) {
//     $userCondition = $isSignedIn ? 'IS NOT NULL' : 'IS NULL';
//     $stmt = $this->pdo->prepare("
//         SELECT DAY(download_time) as download_day, COUNT(*) as download_count 
//         FROM downloads 
//         WHERE admin_id $userCondition
//         AND MONTH(download_time) = :currentMonth 
//         AND YEAR(download_time) = :currentYear 
//         GROUP BY DAY(download_time)
//     ");
//     $stmt->execute(['currentMonth' => $currentMonth, 'currentYear' => $currentYear]);
//     return $stmt->fetchAll(PDO::FETCH_ASSOC);
// }

// end 
    // public function getVisitors() {
    //     $stmt = $this->pdo->prepare("
    //         SELECT  v.id, v.admin_id, v.ip, v.city, v.region, v.country, v.latitude, v.longitude,  v.visit_time, v.visit_count, u.fullname
    //          FROM visitor_data v
    //         LEFT JOIN 
    //             admin u ON v.admin_id = u.admin_id
    //         ORDER BY 
    //             v.visit_time DESC
    //     ");
    //     $stmt->execute();
    //     return $stmt->fetchAll(PDO::FETCH_ASSOC);
    // }
    
    // public function getDownloads() {
    //     $stmt = $this->pdo->prepare("
    //         SELECT d.id, d.file_id, d.admin_id, d.download_time, 
    //                u.fullname, f.title
    //         FROM downloads d
    //         LEFT JOIN admin u ON d.admin_id = u.admin_id
    //         LEFT JOIN files f ON d.file_id = f.id
    //         ORDER BY d.download_time DESC
    //     ");
    //     $stmt->execute();
    //     return $stmt->fetchAll(PDO::FETCH_ASSOC);
    // }
    
   

//line cahrt end


    // public function isDownloadRecorded($file_id, $admin_id) {
    //     $stmt = $this->pdo->prepare("
    //         SELECT COUNT(*) FROM downloads 
    //         WHERE file_id = :file_id AND (admin_id = :admin_id OR :admin_id IS NULL)
    //     ");
    //     $stmt->execute(['file_id' => $file_id, 'admin_id' => $admin_id]);
    //     return $stmt->fetchColumn() > 0;
    // }
    
    // public function recordDownload($file_id, $admin_id) {
    //     // Insert the new record
    //     $stmt = $this->pdo->prepare("
    //         INSERT INTO downloads (file_id, admin_id, download_time) 
    //         VALUES (:file_id, :admin_id, NOW())
    //     ");
    //     return $stmt->execute(['file_id' => $file_id, 'admin_id' => $admin_id]);
    // }
    
    
    
    // public function getUserNotifications($admin_id) {
    //     $stmt = $this->pdo->prepare("SELECT id, file_id, message, is_read, created_at FROM user_notifications WHERE admin_id = ? ORDER BY created_at DESC");
    //     $stmt->execute([$admin_id]);
    //     return $stmt->fetchAll(PDO::FETCH_ASSOC);
    // }
    
    // public function getUnreadNotificationCount($admin_id) {
    //     $stmt = $this->pdo->prepare("SELECT COUNT(*) FROM user_notifications WHERE admin_id = ? AND is_read = 0");
    //     $stmt->execute([$admin_id]);
    //     return $stmt->fetchColumn();
    // }
    

    // public function approveFile($file_id, $remarks) {
    //     try {
    //         $query = "UPDATE files SET status = 'Approved', remarks = ? WHERE id = ?";
    //         $stmt = $this->pdo->prepare($query);
    //         $stmt->execute([$remarks, $file_id]);
    
    //         $fileQuery = "SELECT admin_id, title, upload_date FROM files WHERE id = ?";
    //         $fileStmt = $this->pdo->prepare($fileQuery);
    //         $fileStmt->execute([$file_id]);
    //         $file = $fileStmt->fetch();
    
    //         if ($file) {
    //             $message = "Your file <strong> ".$file['title']."</strong> has been approved 
    //             and successfully published to the website.";
    //             $notificationQuery = "INSERT INTO user_notifications (admin_id, file_id, message) VALUES (?, ?, ?)";
    //             $notificationStmt = $this->pdo->prepare($notificationQuery);
    //             $notificationStmt->execute([$file['admin_id'], $file_id, $message]);
    //         }
    
    //         return true;
    //     } catch (PDOException $e) {
    //         return false;
    //     }
    // }

    // recycle declined files 
    
    // public function addToPending($file_id, $remarks) {
    //     try {
    //         $query = "UPDATE files SET status = 'Pending', remarks = ? WHERE id = ?";
    //         $stmt = $this->pdo->prepare($query);
    //         $stmt->execute([$remarks, $file_id]);
    
    //         $fileQuery = "SELECT admin_id, title, upload_date FROM files WHERE id = ?";
    //         $fileStmt = $this->pdo->prepare($fileQuery);
    //         $fileStmt->execute([$file_id]);
    //         $file = $fileStmt->fetch();
    
    //         if ($file) {
    //             $message = "Your approvedfile <strong> ".$file['title']."</strong> is under investigation for upload agreement violations. 
    //             We have decided to take it down from the website temporarily.";
    //             $notificationQuery = "INSERT INTO user_notifications (admin_id, file_id, message) VALUES (?, ?, ?)";
    //             $notificationStmt = $this->pdo->prepare($notificationQuery);
    //             $notificationStmt->execute([$file['admin_id'], $file_id, $message]);
    //         }
    
    //         return true;
    //     } catch (PDOException $e) {
    //         return false;
    //     }
    // }
    // public function addToPending1($file_id, $remarks) {
    //     try {
    //         $query = "UPDATE files SET status = 'Pending', remarks = ? WHERE id = ?";
    //         $stmt = $this->pdo->prepare($query);
    //         $stmt->execute([$remarks, $file_id]);
    
    //         $fileQuery = "SELECT admin_id, title, upload_date FROM files WHERE id = ?";
    //         $fileStmt = $this->pdo->prepare($fileQuery);
    //         $fileStmt->execute([$file_id]);
    //         $file = $fileStmt->fetch();
    
    //         if ($file) {
    //             $message = "Your approvedfile <strong> ".$file['title']."</strong> is under investigation for upload agreement violations. 
    //             We have decided to take it down from the website temporarily.";
    //             $notificationQuery = "INSERT INTO user_notifications (admin_id, file_id, message) VALUES (?, ?, ?)";
    //             $notificationStmt = $this->pdo->prepare($notificationQuery);
    //             $notificationStmt->execute([$file['admin_id'], $file_id, $message]);
    //         }
    
    //         return true;
    //     } catch (PDOException $e) {
    //         return false;
    //     }
    // }
    //for recosndier buttons from declined files
    
    // public function declineFile($file_id, $remarks) {
    //     try {
    //         $query = "UPDATE files SET status = 'Archive', remarks = ? WHERE id = ?";
    //         $stmt = $this->pdo->prepare($query);
    //         $stmt->execute([$remarks, $file_id]);
    
    //         $fileQuery = "SELECT admin_id, title, upload_date FROM files WHERE id = ?";
    //         $fileStmt = $this->pdo->prepare($fileQuery);
    //         $fileStmt->execute([$file_id]);
    //         $file = $fileStmt->fetch();
    
    //         if ($file) {
    //             $message = "Your uploaded file (".$file['title'].") on (".$file['upload_date'].") has been declined.";
    //             $notificationQuery = "INSERT INTO user_notifications (admin_id, file_id, message) VALUES (?, ?, ?)";
    //             $notificationStmt = $this->pdo->prepare($notificationQuery);
    //             $notificationStmt->execute([$file['admin_id'], $file_id, $message]);
    //         }
    
    //         return true;
    //     } catch (PDOException $e) {
    //         return false;
    //     }
    // }

      
    // public function restoreFile($file_id) {
    //     try {
    //         $query = "UPDATE files SET status = 'Declined' WHERE id = ?";
    //         $stmt = $this->pdo->prepare($query);
    //         $stmt->execute([$file_id]);
    
    //         return true;
    //     } catch (PDOException $e) {
    //         return false;
    //     }
    // }
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
            $query = "delete * from files ";
            $stmt = $this->pdo->prepare($query);
            $stmt->execute([$file_id]);
    
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }
    
    
    public function changePassword($userId, $currentPassword, $newPassword) {
        try {
            $stmt = $this->pdo->prepare("SELECT password FROM admin WHERE admin_id = :userId");
            $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetch();
    
            if ($result && password_verify($currentPassword, $result['password'])) {
                $newPasswordHash = password_hash($newPassword, PASSWORD_DEFAULT);
                $updateStmt = $this->pdo->prepare("UPDATE admin SET password = :newPassword WHERE admin_id = :userId");
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
    public function login_user($emailOrUsername, $password) {
        $stmt = $this->pdo->prepare("SELECT admin_id, email, username, password FROM admin WHERE email = :emailOrUsername OR 
        username = :emailOrUsername");
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
                return false; // Invalid password
            }
        } else {
            return false; // User not found
        }
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

 //user details currently login
 public function current_Loggedin_UserDetails($admin_id) {
    $stmt = $this->pdo->prepare("SELECT * FROM admin WHERE admin_id = :admin_id");
    $stmt->bindParam(':admin_id', $admin_id);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        return [
            'user_photo' => !empty($user['user_photo']) ? $user['user_photo'] : 'default_photo.jpg',
            'fullname' => $user['fullname'],
            'username' => $user['username'],
            'date_created' => $user['date_created'],
            'date_updated' => $user['date_updated'],
            'email' => $user['email'],
            'status' => $user['status'],
            
            'last_login' => $user['last_login']
            
        ];
    } else {
        return [
            'user_photo' => 'uploads/default_photo.jpg',
            'fullname' => ''
        ];
    }
}


public function get_all_files() {
    $stmt = $this->pdo->prepare("
        SELECT files 
        FROM files 
        ORDER BY files.upload_date DESC
    ");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// end forcontriu user 

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
            $_SESSION['status'] = "Admin successfully deleted!";
            $_SESSION['status_icon'] = "success";
        } else {
            $_SESSION['status'] = "Error deleting admin.";
            $_SESSION['status_icon'] = "error";
        }
    } catch (PDOException $e) {
        $_SESSION['status'] = "Oops! Error: " . $e->getMessage();
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

public function get_all_events1() {
    $stmt = $this->pdo->prepare("SELECT * FROM events ORDER BY created_at DESC");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
public function count_all_events() {
    $stmt = $this->pdo->prepare("SELECT COUNT(*) AS total FROM events");
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

public function insert_event($event_name, $description, $location, $event_photo, $date_start, $date_end, $organizer) {
    $sql = "INSERT INTO events (event_name, description,  location, created_at, updated_at, event_photo, date_start, date_end, organizer) 
            VALUES (:event_name, :description, :location, NOW(), NOW(), :event_photo, :date_start, :date_end, :organizer)";
    $stmt = $this->pdo->prepare($sql);

    $stmt->bindParam(':event_name', $event_name);
    $stmt->bindParam(':description', $description);
    
    $stmt->bindParam(':location', $location);
    $stmt->bindParam(':event_photo', $event_photo, PDO::PARAM_STR);
    $stmt->bindParam(':date_start', $date_start);
    $stmt->bindParam(':date_end', $date_end);
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


public function get_all_messages() {
    $stmt = $this->pdo->prepare("SELECT * FROM messages");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


public function get_all_unpublished_files() {
    $stmt = $this->pdo->prepare("
        SELECT files.*, admin.fullname 
        FROM files 
        LEFT JOIN admin ON files.admin_id = admin.admin_id
        WHERE files.status = 'unpublished' AND isDeleted = 0 
        ORDER BY files.upload_date DESC
    ");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
public function get_all_published_files() {
    $stmt = $this->pdo->prepare("
        SELECT files.*, admin.fullname 
        FROM files 
        LEFT JOIN admin ON files.admin_id = admin.admin_id
        WHERE files.status = 'published' AND isDeleted = 0 
        ORDER BY files.upload_date DESC
    ");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


public function all_files() {
    $stmt = $this->pdo->prepare("
        SELECT files.*, admin.fullname 
        FROM files 
        LEFT JOIN admin ON files.admin_id = admin.admin_id
       
        ORDER BY files.upload_date DESC
    ");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

public function get_all_recycled_files() {
    $stmt = $this->pdo->prepare("
        SELECT files.*, admin.fullname 
        FROM files 
        LEFT JOIN admin ON files.admin_id = admin.admin_id
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
    $stmt = $this->pdo->prepare("SELECT COUNT(*) AS total FROM files WHERE status = 'Archived' ");
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result['total'];
}
//ALL USER SIDES HERE




// Method to check if token exists
public function is_token_valid($token_hash) {
    $sql = "SELECT admin_id FROM admin WHERE account_activation_hash = :token_hash LIMIT 1";
    $stmt = $this->pdo->prepare($sql);
    $stmt->bindParam(':token_hash', $token_hash);
    $stmt->execute();
    return $stmt->rowCount() > 0;
}

public function update_activation_hash($token_hash) {
    $sql = "UPDATE admin SET account_activation_hash = NULL WHERE account_activation_hash = :token_hash";
    $stmt = $this->pdo->prepare($sql);
    $stmt->bindParam(':token_hash', $token_hash);
    return $stmt->execute(); // This returns true on success or false on failure
}


    //forgot passwd
    public function save_reset_token($email, $token_hash, $expiry) {
        try {
            $sql = "UPDATE admin 
                    SET reset_token_hash = :token_hash, reset_token_expires_at = :expiry 
                    WHERE email = :email";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([
                ':token_hash' => $token_hash,
                ':expiry' => $expiry,
                ':email' => $email
            ]);
            return $stmt->rowCount() > 0;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }
    //start louie
// Fetch user by reset token
public function get_user_by_reset_token($token_hash) {
    try {
        $sql = "SELECT * FROM admin WHERE reset_token_hash = :token_hash LIMIT 1";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':token_hash' => $token_hash]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        return null;
    }
}

// Update user password and clear reset token
public function update_password($admin_id, $password_hash) {
    try {
        $sql = "UPDATE admin 
                SET password = :password_hash, 
                    reset_token_hash = NULL, 
                    reset_token_expires_at = NULL 
                WHERE admin_id = :admin_id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ':password_hash' => $password_hash,
            ':admin_id' => $admin_id
        ]);
        return $stmt->rowCount() > 0;
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        return false;
    }
}

    // end luie
       

        public function is_username_exists($username) {
            $stmt = $this->pdo->prepare("SELECT COUNT(*) FROM admin WHERE username = :username");
            $stmt->execute([':username' => $username]);
            return $stmt->fetchColumn() > 0;
        }

        // end regitser 
        // start updaitng 

        public function is_email_exists_except_user($email, $userId) {
            $stmt = $this->pdo->prepare("SELECT COUNT(*) FROM admin WHERE email = :email AND admin_id != :admin_id");
            $stmt->execute([':email' => $email, ':admin_id' => $userId]);
            return $stmt->fetchColumn() > 0;
        }
        
        public function is_username_exists_except_user($username, $userId) {
            $stmt = $this->pdo->prepare("SELECT COUNT(*) FROM admin WHERE username = :username AND admin_id != :admin_id");
            $stmt->execute([':username' => $username, ':admin_id' => $userId]);
            return $stmt->fetchColumn() > 0;
        }
        
        public function update_user_profile($userId, $fullname, $username, $email, $address, $birthday) {
            $date_updated = date('Y-m-d H:i:s');
            $stmt = $this->pdo->prepare("UPDATE admin SET fullname = :fullname, username = :username, email = :email, 
             address = :address, birthday = :birthday, date_updated = :date_updated WHERE admin_id = :admin_id");
            return $stmt->execute([
                ':fullname' => $fullname,
                ':username' => $username,
                ':email' => $email,
               
                ':address' => $address,
                ':birthday' => $birthday,
                ':date_updated' => $date_updated,
                ':admin_id' => $userId
            ]);
        }
        
        public function update_user_photo($userId, $photoPath) {
            try {
                $stmt = $this->pdo->prepare("UPDATE admin SET user_photo = :photo WHERE admin_id = :admin_id");
                $stmt->execute([
                    ':photo' => $photoPath,
                    ':admin_id' => $userId
                ]);
                return true;
            } catch (PDOException $e) {
                // Handle error
                return false;
            }
        }
        
       //login for admin
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
            $updateVisitorStmt = $this->pdo->prepare("UPDATE visitor_data SET admin_id = :admin_id, city = :city, region = :region, country = :country, latitude = :latitude, longitude = :longitude WHERE id = :id");
            $updateVisitorStmt->execute([
                ':admin_id' => $userId,
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
        $insertIpStmt = $this->pdo->prepare("INSERT INTO ip_addresses (admin_id, ip) VALUES (:admin_id, :ip) ON DUPLICATE KEY UPDATE ip = :ip");
        $insertIpStmt->execute([':admin_id' => $userId, ':ip' => $ip]);
    }
   
    
    public function user_login($email, $password) {
        try {
            $stmt = $this->pdo->prepare("
                SELECT * FROM admin 
                WHERE email = :email 
                AND account_activation_hash IS NULL 
                AND status = 'enabled' 
                LIMIT 1
            ");
            $stmt->execute([':email' => $email]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
            if ($user) {
                if (password_verify($password, $user['password'])) {
                    $this->update_last_login($user['admin_id']);
                    return $user;
                } else {
                    return false; // Invalid password
                }
            } else {
                return 'account_not_activated_or_disabled'; // Account not activated or status not enabled
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }
    
    
    public function update_last_login($admin_id) {
        try {
            $updateStmt = $this->pdo->prepare("UPDATE admin SET last_login = NOW() WHERE admin_id = :admin_id");
            $updateStmt->execute([':admin_id' => $admin_id]);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    


        public function get_user_info() {
            if (isset($_SESSION['admin_id'])) {
                $admin_id = $_SESSION['admin_id'];
                $stmt = $this->pdo->prepare("SELECT * FROM admin WHERE admin_id = :admin_id");
                $stmt->bindParam(':admin_id', $admin_id, PDO::PARAM_INT);
                $stmt->execute();
                return $stmt->fetch(PDO::FETCH_ASSOC);
            }
            return null;
        }

//file crud contiebutorrs
        public function saveFileInfo($adminId, $title, $description, $filePath, $coverPath, $status) 
        {
            try {
                $uploadDate = date('Y-m-d H:i:s');

                $stmt = $this->pdo->prepare("INSERT INTO files (admin_id, title, cover_path, description, file_path, status, upload_date) 
                                            VALUES (:admin_id, :title, :cover_path, :description, :file_path,:status, :upload_date)");

                $stmt->bindParam(':admin_id', $adminId);
                $stmt->bindParam(':title', $title);
                $stmt->bindParam(':cover_path', $coverPath);
                $stmt->bindParam(':description', $description);
                $stmt->bindParam(':file_path', $filePath);
                $stmt->bindParam(':status', $status);
                $stmt->bindParam(':upload_date', $uploadDate);

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

        public function updateFileInfo($id, $adminId, $title, $description, $filePath, $coverPath, $status) 
        {
            try {
                $updateDate = date('Y-m-d H:i:s');
        
                $stmt = $this->pdo->prepare("UPDATE files SET admin_id = :admin_id, title = :title, cover_path = :cover_path, description = :description, file_path = :file_path, status = :status, upload_date = :upload_date WHERE id = :id");
        
                $stmt->bindParam(':admin_id', $adminId);
                $stmt->bindParam(':title', $title);
                $stmt->bindParam(':cover_path', $coverPath);
                $stmt->bindParam(':description', $description);
                $stmt->bindParam(':file_path', $filePath);
                $stmt->bindParam(':status', $status);
                $stmt->bindParam(':upload_date', $updateDate);
                $stmt->bindParam(':id', $id);
        
                $stmt->execute();
        
                $_SESSION['status'] = "File successfully updated!";
                $_SESSION['status_icon'] = "success";
                return true;
            } catch (PDOException $e) {
                $_SESSION['status'] = "Error updating file: " . $e->getMessage();
                $_SESSION['status_icon'] = "error";
                return false;
            }
        }

       
        
        


}
?>

