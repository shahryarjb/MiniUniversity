<?php
/**
 * @copyright   Copyright (C) 2016 Open Source Matters, Inc. All rights reserved. ( https://trangell.com )
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @subpackage  com_MiniUniversity
 */
defined('_JEXEC') or die;

use Joomla\Registry\Registry;

	 JHtml::stylesheet(JURI::root().'components/com_miniuniversity/css/style.css');
	JHtml::stylesheet('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css');
	JHtml::script('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js');
	JHtml::stylesheet('https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css');
class MiniUniversityViewSearch extends JViewLegacy
{
	public function display($tpl = null) {

	$optionHtml3 = '';
	
	$out= $this->get('data');
	if (isset($out)) {
	  	foreach ($out as $result) {
	  		$b = htmlspecialchars($result->dis);
	  		$b = str_replace("<p>", " ", $b);
			$test= JRoute::_('index.php?option=com_miniuniversity&view=teacher&id=' . str_replace(" ","-",$result->slug) ); 
		         	$optionHtml3 .= '<a href='.$test.'>' .  htmlspecialchars($result->name) .'</a>';
		      	$optionHtml3 .=  '<p>'.substr($b,0, 560). "..." . '</p>';

		}
	  		$this->output = $optionHtml3; 
	} else {
	  		$this->output = '';
	}

		$terms = $this->get('Listterm');
      		$this->terms  = &$terms;

      		$books = $this->get('ListBook');
      		$this->books  = &$books;
			parent::display($tpl);
	}
	
}
