<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_search
 *
 * @copyright   Copyright (C) 2005 - 2016 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

use Joomla\Registry\Registry;

	 JHtml::stylesheet(JURI::root().'components/com_helloworld/css/style.css');
	JHtml::stylesheet('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css');
	JHtml::script('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js');
	JHtml::stylesheet('https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css');
class HelloWorldViewSearch extends JViewLegacy
{
	public function display($tpl = null) {
		
			// $rows1= HelloWorldModelSearch::term();
			// $optionHtml1 = '';
			// $optionHtml1 .='<select class="col-sm-2 right cap input-lg" name="term">';
			// $optionHtml1 .='<option value="">انتخاب کنید</option>';

			// 	foreach ($rows1 as $result) {
   //    	 				$optionHtml1 .=  ("<option value='{$result->id}'>{$result->name}</option>");
	  //   			}
			//     		$optionHtml1 .= '</select>';
			// 		$this->term =  $optionHtml1;

			// $rows2= HelloWorldModelSearch::reshte();
			// $optionHtml2 = '';
			// $optionHtml2 .='<select class="col-sm-2 right cap input-lg" name="book">';
			// $optionHtml2 .='<option value="">انتخاب کنید</option>';

			// 	foreach ($rows2 as $result) {
   //    	 				$optionHtml2 .=  ("<option value='{$result->id}'>{$result->name}</option>");
	  //  			}
	   			
			//     		$optionHtml2 .= '</select>';
			// 		$this->reshte =  $optionHtml2;
					$optionHtml3 = '';
	
	$out= $this->get('data');
	if (isset($out)) {
	  	foreach ($out as $result) {
	  		$b = htmlspecialchars($result->dis);
	  		$b = str_replace("<p>", " ", $b);
			$test= JRoute::_('index.php?option=com_helloworld&view=helloworld&id=' . str_replace(" ","-",$result->slug) ); 
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
