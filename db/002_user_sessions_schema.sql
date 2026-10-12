CREATE TABLE user_sessions (
    -- Session id to be used in dashboard and references
    session_id INT AUTO_INCREMENT PRIMARY KEY,
    
    -- User ID reference
    user_id INT NOT NULL,

    -- Session attributes
   session_start DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
   session_end DATETIME DEFAULT NULL,
   session_duration INT DEFAULT NULL,

   -- Constraints and foreign key implementaion
   CONSTRAINT  fk_user_sessions_user_id
          FOREIGN KEY (user_id)
          REFERENCES user(user_id)
          ON DELETE CASCADE
          ON UPDATE CASCADE
);
  