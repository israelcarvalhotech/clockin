USE clockin;

DROP TABLE IF EXISTS working_hours, users;

CREATE TABLE users (
                       id INT AUTO_INCREMENT PRIMARY KEY,
                       name VARCHAR(100) NOT NULL,
                       email VARCHAR(100) UNIQUE NOT NULL,
                       password VARCHAR(255) NOT NULL,
                       is_admin BOOLEAN NOT NULL DEFAULT false,
                       created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                       updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE working_hours (
                               id INT AUTO_INCREMENT PRIMARY KEY,
                               user_id INT NOT NULL,
                               work_date DATE NOT NULL,
                               time1 TIME,
                               time2 TIME,
                               time3 TIME,
                               time4 TIME,
                               worked_time INT DEFAULT 0,
                               created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                               FOREIGN KEY (user_id) REFERENCES users(id),
                               CONSTRAINT unique_user_date UNIQUE (user_id, work_date)
);

INSERT INTO users (name, email, password, is_admin)
VALUES ('Admin', 'admin@clockin.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', true);