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
 * HelloWorld component helper.
 *
 * @param   string  $submenu  The name of the active view.
 *
 * @return  void
 *
 * @since   1.6
 */
abstract class HelloWorldHelper
{
	/**
	 * Configure the Linkbar.
	 */
	public static function addSubmenu($submenu) 
	{

		JSubMenuHelper::addEntry(
			JText::_('<i class="fa fa-angle-double-left"></i> خانه'),
			'index.php?option=com_helloworld',
			$submenu == 'home'
		);

		JSubMenuHelper::addEntry(
			JText::_('<i class="fa fa-angle-double-left"></i> اساتید'),
			'index.php?option=com_helloworld&view=helloworlds',
			$submenu == 'teacher'
		);

		JSubMenuHelper::addEntry(
			JText::_('<i class="fa fa-angle-double-left"></i> دروس/امتحانات'),
			'index.php?option=com_helloworld&view=books',
			$submenu == 'book'
		);
		

		JSubMenuHelper::addEntry(
			JText::_('<i class="fa fa-angle-double-left"></i> ترم تحصیلی'),
			'index.php?option=com_helloworld&view=semesters',
			$submenu == ' semester'
		);

		JSubMenuHelper::addEntry(
			JText::_('<i class="fa fa-angle-double-left"></i> کتاب خانه'),
			'index.php?option=com_helloworld&view=libs',
			$submenu == 'libs'
		);


		// set some global property
		$document = JFactory::getDocument();
		$document->addStyleDeclaration('.icon-48-helloworld ' .
		                               '{background-image: url(../media/com_helloworld/images/tux-48x48.png);}');
		if ($submenu == 'categories') 
		{
			$document->setTitle(JText::_('COM_HELLOWORLD_ADMINISTRATION_CATEGORIES'));
		}
	}

	/**
	 * Get the actions
	 */
	public static function getActions($messageId = 0)
	{	
		$result	= new JObject;

		if (empty($messageId)) {
			$assetName = 'com_helloworld';
		}
		else {
			$assetName = 'com_helloworld.message.'.(int) $messageId;
		}

		$actions = JAccess::getActions('com_helloworld', 'component');

		foreach ($actions as $action) {
			$result->set($action->name, JFactory::getUser()->authorise($action->name, $assetName));
		}

		return $result;
	}
}
