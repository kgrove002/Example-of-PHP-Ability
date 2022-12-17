DROP DATABASE IF EXISTS `landscape`;
CREATE DATABASE `landscape`; 
USE `landscape`;

SET NAMES utf8 ;
SET character_set_client = utf8mb4 ;

CREATE TABLE `customer` (
    `customer_ID` int(4) NOT NULL AUTO_INCREMENT,
    `customer_L_Name` VARCHAR(50) NOT NULL,
    `customer_F_Name` VARCHAR(50) NOT NULL,
    `customer_title` VARCHAR(50) NOT NULL,   
    `street_Address` VARCHAR(50) NOT NULL,  
    `city_State_Zip` VARCHAR(50) NOT NULL,
    `customer_Phone` VARCHAR(50) NOT NULL,
    `customer_Email` VARCHAR(50) NOT NULL DEFAULT 'darkandalone23@live.com',
  PRIMARY KEY (`customer_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

INSERT INTO `customer` VALUES (DEFAULT, 'King', 'Jean', 'Mr', '8489 Strong St.', 'Las Vegas, NV 83030', '7025551838', DEFAULT );
INSERT INTO `customer` VALUES (DEFAULT, 'Nelson', 'Susan', 'Ms', '567 Strong St.', 'San Rafael, CA 97562', '4155551450', DEFAULT );
INSERT INTO `customer` VALUES (DEFAULT, 'Murphy', 'Julie', 'Ms', '5557 North Pendale Street', 'San Francisco, CA 94217', '6505555787', DEFAULT );
INSERT INTO `customer` VALUES (DEFAULT, 'Lee', 'Kwai', 'Mr', '897 Long Airport Avenue', 'NYC, NY 10022', '2125557818', DEFAULT );
INSERT INTO `customer` VALUES (DEFAULT, 'Young', 'Jeff', 'Mr', '4092 Furth Circle Suite 400', 'NYC, NY 10022', '2125557413', DEFAULT );

CREATE TABLE `billing` (
    `invoice_ID` int(4) NOT NULL AUTO_INCREMENT,
    `customer_ID` int(4) NOT NULL,
    `customer_L_Name` VARCHAR(50) NOT NULL,
    `service` VARCHAR(50) NOT NULL,
    `customer_bill` DECIMAL(9,2) DEFAULT '0.00',   
    `amt_paid` DECIMAL(9,2) DEFAULT '0.00',  
    `bill_date` DATE DEFAULT NULL,
    `date_paid` DATE DEFAULT NULL,
  PRIMARY KEY (`invoice_ID`),
  KEY `FK_customer_id` (`customer_id`),
  CONSTRAINT `FK_customer_id` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`customer_id`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

INSERT INTO `billing` VALUES (DEFAULT, '1', 'King', 'Hedging', 40.50, DEFAULT, '2022-07-02', DEFAULT);
INSERT INTO `billing` VALUES (DEFAULT, '1', 'King', 'Gardening', 35.75, DEFAULT, '2022-08-03', DEFAULT);
INSERT INTO `billing` VALUES (DEFAULT, '2', 'Nelson', 'Gardening', 20.75, 15.00, '2022-04-05', '2022-04-12');
INSERT INTO `billing` VALUES (DEFAULT, '3', 'Murphy', 'Mowing', 50.00, DEFAULT, '2022-06-15', DEFAULT);
INSERT INTO `billing` VALUES (DEFAULT, '4', 'Lee', 'Hedging', 40.50, DEFAULT, '2022-08-05', DEFAULT);
INSERT INTO `billing` VALUES (DEFAULT, '5', 'Young', 'Hedging', 40.50, DEFAULT, '2022-09-25', DEFAULT);
