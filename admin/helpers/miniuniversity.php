<?php
/**
 * @copyright   Copyright (C) 2016 Open Source Matters, Inc. All rights reserved. ( https://trangell.com )
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @subpackage  com_MiniUniversity
 */
defined('_JEXEC') or die('Restricted access');

abstract class MiniUniversityHelper {

	public static function addSubmenu($submenu) 
	{

		JSubMenuHelper::addEntry(
			'<i class="fa fa-angle-double-left"></i>' . JText::_("COM_MINIUNIVERSITY_ADMIN_PANEL_HOME"),
			'index.php?option=com_miniuniversity',
			$submenu == 'home'
		);

		JSubMenuHelper::addEntry(
			'<i class="fa fa-angle-double-left"></i>'. JText::_("COM_MINIUNIVERSITY_ADMIN_PANEL_TEACHER"),
			'index.php?option=com_miniuniversity&view=teachers',
			$submenu == 'teacher'
		);

		JSubMenuHelper::addEntry(
		'<i class="fa fa-angle-double-left"></i>'. JText::_("COM_MINIUNIVERSITY_ADMIN_PANEL_COURSE"),
			'index.php?option=com_miniuniversity&view=books',
			$submenu == 'book'
		);
		

		JSubMenuHelper::addEntry(
			 '<i class="fa fa-angle-double-left"></i>'. JText::_("COM_MINIUNIVERSITY_ADMIN_PANEL_TERM"),
			'index.php?option=com_miniuniversity&view=semesters',
			$submenu == ' semester'
		);
		
		JSubMenuHelper::addEntry(
			 '<i class="fa fa-angle-double-left"></i>'. JText::_("COM_MINIUNIVERSITY_ADMIN_PANEL_LIB"),
			'index.php?option=com_miniuniversity&view=libs',
			$submenu == ' lib'
		);
		
		
		JSubMenuHelper::addEntry(
			 '<i class="fa fa-angle-double-left"></i>'. JText::_("COM_MINIUNIVERSITY_ADMIN_PANEL_LIBRES"),
			'index.php?option=com_miniuniversity&view=libresvs',
			$submenu == ' libresv'
		);
		
		
		JSubMenuHelper::addEntry(
			 '<i class="fa fa-angle-double-left"></i>'. JText::_("COM_MINIUNIVERSITY_ADMIN_PANEL_LIBCAT"),
			'index.php?option=com_miniuniversity&view=libcats',
			$submenu == ' libcat'
		);


		$document = JFactory::getDocument();
		$document->addStyleDeclaration('.icon-48-miniuniversity ' .
		                               '{background-image: url(../media/com_miniuniversity/images/tux-48x48.png);}');
		if ($submenu == 'categories') 
		{
			$document->setTitle(JText::_('COM_MINIUNIVERSITY_ADMINISTRATION_CATEGORIES'));
		}
	}

	public static function getActions($messageId = 0) {	
		$result	= new JObject;

		if (empty($messageId)) {
			$assetName = 'com_miniuniversity';
		}
		else {
			$assetName = 'com_miniuniversity.message.'.(int) $messageId;
		}

		$actions = JAccess::getActions('com_miniuniversity', 'component');

		foreach ($actions as $action) {
			$result->set($action->name, JFactory::getUser()->authorise($action->name, $assetName));
		}

		return $result;
	}
}
