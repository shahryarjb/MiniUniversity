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
class JFormFieldHelloWorld extends JFormFieldList
{
	/**
	 * The field type.
	 *
	 * @var         string
	 */
	protected $type = 'HelloWorld';

	/**
	 * Method to get a list of options for a list input.
	 *
	 * @return  array  An array of JHtml options.
	 */
	protected function getOptions()
	{
		$db    = JFactory::getDBO();
		$query = $db->getQuery(true);
		$query->select('#__scquiz_teacher.id as id,name,cat_id#__scquiz_book.id as book,cat_id');
		$query->from('#__scquiz_teacher');
		$query->leftJoin('#__scquiz_book on cat_id=#__scquiz_book.id');
		// Retrieve only published items
		//$query->where('#__scquiz_teacher.published = 1');
		$db->setQuery((string) $query);
		$messages = $db->loadObjectList();
		$options  = array();

		if ($messages)
		{
			foreach ($messages as $message)
			{
$options[] = JHtml::_('select.option', $message->id, $message->name .  ($message->cat_id ? ' (' . $message->book . ')' : ''));
			}
		}

		$options = array_merge(parent::getOptions(), $options);
		
		return $options;

	}
}
