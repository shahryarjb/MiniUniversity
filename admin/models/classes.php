<?php
/**
 * @copyright   Copyright (C) 2016 Open Source Matters, Inc. All rights reserved. ( https://trangell.com )
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @subpackage  com_MiniUniversity
 */
defined('_JEXEC') or die('Restricted access');

class MiniUniversityModelClasses extends JModelList
{
	public $comName = "miniuniver"; // *************** name of component *******************
	public $viewName = "class"; // *************** name of component *******************
	
	public function __construct($config = array())
	{
		if (empty($config['filter_fields']))
		{
			$config['filter_fields'] = array(
				'id',
				'name',
				'published'
			);
		}

		parent::__construct($config);
	}

	protected function getListQuery()
	{
		$db    = JFactory::getDbo();
		$query = $db->getQuery(true);

		$query->select('c.id,c.class_name,t.name as teacher_name,b.name as lesson_name');
		$query->from('#__'.$this->comName.'_class as c');
		$query->leftJoin('#__'.$this->comName.'_teacher as t ON t.id = c.teacher_id');
		$query->leftJoin('#__'.$this->comName.'_book as b ON b.id = c.lesson_id');
				  
		$search = $this->getState('filter.search');

		if (!empty($search))
		{
			$like = $db->quote('%' . $search . '%');
			$query->where('c.class_name LIKE ' . $like);
		}

		$published = $this->getState('filter.published');

		if (is_numeric($published))
		{
			$query->where('published = ' . (int) $published);
		}
		elseif ($published === '')
		{
			$query->where('(published IN (0, 1))');
		}

		$orderCol	= $this->state->get('list.ordering', 'c.id');
		$orderDirn 	= $this->state->get('list.direction', 'asc');

		$query->order($db->escape($orderCol) . ' ' . $db->escape($orderDirn));
		
		return $query;

	 }
	 //================================================================================== delete
	  //==============================================
	 function deleteAttribs() {
		$values = JRequest::getVar('pageId');
		
		if ($values != "empty")
			$values = explode(',',$values);
			
		foreach ($values as $val) {
	
			$db1 = JFactory::getDbo();
			$query1 = $db1->getQuery(true);
			$query1->delete('#__'.$this->comName.'_'.$this->viewName); 
			$query1->where('id = '. $val);
			$db1->setQuery($query1);
			$db1->execute();
			
		}
	}
}
?>
