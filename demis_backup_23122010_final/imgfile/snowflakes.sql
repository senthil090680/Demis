-- phpMyAdmin SQL Dump
-- version 2.11.9.6
-- http://www.phpmyadmin.net
--
-- Host: mysql
-- Generation Time: Jul 27, 2012 at 06:25 PM
-- Server version: 4.1.14
-- PHP Version: 5.2.12

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Database: `shopping_snow`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `ADMIN_ID` int(11) NOT NULL auto_increment,
  `USERNAME` varchar(200) NOT NULL default '',
  `PASSWORD` varchar(200) NOT NULL default '',
  `EMAIL` varchar(200) NOT NULL default '',
  `MOBILE` varchar(200) NOT NULL default '',
  `STATUS` enum('Y','N') default NULL,
  PRIMARY KEY  (`ADMIN_ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`ADMIN_ID`, `USERNAME`, `PASSWORD`, `EMAIL`, `MOBILE`, `STATUS`) VALUES
(1, 'admin', 'admin123', 'senw4@wererew.com', '1234567890', NULL),
(3, 'superadmi', 'adminsuper', 'webcam@gmail.com', '8989456566', 'Y'),
(5, 'ewwersdfsdfsdfwe', '343frsdrerwerwe', 'senthil@dsfdfgfsd.com', '3234234343', 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `background`
--

CREATE TABLE IF NOT EXISTS `background` (
  `BACKGROUND_ID` int(11) NOT NULL auto_increment,
  `BACKGROUND_PATH` varchar(200) NOT NULL default '',
  PRIMARY KEY  (`BACKGROUND_ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `background`
--

INSERT INTO `background` (`BACKGROUND_ID`, `BACKGROUND_PATH`) VALUES
(5, 'a1d4fSunset.jpg'),
(6, 'aada0Sunset.jpg'),
(8, 'b96ccSunset.jpg'),
(9, 'faad8cocunt - man rotate.mp3'),
(10, '54c09Water_lilies.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `backup`
--

CREATE TABLE IF NOT EXISTS `backup` (
  `BACK_ID` int(11) NOT NULL auto_increment,
  `FILE_NAME` varchar(200) NOT NULL default '',
  PRIMARY KEY  (`BACK_ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `backup`
--

INSERT INTO `backup` (`BACK_ID`, `FILE_NAME`) VALUES
(6, 'sql_snow_Nov_23_2010_12.sql'),
(9, 'sql_snow_Nov_23_2010_26.sql'),
(8, 'sql_snow_Nov_23_2010_25.sql'),
(10, 'sql_snow_Nov_23_2010_27.sql'),
(11, 'sql_snow_Nov_23_2010_03.sql'),
(12, 'sql_snow_Nov_23_2010_07.sql'),
(13, 'sql_snow_Nov_23_2010_10.sql'),
(14, 'sql_snow_Nov_23_2010_13.sql');

-- --------------------------------------------------------

--
-- Table structure for table `config`
--

CREATE TABLE IF NOT EXISTS `config` (
  `CONFIG_ID` int(11) NOT NULL auto_increment,
  `APPLICATION_NAME` varchar(200) NOT NULL default '',
  `LEVEL_TIME` double NOT NULL default '0',
  `NONCAM_BG_PATH` int(11) NOT NULL default '0',
  `MUSIC_PATH` varchar(200) NOT NULL default '',
  PRIMARY KEY  (`CONFIG_ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `config`
--

INSERT INTO `config` (`CONFIG_ID`, `APPLICATION_NAME`, `LEVEL_TIME`, `NONCAM_BG_PATH`, `MUSIC_PATH`) VALUES
(1, 'digient', 12, 6, 'Winter.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `fallingpath`
--

CREATE TABLE IF NOT EXISTS `fallingpath` (
  `FALLINGPATH_ID` int(11) NOT NULL auto_increment,
  `DEGREE` double NOT NULL default '0',
  `OCCURRENCE` double NOT NULL default '0',
  PRIMARY KEY  (`FALLINGPATH_ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=31 ;

--
-- Dumping data for table `fallingpath`
--

INSERT INTO `fallingpath` (`FALLINGPATH_ID`, `DEGREE`, `OCCURRENCE`) VALUES
(1, 260, 25),
(5, 270, 50),
(6, 280, 25);

-- --------------------------------------------------------

--
-- Table structure for table `game`
--

CREATE TABLE IF NOT EXISTS `game` (
  `GAME_ID` int(11) NOT NULL auto_increment,
  `USER_ID` int(11) NOT NULL default '0',
  `SCORE` int(11) NOT NULL default '0',
  `TOTAL_SECS` int(11) NOT NULL default '0',
  `LEVEL_ID` int(11) NOT NULL default '0',
  `GAME_DATE` datetime NOT NULL default '0000-00-00 00:00:00',
  `TYPE_GAME` varchar(200) NOT NULL default '',
  `PIC_PATH` varchar(200) NOT NULL default '',
  PRIMARY KEY  (`GAME_ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `game`
--

INSERT INTO `game` (`GAME_ID`, `USER_ID`, `SCORE`, `TOTAL_SECS`, `LEVEL_ID`, `GAME_DATE`, `TYPE_GAME`, `PIC_PATH`) VALUES
(1, 1, 52, 23, 0, '2010-11-22 22:17:57', 'snowflake', ''),
(2, 1, 25, 41, 0, '2010-11-23 11:06:56', 'snowflake', ''),
(3, 3, 71, 23, 0, '2010-11-10 11:07:45', 'snowflake', ''),
(4, 3, 4, 56, 0, '2010-11-19 11:08:14', 'snowflake', ''),
(5, 6, 36, 12, 0, '2010-11-22 11:08:35', 'snowflake', ''),
(6, 6, 32, 15, 0, '2010-11-21 11:08:57', 'snowflake', ''),
(7, 7, 24, 96, 0, '2010-11-18 11:09:30', 'snowflake', ''),
(8, 7, 102, 58, 0, '2010-11-20 11:09:48', 'snowflake', ''),
(9, 8, 43, 93, 0, '2010-11-21 11:10:10', 'snowflake', ''),
(10, 8, 47, 95, 0, '2010-11-22 11:10:35', 'snowflake', '');

-- --------------------------------------------------------

--
-- Table structure for table `level`
--

CREATE TABLE IF NOT EXISTS `level` (
  `LEV_ID` int(11) NOT NULL auto_increment,
  `LEVEL_ID` varchar(200) NOT NULL default '',
  `LEVEL_DESC` varchar(200) NOT NULL default '',
  `POINTS_BEAT` double NOT NULL default '0',
  `SNOW_FREQUENCY` double NOT NULL default '0',
  `SNOW_MAXSPEED` double NOT NULL default '0',
  `NICKNAME` varchar(200) NOT NULL default '',
  PRIMARY KEY  (`LEV_ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `level`
--

INSERT INTO `level` (`LEV_ID`, `LEVEL_ID`, `LEVEL_DESC`, `POINTS_BEAT`, `SNOW_FREQUENCY`, `SNOW_MAXSPEED`, `NICKNAME`) VALUES
(2, '2', 'this is level 2', 40, 2, 1.3, 'Nick2'),
(3, '3', 'this is level3', 50, 3, 1.6, 'Nick3'),
(4, '4', 'this is level 4', 60, 4, 1.9, 'Nick4'),
(5, '5', 'this is level 5', 70, 5, 2.2, 'Nick5'),
(12, '1', 'this is level1', 30, 1, 1, 'Nick1'),
(7, '7', 'this is level 7', 90, 7, 2.8, 'Nick7'),
(8, '8', 'this is level 8', 100, 8, 3.1, 'Nick8'),
(9, '9', 'this is level 9', 110, 9, 3.4, 'Nick9'),
(10, '10', 'this is level10', 120, 10, 3.7, 'Nick10'),
(11, '11', 'Winning the games', 0, 0, 0, 'NickW'),
(13, '6', 'this is level6', 80, 6, 2.5, 'Nick6');

-- --------------------------------------------------------

--
-- Table structure for table `level_snowflake`
--

CREATE TABLE IF NOT EXISTS `level_snowflake` (
  `LEVEL_SF_ID` int(11) NOT NULL auto_increment,
  `SNOWFLAKE_ID` varchar(200) NOT NULL default '0',
  `LEVEL_ID` int(11) NOT NULL default '0',
  `OCCURRENCE` varchar(200) NOT NULL default '0',
  PRIMARY KEY  (`LEVEL_SF_ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=33 ;

--
-- Dumping data for table `level_snowflake`
--

INSERT INTO `level_snowflake` (`LEVEL_SF_ID`, `SNOWFLAKE_ID`, `LEVEL_ID`, `OCCURRENCE`) VALUES
(1, '1,2,3', 1, '100,0,0'),
(3, '1,2,3', 7, '76,16,8'),
(4, '1,2,3', 4, '88,10,2'),
(5, '1,2,3', 8, '72,18,10'),
(6, '1,2,3', 5, '84,12,4'),
(7, '1,2,3', 6, '80,14,6'),
(9, '1,2,3', 2, '96,4,0'),
(10, '1,2,3', 9, '68,20,12'),
(11, '1,2,3', 3, '92,8,0'),
(32, '1,2,3', 10, '64,22,14');

-- --------------------------------------------------------

--
-- Table structure for table `snowflake`
--

CREATE TABLE IF NOT EXISTS `snowflake` (
  `SNOWFLAKE_ID` int(11) NOT NULL auto_increment,
  `SNOWFLAKE_DESC` varchar(200) NOT NULL default '',
  `IMAGE_PATH` varchar(200) NOT NULL default '',
  `COLOR` varchar(200) NOT NULL default '',
  `POINTS` varchar(200) NOT NULL default '',
  `SOUND_PATH` varchar(200) NOT NULL default '',
  PRIMARY KEY  (`SNOWFLAKE_ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `snowflake`
--

INSERT INTO `snowflake` (`SNOWFLAKE_ID`, `SNOWFLAKE_DESC`, `IMAGE_PATH`, `COLOR`, `POINTS`, `SOUND_PATH`) VALUES
(1, 'Standard snowflake', '2dc3aWater lilies.jpg', '#FFFEFC', '+1', '0b34c01_main[1]_06.mp3'),
(2, 'Plus snowflake', '5ded2Sunset.jpg', '#D1D1FF', '+3', 'ec268cocunt - man rotate.mp3'),
(18, 'wefre', '1a60fWinter.jpg', '#FFFFFF', '111', '1a60f19094.mp3');

-- --------------------------------------------------------

--
-- Table structure for table `stats`
--

CREATE TABLE IF NOT EXISTS `stats` (
  `STATS_ID` int(11) NOT NULL auto_increment,
  `TOTAL_SCORE` double NOT NULL default '0',
  `TOTAL_PLAYS` int(11) NOT NULL default '0',
  `TOTAL_USERS` int(11) NOT NULL default '0',
  `BEST_PLAYER_ID` int(11) NOT NULL default '0',
  PRIMARY KEY  (`STATS_ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `stats`
--


-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `USER_ID` int(11) NOT NULL auto_increment,
  `FIRSTNAME` varchar(200) NOT NULL default '',
  `LASTNAME` varchar(200) NOT NULL default '',
  `USERNAME` varchar(200) NOT NULL default '',
  `PASSWORD` varchar(200) NOT NULL default '',
  `FACEBOOK_ID` varchar(200) NOT NULL default '',
  `TWITTER_ID` varchar(200) NOT NULL default '',
  `EMAIL` varchar(200) NOT NULL default '',
  `GENDER` varchar(200) NOT NULL default '',
  `USER_IMAGE` varchar(200) NOT NULL default '',
  `REGISTERED_DATE` datetime NOT NULL default '0000-00-00 00:00:00',
  `LASTPLAYED_DATE` varchar(200) default NULL,
  `SCORE` double NOT NULL default '0',
  `LASTPLAYED_TYPE` varchar(200) NOT NULL default '',
  `STATUS` int(12) NOT NULL default '0',
  `LAST_LOGIN_DATE_TIME` varchar(200) NOT NULL default '',
  PRIMARY KEY  (`USER_ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`USER_ID`, `FIRSTNAME`, `LASTNAME`, `USERNAME`, `PASSWORD`, `FACEBOOK_ID`, `TWITTER_ID`, `EMAIL`, `GENDER`, `USER_IMAGE`, `REGISTERED_DATE`, `LASTPLAYED_DATE`, `SCORE`, `LASTPLAYED_TYPE`, `STATUS`, `LAST_LOGIN_DATE_TIME`) VALUES
(1, 'senthil', 'kumar', 'senthil', 'harihar', '', '', 'senthilsang24@gmail.com', 'Female', 'abc123.jpg', '2010-11-02 17:43:55', '2020-01-01 01:01:01', 1234567890, '2', 1, ''),
(3, 'rajesh', 'kumar', 'rajeshkumar', '', 'rajesh_24', '', 'rajesh@gmail.com', 'Male', 'ijk123.jpg', '2010-11-02 17:43:55', '2020-01-01 01:01:01', 788123, '2', 1, ''),
(4, 'hari', 'har', 'hari', '', 'sersdfsdwerer', '', 'senthil@gmail.com', 'Male', 'user_image', '2010-11-22 19:16:11', '2010-11-25 04:30:40PM', 0, '', 1, ''),
(5, 'wersdfsdfrew', 'wererwer', 'drerwer', 'india123', '', '', 'senthil@gmail.com', 'Male', 'c19fcWinter.jpg', '2010-11-22 20:22:18', '2010-11-30 04:31:49PM', 0, '', 1, ''),
(6, 'vinoth', 'kumar', 'vinoth', 'vinoth', '', '', 'vinothkumar@digient.in', 'Male', '41517Winter.jpg', '2010-11-23 19:23:51', '', 0, '', 1, ''),
(7, 'karthik', 'keyan', 'karthik', 'digient', '', '', 'hfjvh@cefuh.cnf', 'Male', '9a5a0Blue hills.jpg', '2010-11-25 17:01:42', '2010-11-24 04:31:33PM', 0, '', 1, ''),
(8, 'senthil', 'senthil', 'harihardfd', 'senthil', '', '', 'senthil@gmail.co', 'Male', '5d034Water lilies.jpg', '2010-11-26 08:20:27', '', 0, '', 1, ''),
(9, 'Senthil', 'Kumar', 'Senthil Kumar', '', '100000966868279', '', 'senthil_sang24@yahoo.co.in', 'male', 'http://static.ak.fbcdn.net/rsrc.php/zL/r/HsTZSDw4avx.gif', '2010-11-27 09:21:52', NULL, 0, '', 1, '2010-11-27 23:06:27'),
(10, 'Hari', 'Gopalakrishnan', 'Hari Gopalakrishnan', '', '100000485250711', '', 'haricolababa@gmail.com', 'male', 'http://profile.ak.fbcdn.net/hprofile-ak-snc4/hs444.snc4/48985_100000485250711_6316_n.jpg', '2010-11-27 15:36:33', NULL, 0, '', 1, '2010-11-28 11:45:22');

-- --------------------------------------------------------

--
-- Table structure for table `user_friend_fb`
--

CREATE TABLE IF NOT EXISTS `user_friend_fb` (
  `USER_FB_ID` int(11) NOT NULL auto_increment,
  `USER_ID` varchar(200) NOT NULL default '0',
  `USER_FR_FB_ID` varchar(200) NOT NULL default '',
  PRIMARY KEY  (`USER_FB_ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `user_friend_fb`
--


-- --------------------------------------------------------

--
-- Table structure for table `user_friend_tw`
--

CREATE TABLE IF NOT EXISTS `user_friend_tw` (
  `USER_TW_ID` int(11) NOT NULL auto_increment,
  `USER_ID` int(11) NOT NULL default '0',
  `USER_FR_TW_ID` varchar(200) NOT NULL default '',
  PRIMARY KEY  (`USER_TW_ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `user_friend_tw`
--

