CREATE DATABASE `livingworditpark` /*!40100 DEFAULT CHARACTER SET latin1 */;

CREATE TABLE `article` (
  `article_id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `author` varchar(50) NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`article_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#dummy data
INSERT INTO `article` (`article_id`,`title`,`author`,`date`) VALUES (1,'Does It Matter What Others Think?','John Piper','2001-06-25 00:00:00');
INSERT INTO `article` (`article_id`,`title`,`author`,`date`) VALUES (2,'Spiritual Boot Camp','Hank Hanegraaff','2014-06-20 00:00:00');
INSERT INTO `article` (`article_id`,`title`,`author`,`date`) VALUES (3,'Intelligence or Chance?','Donald E Calbreath','2006-08-05 00:00:00');

CREATE TABLE `events` (
  `event_id` int(11) NOT NULL AUTO_INCREMENT,
  `event_name` varchar(30) NOT NULL,
  `event_theme` varchar(30) NOT NULL,
  `date_start` datetime NOT NULL,
  `date_end` datetime NOT NULL,
  `description` text,
  `venue` varchar(50) NOT NULL,
  `reg` decimal(8,2) DEFAULT NULL,
  `event_photo` text,
  PRIMARY KEY (`event_id`),
  UNIQUE KEY `event_id_UNIQUE` (`event_id`)
) ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=latin1;

#dummy data
INSERT INTO `events` (`event_id`,`event_name`,`event_theme`,`date_start`,`date_end`,`description`,`venue`,`reg`,`event_photo`) VALUES (1,'Easter Cantata','Christ Arose','2015-04-05 09:30:00','2015-04-05 11:30:00','Celebration of the Lord\'s resurrection','6th Floor, Skyrise 4, IT Park, Lahug',NULL,'images/resources/StatementOfFaith_icon.jpg');
INSERT INTO `events` (`event_id`,`event_name`,`event_theme`,`date_start`,`date_end`,`description`,`venue`,`reg`,`event_photo`) VALUES (2,'VBS','Agency D3: Discover, Decide, D','2015-04-06 08:00:00','2015-04-10 11:30:00','Teaching your kids how to discover the truth about Jesus, and let them decide and defend for their f','6th Floor, Skyrise 4, IT Park, Lahug',1500.00,'images/resources/StatementOfFaith_icon.jpg');
INSERT INTO `events` (`event_id`,`event_name`,`event_theme`,`date_start`,`date_end`,`description`,`venue`,`reg`,`event_photo`) VALUES (3,'JAMM','Jesus and My Music','2015-03-10 21:30:00','2015-03-10 23:00:00','Sharing the gospel through Jesus Christ','Ground Floor, Skyrise 1, IT Park, Lahug',NULL,'images/resources/StatementOfFaith_icon.jpg');

CREATE TABLE `sermon` (
  `sermon_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `series` varchar(100) NOT NULL,
  `speaker` varchar(100) NOT NULL,
  `date` datetime NOT NULL,
  `scripture` varchar(100) DEFAULT NULL,
  `picture` varchar(100) DEFAULT NULL,
  `sermon` varchar(100) DEFAULT NULL,
  `sermon_notes` varchar(100) DEFAULT NULL,
  `leader_guide` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`sermon_id`),
  UNIQUE KEY `sermon_id_UNIQUE` (`sermon_id`)
) ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=latin1;

#dummy data
INSERT INTO `sermon` (`sermon_id`,`title`,`series`,`speaker`,`date`,`scripture`,`picture`,`sermon`,`sermon_notes`,`leader_guide`) VALUES (1,'The Plundering of Your Property and the Power of Hope in the Word','series1','Ptr. Nestor Sy','2015-01-01 00:00:00','Psalm 46','uploads/sermon/images/love.jpg','uploads/sermon/audio/2015/2015.01.11-more-than-words.mp3','uploads/sermon/images/sermon note.doc','uploads/sermon/images/leader\'s guide.doc');
INSERT INTO `sermon` (`sermon_id`,`title`,`series`,`speaker`,`date`,`scripture`,`picture`,`sermon`,`sermon_notes`,`leader_guide`) VALUES (2,'The Glory of God in the Good Resolves of His People','series1','Dr. Anthony Ang','2015-02-15 00:00:00','Psalm 46','uploads/sermon/images/sermon_img.jpg','uploads/sermon/audio/2015/2015.01.11-more-than-words.mp3','uploads/sermon/images/sermon note.doc','uploads/sermon/images/leader\'s guide.doc');
INSERT INTO `sermon` (`sermon_id`,`title`,`series`,`speaker`,`date`,`scripture`,`picture`,`sermon`,`sermon_notes`,`leader_guide`) VALUES (3,'Evangelism','series1','Ptr. Jojo Chua','2014-11-16 00:00:00','Psalm 46','uploads/sermon/images/white-cross-with-heart-on-pink.jpg','uploads/sermon/audio/2015/2015.01.11-more-than-words.mp3','uploads/sermon/images/sermon note.doc','uploads/sermon/images/leader\'s guide.doc');
INSERT INTO `sermon` (`sermon_id`,`title`,`series`,`speaker`,`date`,`scripture`,`picture`,`sermon`,`sermon_notes`,`leader_guide`) VALUES (4,'Service','series1','Elder Nick Shan','2014-11-16 00:00:00','psalm 1','uploads/sermon/images/cloud_heart_jesus_hd_wallpaper.jpg','uploads/sermon/audio/2015/2015.01.11-more-than-words.mp3','','');
