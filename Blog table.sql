SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;


CREATE TABLE `tbl_blog` 
	( `fld_bid` INT NOT NULL AUTO_INCREMENT 
	, `fld_btitle` VARCHAR(128) NOT NULL 
	, `fld_bcontent` TEXT NOT NULL 
	, `fld_bpict` VARCHAR(128) NOT NULL 
	, `fld_bdate` DATE NOT NULL DEFAULT CURRENT_TIMESTAMP 
	, `fld_uid` INT NOT NULL , PRIMARY KEY (`fld_bid`)
) ENGINE = InnoDB;

CREATE TABLE `tbl_feedback` 
	( `fld_fid` INT NOT NULL AUTO_INCREMENT
	, `fld_username` VARCHAR(64) NOT NULL 
	, `fld_feedback` TEXT NOT NULL 
	, `fld_bid` INT NOT NULL 
	, `fld_uid` INT NOT NULL 
	, PRIMARY KEY (`fld_fid`)
) ENGINE = InnoDB

CREATE TABLE `tbl_login` (
  `fld_uid` int(11) NOT NULL AUTO_INCREMENT,
  `fld_username` varchar(64) NOT NULL,
  `fld_password` varchar(64) NOT NULL,
  `fld_act_type` varchar(32) NOT NULL DEFAULT 'reader',
  `fld_useremail` varchar(64) NOT NULL, 
  PRIMARY KEY (`fld_uid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `tbl_login` (`fld_username`, `fld_password`, `fld_act_type`, `fld_useremail`) VALUES
('admin', '7c222fb2927d828af22f592134e8932480637c0d', 'editor', 'super.admin@gmail.com');

('administrator', 'admin1234', 'editor', 'super.admin@gmail.com');
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
