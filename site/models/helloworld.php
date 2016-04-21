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
class HelloWorldModelHelloWorld extends JModelItem
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
			$query->from('#__scquiz_teacher as t');
			$query->where('t.id = ' . $id);
			$query->leftJoin('#__scquiz_book b ON t.cat_id=b.id');
				 
				  $db->setQuery($query);
				  $data = $db->loadObject();
		}
		
		return $data;
	}
	//======================================
	public function getBook()
	{
		$a =HelloWorldModelHelloWorld::getItem();
		if (!empty($a))
		{
			$cat_id =(explode(',', $a->cat_id));  // convert cat_id to array
			
			$db    = JFactory::getDbo();
			$query = $db->getQuery(true);
			
			
			$ids = join(',',$cat_id);  
			
			$query->select('b.*');
			$query->from('#__scquiz_book as b');
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
}
