SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Table structure for table `register`
--

CREATE TABLE IF NOT EXISTS `register` (
  `reg_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `privileges` tinyint(3) unsigned NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `address` text NOT NULL,
  `time` text NOT NULL,
  PRIMARY KEY (`reg_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=408 ;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `email_id` text NOT NULL,
  `contact_no` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=408 ;

-- --------------------------------------------------------

--
-- Table structure for table `visitors_details`
--

CREATE TABLE IF NOT EXISTS `visitors_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `visitor_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

-- --------------------------------------------------------

--
-- Table structure for table `visitors_list`
--

CREATE TABLE IF NOT EXISTS `visitors_list` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `unique_id` text NOT NULL,
  `ip` text NOT NULL,
  `user_agent` text NOT NULL,
  `time` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=41 ;

-- --------------------------------------------------------

--
-- Table structure for table `visitors_pages`
--

CREATE TABLE IF NOT EXISTS `visitors_pages` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `session_id` int(11) NOT NULL,
  `ip` text NOT NULL,
  `time` text NOT NULL,
  `page_url` text NOT NULL,
  `referrer` text NOT NULL,
  `referer_website` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3145 ;

-- --------------------------------------------------------

--
-- Table structure for table `visitors_sessions`
--

CREATE TABLE IF NOT EXISTS `visitors_sessions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `visitor_id` int(11) NOT NULL,
  `session_id` text NOT NULL,
  `time` text NOT NULL,
  `online_time` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=180 ;
