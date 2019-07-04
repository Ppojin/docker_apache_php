create database if not exists userDB;
use userDB;
create table users(
    id INT PRIMARY KEY AUTO_INCREMENT,
    r_code VARCHAR(40) UNIQUE,
    recommender VARCHAR(40),
    email VARCHAR(40) UNIQUE NOT NULL,
    signin_date datetime DEFAULT CURRENT_TIMESTAMP NOT NULL,
    pwd VARCHAR(40) NOT NULL,
    name VARCHAR(40) NOT NULL,
    phone VARCHAR(40) UNIQUE NOT NULL
);

DELIMITER ;;
CREATE TRIGGER `users_before_insert` 
BEFORE INSERT ON `users` FOR EACH ROW 
BEGIN
  IF new.r_code IS NULL THEN
    SET new.r_code = LEFT(UUID(), 4);
  END IF;
END;;
DELIMITER ;