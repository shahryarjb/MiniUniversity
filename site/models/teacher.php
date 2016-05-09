<?php
/**
 * @copyright   Copyright (C) 2016 Open Source Matters, Inc. All rights reserved. ( https://trangell.com )
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @subpackage  com_MiniUniversity
 */
defined('_JEXEC') or die('Restricted access');
/**
 *
 * @since  0.0.1
 */
class MiniUniversityModelTeacher extends JModelItem
{

	public function getItem($pk = null)
	{
		if (!isset($this->item)) 
		{

			$app = JFactory::getApplication('site');
			$id = $app->input->getInt('id');

			$db    = JFactory::getDbo();
			$query = $db->getQuery(true);
			
		
			$query->select('t.*,t.name as nametich,b.*,t.id as tichid');
			$query->from('#__miniuniver_teacher as t');
			$query->where('t.id = ' . $id);
			$query->leftJoin('#__miniuniver_book b ON t.cat_id=b.id');
				 
				  $db->setQuery($query);
				  $data = $db->loadObject();
		}
		
		return $data;
	}

	public function getBook()
	{
		$a =MiniUniversityModelTeacher::getItem();
		if (!empty($a))
		{
			$cat_id =(explode(',', $a->cat_id));
			
			$db    = JFactory::getDbo();
			$query = $db->getQuery(true);
			
			
			$ids = join(',',$cat_id);  
			
			$query->select('b.*');
			$query->from('#__miniuniver_book as b');
			$query->where(('id') . ' IN (' . $ids .')');
			$db->setQuery($query);
			$data = $db->loadObjectList();
	    }
	    else 
	    {
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
