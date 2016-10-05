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
		echo '<p>' . JText::_('COM_MINIUNIVERSITY_INSTALL'). $parent->get('manifest')->version  . '</p>';
	}
 

	function uninstall($parent) 
	{
		echo '<p>' . JText::_('COM_MINIUNIVERSITY_UNINSTALL') . '</p>';
	}
 
	function update($parent) 
	{
		echo '<p>' . JText::_('COM_MINIUNIVERSITY_UPDATE') . ' ==> '. $parent->get('manifest')->version . '</p>';
	}
 
	function preflight($type, $parent) 
	{

		
	}

	function postflight($type, $parent) 
	{

		
	}
}
