<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_helloworld
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

// No direct access to this file
defined('_JEXEC') or die('Restricted Access');
JHtml::_('formbehavior.chosen', 'select');
JHtml::stylesheet(JURI::root().'administrator/components/com_helloworld/css/style.css');
JHtml::stylesheet('https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css');
$model      = $this->getModel();
// $items = $model->date();
?>
<div class="row maselemnts alert alert-success span12" role="alert">
<i class="fa fa-cubes"></i>
به سیستم مدیریت اساتید و نمایش میانترم خوش آمدید
</div>

<div class="tris span12">
	<div class="span8 stubs">
		<div class="span12 stubs1">
			
				<div class="span6 yu pad">
				<a href="index.php?option=com_helloworld&view=helloworlds">
						<i class="fa fa-users"></i>
						مدیریت اساتید
				</a>
				</div>
			
			
			<div class="span6 yu pad">
			<a href="index.php?option=com_helloworld&view=books">
					<i class="fa fa-book"></i>
					مدیریت درس ها
			</a>
			</div>
			
		</div>
			<div class="span12 stubs1" style="padding-right: 0; margin-right: 0;">	
				<div class="span6 yu pad">
				<a href="index.php?option=com_helloworld&view=semesters">
					<i class="fa fa-calendar-check-o"></i>
					تقویم آموزشی
				</a>
				</div>
				<div class="span6 yu pad">
				<a href="index.php?option=com_helloworld&view=semesters">
					<i class="fa fa-cogs"></i>
					تنظیمات پیکربندی
				 </a>
				 </div>
			</div>	



<div class="span12 stubs1" style="padding-right: 0; margin-right: 0;">	
				<div class="span6 yu pad">
				<a href="index.php?option=com_helloworld&view=libs">
					<i class="fa fa-file-text" aria-hidden="true"></i>
					کتاب خانه
				</a>
				</div>
				<div class="span6 yu pad">
				<a href="index.php?option=com_helloworld&view=semesters">
					<i class="fa fa-cogs"></i>
					تنظیمات پیکربندی
				 </a>
				 </div>
			</div>	



	</div>
	<div class="span4 stubs">

			<div class="span12 label label-success grt">
			امروز سه شنبه 17 فروردین 1395
			</div>
			<div class="span12 botom">
				<center>
					<img src="/mojtaba/administrator/components/com_helloworld/css/test.png">
				</center>
			</div>

				<div class="span12 s1">
					<div class="span10">
						<i class="fa fa-user"></i>
					تعداد کل اساتید
					</div>
					<div class="span1 s1p">
					<?php $items = $model->UserTich(); ?>
					</div>
				</div>
				<div class="span12 s2">
					<div class="span10">
						<i class="fa fa-file-text-o"></i>
					دروس ارائه شده
					</div>
					<div class="span1 s1p">
					<?php $items = $model->QueryBook(); ?>
					</div>
				</div>
				<div class="span12 s3">
					<div class="span10">
						<i class="fa fa-bar-chart"></i>
					تعداد ترم های تحصیلی
					</div>
					<div class="span1 s1p">
					<?php $items = $model->QuerySemester(); ?>
					</div>
				</div>

	</div>
</div>