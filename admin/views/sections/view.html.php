<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_miniuniversity
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

/**
 * Teachers View
 *
 * @since  0.0.1
 */
class MiniUniversityViewSections extends JViewLegacy
{
	public $comName = "miniuniversity"; // *********************** component name  *******************
	/**
	 * Display the Hello World view
	 *
	 * @param   string  $tpl  The name of the template file to parse; automatically searches through the template paths.
	 *
	 * @return  void
	 */
	function display($tpl = null)
	{
		
		// Get application
		$app = JFactory::getApplication();
		$context = "miniuniversity.list.admin.section";
		// Get data from the model
		$this->items		= $this->get('Items');
		$this->pagination	= $this->get('Pagination');
		$this->state		= $this->get('State');
		$this->filter_order	= $app->getUserStateFromRequest($context.'filter_order', 'filter_order', 'greeting', 'cmd');
		$this->filter_order_Dir = $app->getUserStateFromRequest($context.'filter_order_Dir', 'filter_order_Dir', 'asc', 'cmd');
		$this->filterForm    	= $this->get('FilterForm');
		$this->activeFilters 	= $this->get('ActiveFilters');

		// What Access Permissions does this user have? What can (s)he do?
		$this->canDo = MiniUniversityHelper::getActions();

		// Check for errors.
		if (count($errors = $this->get('Errors')))
		{
			JError::raiseError(500, implode('<br />', $errors));

			return false;
		}

		// Set the submenu
		MiniUniversityHelper::addSubmenu('sections');

		// Set the toolbar and number of found items
		$this->addToolBar();

		// Display the template
		parent::display($tpl);

		// Set the document
		$this->setDocument();
	}

	/**
	 * Add the page title and toolbar.
	 *
	 * @return  void
	 *
	 * @since   1.6
	 */
	protected function addToolBar()
	{
		
		$title = JText::_(strtoupper('com_'.$this->comName).'_MANAGER_SECTIONS');

		if ($this->pagination->total)
		{
			$title .= "<span style='font-size: 0.5em; vertical-align: middle;'>(" . $this->pagination->total . ")</span>";
		}

		JToolBarHelper::title($title, 'section');

		if ($this->canDo->get('core.create')) 
		{
			JToolBarHelper::addNew('section.add', 'JTOOLBAR_NEW');
		}
		if ($this->canDo->get('core.edit')) 
		{
			$eString = "section";
			echo '<input class="btn btn-small" name="button" type="button" value="' .JText::_('COM_'.strtoupper($this->comName)."_SECTION_EDIT_BUTTON"). '" onclick="javascript:editAttrib(\''.$eString.'\')">';
		}
		if ($this->canDo->get('core.delete')) 
		{
			$dString = "sections";
			echo '<input class="btn btn-small" name="button" type="button" value="' .JText::_('COM_'.strtoupper($this->comName)."_SECTION_DELETE_BUTTON"). '" onclick="javascript:deleteAttrib(\''.$dString.'\')">';
		}
		if ($this->canDo->get('core.admin')) 
		{
			JToolBarHelper::divider();
			JToolBarHelper::preferences('com_'.$this->comName);
		}
	}
	/**
	 * Method to set up the document properties
	 *
	 * @return void
	 */
	protected function setDocument() 
	{
		$document = JFactory::getDocument();
		$document->setTitle(JText::_('COM_MINIUNIVERSITY_SECTIONS_TITLE'));
	}
}
