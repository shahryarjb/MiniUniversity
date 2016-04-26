<?php
/**
 * @copyright   Copyright (C) 2016 Open Source Matters, Inc. All rights reserved. ( https://trangell.com )
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @subpackage  com_MiniUniversity
 */
defined('_JEXEC') or die('Restricted access');

class MiniUniversityViewTeacher extends JViewLegacy
{

	function display($tpl = null)
	{

		$items = $this->get('Item');
      		$this->items  = &$items;
      		
		$books = $this->get('Book');
		$this->books  = &$books;
		
		parent::display($tpl);
	}

}
