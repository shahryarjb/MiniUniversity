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
			$query->select('co.*, c.name as category,c.qextime,c.endextime,c.endexdis,c.qexdis');
			$query->from('#__scquiz_teacher as co');
			$query->where('co.id = ' . $id);
			$query->leftJoin('#__scquiz_book c ON co.cat_id=c.id');
				 
				  $db->setQuery($query);
				  $data = $db->loadObject();
		}
		return $data;
	}
}
