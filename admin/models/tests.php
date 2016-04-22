<?php
/**
 * @copyright   Copyright (C) 2016 Open Source Matters, Inc. All rights reserved. ( https://trangell.com )
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @subpackage  com_MiniUniversity
 */
defined('_JEXEC') or die('Restricted access');

class HelloWorldModelTests extends JModelList
{

		function UserTich() {
			$db = JFactory::getDbo();
			$query = $db->getQuery(true);
			$query->select('COUNT(*)');
			$query->from($db->quoteName('#__scquiz_teacher'));
			$db->setQuery($query);
			$count = $db->loadResult();
			echo (int) $count;
	}
		function QueryBook() {
			$db = JFactory::getDbo();
			$query = $db->getQuery(true);
			$query->select('COUNT(*)');
			$query->from($db->quoteName('#__scquiz_book'));
			$db->setQuery($query);
			$count = $db->loadResult();
			echo (int) $count;
	}
		function QuerySemester() {
			$db = JFactory::getDbo();
			$query = $db->getQuery(true);
			$query->select('COUNT(*)');
			$query->from($db->quoteName('#__scquiz_semester'));
			$db->setQuery($query);
			$count = $db->loadResult();
			echo (int) $count;
	}
}
?>
