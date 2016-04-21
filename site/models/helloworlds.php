<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_helloworld
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
defined('_JEXEC') or die('Restricted access');
/**
 *
 * @since  0.0.1
 */
class HelloWorldModelHelloWorlds extends JModelList
{
	/**
	 * @var object item
	 */
	/**
	 * @return	void
	 * @since	2.5
	/**
	 * Get the message
	 * @return object The message to be displayed to the user
	 */


	public function getListQuery() {		
		if (!isset($this->item)) 
		{
			$db    = JFactory::getDbo();
			$query = $db->getQuery(true);
			$query->select('co.*, c.name as category,c.name as namebooks,c.id as idbook,d.id as termeid, d.name as termname,CASE WHEN CHAR_LENGTH(co.name) THEN CONCAT_WS(":", co.id, co.name) ELSE co.name END as slug')
				  ->from('#__scquiz_teacher as co ')
				  ->leftJoin('#__scquiz_book as c ON co.cat_id=c.id')
				  ->leftJoin('#__scquiz_semester as d ON co.term_id=d.id');
		}

		return $query;
	}


	public function getListterm() {		

			$db    = JFactory::getDbo();
			$queryy = $db->getQuery(true);
			$queryy->select('*');
			$queryy->from('#__scquiz_semester');
			$db->setQuery($queryy);
			$result = $db->loadObjectList();
			return $result;
		}

	public function getListBook() {		

			$db    = JFactory::getDbo();
			$queryy = $db->getQuery(true);
			$queryy->select('*');
			$queryy->from('#__scquiz_book');
			$db->setQuery($queryy);
			$result = $db->loadObjectList();
			return $result;
		}

}

