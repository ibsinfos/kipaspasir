SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

-- --------------------------------------------------------

--
-- Table structure for table `administrators`
--

CREATE TABLE IF NOT EXISTS `administrators` (
  `ADMINID` bigint(20) NOT NULL AUTO_INCREMENT,
  `email` varchar(80) NOT NULL DEFAULT '',
  `username` varchar(80) NOT NULL DEFAULT '',
  `password` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`ADMINID`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `username` (`username`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `administrators`
--

INSERT INTO `administrators` (`ADMINID`, `email`, `username`, `password`) VALUES
(1, 'webmaster@fiverrscript.com', 'Admin', '7301673cb1e6624964db94c4d74e741b');

-- --------------------------------------------------------

--
-- Table structure for table `advertisements`
--

CREATE TABLE IF NOT EXISTS `advertisements` (
  `AID` bigint(30) NOT NULL AUTO_INCREMENT,
  `description` varchar(200) NOT NULL DEFAULT '',
  `code` text NOT NULL,
  `active` enum('1','0') NOT NULL DEFAULT '1',
  PRIMARY KEY (`AID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `advertisements`
--

INSERT INTO `advertisements` (`AID`, `description`, `code`, `active`) VALUES
(1, '468 x 60 pixels', '<div style="width:468px; height:60px; border:1px solid #DFDFDF;" align="center"><br/>Insert Your<br/>Advertisement Here</div>', '1'),
(2, '120 x 728 pixels', '<div style="width:120px; height:728px; border:1px solid #DFDFDF;" align="center"><br/><br/>Insert Your Advertisement Here</div>', '1'),
(3, '600 x 30 pixels', '<div style="width:600px; height:30px; border:1px solid #DFDFDF;" align="center"><div style="padding-top: 5px">Insert Your Advertisement Here</div></div>', '1');

-- --------------------------------------------------------

--
-- Table structure for table `archive`
--

CREATE TABLE IF NOT EXISTS `archive` (
  `ID` bigint(20) NOT NULL AUTO_INCREMENT,
  `USERID` bigint(20) NOT NULL DEFAULT '0',
  `AID` bigint(20) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ID`),
  UNIQUE KEY `USERID` (`USERID`,`AID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `bans_ips`
--

CREATE TABLE IF NOT EXISTS `bans_ips` (
  `ip` varchar(20) NOT NULL,
  UNIQUE KEY `ip` (`ip`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `bookmarks`
--

CREATE TABLE IF NOT EXISTS `bookmarks` (
  `BID` bigint(20) NOT NULL AUTO_INCREMENT,
  `USERID` bigint(20) NOT NULL DEFAULT '0',
  `PID` bigint(20) NOT NULL DEFAULT '0',
  `time_added` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`BID`),
  UNIQUE KEY `USERID` (`USERID`,`PID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `CATID` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(120) NOT NULL DEFAULT '',
  `seo` varchar(200) NOT NULL,
  `parent` bigint(20) NOT NULL DEFAULT '0',
  `details` text NOT NULL,
  `mtitle` text NOT NULL,
  `mdesc` text NOT NULL,
  `mtags` text NOT NULL,
  PRIMARY KEY (`CATID`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`CATID`, `name`, `seo`, `parent`, `details`, `mtitle`, `mdesc`, `mtags`) VALUES
(1, 'Gift Ideas', 'Gift-Ideas', 0, 'Example description for gift ideas', '', '', ''),
(2, 'Fun &amp; Bizarre', 'Fun-Bizarre', 0, 'Example description for fun and bizarre', '', '', ''),
(3, 'Graphics', 'Graphics', 0, 'Example description for graphics', '', '', ''),
(4, 'Social Marketing', 'Social-Marketing', 0, 'Example description for social marketing', '', '', ''),
(5, 'Writing', 'Writing', 0, 'Example description for writing', '', '', ''),
(6, 'Advertising', 'Advertising', 0, 'Example description for advertising', '', '', ''),
(7, 'Music &amp; Audio', 'Music-Audio', 0, 'Example description for music and audio', '', '', ''),
(8, 'Tips &amp; Advice', 'Tips-Advice', 0, 'Example description for tips and advice', '', '', ''),
(9, 'Business', 'Business', 0, 'Example description for business', '', '', ''),
(10, 'Technology', 'Technology', 0, 'Example description for technology', '', '', ''),
(11, 'Programming', 'Programming', 0, 'Example description for programming', '', '', ''),
(12, 'Other', 'Other', 0, 'Example description for other', '', '', ''),
(13, 'Silly Stuff', 'Silly-Stuff', 0, 'Example description for silly stuff', '', '', ''),
(14, 'Video', 'Video', 0, 'Example description for video', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `config`
--

CREATE TABLE IF NOT EXISTS `config` (
  `setting` varchar(60) NOT NULL DEFAULT '',
  `value` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `config`
--

INSERT INTO `config` (`setting`, `value`) VALUES
('site_email', 'webmaster@yourdomain.com'),
('site_name', 'Fiverr Script'),
('max_syndicate_results', '25'),
('maximum_results', '1000000'),
('emailsender', 'Admin'),
('max_suggest', '14'),
('items_per_page', '17'),
('site_slogan', 'Things people do for money'),
('approve_stories', '0'),
('metadescription', 'FiverrScript is the fiverr clone script and marketplace script.'),
('metakeywords', 'fiverr script, fiverr clone, fiverr clone script, marketplace script'),
('price', '5'),
('ver', '5.6'),
('price_mode', '0'),
('approve_suggests', '0'),
('view_rel_max', '7'),
('view_more_max', '7'),
('paypal_email', 'payments@yourdomain.com'),
('notify_email', 'notify@yourdomain.com'),
('currency', 'USD'),
('days_before_withdraw', '14'),
('commission', '1'),
('FACEBOOK_APP_ID', ''),
('FACEBOOK_SECRET', ''),
('enable_fc', '0'),
('commission_percent', '20'),
('short_urls', '1'),
('twitter', 'Scriptolution'),
('vonly', '0'),
('enable_alertpay', '0'),
('enable_paypal', '1'),
('alertpay_email', 'payments@yourdomain.com'),
('alertpay_currency', 'USD'),
('ap_code', ''),
('fprice', '100'),
('fdays', '300'),
('scriptolution_toprated_rating', '99'),
('scriptolution_toprated_count', '10'),
('verify_pm', '1'),
('def_country', 'US'),
('enable_levels', '0'),
('level1job', '1'),
('level2job', '3'),
('level3job', ''),
('level2num', '10'),
('level2rate', '90'),
('level3num', '20'),
('level3rate', '90'),
('scriptolution_proxy_block', '0'),
('enable_ref', '0'),
('ref_price', '1'),
('scriptolution_paypal_confirm', '0');

-- --------------------------------------------------------

--
-- Table structure for table `featured`
--

CREATE TABLE IF NOT EXISTS `featured` (
  `ID` bigint(20) NOT NULL AUTO_INCREMENT,
  `PID` bigint(20) NOT NULL DEFAULT '0',
  `time` varchar(20) DEFAULT NULL,
  `price` varchar(20) NOT NULL DEFAULT '0',
  `PAYPAL` bigint(20) NOT NULL,
  `exp` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `files`
--

CREATE TABLE IF NOT EXISTS `files` (
  `FID` bigint(20) NOT NULL AUTO_INCREMENT,
  `fname` varchar(400) NOT NULL DEFAULT '',
  `time` varchar(20) NOT NULL DEFAULT '',
  `ip` varchar(20) NOT NULL,
  `s` varchar(100) NOT NULL,
  PRIMARY KEY (`FID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `inbox`
--

CREATE TABLE IF NOT EXISTS `inbox` (
  `MID` bigint(20) NOT NULL AUTO_INCREMENT,
  `MSGTO` bigint(20) NOT NULL DEFAULT '0',
  `MSGFROM` bigint(20) NOT NULL DEFAULT '0',
  `message` text NOT NULL,
  `PID` bigint(20) NOT NULL DEFAULT '0',
  `FID` bigint(20) NOT NULL DEFAULT '0',
  `time` varchar(20) NOT NULL DEFAULT '',
  `unread` char(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`MID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `inbox2`
--

CREATE TABLE IF NOT EXISTS `inbox2` (
  `MID` bigint(20) NOT NULL AUTO_INCREMENT,
  `MSGTO` bigint(20) NOT NULL DEFAULT '0',
  `MSGFROM` bigint(20) NOT NULL DEFAULT '0',
  `message` text NOT NULL,
  `OID` bigint(20) NOT NULL DEFAULT '0',
  `FID` bigint(20) NOT NULL DEFAULT '0',
  `time` varchar(20) NOT NULL DEFAULT '',
  `start` bigint(1) NOT NULL DEFAULT '0',
  `action` varchar(100) NOT NULL,
  `cancel` bigint(1) NOT NULL DEFAULT '0',
  `ctime` varchar(20) NOT NULL,
  `CID` bigint(20) NOT NULL DEFAULT '0',
  `reject` bigint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`MID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `inbox_reports`
--

CREATE TABLE IF NOT EXISTS `inbox_reports` (
  `RID` bigint(20) NOT NULL AUTO_INCREMENT,
  `MID` bigint(20) NOT NULL DEFAULT '0',
  `USERID` bigint(20) NOT NULL DEFAULT '0',
  `time` varchar(20) NOT NULL DEFAULT '',
  PRIMARY KEY (`RID`),
  UNIQUE KEY `MID` (`MID`,`USERID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE IF NOT EXISTS `members` (
  `USERID` bigint(20) NOT NULL AUTO_INCREMENT,
  `email` varchar(80) NOT NULL DEFAULT '',
  `pemail` varchar(100) NOT NULL,
  `username` varchar(80) NOT NULL DEFAULT '',
  `password` varchar(50) NOT NULL DEFAULT '',
  `pwd` varchar(50) NOT NULL,
  `funds` decimal(9,2) NOT NULL,
  `afunds` decimal(9,2) NOT NULL,
  `withdrawn` decimal(9,2) NOT NULL,
  `used` decimal(9,2) NOT NULL,
  `fullname` varchar(100) NOT NULL DEFAULT '',
  `description` text NOT NULL,
  `rating` float NOT NULL DEFAULT '0',
  `ratingcount` bigint(10) NOT NULL DEFAULT '0',
  `profileviews` int(20) NOT NULL DEFAULT '0',
  `addtime` varchar(20) NOT NULL DEFAULT '',
  `lastlogin` varchar(20) NOT NULL DEFAULT '',
  `verified` char(1) NOT NULL DEFAULT '0',
  `status` enum('1','0') NOT NULL DEFAULT '1',
  `profilepicture` varchar(100) NOT NULL DEFAULT '',
  `remember_me_key` varchar(32) DEFAULT NULL,
  `remember_me_time` datetime DEFAULT NULL,
  `ip` varchar(20) NOT NULL,
  `lip` varchar(20) NOT NULL,
  `aemail` varchar(100) NOT NULL,
  `country` varchar(2) NOT NULL DEFAULT 'US',
  `toprated` int(1) NOT NULL DEFAULT '0',
  `level` bigint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`USERID`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `members_passcode`
--

CREATE TABLE IF NOT EXISTS `members_passcode` (
  `USERID` bigint(20) NOT NULL DEFAULT '0',
  `code` varchar(30) NOT NULL DEFAULT '',
  PRIMARY KEY (`USERID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `members_verifycode`
--

CREATE TABLE IF NOT EXISTS `members_verifycode` (
  `USERID` bigint(20) NOT NULL DEFAULT '0',
  `code` varchar(30) NOT NULL DEFAULT '',
  PRIMARY KEY (`USERID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE IF NOT EXISTS `orders` (
  `OID` bigint(20) NOT NULL AUTO_INCREMENT,
  `USERID` bigint(20) NOT NULL DEFAULT '0',
  `PID` bigint(20) NOT NULL DEFAULT '0',
  `time_added` varchar(20) DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT '0',
  `stime` varchar(20) NOT NULL,
  `price` varchar(20) NOT NULL DEFAULT '0',
  `cltime` varchar(20) NOT NULL,
  `IID` bigint(20) NOT NULL,
  `late` bigint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`OID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE IF NOT EXISTS `order_items` (
  `IID` bigint(20) NOT NULL AUTO_INCREMENT,
  `PID` bigint(20) NOT NULL DEFAULT '0',
  `USERID` bigint(20) NOT NULL DEFAULT '0',
  `multi` bigint(5) NOT NULL DEFAULT '0',
  `EID` bigint(20) NOT NULL DEFAULT '0',
  `EID2` bigint(20) NOT NULL DEFAULT '0',
  `EID3` bigint(20) NOT NULL DEFAULT '0',
  `totalprice` bigint(20) NOT NULL DEFAULT '0',
  `ctp` decimal(9,2) NOT NULL,
  `scriptolutionbuy` bigint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`IID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `packs`
--

CREATE TABLE IF NOT EXISTS `packs` (
  `ID` bigint(20) NOT NULL AUTO_INCREMENT,
  `pprice` bigint(10) NOT NULL,
  `pcom` bigint(10) NOT NULL,
  `l1` int(1) NOT NULL DEFAULT '1',
  `l2` int(1) NOT NULL DEFAULT '1',
  `l3` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `packs`
--

INSERT INTO `packs` (`ID`, `pprice`, `pcom`, `l1`, `l2`, `l3`) VALUES
(1, 5, 20, 1, 1, 1),
(2, 10, 20, 1, 1, 1),
(3, 15, 20, 1, 1, 1),
(4, 20, 20, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE IF NOT EXISTS `payments` (
  `ID` bigint(20) NOT NULL AUTO_INCREMENT,
  `USERID` bigint(20) NOT NULL DEFAULT '0',
  `OID` bigint(20) NOT NULL DEFAULT '0',
  `time` varchar(20) DEFAULT NULL,
  `price` varchar(20) NOT NULL DEFAULT '0',
  `t` bigint(1) NOT NULL DEFAULT '0',
  `PAYPAL` bigint(20) NOT NULL,
  `cancel` bigint(1) NOT NULL DEFAULT '0',
  `wd` bigint(20) NOT NULL DEFAULT '0',
  `IID` bigint(20) NOT NULL DEFAULT '0',
  `fiverrscriptdotcom_balance` bigint(20) NOT NULL DEFAULT '0',
  `fiverrscriptdotcom_available` bigint(20) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `paypal_table`
--

CREATE TABLE IF NOT EXISTS `paypal_table` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `payer_id` varchar(60) DEFAULT NULL,
  `payment_date` varchar(50) DEFAULT NULL,
  `txn_id` varchar(50) DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `payer_email` varchar(75) DEFAULT NULL,
  `payer_status` varchar(50) DEFAULT NULL,
  `payment_type` varchar(50) DEFAULT NULL,
  `memo` tinytext,
  `item_name` varchar(127) DEFAULT NULL,
  `item_number` varchar(127) DEFAULT NULL,
  `quantity` int(11) NOT NULL DEFAULT '0',
  `mc_gross` decimal(9,2) DEFAULT NULL,
  `mc_currency` char(3) DEFAULT NULL,
  `address_name` varchar(255) NOT NULL DEFAULT '',
  `address_street` varchar(255) NOT NULL DEFAULT '',
  `address_city` varchar(255) NOT NULL DEFAULT '',
  `address_state` varchar(255) NOT NULL DEFAULT '',
  `address_zip` varchar(255) NOT NULL DEFAULT '',
  `address_country` varchar(255) NOT NULL DEFAULT '',
  `address_status` varchar(255) NOT NULL DEFAULT '',
  `payer_business_name` varchar(255) NOT NULL DEFAULT '',
  `payment_status` varchar(255) NOT NULL DEFAULT '',
  `pending_reason` varchar(255) NOT NULL DEFAULT '',
  `reason_code` varchar(255) NOT NULL DEFAULT '',
  `txn_type` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  UNIQUE KEY `txn_id` (`txn_id`),
  KEY `txn_id_2` (`txn_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `paypal_table2`
--

CREATE TABLE IF NOT EXISTS `paypal_table2` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `payer_id` varchar(60) DEFAULT NULL,
  `payment_date` varchar(50) DEFAULT NULL,
  `txn_id` varchar(50) DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `payer_email` varchar(75) DEFAULT NULL,
  `payer_status` varchar(50) DEFAULT NULL,
  `payment_type` varchar(50) DEFAULT NULL,
  `memo` tinytext,
  `item_name` varchar(127) DEFAULT NULL,
  `item_number` varchar(127) DEFAULT NULL,
  `quantity` int(11) NOT NULL DEFAULT '0',
  `mc_gross` decimal(9,2) DEFAULT NULL,
  `mc_currency` char(3) DEFAULT NULL,
  `address_name` varchar(255) NOT NULL DEFAULT '',
  `address_street` varchar(255) NOT NULL DEFAULT '',
  `address_city` varchar(255) NOT NULL DEFAULT '',
  `address_state` varchar(255) NOT NULL DEFAULT '',
  `address_zip` varchar(255) NOT NULL DEFAULT '',
  `address_country` varchar(255) NOT NULL DEFAULT '',
  `address_status` varchar(255) NOT NULL DEFAULT '',
  `payer_business_name` varchar(255) NOT NULL DEFAULT '',
  `payment_status` varchar(255) NOT NULL DEFAULT '',
  `pending_reason` varchar(255) NOT NULL DEFAULT '',
  `reason_code` varchar(255) NOT NULL DEFAULT '',
  `txn_type` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  UNIQUE KEY `txn_id` (`txn_id`),
  KEY `txn_id_2` (`txn_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE IF NOT EXISTS `posts` (
  `PID` bigint(20) NOT NULL AUTO_INCREMENT,
  `USERID` bigint(20) NOT NULL DEFAULT '0',
  `gtitle` text NOT NULL,
  `gtags` text NOT NULL,
  `gdesc` text NOT NULL,
  `ginst` text NOT NULL,
  `category` bigint(20) NOT NULL DEFAULT '0',
  `days` bigint(10) NOT NULL DEFAULT '0',
  `youtube` varchar(200) NOT NULL,
  `feat` bigint(1) NOT NULL DEFAULT '0',
  `scriptolution_add_multiple` bigint(3) NOT NULL DEFAULT '0',
  `time_added` varchar(20) DEFAULT NULL,
  `date_added` date NOT NULL DEFAULT '0000-00-00',
  `active` char(1) NOT NULL DEFAULT '',
  `last_viewed` varchar(20) NOT NULL DEFAULT '',
  `rating` float NOT NULL DEFAULT '0',
  `rcount` bigint(20) NOT NULL DEFAULT '0',
  `viewcount` bigint(20) NOT NULL DEFAULT '0',
  `pip` varchar(20) NOT NULL,
  `p1` varchar(20) NOT NULL,
  `p2` varchar(20) NOT NULL,
  `p3` varchar(20) NOT NULL,
  `price` bigint(10) NOT NULL DEFAULT '0',
  `rev` bigint(20) NOT NULL DEFAULT '0',
  `ctp` decimal(9,2) NOT NULL DEFAULT '0.00',
  `short` varchar(200) NOT NULL,
  PRIMARY KEY (`PID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `ratings`
--

CREATE TABLE IF NOT EXISTS `ratings` (
  `RID` bigint(20) NOT NULL AUTO_INCREMENT,
  `USERID` bigint(20) NOT NULL DEFAULT '0',
  `PID` bigint(20) NOT NULL DEFAULT '0',
  `OID` bigint(20) NOT NULL DEFAULT '0',
  `RATER` bigint(20) NOT NULL DEFAULT '0',
  `time_added` varchar(20) DEFAULT NULL,
  `good` bigint(1) NOT NULL DEFAULT '0',
  `bad` bigint(1) NOT NULL DEFAULT '0',
  `comment` varchar(500) NOT NULL,
  PRIMARY KEY (`RID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `referrals`
--

CREATE TABLE IF NOT EXISTS `referrals` (
  `RID` bigint(20) NOT NULL AUTO_INCREMENT,
  `USERID` bigint(20) NOT NULL DEFAULT '0',
  `REFERRED` bigint(20) NOT NULL DEFAULT '0',
  `money` decimal(9,2) NOT NULL,
  `time_added` varchar(20) DEFAULT NULL,
  `ip` text NOT NULL,
  `status` bigint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`RID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `static`
--

CREATE TABLE IF NOT EXISTS `static` (
  `ID` bigint(30) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL DEFAULT '',
  `value` text NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `static`
--

INSERT INTO `static` (`ID`, `title`, `value`) VALUES
(1, 'Terms Of Use', 'Insert your terms of use information here.<br><br>\r\n\r\nHTML is accepted.'),
(2, 'Privacy Policy', 'Insert your privacy policy information here.<br><br>\r\n\r\nHTML is accepted.'),
(3, 'About Us', 'Insert your about us information here.<br><br>\r\n\r\nHTML is accepted.'),
(4, 'Advertising', 'Insert your advertising information here.<br><br>\r\n\r\nHTML is accepted.'),
(5, 'Contact Us', 'Insert your contact us information here.<br><br>\r\n\r\nHTML is accepted.'),
(6, 'Job Levels', 'Insert your information about job levels here.<br><br>\r\n\r\nHTML is accepted.');

-- --------------------------------------------------------

--
-- Table structure for table `wants`
--

CREATE TABLE IF NOT EXISTS `wants` (
  `WID` bigint(20) NOT NULL AUTO_INCREMENT,
  `USERID` bigint(20) NOT NULL DEFAULT '0',
  `want` text NOT NULL,
  `category` bigint(20) NOT NULL DEFAULT '0',
  `time_added` varchar(20) DEFAULT NULL,
  `date_added` date NOT NULL DEFAULT '0000-00-00',
  `active` char(1) NOT NULL DEFAULT '',
  PRIMARY KEY (`WID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `withdraw_requests`
--

CREATE TABLE IF NOT EXISTS `withdraw_requests` (
  `WID` bigint(20) NOT NULL AUTO_INCREMENT,
  `USERID` bigint(20) NOT NULL DEFAULT '0',
  `time_added` varchar(20) DEFAULT NULL,
  `ap` bigint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`WID`),
  UNIQUE KEY `USERID` (`USERID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

INSERT INTO `config` (`setting`, `value`) VALUES ('items_per_page_new', '28');
INSERT INTO `config` (`setting`, `value`) VALUES ('hide_catnav', '0');
INSERT INTO `config` (`setting`, `value`) VALUES ('enable_captcha', '1');