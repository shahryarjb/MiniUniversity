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
class HelloWorldModelLibs extends JModelList
{
	/**
	 * Constructor.
	 *
	 * @param   array  $config  An optional associative array of configuration settings.
	 *
	 * @see     JController
	 * @since   1.6
	 */
	public function __construct($config = array())
	{
		if (empty($config['filter_fields']))
		{
			$config['filter_fields'] = array(
				'id'
			);
		}

		parent::__construct($config);
	}

	/**
	 * Method to build an SQL query to load the list data.
	 *
	 * @return      string  An SQL query
	 */
	protected function getListQuery()
	{
		// start db dar joomla ba 2 khate badi anjam mishavad 
		$db    = JFactory::getDbo();
		$query = $db->getQuery(true);

		// shoroEe moArefii dtabese va sharte haye baresii db ghable az namayesh ya save kardan dar database
		$query->select('*')
			  ->from($db->quoteName('#__scquiz_lib'));

		// Filter: like / search be manzoor peyda kardan yek onsor ke shabiye moteghayer ma to db bashad estefade mishavad
		$search = $this->getState('filter.search');
		if (!empty($search))
		{
			$like = $db->quote('%' . $search . '%');
			$query->where('name LIKE ' . $like);
		}

		// Filter by published state
		$published = $this->getState('filter.published');

		if (is_numeric($published))
		{
			$query->where('published = ' . (int) $published);
		}
		elseif ($published === '')
		{
			$query->where('(published IN (0, 1))');
		}

		// nahve namayesh be sorate sOUdi va nozoLi hast
		$orderCol	= $this->state->get('list.ordering', 'id');
		$orderDirn 	= $this->state->get('list.direction', 'asc');
		$query->order($db->escape($orderCol) . ' ' . $db->escape($orderDirn));

		return $query;
	}
}
