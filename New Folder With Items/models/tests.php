<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_helloworld
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
// No direct access to this file
defined('_JEXEC') or die('Restricted access');

/**
 * HelloWorldList Model
 *
 * @since  0.0.1
 */
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
