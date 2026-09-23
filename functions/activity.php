<?php
     function logActivity($pdo,$user_id,$user_email,$action, $status='success') {
        try{
            // Get Client IP Address
            $ip_ = $_SERVER['HTTP_X_FORWARDED_FOR'] ?? $_SERVER['REMOTE_ADDR'] ?? 'Unknown';

            // String to Array
            if(strpos($ip_, ',') !== false){
                $ip_ = trim(explode(',', $ip_)[0]);
            }

            // GET user agent (browser)
            $user_agent = substr($_SERVER['HTTP_USER_AGENT'] ?? 'Unknown', 0, 255);

            // Application Query
            $stmt = $pdo -> prepare("
               INSERT INTO activity_logs(
                    user_id, 
                    user_email,
                    activity_log_action,
                    activity_log_status,
                    activity_log_ip_address,
                    activity_log_user_agent
                ) VALUES (?, ?, ?, ?, ?, ?)
            ");

            $stmt->execute([
            $user_id,
            $user_email,
            $action,
            $status,
            $ip_,
            $user_agent
        ]);

        return true;

        } catch (PDOException $e) {
            error_log("Activity Log Error: " . $e->getMessage());
            return false;
        }
     }
?>