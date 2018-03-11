CREATE TABLE `IT350`.`User` (`username` VARCHAR(40) NOT NULL , `password` VARCHAR(40) NOT NULL , `firstname` VARCHAR(40) NOT NULL , `lastname` VARCHAR(40) NOT NULL , `phonenumber` VARCHAR(40) NOT NULL , `address` VARCHAR(255) NOT NULL , `email` VARCHAR(40) NOT NULL , `privledge` INT NOT NULL DEFAULT '0' , PRIMARY KEY (`username`)) ENGINE = InnoDB;
CREATE TABLE `IT350`.`PaymentMethod` ( `paymentMethodId` INT NULL , `paymentInfo` VARCHAR(255) NOT NULL , `paymentType` INT NOT NULL , `username` VARCHAR(40) NOT NULL , PRIMARY KEY (`paymentMethodId`)) ENGINE = InnoDB;
CREATE TABLE `IT350`.`ProcessingCompany` ( `paymentTypeId` INT NOT NULL AUTO_INCREMENT , `processingCompany` VARCHAR(255) NOT NULL , PRIMARY KEY (`paymentTypeId`)) ENGINE = InnoDB;
CREATE TABLE `IT350`.`ShoppingCart` ( `cartId` INT NOT NULL AUTO_INCREMENT , `username` VARCHAR(40) NOT NULL , `totalCost` INT NULL , PRIMARY KEY (`cartId`)) ENGINE = InnoDB;
CREATE TABLE `IT350`.`List` ( `cartId` INT NOT NULL , `itemId` INT NOT NULL , `quantity` INT NOT NULL , PRIMARY KEY (`cartId`, `itemId`)) ENGINE = InnoDB;
CREATE TABLE `IT350`.`Item` ( `itemId` INT NOT NULL AUTO_INCREMENT , `itemName` VARCHAR(255) NOT NULL , `description` VARCHAR(512) NOT NULL , `quantity` INT NOT NULL , `cost` DECIMAL NOT NULL , `categoryId` INT NOT NULL , PRIMARY KEY (`itemId`)) ENGINE = InnoDB;
CREATE TABLE `IT350`.`Review` ( `reviewId` INT NOT NULL AUTO_INCREMENT , `itemId` INT NOT NULL , `username` VARCHAR(40) NOT NULL , `description` VARCHAR(512) NOT NULL , PRIMARY KEY (`reviewId`)) ENGINE = InnoDB;
CREATE TABLE `IT350`.`Feedback` ( `feedbackId` INT NOT NULL AUTO_INCREMENT , `orderNumber` INT NOT NULL , `description` VARCHAR(255) NOT NULL , PRIMARY KEY (`feedbackId`)) ENGINE = InnoDB;

CREATE TABLE `IT350`.`Category` (
  `categoryId` int(11) NOT NULL,
  `name` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `IT350`.`CustomerOrder` (
  `orderNumber` int(11) NOT NULL,
  `trackingNumber` varchar(10) DEFAULT NULL,
  `username` varchar(40) NOT NULL,
  `paymentMethod` int(11) NOT NULL,
  `cartId` int(11) NOT NULL,
  `transactionDate` date NOT NULL,
  `fulfilled` date DEFAULT NULL,
  `totalCost` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;