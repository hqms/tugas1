/*

 Source Server         : docker
 Source Server Type    : MySQL
 Source Server Version : 50505
 Source Host           : localhost
 Source Database       : tugas1

 Target Server Type    : MySQL
 Target Server Version : 50505
 File Encoding         : utf-8

 Date: 09/14/2017 21:15:49 PM
*/

SET NAMES utf8;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
--  Table structure for `categories`
-- ----------------------------
DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Records of `categories`
-- ----------------------------
BEGIN;
INSERT INTO `categories` VALUES ('1', 'Appetizer'), ('2', 'Pasta'), ('3', 'Dessert'), ('5', 'Coffee');
COMMIT;

-- ----------------------------
--  Table structure for `menus`
-- ----------------------------
DROP TABLE IF EXISTS `menus`;
CREATE TABLE `menus` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `price` decimal(10,0) DEFAULT NULL,
  `description` varchar(200) DEFAULT NULL,
  `image` varchar(200) DEFAULT 'NULL',
  `id_cat` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Records of `menus`
-- ----------------------------
BEGIN;
INSERT INTO `menus` VALUES ('1', 'French Fries', '20000', 'Kentang goreng bercita rasa tinggi sekali', 'https://cms.splendidtable.org/sites/default/files/styles/900x500/public/french-fries.jpg?itok=2wcnbFAY', '1'), ('2', 'Bruschetta', '35000', 'Bruschetta with tomato and basil. Chopped fresh tomatoes with garlic, basil, olive oil, and vinegar, served on toasted slices of French or Italian', 'http://ot-foodspotting-production.s3.amazonaws.com/reviews/1896236/thumb_600.jpg?1339715029', '1'), ('3', 'Chicken Wing', '25000', 'From hot Buffalo wings to milder versions, find dozens of chicken wing recipes. See how to bake, deep-fry, or grill wings', 'https://search.chow.com/thumbnail/800/600/www.chowstatic.com/assets/recipe_photos/30492_korean_chicken_wings.jpg', '1'), ('4', 'Spaghetti Bolognese', '40000', 'A traditional spaghetti Bolognese recipe with homemade Bolognese sauce and tender beef, making this a family favourite. ', 'https://scm-assets.constant.co/scm/unilever/a6798e909fa57bfd19c3e7f00737e5d6/d6ed4451-2c6b-4782-b19e-da7c6c558cc3.jpg', '2'), ('5', 'Fettucini Carbonara', '43000', 'Do you want to cook creamy and tasty fettucine carbonara ala restaurants', 'https://cdn2.tmbi.com/TOH/Images/Photos/37/1200x1200/Fettuccine-Carbonara_exps175448_SD143205B01_28_2bC_RMS.jpg', '2'), ('6', 'Ice Cream', '15000', 'Ice cream is a sweetened frozen food typically eaten as a snack or dessert. It is usually made from dairy products, such as milk and cream, and often combined', 'https://www.biggerbolderbaking.com/wp-content/uploads/2016/05/BBB124-Top-5-Homemade-Ice-Cream-Flavors-Thumbnail-FINAL-2-1024x576.jpg', '3'), ('7', 'Espresso', '20000', 'Espresso is coffee brewed by forcing a small amount of nearly boiling water under pressure through finely ground coffee beans', 'https://majalah.ottencoffee.co.id/wp-content/uploads/2016/10/espresso_830x550.jpg', '5'), ('8', 'Latte', '35000', 'A latte is a coffee drink made with espresso and steamed milk. The term as used in English is a shortened form of the Italian caffè latte ', 'https://s3-us-west-2.amazonaws.com/beachbody-blog/uploads/2017/04/Beachbody-Blog-Pumpkin-Spice-Latte.jpg', '5');
COMMIT;

-- ----------------------------
--  Table structure for `user`
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(150) DEFAULT NULL,
  `group` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
--  Records of `user`
-- ----------------------------
BEGIN;
INSERT INTO `user` VALUES ('1', 'hakim', 'password', 'admin');
COMMIT;

-- ----------------------------
--  Register user 'user'
-- ----------------------------
GRANT USAGE ON *.* TO 'users'@'%' IDENTIFIED BY 'userpassword'

GRANT Select ON TABLE `tugas1`.`user` TO `user`@`localhost`;
GRANT Insert, Select, Update ON TABLE `tugas1`.`categories` TO `user`@`localhost`;
GRANT Insert, Select, Update ON TABLE `tugas1`.`menus` TO `user`@`localhost`;

-- ----------------------------
--  Register user 'admin'
-- ----------------------------
GRANT USAGE ON *.* TO 'admin'@'%' IDENTIFIED BY 'adminpassword'

GRANT Insert, Select, Update, Delete ON TABLE `tugas1`.`user` TO `user`@`localhost`;
GRANT Insert, Select, Update, Delete ON TABLE `tugas1`.`categories` TO `user`@`localhost`;
GRANT Insert, Select, Update, Delete ON TABLE `tugas1`.`menus` TO `user`@`localhost`;

FLUSH PRIVILEGES;

SET FOREIGN_KEY_CHECKS = 1;
