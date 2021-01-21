
SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

CREATE DATABASE IF NOT EXISTS `foodorder` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `foodorder`;

DROP TABLE IF EXISTS `address`;
CREATE TABLE IF NOT EXISTS `address` (
`id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `line1` text NOT NULL,
  `line2` text,
  `city` varchar(30) NOT NULL,
  `phone` varchar(10) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

INSERT INTO `address` (`id`, `user_id`, `name`, `line1`, `line2`, `city`, `phone`) VALUES
(1, 3, 'Sanchit', 'R-2 Evergreen Appts,', 'Prahladnagar', 'Ahmedabad', '9158514761'),
(2, 3, 'Raju', 'Hostel 2, Nirma University', 'Sarkhej-Gandhinagar Highway', 'Ahmedabad', '9158514761'),
(3, 3, 'Mansi', 'Girls Hostel, Nirma University', 'Sarkhej-Gandhinagar Highway', 'Ahmedabad', '9765024148');


DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
`id` int(11) NOT NULL,
  `categ` varchar(20) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;


INSERT INTO `categories` (`id`, `categ`) VALUES
(1, 'Chinese'),
(4, 'Thai'),
(2, 'Mexican'),
(3, 'Italian'),
(5, 'French'),
(6, 'Best of Indian');



DROP TABLE IF EXISTS `discount`;
CREATE TABLE IF NOT EXISTS `discount` (
`id` int(11) NOT NULL,
  `code` varchar(15) NOT NULL,
  `percent` int(11) NOT NULL,
  `minprice` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;


INSERT INTO `discount` (`id`, `code`, `percent`, `minprice`, `status`) VALUES
(1, 'Spicy250', 10, 250, 0),
(2, 'NonVeggie50', 50, 200, 1);


DROP TABLE IF EXISTS `fooditems`;
CREATE TABLE IF NOT EXISTS `fooditems` (
`id` int(40) NOT NULL,
  `itemname` varchar(40) NOT NULL,
  `category_id` int(40) NOT NULL,
  `price` int(10) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;


INSERT INTO `fooditems` (`id`, `itemname`, `category_id`, `price`) VALUES
(3, 'Taste of Punjab', 6, 315),
(4, 'North Indian Curry', 6, 125),
(5, 'Pizza style Dosa', 6, 250),
(6, 'Dal Makhani', 6, 90),
(7, 'Dal Fry', 6, 65),
(8, 'Dal Tadka', 6, 75),
(9, 'Taste of Gujarat', 6, 275),
(10, 'Japanese Ramen(w. the Best Noodles of Shanghai)',1,920),
(11, 'Fried Rice',1,445),
(12, 'Szechuan Noodles',1,445),
(13, 'Best of Chinese Street Food',1,285),
(14, 'Dan Dan Noodles',1,845),
(15, 'Cabbage Soup',1,145),
(16, 'Tom Yum Goong',4,1045),
(17, 'Flavors of Pad Thai',4,945),
(18, 'Gaeng Keow Wan Gai',4,1245),
(19, 'Tom Kha Gai',4,1245),
(20, 'Khao Soi (Creamy Coconut Noodle Soup)',4,1045),
(21, 'Chilaquiles',2,645),
(22, 'Tacos al pastor',2,849),
(23, 'Chiles en nogada',2,1245),
(24, 'Pozole',2,545),
(25, 'Mole (National Sauce)',2,745),
(26, 'Pizza Napoletana',3,1245),
(27, 'Lasagna',3,545),
(28, 'Ossobuco alla Milanese',3,999),
(29, 'Spaghetti alla Carbonara (Best of Rome)',3,1545),
(30, 'Cicchetti (Best of Venice)',3,1545),
(31, 'Soupe a loignon',5,1045),
(32, 'Coq au vin',5,745),
(33, 'Cassoulet',5,545),
(34, 'Chocolate souffle',5,645),
(35, 'Salade Nicoise',5,745);



DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
`id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `discount_id` int(11) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `addressid` int(11) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0=not completed, 1=new, 2=Ready, 3=Transit, 4=Delivered'
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;


INSERT INTO `orders` (`id`, `user_id`, `discount_id`, `price`, `addressid`, `status`) VALUES
(2, 3, 1, 410, 3, 4),
(5, 3, 1, 324, 1, 4);

DROP TABLE IF EXISTS `order_fooditems`;
CREATE TABLE IF NOT EXISTS `order_fooditems` (
  `order_id` int(11) NOT NULL,
  `fooditems_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `remarks` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


INSERT INTO `order_fooditems` (`order_id`, `fooditems_id`, `quantity`, `remarks`) VALUES
(2, 3, 4, ''),
(2, 5, 2, 'Extra butter'),
(2, 6, 1, 'Spicy'),
(2, 7, 1, ''),
(5, 4, 6, ''),
(5, 5, 1, 'Spicy'),
(6, 3, 10, ''),
(6, 5, 2, 'Spicy'),
(6, 9, 2, ''),
(7, 3, 6, ''),
(7, 5, 1, 'Spicy'),
(7, 6, 1, 'Pack Seperately'),
(7, 9, 1, '');



DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
`id` int(11) NOT NULL,
  `name` text NOT NULL,
  `email` varchar(40) NOT NULL,
  `password` varchar(30) NOT NULL,
  `type` tinyint(4) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;


INSERT INTO `user` (`id`, `name`, `email`, `password`, `type`) VALUES
(1, 'Admin', 'admin@foodorder.com', 'admin', 0),
(2, 'Manager', 'manager@foodorder.com', 'manager', 1),
(3, 'Amit', 'a.daveamit@gmail.com', 'a', 2);


ALTER TABLE `address`
 ADD PRIMARY KEY (`id`), ADD KEY `addr` (`user_id`);


ALTER TABLE `categories`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `categ` (`categ`);


ALTER TABLE `discount`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `code` (`code`);

ALTER TABLE `fooditems`
 ADD PRIMARY KEY (`id`), ADD KEY `category_id` (`category_id`);

ALTER TABLE `orders`
 ADD PRIMARY KEY (`id`), ADD KEY `user_id` (`user_id`,`discount_id`), ADD KEY `addressid` (`addressid`), ADD KEY `discorder` (`discount_id`);


ALTER TABLE `order_fooditems`
 ADD PRIMARY KEY (`order_id`,`fooditems_id`), ADD KEY `order_id` (`order_id`,`fooditems_id`), ADD KEY `jointblfood` (`fooditems_id`);


ALTER TABLE `user`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `email` (`email`);


ALTER TABLE `address`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;

ALTER TABLE `categories`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;

ALTER TABLE `discount`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;

ALTER TABLE `fooditems`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;

ALTER TABLE `orders`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;

ALTER TABLE `user`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;

ALTER TABLE `address`
ADD CONSTRAINT `addrusr` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;


ALTER TABLE `fooditems`
ADD CONSTRAINT `categfood` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;


ALTER TABLE `orders`
ADD CONSTRAINT `addrordr` FOREIGN KEY (`addressid`) REFERENCES `address` (`id`) ON DELETE SET NULL ON UPDATE NO ACTION,
ADD CONSTRAINT `discordr` FOREIGN KEY (`discount_id`) REFERENCES `discount` (`id`) ON DELETE SET NULL ON UPDATE NO ACTION,
ADD CONSTRAINT `usrorder` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

ALTER TABLE `order_fooditems`
ADD CONSTRAINT `jointblfood` FOREIGN KEY (`fooditems_id`) REFERENCES `fooditems` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `jointblodr` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;
SET FOREIGN_KEY_CHECKS=1;
