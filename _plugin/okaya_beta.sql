CREATE TABLE users (
                       user_id INT AUTO_INCREMENT PRIMARY KEY,
                       user_name VARCHAR(100),
                       email VARCHAR(100)
);
CREATE TABLE usersacvity (
                       user_id INT AUTO_INCREMENT PRIMARY KEY,
                       user_name VARCHAR(100),
                       email VARCHAR(100)
);
CREATE TABLE user_login_attempt (
                                    attempt_id INT AUTO_INCREMENT PRIMARY KEY,
                                    user_id INT,
                                    ip_address VARCHAR(50),
                                    success BOOLEAN,
                                    attempted_at DATETIME DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE Roles (
                          roles_id INT AUTO_INCREMENT PRIMARY KEY,
                          role_name VARCHAR(50) NOT NULL,
                          sort_order INT DEFAULT 0
);
CREATE TABLE Permission (
                          per_id INT AUTO_INCREMENT PRIMARY KEY,
                          per_name VARCHAR(50) NOT NULL
);
CREATE TABLE role_permission (
                                 roles_id INT,
                                 per_id INT,
                                 PRIMARY KEY(roles_id, per_id)
);

CREATE TABLE status_type (
                          statu_id INT AUTO_INCREMENT PRIMARY KEY,
                          status_name VARCHAR(50) NOT NULL
);
CREATE TABLE subscription_type (
                             sub_id INT AUTO_INCREMENT PRIMARY KEY,
                             sub_type enum('Free','Paid')
);

CREATE TABLE category (
    cat_id INT AUTO_INCREMENT PRIMARY KEY,
    cat_name VARCHAR(50) NOT NULL,
    sort_order INT DEFAULT 0
);

CREATE TABLE course (
    course_id INT AUTO_INCREMENT PRIMARY KEY,
    course_name VARCHAR(150) NOT NULL
);
CREATE TABLE category_by_course (
    cc_id INT AUTO_INCREMENT PRIMARY KEY,
    cat_id INT NOT NULL,
    course_id INT NOT NULL,
    FOREIGN KEY (cat_id) REFERENCES category(cat_id),
    FOREIGN KEY (course_id) REFERENCES course(course_id)
);
CREATE TABLE quiz (
    quiz_id INT AUTO_INCREMENT PRIMARY KEY,
    quiz_title VARCHAR(255) NOT NULL,
    quiz_data LONGTEXT NOT NULL, -- questions JSON / text
    course_id INT NOT NULL,
    cat_id INT NOT NULL,
    total_marks INT,
    duration_minutes INT,
    FOREIGN KEY (course_id) REFERENCES course(course_id),
    FOREIGN KEY (cat_id) REFERENCES category(cat_id)
);

CREATE TABLE quiz_attempt (
    attempt_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    quiz_id INT NOT NULL,
    obtained_marks INT,
    total_marks INT,
    attempt_date DATETIME DEFAULT CURRENT_TIMESTAMP,
    duration_taken INT, -- seconds
    FOREIGN KEY (user_id) REFERENCES users(user_id),
    FOREIGN KEY (quiz_id) REFERENCES quiz(quiz_id)
);
CREATE TABLE quiz_attempt_analysis (
    qa_id INT AUTO_INCREMENT PRIMARY KEY,
    attempt_id INT NOT NULL,
    question_id INT,
    is_correct BOOLEAN,
    FOREIGN KEY (attempt_id) REFERENCES quiz_attempt(attempt_id)
);
CREATE TABLE practice_set (
                              practice_id INT AUTO_INCREMENT PRIMARY KEY,
                              practice_questions JSON NOT NULL
);
CREATE TABLE course_practice_set (
                                     cp_id INT AUTO_INCREMENT PRIMARY KEY,
                                     course_id INT NOT NULL,
                                     practice_id INT NOT NULL,
                                     FOREIGN KEY (course_id) REFERENCES course(course_id),
                                     FOREIGN KEY (practice_id) REFERENCES practice_set(practice_id)
);
CREATE TABLE content_index (
                               content_index_id INT AUTO_INCREMENT PRIMARY KEY,
                               content_name LONGTEXT NOT NULL,
                               content_type ENUM('VIDEO','ARTICLE','QUIZ','PDF') NOT NULL
);
CREATE TABLE content (
                         content_id INT AUTO_INCREMENT PRIMARY KEY,
                         content_index_id INT NOT NULL,
                         content_data LONGTEXT NOT NULL,
                         FOREIGN KEY (content_index_id) REFERENCES content_index(content_index_id)
);
CREATE TABLE content_metadata (
                                  meta_id INT AUTO_INCREMENT PRIMARY KEY,
                                  content_id INT NOT NULL,
                                  title VARCHAR(255),
                                  description TEXT,
                                  FOREIGN KEY (content_id) REFERENCES content(content_id)
);
CREATE TABLE content_notes (
                               note_id INT AUTO_INCREMENT PRIMARY KEY,
                               content_id INT NOT NULL,
                               user_id INT NOT NULL,
                               note_text LONGTEXT NOT NULL,
                               created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
                               FOREIGN KEY (content_id) REFERENCES content(content_id),
                               FOREIGN KEY (user_id) REFERENCES users(user_id)
);
CREATE TABLE user_course_enrollment (
                                        enrollment_id INT AUTO_INCREMENT PRIMARY KEY,
                                        user_id INT NOT NULL,
                                        course_id INT NOT NULL,
                                        enrolled_on DATETIME DEFAULT CURRENT_TIMESTAMP,
                                        last_accessed DATETIME,
                                        status ENUM('ACTIVE','COMPLETED','PAUSED','DROPPED') DEFAULT 'ACTIVE',
                                        progress_percent DECIMAL(5,2) DEFAULT 0,
                                        FOREIGN KEY (user_id) REFERENCES users(user_id),
                                        FOREIGN KEY (course_id) REFERENCES course(course_id)
);
CREATE TABLE course_activity (
                                 activity_id INT AUTO_INCREMENT PRIMARY KEY,
                                 enrollment_id INT NOT NULL,
                                 activity_type ENUM('VIDEO','QUIZ','PRACTICE','NOTE','CONTENT_VIEW') NOT NULL,
                                 reference_id INT, -- quiz_id / content_id / practice_id
                                 activity_time DATETIME DEFAULT CURRENT_TIMESTAMP,
                                 duration_seconds INT,
                                 FOREIGN KEY (enrollment_id) REFERENCES user_course_enrollment(enrollment_id)
);
CREATE TABLE daily_study_log (
                                 log_id INT AUTO_INCREMENT PRIMARY KEY,
                                 user_id INT NOT NULL,
                                 course_id INT NOT NULL,
                                 study_date DATE NOT NULL,
                                 total_minutes INT DEFAULT 0,
                                 FOREIGN KEY (user_id) REFERENCES users(user_id),
                                 FOREIGN KEY (course_id) REFERENCES course(course_id)
);
CREATE TABLE course_progress (
                                 progress_id INT AUTO_INCREMENT PRIMARY KEY,
                                 enrollment_id INT NOT NULL,
                                 total_contents INT,
                                 completed_contents INT,
                                 total_quizzes INT,
                                 attempted_quizzes INT,
                                 FOREIGN KEY (enrollment_id) REFERENCES user_course_enrollment(enrollment_id)
);
CREATE TABLE user_last_activity (
                                    user_id INT PRIMARY KEY,
                                    course_id INT,
                                    last_activity DATETIME,
                                    FOREIGN KEY (user_id) REFERENCES users(user_id),
                                    FOREIGN KEY (course_id) REFERENCES course(course_id)
);
CREATE TABLE activity_master (
                                 activity_code VARCHAR(20) PRIMARY KEY,
                                 activity_name VARCHAR(100)
);
