<?php
/**
 * @copyright   Copyright (C) 2016 Open Source Matters, Inc. All rights reserved. ( https://trangell.com )
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @subpackage  com_MiniUniversity
 */
defined('_JEXEC') or die('Restricted access');

class MiniUniversityViewLibcats extends JViewLegacy
{
	function display($tpl = null)
	{

		$items = $this->get('Items');
      		$this->items  = &$items;

      	$warning = $this->get('Warning');
      		$this->warning  = &$warning;
			  
			  $params 		= JComponentHelper::getParams('com_miniuniversity');
		$this->params   = $params->toArray();
		
		//---------------------------------------------------------------
		$mainframe = JFactory::getApplication();
		$limit = $mainframe->getUserStateFromRequest('global.list.limit', 'limit', $mainframe->getCfg('list_limit'), 'int');
		$limitstart = JRequest::getVar('limitstart', 0, '', 'int');
		$pagination = new JPagination(10, $limitstart, $limit);
		$this->assignRef('pagination', $pagination);
		//---------------------------------------------------------------
		
		 
		parent::display($tpl);
	}
}
