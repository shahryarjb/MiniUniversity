<?php
/**
 * @copyright   Copyright (C) 2016 Open Source Matters, Inc. All rights reserved. ( https://trangell.com )
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @subpackage  com_MiniUniversity
 */
defined('_JEXEC') or die('Restricted access');

class MiniUniversityModelLibs extends JModelList {

	public function getListQuery() {		
		if (!isset($this->item)) {
			$db    = JFactory::getDbo();
			$query = $db->getQuery(true);
			$query->select('co.*,co.bookpic as libspics, c.name as category, CASE WHEN CHAR_LENGTH(co.name) THEN CONCAT_WS(":", co.id, co.name) ELSE co.name END as slug')
				  ->from('#__miniuniver_lib as co ')
				  ->leftJoin('#__miniuniver_libcat as c ON co.cat_id=c.id');
		}

		return $query;
	}
public function TotalResBook($id) {
			$db = JFactory::getDbo();
			$queryy = $db->getQuery(true);
			$queryy->select('*');
			$queryy->from('#__miniuniver_libresv as libresv')
				   ->where('libresv.lib_id='.$id);
			$db->setQuery($queryy);
			$result = $db->loadObjectList();
			  
			return $result;
	}
}
