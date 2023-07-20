
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

CREATE TABLE `companydata` (
  `user_id` int(11) NOT NULL,
  `date` int(11) NOT NULL,
  `assets` int(11) NOT NULL,
  `liability` int(11) NOT NULL,
  `accbalance` int(11) NOT NULL
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



CREATE TABLE `Transaction` (
 `user_id` int(11) NOT NULL,
  `date` int(11) NOT NULL,
  `assets` int(11) NOT NULL,
  `liability` int(11) NOT NULL,
  `status` varchar(300) NOT NULL,
  `phone1` int(9) NOT NULL,
  `phone2` int(9) NOT NULL,
  `paystatus` text(9) NOT NULL,
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


CREATE TABLE `users` (
  `id` int(11) NOT NULL PRIMARY KEY,
  `user_id` int(11) NOT NULL,  
  `fname` int(22) NOT NULL,
  `lname` varchar(22) NOT NULL,
  `account` int(22) NOT NULL,
  `password` varchar(22) NOT NULL
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO users (user_id,date,assets,liability,accbalance) 
 VALUES (11111,2023, 0,0, 50000);
