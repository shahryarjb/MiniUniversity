--
-- Table structure for table 
--

CREATE TABLE IF NOT EXISTS `#__miniuniver_book` (
  `id` int(11) NOT NULL,
  `name` varchar(40) NOT NULL,
  `qextime` date NOT NULL,
  `qexdis` varchar(100) NOT NULL,
  `bookpic` text NOT NULL,
  `endextime` date NOT NULL,
  `endexdis` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;



CREATE TABLE IF NOT EXISTS `#__miniuniver_semester` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `termtimes` date NOT NULL,
  `termtimeex` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;



CREATE TABLE IF NOT EXISTS `#__miniuniver_teacher` (
  `id` int(11) NOT NULL,
  `name` varchar(25) NOT NULL,
  `dis` text NOT NULL,
  `profilepic` text NOT NULL,
  `shtich` int(20) NOT NULL,
  `tichlicens` varchar(30) NOT NULL,
  `cat_id` varchar(10) NOT NULL,
  `term_id` int(10) NOT NULL,
  `published` tinyint(4) NOT NULL,
  `email` text NOT NULL,
  `tell` varchar(12) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;


--
-- Indexes for table 
--
ALTER TABLE `#__miniuniver_book`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `#__miniuniver_semester`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `#__miniuniver_teacher`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cat_id` (`cat_id`),
  ADD KEY `term_id` (`term_id`),
  ADD KEY `tell` (`tell`);

--
-- AUTO_INCREMENT for dumped tables
--

ALTER TABLE `#__miniuniver_book`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;

ALTER TABLE `#__miniuniver_semester`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;

ALTER TABLE `#__miniuniver_teacher`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=17;
