<?php
/**
 * @copyright   Copyright (C) 2016 Open Source Matters, Inc. All rights reserved. ( https://trangell.com )
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @subpackage  com_MiniUniversity
 */

defined('_JEXEC') or die;
JHtml::stylesheet(JURI::root().'components/com_helloworld/css/style.css');
JHtml::stylesheet('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css');
JHtml::script('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js');
JHtml::stylesheet('https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css');
?>


	<?php if (($this->output) != null) { 
		echo htmlspecialchars($this->output);
	}else {
		echo "<p class='erse bg-danger'><i class='fa fa-bell-slash-o' aria-hidden='true'></i> جستجویی وجود ندارد !!</p>";
	} ?>

