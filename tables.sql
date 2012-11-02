CREATE TABLE articles (
	`id` INT(8) auto_increment,
	`title` varchar(100) NOT NULL,
	`seftitle` varchar(100) NOT NULL,
	`text` longtext NOT NULL,
	`category` INT(8) NOT NULL,
	`visible` enum('YES','NO') NOT NULL default 'YES',
	`artorder` INT(8) NOT NULL default '0',
	`public` enum('YES','NO','SPC') NOT NULL default 'YES',
	`byline` enum('YES','NO') NOT NULL default 'YES',
	`comments` enum('YES','NO') NOT NULL default 'YES',
	`views` INT(8) NOT NULL default '0',
	`rating` INT(8) NOT NULL default '0',
	`display_title` enum('YES','NO') NOT NULL default 'YES',
	`date` INT(11) NOT NULL default '0',
	`postedBy` INT(8) NOT NULL default '0',
	PRIMARY KEY (`id`)
 );

 CREATE TABLE categories (
	`id` INT(8) auto_increment,
	`title` varchar(100) NOT NULL,
	`seftitle` varchar(100) NOT NULL,
	`catorder` INT(8) NOT NULL default '0',
	`visible` enum('YES','NO') NOT NULL default 'YES',
	`max` INT(8) NOT NULL default '0',
	`public` enum('YES','NO','SPC') NOT NULL default 'YES',
	`views` INT(8) NOT NULL default '0',
	`sortBy` varchar(100) NOT NULL default 'id',
	PRIMARY KEY (`id`)
 );
 INSERT INTO categories VALUES (1, 'Home', 'home', '0', 'YES', '0', 'YES', '0','id');

CREATE TABLE comments (
	`id` INT(8) NOT NULL AUTO_INCREMENT,
	`comment` LONGTEXT NOT NULL,
	`userID` VARCHAR(100) NOT NULL,
	`articleID` INT(8) NOT NULL,
	`websiteURL` VARCHAR(100) NOT NULL,
	`date` INT(11) NOT NULL default '0',
	`approved` enum('YES','NO') NOT NULL default 'NO',
	`email` VARCHAR(100) NOT NULL,
	PRIMARY KEY (`id`)
 );

 CREATE TABLE wallPosts (
	`id` INT(8) NOT NULL AUTO_INCREMENT,
	`text` LONGTEXT NOT NULL,
	`userID` VARCHAR(100) NOT NULL,
	`posterID` INT(8) NOT NULL,
	`date` INT(11) NOT NULL default '0',
	`approved` enum('YES','NO') NOT NULL default 'NO',
	PRIMARY KEY (`id`)
 );
 
CREATE TABLE users (
	`id` INT(8) NOT NULL AUTO_INCREMENT,
	`username` VARCHAR(100) NOT NULL,
	`password` VARCHAR(100) NOT NULL,
	`name` VARCHAR(100) NOT NULL,
	`email` VARCHAR(100) NOT NULL,
	`banned` enum('YES','NO') NOT NULL default 'NO',
	`permissions` VARCHAR(100) NOT NULL,
	`ip` VARCHAR(100) NOT NULL,
	`ipVisit` VARCHAR(100) NOT NULL,
	`online` enum('YES','NO') NOT NULL default 'NO',
	`dateJoined` int(11) NOT NULL,
	`lastVisit` int(11) NOT NULL,
	`stats` VARCHAR(100) NOT NULL,
	`uniqueID` VARCHAR(32) NOT NULL,
	`websiteURL` VARCHAR(100) NOT NULL,
	`about_me` longtext NOT NULL,
	`views` int(8) NOT NULL,
	`wall` enum('YES','NO') NOT NULL default 'YES',
	`thumb` VARCHAR(100) NOT NULL,
	`thumbraw` VARCHAR(100) NOT NULL,
	`signature` longtext NOT NULL,
	PRIMARY KEY (`id`)
 );


