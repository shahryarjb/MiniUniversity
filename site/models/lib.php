<?php
/**
 * @copyright   Copyright (C) 2016 Open Source Matters, Inc. All rights reserved. ( https://trangell.com )
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @subpackage  com_MiniUniversity
 */
defined('_JEXEC') or die('Restricted access');

class MiniUniversityModelLib extends JModelItem {

	public function getItem($pk = null) {
		if (!isset($this->item)) {

			$app = JFactory::getApplication('site');
			$id = $app->input->getInt('id');

			$db    = JFactory::getDbo();
			$query = $db->getQuery(true);
			
		
			$query->select('t.*,t.name as namelib,t.bookpic as libpics, t.id as libid,b.*, b.name as category,d.*');
			$query->from('#__miniuniver_lib as t');
			$query->where('t.id = ' . $id);
			$query->leftJoin('#__miniuniver_libcat as b ON t.cat_id=b.id');
			$query->leftJoin('#__miniuniver_libresv as d ON t.id=d.lib_id');
				 
				  $db->setQuery($query);
				  $data = $db->loadObject();
		}
		
		return $data;
	}

	public function getReservation() {
		
		$a = MiniUniversityModelLib::getItem();

		if (!empty($a)) {
			$db    = JFactory::getDbo();
			$query = $db->getQuery(true);
			 
			$ids = intval($a->libid);
			$query->select('d.*');
			$query->from('#__miniuniver_libresv as d');
			$query->where(('lib_id') . ' IN (' . $ids .')');
			$query->setLimit(4);
			$query->order('return_date' . ' DESC');
			$db->setQuery($query);
			$data = $db->loadObjectList();
	    }
	    else {
			$data= NUll;
		}
		return $data;
	}
	public function convert_date_to_unix($date_time) {
    		// Get the User and their timezone
		    	$user = JFactory::getUser();
		    	$timeZone = $user->getParam('timezone', 'UTC');
	    	// Create JDate object set to now in the users timezone.
	    	    $myDate = JDate::getInstance($date_time, $timeZone);
	    		return $myDate->toUnix();
	}
}	