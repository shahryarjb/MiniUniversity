<?php
/**
 * @copyright   Copyright (C) 2016 Open Source Matters, Inc. All rights reserved. ( https://trangell.com )
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @subpackage  com_MiniUniversity
 */
defined('_JEXEC') or die('Restricted access');

class com_miniUniversityInstallerScript
{

	function install($parent) 
	{
		$parent->getParent()->setRedirectURL('index.php?option=com_miniuniversity');
	}
 

	function uninstall($parent) 
	{
		echo '<p>' . JText::_('COM_MINIUNIVERSITY_UNINSTALL_TEXT') . '</p>';
	}
 
	function update($parent) 
	{
		echo '<p>' . JText::sprintf('COM_MINIUNIVERSITY_UPDATE_TEXT', $parent->get('manifest')->version) . '</p>';
	}
 
	function preflight($type, $parent) 
	{

		echo '<p>' . JText::_('COM_MINIUNIVERSITY_PREFLIGHT_' . $type . '_TEXT') . '</p>';
	}

	function postflight($type, $parent) 
	{

		echo '<p>' . JText::_('COM_MINIUNIVERSITY_POSTFLIGHT_' . $type . '_TEXT') . '</p>';
	}
}
