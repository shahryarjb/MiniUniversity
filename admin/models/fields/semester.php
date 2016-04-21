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

JFormHelper::loadFieldClass('list');

/**
 * HelloWorld Form Field class for the HelloWorld component
 *
 * @since  0.0.1
 */
class JFormFieldSemester extends JFormFieldList
{
	

	/**
	 * The field type.
	 *
	 * @var         string
	 */
	protected $type = 'book';

	/**
	 * Method to get a list of options for a list input.
	 *
	 * @return  array  An array of JHtml options.
	 */
	protected function getOptions()
	{
		$db    = JFactory::getDBO();
		$query = $db->getQuery(true);
		$query->select('#__scquiz_semester.id as id,#__scquiz_semester.name as category,catid');
		$query->from('#__scquiz_semester');
		//$query->leftJoin('#__scquiz_book on catid=#__scquiz_book.id');
		// Retrieve only published items
		//$query->where('#__scquiz_book.extension = com_helloworld');
		$db->setQuery((string) $query);
		$messages = $db->loadObjectList();
		$options  = array();
		if ($messages)
		{
			foreach ($messages as $message)
			{
				$options[] = JHtml::_('select.option', $message->id, $message->name .
				                      ($message->catid ? ' (' . $message->category . ')' : ''));
			}
		}

		$options = array_merge(parent::getOptions(), $options);

		return $options;
	}

}
