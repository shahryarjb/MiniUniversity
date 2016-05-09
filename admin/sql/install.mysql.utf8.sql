CREATE TABLE IF NOT EXISTS `#__miniuniver_book` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(40) NOT NULL,
  `qextime` date NOT NULL,
  `qexdis` varchar(100) NOT NULL,
  `bookpic` text NOT NULL,
  `endextime` date NOT NULL,
  `endexdis` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;


CREATE TABLE IF NOT EXISTS `#__miniuniver_semester` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `termtimes` date NOT NULL,
  `termtimeex` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;


CREATE TABLE IF NOT EXISTS `#__miniuniver_teacher` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(25) NOT NULL,
  `dis` text NOT NULL,
  `profilepic` text NOT NULL,
  `shtich` int(20) NOT NULL,
  `tichlicens` varchar(30) NOT NULL,
  `cat_id` varchar(10) NOT NULL,
  `term_id` int(10) NOT NULL,
  `published` tinyint(4) NOT NULL,
  `email` text NOT NULL,
  `tell` varchar(12) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `cat_id` (`cat_id`),
  KEY `term_id` (`term_id`),
  KEY `tell` (`tell`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;


CREATE TABLE IF NOT EXISTS `#__miniuniver_lib` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(125) NOT NULL,
  `author` varchar(125) NOT NULL,
  `translator` varchar(125) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `isbn` int(65) NOT NULL,
  `dis` text NOT NULL,
  `bookpic` text NOT NULL,
  `published` tinyint(3) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `cat_id` (`cat_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE IF NOT EXISTS `#__miniuniver_libcat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(125) NOT NULL,
  `cat_pic` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;


CREATE TABLE IF NOT EXISTS `#__miniuniver_libresv` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lib_id` int(11) NOT NULL,
  `last_transferee` int(11) NOT NULL,
  `return_date` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `book_id` (`lib_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

