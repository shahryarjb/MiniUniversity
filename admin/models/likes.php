<?php
/**
 * @copyright   Copyright (C) 2016 Open Source Matters, Inc. All rights reserved. ( https://trangell.com )
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @subpackage  com_MiniUniversity
 */
defined('_JEXEC') or die('Restricted access');

class MiniUniversityModelLikes extends JModelList
{

	public function __construct($config = array())
	{
		if (empty($config['filter_fields']))
		{
			$config['filter_fields'] = array('id');
		}

		parent::__construct($config);
	}

	protected function getListQuery()
	{
		$db    = JFactory::getDbo();
		$query = $db->getQuery(true);

		$query->select('l.*');
		$query->from('#__miniuniver_like as l');

		$search = $this->getState('filter.search');

		if (!empty($search))
		{
			$like = $db->quote('%' . $search . '%');
			$query->where('l.name LIKE ' . $like);
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

		$orderCol	= $this->state->get('list.ordering', 'id');
		$orderDirn 	= $this->state->get('list.direction', 'asc');

		$query->order($db->escape($orderCol) . ' ' . $db->escape($orderDirn));
		return $query;

	 }
}
?>
