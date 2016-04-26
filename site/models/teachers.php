<?php
/**
 * @copyright   Copyright (C) 2016 Open Source Matters, Inc. All rights reserved. ( https://trangell.com )
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @subpackage  com_MiniUniversity
 */
defined('_JEXEC') or die('Restricted access');

class MiniUniversityModelTeachers extends JModelList
{

	public function getListQuery() {		
		if (!isset($this->item)) 
		{
			$db    = JFactory::getDbo();
			$query = $db->getQuery(true);
			$query->select('co.*, c.name as category,c.name as namebooks,c.id as idbook,d.id as termeid, d.name as termname,CASE WHEN CHAR_LENGTH(co.name) THEN CONCAT_WS(":", co.id, co.name) ELSE co.name END as slug')
				  ->from('#__miniuniver_teacher as co ')
				  ->leftJoin('#__miniuniver_book as c ON co.cat_id=c.id')
				  ->leftJoin('#__miniuniver_semester as d ON co.term_id=d.id');
		}

		return $query;
	}


	public function getListterm() {		

			$db    = JFactory::getDbo();
			$queryy = $db->getQuery(true);
			$queryy->select('*');
			$queryy->from('#__miniuniver_semester');
			$db->setQuery($queryy);
			$result = $db->loadObjectList();
			return $result;
		}

	public function getListBook() {		

			$db    = JFactory::getDbo();
			$queryy = $db->getQuery(true);
			$queryy->select('*');
			$queryy->from('#__miniuniver_book');
			$db->setQuery($queryy);
			$result = $db->loadObjectList();
			return $result;
		}

}