INSERT INTO users VALUES (1, 'test', 'e25792d701ed4a8a1381bba97c45b46b', 'start_up_account', '', 'NO', 'administrator', '1','1','NO',0,'','','d6e8513ef74cccea7a913b5eb59829cd','','','','','','','');

 
CREATE TABLE settings (
	`id` INT(8) NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(60) NOT NULL,
	`value` LONGTEXT NOT NULL,
	PRIMARY KEY (`id`)
 );

INSERT INTO settings VALUES (1, 'title', 'sUbmit CMS');
INSERT INTO settings VALUES (2, 'template', 'default');
INSERT INTO settings VALUES (3, 'login_disabled', 'NO');
INSERT INTO settings VALUES (4, 'keywords', 'sUmbit, PHP, CMS, mySQL');
INSERT INTO settings VALUES (5, 'email', 'webmaster@website.com');
INSERT INTO settings VALUES (6, 'description', 'sUmbit CMS');
INSERT INTO settings VALUES (7, 'offline', 'NO');
INSERT INTO settings VALUES (8, 'comments_order', 'DESC');
INSERT INTO settings VALUES (9, 'comments_limit', '10');
INSERT INTO settings VALUES (10, 'comments_freeze', 'NO');
INSERT INTO settings VALUES (11, 'footer', 'Powered by sUmbit 2.1 | ©2008 All Rights Reserved');
INSERT INTO settings VALUES (12, 'offline_message', 'We are currently performing site maINTenance. Please Come Back Later');
INSERT INTO settings VALUES (13, 'new_on_home', 'NO');
INSERT INTO settings VALUES (14, 'article_views', 'NO');
INSERT INTO settings VALUES (15, 'article_ratings', 'NO');
INSERT INTO settings VALUES (16, 'registration_disabled', 'NO');
INSERT INTO settings VALUES (17, 'comment_permissions', 'NO');
INSERT INTO settings VALUES (18, 'subtitle', 'Website Sub Title');
INSERT INTO settings VALUES (19, 'comments_disabled', 'NO');
INSERT INTO settings VALUES (20, 'stats', 'NO');
INSERT INTO settings VALUES (21, 'register_email', 'NO');
INSERT INTO settings VALUES (22, 'comment_approval', 'NO');
INSERT INTO settings VALUES (23, 'email_on_register', 'NO');
INSERT INTO settings VALUES (24, 'email_on_comment', 'NO');
INSERT INTO settings VALUES (25, 'rss_limit', '10');
INSERT INTO settings VALUES (26, 'rss_comments', 'NO');
INSERT INTO settings VALUES (27, 'rss_articles', 'YES');
INSERT INTO settings VALUES (28, 'date_format', 'dS M, Y @ h:i a');
INSERT INTO settings VALUES (29, 'wysiwyg', 'NO');
INSERT INTO settings VALUES (30, 'community', 'NO');
INSERT INTO settings VALUES (31, 'language', 'EN');
INSERT INTO settings VALUES (32, 'word_filter_change', '');
INSERT INTO settings VALUES (33, 'word_filter_file', 'badwords.txt');
INSERT INTO settings VALUES (34, 'word_filter_enable', 'NO');
INSERT INTO settings VALUES (35, 'user_pages', 'NO');
INSERT INTO settings VALUES (36, 'admin_template', 'default');

 CREATE TABLE messages (
	`id` INT(8) NOT NULL auto_increment,
	`reciever` varchar(25) NOT NULL default '',
	`sender` varchar(25) NOT NULL default '',
	`subject` text NOT NULL,
	`message` longtext NOT NULL,
	`dateSent` INT(11) default NULL default '0',
	`dateRecieved` INT(11) default NULL default '0',
	`recieved` enum('YES','NO') default 'NO',
	`files` longtext NOT NULL,
	PRIMARY KEY (`id`)
);

CREATE TABLE `usersOnline` (
  `id` int(11) NOT NULL auto_increment,
  `ip` varchar(100) NOT NULL ,
  `date` int(14) NOT NULL,
  PRIMARY KEY  (`id`)
)