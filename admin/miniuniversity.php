<?php
/**
 * @copyright   Copyright (C) 2016 Open Source Matters, Inc. All rights reserved. ( https://trangell.com )
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @subpackage  com_MiniUniversity
 */
defined('_JEXEC') or die('Restricted access');

$document = JFactory::getDocument();
$document->addStyleDeclaration('.icon-miniuniversity {background-image: url(../media/com_miniuniversity/images/tux-16x16.png);}');

if (!JFactory::getUser()->authorise('core.manage', 'com_miniuniversity'))
{
	return JError::raiseWarning(404, JText::_('JERROR_ALERTNOAUTHOR'));
}

JLoader::register('MiniUniversityHelper', JPATH_COMPONENT . '/helpers/miniuniversity.php');

$controller = JControllerLegacy::getInstance('miniuniversity');

$input = JFactory::getApplication()->input;
$controller->execute($input->getCmd('task'));

$controller->redirect();
