<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_miniuniversity
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

// No direct access to this file
defined('_JEXEC') or die('Restricted Access');
JHtml::_('formbehavior.chosen', 'select');
JHtml::stylesheet(JURI::root().'administrator/components/com_miniuniversity/css/style.css');
JHtml::stylesheet('https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css');
require_once JPATH_SITE .'/components/com_miniuniversity/helpers/jdf.php';


use Joomla\Registry\Registry;  // include PasswordHash with JUserHelper



$model      = $this->getModel();
//$items = $model->date();
?>
<div class="row maselemnts alert alert-success span12" role="alert">
<i class="fa fa-cubes"></i>
<?php echo JText::_('COM_MINIUNIVERSITY_WELCOME');?>
</div>

<div class="tris span12">
	<div class="span8 stubs">
		<div class="span12 stubs1">
			
				<div class="span6 yu pad">
				<a href="index.php?option=com_miniuniversity&view=teachers">
						<i class="fa fa-users"></i>
					<?php echo JText::_('COM_MINIUNIVERSITY_MANAGE_TEACHER');?>
				</a>
				</div>
			
			
			<div class="span6 yu pad">
			<a href="index.php?option=com_miniuniversity&view=books">
					<i class="fa fa-book"></i>
					<?php echo JText::_('COM_MINIUNIVERSITY_MANAGE_COURSES');?>
			</a>
			</div>
			
		</div>
			<div class="span12 stubs1" style="padding-right: 0; margin-right: 0;">	
				<div class="span6 yu pad">
				<a href="index.php?option=com_miniuniversity&view=semesters">
					<i class="fa fa-calendar-check-o"></i>
					<?php echo JText::_('COM_MINIUNIVERSITY_EDUCATIONAL_CALENDER');?>
				</a>
				</div>
				<div class="span6 yu pad">
				<a href="index.php?option=com_config&view=component&component=com_miniuniversity">
					<i class="fa fa-cogs"></i>
					<?php echo JText::_('COM_MINIUNIVERSITY_CONFIG');?>
				 </a>
				 </div>
			</div>	



<div class="span12 stubs1" style="padding-right: 0; margin-right: 0;">	
				
				
			</div>	



	</div>
	<div class="span4 stubs">

			<div class="span12 label label-success grt">
			<center><?php 
			$date = date_create();
	        echo 'امروز'.'&nbsp&nbsp&nbsp'.jdate("l  j  F  Y",date_timestamp_get($date));
			?></center>
			</div>
			<div class="span12 botom">
				<center>
					<img src="<?php echo JURI::base();?>components/com_miniuniversity/css/test.png">
				</center>
			</div>

				<div class="span12 s1">
					<div class="span10">
						<i class="fa fa-user"></i>
					<?php echo JText::_('COM_MINIUNIVERSITY_NUMBER_OF_TEACHER');?>
					</div>
					<div class="span1 s1p">
					<?php $items = $model->UserTich(); ?>
					</div>
				</div>
				<div class="span12 s2">
					<div class="span10">
						<i class="fa fa-file-text-o"></i>
					<?php echo JText::_('COM_MINIUNIVERSITY_NUMBER_OF_COURSE');?>
					</div>
					<div class="span1 s1p">
					<?php $items = $model->QueryBook(); ?>
					</div>
				</div>
				<div class="span12 s3">
					<div class="span10">
						<i class="fa fa-bar-chart"></i>
					<?php echo JText::_('COM_MINIUNIVERSITY_NUMBER_OF_TERM');?>
					</div>
					<div class="span1 s1p">
					<?php $items = $model->QuerySemester(); ?>
					</div>
				</div>

	</div>
</div>

