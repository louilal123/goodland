<?php
require_once('geoplugin.class.php');
require_once 'database.php';


class Main_class extends Database {

    public function __construct() {
        parent::__construct(); // Initialize the database connection

         // Set the timezone for the Philippines
         date_default_timezone_set('Asia/Manila');
    }

    public function fetchEvents()
{
    $sql = "SELECT event_id, event_name AS title, date_start AS start, date_end AS end FROM events "; // Adjust as needed
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


public function fetchSettings() {
    $sql = "SELECT * FROM settings LIMIT 1"; // Adjust to fetch a single row or all rows as needed
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

public function updateSettings($address, $contact, $email, $facebook_url) {
    try {
        // Prepare an SQL query to update the settings
        $query = "UPDATE settings SET address = :address, contact = :contact, email = :email, facebook_url = :facebook_url WHERE id = 1";
        $stmt = $this->pdo->prepare($query);

        // Bind the values to the query parameters
        $stmt->bindParam(':address', $address);
        $stmt->bindParam(':contact', $contact);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':facebook_url', $facebook_url);

        // Execute the statement
        return $stmt->execute();
    } catch (Exception $e) {
        // In case of an error, return false
        return false;
    }
}





public function update_event($event_id, $event_name, $description, $location, $photoPath, $start_date, $end_date, $organizer) {
    // Prepare the SQL query to update the event
    $sql = "UPDATE events SET event_name = :event_name, description = :description, location = :location, 
            date_start = :start_date, date_end = :end_date, organizer = :organizer";

    // If there is a new photo, add it to the query
    if ($photoPath !== null) {
        $sql .= ", event_photo = :event_photo";
    }

    $sql .= " WHERE event_id = :event_id";

    // Prepare the statement
    $stmt = $this->pdo->prepare($sql);

    // Bind the parameters
    $stmt->bindParam(':event_name', $event_name);
    $stmt->bindParam(':description', $description);
    $stmt->bindParam(':location', $location);
    $stmt->bindParam(':start_date', $start_date);
    $stmt->bindParam(':end_date', $end_date);
    $stmt->bindParam(':organizer', $organizer);
    
    // Bind the photo if available
    if ($photoPath !== null) {
        $stmt->bindParam(':event_photo', $photoPath);
    }

    // Bind the event ID
    $stmt->bindParam(':event_id', $event_id);

    // Execute the query and return success or failure
    return $stmt->execute();
}

public function deleteEvent($eventId) {
    $sql = "DELETE FROM events WHERE event_id = :event_id";
    $stmt = $this->pdo->prepare($sql);
    $stmt->bindParam(':event_id', $eventId, PDO::PARAM_INT);
    return $stmt->execute();
}
 
public function updateEventStatus() {
    try {
        // Get current date and time
        $now = date("Y-m-d H:i:s"); // Current timestamp

        $sqlFinished = "UPDATE events 
                        SET status = 'finished' 
                        WHERE date_end < ? 
                          AND status != 'finished' 
                          AND status != 'canceled'";
        $stmtFinished = $this->pdo->prepare($sqlFinished);
        $stmtFinished->execute([$now]);

        $sqlOngoing = "UPDATE events 
                       SET status = 'ongoing' 
                       WHERE date_start <= ? 
                         AND date_end >= ? 
                         AND status != 'ongoing' 
                         AND status != 'canceled'";
        $stmtOngoing = $this->pdo->prepare($sqlOngoing);
        $stmtOngoing->execute([$now, $now]);

        $sqlUpcoming = "UPDATE events 
                        SET status = 'upcoming' 
                        WHERE date_start > ? 
                          AND status != 'upcoming' 
                          AND status != 'canceled'";
        $stmtUpcoming = $this->pdo->prepare($sqlUpcoming);
        $stmtUpcoming->execute([$now]);

        return "Event statuses updated successfully!";
    } catch (PDOException $e) {
        return "Error updating event statuses: " . $e->getMessage();
    }
}

public function getVisitorDailyData()
{
    // Query to get daily new and returning visitors for the current month
    $sql = "
        SELECT 
            DAY(s.visit_time) AS day, 
            COUNT(DISTINCT CASE WHEN s.visit_count = 1 THEN s.visitor_id ELSE NULL END) AS new_visitors,
            COUNT(DISTINCT CASE WHEN s.visit_count > 1 THEN s.visitor_id ELSE NULL END) AS returning_visitors
        FROM sessions s
        LEFT JOIN visitor_logs vl ON s.visitor_id = vl.visitor_id
        WHERE YEAR(s.visit_time) = YEAR(CURDATE()) 
          AND MONTH(s.visit_time) = MONTH(CURDATE())
        GROUP BY DAY(s.visit_time)";
    
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Initialize arrays to store new and returning visitor counts for each day (1 to 31)
    $daysInMonth = cal_days_in_month(CAL_GREGORIAN, date('m'), date('Y'));
    $visitorData = [
        'newVisitors' => array_fill(0, $daysInMonth, 0), // Initialize with 0 for all days
        'returningVisitors' => array_fill(0, $daysInMonth, 0)
    ];

    // Populate the data arrays with the actual results
    foreach ($result as $row) {
        $dayIndex = (int)$row['day'] - 1; // Convert to zero-based index
        $visitorData['newVisitors'][$dayIndex] = (int)$row['new_visitors'];
        $visitorData['returningVisitors'][$dayIndex] = (int)$row['returning_visitors'];
    }

    return $visitorData;
}
//THIS IS FOR REPORTS
public function getVisitorDailyData1($dateFrom, $dateTo)
{
    // Query to get daily new and returning visitors for the selected date range
    $sql = "
        SELECT 
            DATE(s.visit_time) AS date, 
            COUNT(DISTINCT CASE WHEN s.visit_count = 1 THEN s.visitor_id ELSE NULL END) AS new_visitors,
            COUNT(DISTINCT CASE WHEN s.visit_count > 1 THEN s.visitor_id ELSE NULL END) AS returning_visitors
        FROM sessions s
        LEFT JOIN visitor_logs vl ON s.visitor_id = vl.visitor_id
        WHERE s.visit_time BETWEEN :date_from AND :date_to
        GROUP BY DATE(s.visit_time)";

    $stmt = $this->pdo->prepare($sql);
    $stmt->bindParam(':date_from', $dateFrom);
    $stmt->bindParam(':date_to', $dateTo);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Process data
    $visitorData = ['newVisitors' => [], 'returningVisitors' => [], 'dates' => []];
    foreach ($result as $row) {
        $visitorData['dates'][] = $row['date'];
        $visitorData['newVisitors'][] = (int)$row['new_visitors'];
        $visitorData['returningVisitors'][] = (int)$row['returning_visitors'];
    }

    return $visitorData;
}


public function getVisitorDailyDataForRange($dateFrom, $dateTo)
{
    // Query to get visitor data for the given range
    $sql = "
        SELECT 
            DATE(s.visit_time) AS date,
            COUNT(DISTINCT CASE WHEN s.visit_count = 1 THEN s.visitor_id ELSE NULL END) AS new_visitors,
            COUNT(DISTINCT CASE WHEN s.visit_count > 1 THEN s.visitor_id ELSE NULL END) AS returning_visitors
        FROM sessions s
        WHERE DATE(s.visit_time) BETWEEN :dateFrom AND :dateTo
        GROUP BY DATE(s.visit_time)";
    
    $stmt = $this->pdo->prepare($sql);
    $stmt->bindParam(':dateFrom', $dateFrom);
    $stmt->bindParam(':dateTo', $dateTo);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Format the data for Highcharts
    $dates = [];
    $newVisitors = [];
    $returningVisitors = [];

    foreach ($result as $row) {
        $dates[] = $row['date'];
        $newVisitors[] = (int)$row['new_visitors'];
        $returningVisitors[] = (int)$row['returning_visitors'];
    }

    return [
        'dates' => $dates,
        'newVisitors' => $newVisitors,
        'returningVisitors' => $returningVisitors,
    ];
}




// Inside the class
public function getSessionsByVisitorId($visitorId) {
    $sql = "SELECT * FROM sessions WHERE visitor_id = :visitor_id";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute(['visitor_id' => $visitorId]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


public function getTotalReturningVisitors()
{
    // Query to count the total number of returning visitors (those with visit_count > 1)
    $sql = "
        SELECT COUNT(DISTINCT s.visitor_id) AS returning_visitors_count
        FROM sessions s
        LEFT JOIN visitor_logs vl ON s.visitor_id = vl.visitor_id
        WHERE s.visit_count > 1 AND YEAR(s.visit_time) = YEAR(CURDATE())";
    
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return (int)$result['returning_visitors_count'];
}




public function fetchMonthlyVisitorStats() {
    // Query to count new and returning visitors grouped by month
    $sql = "
        SELECT 
            MONTH(s.visit_time) AS month,
            SUM(CASE WHEN s.visit_count = 1 THEN 1 ELSE 0 END) AS new_visitors,
            SUM(CASE WHEN s.visit_count > 1 THEN 1 ELSE 0 END) AS returning_visitors
        FROM 
            sessions AS s
        GROUP BY 
            MONTH(s.visit_time)
        ORDER BY 
            MONTH(s.visit_time)";

    $stmt = $this->pdo->prepare($sql);
    $stmt->execute();
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Prepare data arrays for chart
    $monthlyData = [
        'newVisitors' => array_fill(0, 12, 0), // Initialize with 12 months
        'returningVisitors' => array_fill(0, 12, 0)
    ];

    foreach ($data as $row) {
        $monthIndex = $row['month'] - 1; // Adjust month to 0-based index
        $monthlyData['newVisitors'][$monthIndex] = (int)$row['new_visitors'];
        $monthlyData['returningVisitors'][$monthIndex] = (int)$row['returning_visitors'];
    }

    return $monthlyData;
}

    public function deleteVisitor($visitorId) {
        try {
            $this->pdo->beginTransaction();


            $stmt = $this->pdo->prepare("DELETE FROM sessions WHERE visitor_id = :visitor_id");
            $stmt->bindParam(':visitor_id', $visitorId);
            $stmt->execute();

            $stmt = $this->pdo->prepare("DELETE FROM visitor_logs WHERE visitor_id = :visitor_id");
            $stmt->bindParam(':visitor_id', $visitorId);
            $stmt->execute();

            $this->pdo->commit();
        } catch (Exception $e) {
            $this->pdo->rollBack();
            throw $e;
        }
    }


    // Method to delete all sessions
    public function deleteAllSessions() {
        try {
            $stmt = $this->pdo->prepare("DELETE FROM sessions");
            $stmt->execute();
        } catch (Exception $e) {
            throw new Exception('Failed to delete sessions: ' . $e->getMessage());
        }
    }

    // Method to delete all visitors
    public function deleteAllVisitors() {
        try {
            $stmt = $this->pdo->prepare("DELETE FROM visitor_logs");
            $stmt->execute();
        } catch (Exception $e) {
            throw new Exception('Failed to delete visitors: ' . $e->getMessage());
        }
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

// VERIFY FOR SINGIN 
public function sendSmsOtp($admin_id, $phone) {
    $otp = rand(100000, 999999); // Generate a 6-digit OTP
    $expiry = date("Y-m-d H:i:s", strtotime("+1 day")); // OTP valid for 1 day

    try {
        // Insert OTP into the database
        $insertStmt = $this->pdo->prepare("
            INSERT INTO mfa_tokens (admin_id, otp, type, expiration_time, created_at, verified)
            VALUES (:admin_id, :otp, 'sms', :expiration_time, NOW(), 0)
            ON DUPLICATE KEY UPDATE
                otp = :otp, expiration_time = :expiration_time, created_at = NOW(), verified = 0
        ");
        $insertStmt->execute([
            'admin_id' => $admin_id,
            'otp' => $otp,
            'expiration_time' => $expiry,
        ]);

        return $otp; // Return OTP for use in the message
    } catch (Exception $e) {
        error_log("Error saving OTP to the database: " . $e->getMessage());
        return false;
    }
}

public function verifyEmailOtp($email, $otp) {
    // Fetch user information using the email
    $stmt = $this->pdo->prepare("SELECT admin_id, email FROM admin WHERE email = :email");
    $stmt->execute(['email' => $email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // Capture IP address and User-Agent
    $ip_address = $_SERVER['REMOTE_ADDR'];
    $user_agent = $_SERVER['HTTP_USER_AGENT'];

    if ($user) {
        // Check the latest unverified OTP of type 'email' in the mfa_tokens table
        $stmt = $this->pdo->prepare("
            SELECT otp, expiration_time, verified 
            FROM mfa_tokens 
            WHERE admin_id = :admin_id AND verified = 0 AND type = 'email'
            ORDER BY created_at DESC 
            LIMIT 1
        ");
        $stmt->execute(['admin_id' => $user['admin_id']]);
        $token = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($token) {
            // Verify OTP and expiration
            if ($token['otp'] == $otp && strtotime($token['expiration_time']) > time()) {
                // OTP is valid and not expired, mark as verified
                $updateStmt = $this->pdo->prepare("
                    UPDATE mfa_tokens 
                    SET verified = 1 
                    WHERE admin_id = :admin_id AND otp = :otp AND type = 'email'
                ");
                $updateStmt->execute([
                    'admin_id' => $user['admin_id'],
                    'otp' => $otp,
                ]);

                // Log successful login attempt
                $logStmt = $this->pdo->prepare("
                    INSERT INTO login_logs (admin_id, email, status, ip_address, user_agent) 
                    VALUES (:admin_id, :email, 'success', :ip_address, :user_agent)
                ");
                $logStmt->execute([
                    'admin_id' => $user['admin_id'],
                    'email' => $email,
                    'ip_address' => $ip_address,
                    'user_agent' => $user_agent,
                ]);

                // Return user info for session setup
                return $user;
            }
        }
    }

    // Log failed login attempt
    if ($user) {
        $admin_id = $user['admin_id'];
    } else {
        $admin_id = null; // User not found
    }

    $logStmt = $this->pdo->prepare("
        INSERT INTO login_logs (admin_id, email, status, ip_address, user_agent) 
        VALUES (:admin_id, :email, 'failure', :ip_address, :user_agent)
    ");
    $logStmt->execute([
        'admin_id' => $admin_id,
        'email' => $email,
        'ip_address' => $ip_address,
        'user_agent' => $user_agent,
    ]);

    return false;  // OTP is invalid or expired, or user does not exist
}


public function verifySmsOtp($email, $otp) {
    // Fetch user information using the email
    $stmt = $this->pdo->prepare("SELECT admin_id, email, phone FROM admin WHERE email = :email");
    $stmt->execute(['email' => $email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        // Check the latest unverified OTP of type 'sms' in the mfa_tokens table
        $stmt = $this->pdo->prepare("
            SELECT otp, expiration_time, verified 
            FROM mfa_tokens 
            WHERE admin_id = :admin_id AND verified = 0 AND type = 'sms'
            ORDER BY created_at DESC 
            LIMIT 1
        ");
        $stmt->execute(['admin_id' => $user['admin_id']]);
        $token = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($token) {
            // Verify OTP and expiration
            if ($token['otp'] == $otp && strtotime($token['expiration_time']) > time()) {
                // OTP is valid and not expired, mark as verified
                $updateStmt = $this->pdo->prepare("
                    UPDATE mfa_tokens 
                    SET verified = 1 
                    WHERE admin_id = :admin_id AND otp = :otp AND type = 'sms'
                ");
                $updateStmt->execute([
                    'admin_id' => $user['admin_id'],
                    'otp' => $otp,
                ]);

                // Return user info for session setup
                return $user;
            }
        }
    }

    return false;  // OTP is invalid or expired, or user does not exist
}



public function getUserPhoneAndAdminByEmail($email) {
    $stmt = $this->pdo->prepare("SELECT phone, admin_id FROM admin WHERE email = :email");
    $stmt->execute(['email' => $email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
    // Return both phone and admin_id if found, otherwise return null values
    if ($user) {
        return [
            'phone' => $user['phone'] ?? null,
            'admin_id' => $user['admin_id'] ?? null,
        ];
    }
    return ['phone' => null, 'admin_id' => null];
}


// END VERIFY SIGNIN 

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
    
    public function verifyOtpByHash($email, $otp) {
        // Assuming you have a database connection and a table to store OTPs
        $hashedOtp = hash('sha256', $otp);  // Hash the OTP for comparison
        $query = "SELECT * FROM password_resets WHERE email = ? AND otp = ?";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$email, $hashedOtp]);
    
        if ($stmt->rowCount() > 0) {
            return true; // OTP is valid
        } else {
            return false; // OTP is invalid
        }
    }
    
    public function getEmailFromOtp($otp) {
        // Check if the hashed OTP exists in the database
        $stmt = $this->pdo->prepare("SELECT email FROM password_resets WHERE reset_token_hash = :otp");
        $stmt->bindParam(':otp', $otp);
        $stmt->execute();
        
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row ? $row['email'] : null;  // Return the email if found, otherwise null
    }

    // Get admin ID by email
    public function getAdminIdByEmail($email) {
        $stmt = $this->pdo->prepare("SELECT admin_id FROM admin WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row ? $row['admin_id'] : null;
    }

    
    public function resetPasswordlink($hashed_otp, $new_password) {
        // Hash the new password
        $hashed_password = password_hash($new_password, PASSWORD_BCRYPT);
    
        try {
            $stmt = $this->pdo->prepare("SELECT admin_id FROM password_resets WHERE otp = :otp AND expires_at > NOW()");
            $stmt->execute(['otp' => $hashed_otp]);
            $row = $stmt->fetch();
    
            $admin_id = $row['admin_id'];
    
            $stmt = $this->pdo->prepare("UPDATE admin SET password = :password WHERE admin_id = :admin_id");
            $passwordUpdated = $stmt->execute([
                'password' => $hashed_password,
                'admin_id' => $admin_id
            ]);
    
            if ($passwordUpdated) {
                $updateOtpStmt = $this->pdo->prepare("UPDATE password_resets SET otp = NULL, expires_at = NULL WHERE admin_id = :admin_id");
                $updateOtpStmt->execute(['admin_id' => $admin_id]);
            }
    
            return $passwordUpdated; // Return true if the password was updated successfully
        } catch (PDOException $e) {
            // Error handling
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    public function getOtpFromDatabase($email) {
        $sql = "SELECT reset_otp FROM users WHERE email = :email";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
        return $result ? $result['reset_otp'] : null; // Return the plain OTP from database
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

    
    // In Main_class.php
public function getFileById($fileId) {
    $stmt = $this->pdo->prepare("SELECT * FROM files WHERE id = :id ");
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
    

    // Method to fetch messages based on visitor_id
public function getMessagesByVisitorId($visitorId) {
    $sql = "SELECT * FROM messages WHERE visitor_id = :visitor_id ORDER BY created_at DESC";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute(['visitor_id' => $visitorId]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}



  public function getAllVisitors() {
    $sql = "
        SELECT vl.visitor_id, vl.ip_address, vl.user_agent, vl.country, vl.date_added,
               s.session_id, s.visit_time, s.last_visit, s.visit_count
        FROM visitor_logs vl
        LEFT JOIN sessions s ON vl.visitor_id = s.visitor_id
        WHERE DATE(s.visit_time) = CURDATE() -- Fetch only today's sessions
        ORDER BY vl.date_added ASC
    ";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

    // <!-- SELECT `data_id`, `water_level`, `humidity`, `temperature`, `date_time` FROM `catchment_data` WHERE 1 -->
   
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
    public function editProject($project_id, $title, $header, $image_path, $summary, $banner_quote, $youtube_link)
    {
        // SQL query for updating project details
        $sql = "UPDATE projects 
                SET title = :title, 
                    header = :header, 
                    project_image = :project_image, 
                    summary = :summary, 
                    banner_quote = :banner_quote, 
                    youtube_link = :youtube_link, 
                    updated_at = NOW()
                WHERE project_id = :project_id"; // Use 'project_id' instead of 'id'
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ':title' => $title,
            ':header' => $header,
            ':project_image' => $image_path,
            ':summary' => $summary,
            ':banner_quote' => $banner_quote,
            ':youtube_link' => $youtube_link,
            ':project_id' => $project_id // Ensure this binds correctly
        ]);
        return $stmt->rowCount(); // Returns the number of affected rows
    }
    public function insert_reply($id, $admin_id, $reply_message) {
        $stmt = $this->pdo->prepare("
            INSERT INTO message_replies (id, admin_id, reply, date_replied)
            VALUES (:id, :admin_id, :reply, NOW())
        ");
        
        // Bind the parameters to match the placeholders in the SQL query
        $stmt->bindParam(':id', $id);           // Use 'id' for the message reply
        $stmt->bindParam(':admin_id', $admin_id);
        $stmt->bindParam(':reply', $reply_message);
        
        // Execute the query and return the result
        return $stmt->execute();  // Returns true on success, false on failure
    }
    
    

 
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

    public function saveFileRequest($file_id, $visitor_id, $email) {
       
        $sql = "INSERT INTO file_requests (file_id, visitor_id, email, request_date) 
                VALUES (:file_id, :visitor_id, :email, NOW())";
        
        $stmt = $this->pdo->prepare($sql);
        
        $stmt->bindParam(':file_id', $file_id, PDO::PARAM_INT);
        $stmt->bindParam(':visitor_id', $visitor_id, PDO::PARAM_INT);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        return $stmt->execute();
    }
    public function getFileRequests() {
        $sql = "SELECT fr.request_id, f.title, fr.email, fr.request_date, vl.ip_address
                FROM file_requests fr
                LEFT JOIN files f ON fr.file_id = f.id 
                LEFT JOIN visitor_logs vl ON fr.visitor_id = vl.visitor_id 
                ORDER BY fr.request_date DESC";
    
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
    
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function deleteFileRequest($request_id) {
        $sql = "DELETE FROM file_requests WHERE request_id = :request_id";
    
        $stmt = $this->pdo->prepare($sql);
    
        $stmt->bindParam(':request_id', $request_id, PDO::PARAM_INT);
    
        if ($stmt->execute()) {
            return true;  
        } else {
            return false; 
        }
    }
    public function deleteAllFileRequests() {
        $sql = "DELETE FROM file_requests"; // Deletes all records from file_requests table
        
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute();  // Execute the delete query
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
    
    public function updateProject($project_id, $title, $header, $image_path, $summary, $banner_quote, $youtube_link) {
        // Initialize SQL query
        $query = "UPDATE projects SET 
                  project_name = ?, 
                  project_header = ?, 
                  project_description = ?, 
                  project_quotation = ?, 
                  youtube_link = ?";
        
        // If a new image is uploaded, include it in the update
        if ($image_path) {
            $query .= ", project_image = ?";
        }
        
        $query .= " WHERE project_id = ?";
    
        // Prepare and bind
        $stmt = $this->db->prepare($query);
        if ($image_path) {
            $stmt->bind_param("ssssssi", $title, $header, $summary, $banner_quote, $youtube_link, $image_path, $project_id);
        } else {
            $stmt->bind_param("sssssi", $title, $header, $summary, $banner_quote, $youtube_link, $project_id);
        }
    
        // Execute and return success status
        return $stmt->execute();
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

public function getEventById($eventId) {
    $sql = "
        SELECT 
            e.event_id, 
            e.event_name, 
            e.description, 
            e.location, 
            e.organizer, 
            e.date_start, 
            e.date_end, 
            e.event_photo, 
            e.status, 
            e.created_at, 
            e.updated_at
        FROM 
            events e
        WHERE 
            e.event_id = :event_id";
    
    $stmt = $this->pdo->prepare($sql);
    $stmt->bindParam(':event_id', $eventId, PDO::PARAM_INT);
    $stmt->execute();
    
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
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
   
    public function mark_all_messages_as_read() {
        $sql = "UPDATE messages SET status = 'read' WHERE status != 'read'"; 
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
    }
    public function get_notifications() {
        $sql = "SELECT * FROM notifications ORDER BY time_stamp DESC";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function get_unread_notifications_count() {
        $sql = "SELECT COUNT(*) FROM notifications WHERE status = 'unread'";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchColumn();
    }
    public function get_unread_messages_count() {
        $sql = "SELECT COUNT(*) FROM notifications WHERE status = 'unread'";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchColumn();
    }
        public function mark_notifications_as_read() {
    $sql = "UPDATE notifications SET status = 'read' WHERE status = 'unread'";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute();
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
        $sql = "SELECT * FROM messages  ORDER BY date_sent DESC";
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
 
    // end 

    public function is_email_exists($email) {
        $stmt = $this->pdo->prepare("SELECT COUNT(*) FROM admin WHERE email = :email");
        $stmt->execute([':email' => $email]);
        return $stmt->fetchColumn() > 0;
    }

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
            $query = "delete from files  WHERE id = ?";
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

    
    public function update_otp($email) {
        // Generate a new OTP
        $otp = rand(100000, 999999);  // Generate 6-digit OTP
        $expiry = date("Y-m-d H:i:s", strtotime("+1 day"));  // OTP valid for 1 day

        // Prepare and execute the SQL statement to update the OTP in the mfa_tokens table
        $stmt = $this->pdo->prepare("
            UPDATE mfa_tokens 
            SET otp = :otp, expiration_time = :expiration_time, verified = 0, created_at = NOW()
            WHERE admin_id = (SELECT admin_id FROM admin WHERE email = :email)
        ");

        // Execute the statement with the necessary parameters
        $stmt->execute([
            'otp' => $otp,
            'expiration_time' => $expiry,
            'email' => $email
        ]);

        // Return the generated OTP for further use (e.g., sending it via email)
        return $otp;
    }

    public function login_user($email, $password) {
        // Check if the email exists and fetch user data
        $stmt = $this->pdo->prepare("SELECT admin_id, password FROM admin WHERE email = :email");
        $stmt->execute(['email' => $email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
        if ($user) {
            // Verify password
            if (password_verify($password, $user['password'])) {
                // Generate OTP for Multi-Factor Authentication (MFA)
                $otp = rand(100000, 999999);
                $expiry = date("Y-m-d H:i:s", strtotime("+1 day")); // OTP valid for 1 day
    
                // Insert OTP into `mfa_tokens` table
                $insertStmt = $this->pdo->prepare("
                    INSERT INTO mfa_tokens (admin_id, otp, expiration_time, created_at, verified)
                    VALUES (:admin_id, :otp, :expiration_time, NOW(), 0)
                    ON DUPLICATE KEY UPDATE
                        otp = :otp, expiration_time = :expiration_time, created_at = NOW(), verified = 0
                ");
                $insertStmt->execute([
                    'admin_id' => $user['admin_id'],
                    'otp' => $otp,
                    'email' => $email,
                    'expiration_time' => $expiry,
                ]);
    
                // Return OTP for email sending
                return $otp;
            } else {
                return false; // Invalid password
            }
        } else {
            return false; // Email not found
        }
    }
    
    // for login
    // public function login_user($emailOrUsername, $password) {
    //     $stmt = $this->pdo->prepare("SELECT admin_id, email, username, password FROM admin WHERE email = :emailOrUsername OR 
    //     username = :emailOrUsername");
    //     $stmt->bindParam(':emailOrUsername', $emailOrUsername);
    //     $stmt->execute();
    //     $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
    //     if ($user) {
    //         if (password_verify($password, $user['password'])) {
    //             $_SESSION['admin_id'] = htmlentities($user['admin_id']);
    //             $_SESSION['email'] = htmlentities($user['email']);
    //             $_SESSION['username'] = htmlentities($user['username']);
    //             $_SESSION['status'] = "Login Successful!";
    //             $_SESSION['status_icon'] = "success";
    //             header("Location: ../dashboard.php");
    //             exit();
    //         } else {
    //             return false; 
    //         }
    //     } else {
    //         return false; 
    //     }
    // }
    
    
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

// public function insert_admin($fullname, $username, $email, $password, $photo) {
//     $sql = "INSERT INTO admin (fullname, username, email, password, admin_photo, date_created, role, status) 
//             VALUES (:fullname, :username, :email, :password, :admin_photo, NOW(), 'admin', 'Active')";
//     $stmt = $this->pdo->prepare($sql);

//     $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

//     $stmt->bindParam(':fullname', $fullname);
//     $stmt->bindParam(':username', $username);
//     $stmt->bindParam(':email', $email);
//     $stmt->bindParam(':password', $hashedPassword);
//     $stmt->bindParam(':admin_photo', $photo, PDO::PARAM_STR); 

//     return $stmt->execute();
// }

public function insert_random_admin($fullname, $username, $email, $password, $photo) {
    try {
        $randomAdminId = bin2hex(random_bytes(16));  

        $sql = "INSERT INTO admin (admin_id, fullname, username, email, password, admin_photo, date_created, role, status) 
                VALUES (:admin_id, :fullname, :username, :email, :password, :admin_photo, NOW(), 'admin', 'Active')";
        $stmt = $this->pdo->prepare($sql);

        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

        $stmt->bindParam(':admin_id', $randomAdminId);
        $stmt->bindParam(':fullname', $fullname);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $hashedPassword);
        $stmt->bindParam(':admin_photo', $photo);

        $stmt->execute();

        return true;  
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
        return false;
    }
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

public function get_login_logs_with_admin_info() {
    $stmt = $this->pdo->prepare("
        SELECT 
            login_logs.id,
            login_logs.admin_id,
            login_logs.email,
            login_logs.login_time,
            login_logs.status,
            login_logs.ip_address,
            login_logs.user_agent,
            admin.fullname,
            admin.email AS admin_email
        FROM 
            login_logs
        JOIN 
            admin ON login_logs.admin_id = admin.admin_id
        ORDER BY 
            login_logs.login_time DESC
    ");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
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
    $stmt = $this->pdo->prepare("SELECT COUNT(*) AS total FROM events WHERE status='upcoming' ");
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result['total'];
}

public function count_all_request() {
    $stmt = $this->pdo->prepare("SELECT COUNT(*) AS total FROM file_requests  ");
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result['total'];
}
public function fetchUpcomingEvents() {
    $sql = "SELECT event_id, event_name, description, date_start, date_end 
            FROM events 
            WHERE status='upcoming' 
            ORDER BY date_start ASC"; // Order by date_start for chronological display
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
public function fetchFinishedEvents(){
    $sql = "SELECT event_id, event_name, description, date_start, date_end 
    FROM events 
    WHERE status='finished' 
    ORDER BY date_start ASC"; // Order by date_start for chronological display
$stmt = $this->pdo->prepare($sql);
$stmt->execute();
return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
public function fetchOngoingEvents() {
    $sql = "SELECT event_id, event_name, description, date_start, date_end 
            FROM events 
            WHERE status='ongoing' 
            ORDER BY date_start ASC"; // Order by date_start for chronological display
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
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
    $stmt = $this->pdo->prepare("
        SELECT 
            m.id AS id,
            m.name,
            m.email,
            m.subject,
            m.message,
            m.date_sent,
            m.status,
            r.reply,
            r.date_replied,
            a.fullname AS admin_name
        FROM 
            messages m
        LEFT JOIN 
            message_replies r ON m.id = r.id  -- Fix this part based on actual schema
        LEFT JOIN 
            admin a ON r.admin_id = a.admin_id
    ");
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

       
        public function deleteProject($projectId) {
            try {
                // Start a transaction to ensure both deletions are handled together
                $this->pdo->beginTransaction();
        
                // First, delete the related sections from the project_sections table
                $stmt = $this->pdo->prepare("DELETE FROM `project_sections` WHERE `project_id` = :project_id");
                $stmt->bindParam(':project_id', $projectId);
                $stmt->execute();
        
                // Then, delete the project itself from the projects table
                $stmt = $this->pdo->prepare("DELETE FROM `projects` WHERE `project_id` = :project_id");
                $stmt->bindParam(':project_id', $projectId);
                $stmt->execute();
        
                // Commit the transaction
                $this->pdo->commit();
        
            } catch (PDOException $e) {
                // Rollback the transaction if there was an error
                $this->pdo->rollBack();
                throw new Exception("Error deleting project: " . $e->getMessage());
            }
        }
        
        
    }


?>

