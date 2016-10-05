<?php
/**
 * @copyright   Copyright (C) 2016 Open Source Matters, Inc. All rights reserved. ( https://trangell.com )
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @subpackage  com_MiniUniversity
 */
defined('_JEXEC') or die('Restricted access');

class MiniUniversityModelWarns extends JModelList
{

	public function __construct($config = array())
	{
		if (empty($config['filter_fields']))
		{
			$config['filter_fields'] = array(
				'id' ,
				'content',				
				'kind' ,
				// 'published' , 'co.published' ,
			);
		}

		parent::__construct($config);
	}
//------------------------------------------

protected function populateState($ordering = 'id', $direction = 'desc')
	{
		// List state information.
		parent::populateState($ordering, $direction);
	}

//------------------------------------------
protected function getStoreId($id = '')
	{
		return parent::getStoreId($id);
	}
//------------------------------------------

	protected function getListQuery()
	{
		$db    = JFactory::getDbo();
		$query = $db->getQuery(true);

		$query->select(
			$this->getState(
			'list.select',
			'*'
			)
			);
		$query->from($db->quoteName('#__miniuniver_warn'));

		$search = $this->getState('filter.search');
		if (!empty($search))
		{
			$like = $db->quote('%' . $search . '%');
			$query->where('name LIKE ' . $like);
		}

		$published = $this->getState('filter.published');

		if (is_numeric($published))
		{
			//$query->where('published = ' . (int) $published);
		}
		elseif ($published === '')
		{
			//$query->where('(published IN (0, 1))');
		}
		$orderCol	= $this->state->get('list.ordering', 'id');
		$orderDirn 	= $this->state->get('list.direction', 'asc');

		$query->order($db->escape($orderCol) . ' ' . $db->escape($orderDirn));

		return $query;
	}
}
