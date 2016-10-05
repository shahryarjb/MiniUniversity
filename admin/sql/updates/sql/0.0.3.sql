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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE IF NOT EXISTS `#__miniuniver_libresv` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lib_id` int(11) NOT NULL,
  `last_transferee` int(11) NOT NULL,
  `return_date` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `book_id` (`lib_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

