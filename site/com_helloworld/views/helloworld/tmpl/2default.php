<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_helloworld
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

// No direct access to this file
defined('_JEXEC') or die('Restricted access');
JHtml::stylesheet(JURI::root().'components/com_helloworld/css/style.css');
JHtml::stylesheet('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css');
JHtml::script('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js');
JHtml::stylesheet('https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css');
?>
<?php
  if (empty($this->items->tichid)) { ?>
  <p class="bg-danger pads"><i class="fa fa-bolt" aria-hidden="true"></i> استاد مورد نظر غیر فعال شده است یا وجود ندارد !! </p>
<div class="bs-callout bs-callout-info col-sm-12" id="callout-helper-bg-specificity">
   	<h4 class="fonts">لطفا توجه کنید !!</h4>
    	<p class="fonts">اگر شما فکر می کنید این صفحه قبلا وجود داشته و یا مشکلی فنی باعث این خطا گردیده لطفا با مدیریت وب سایت تماس بگیرید. مطمئن باشید در سریع ترین زمان ممکن به شما پاسخ داده می شود.</p>
    	<code class="cods">با اطلاع رسانی خودتان ما را در این راه پر پیچ خم حمایت کنید</code>
</div>

<?php }else { 

$browserbar= "اطلاعات استاد : " . $this->items->nametich;
$document = JFactory::getDocument();
$document->setTitle($browserbar);

	?>
		<p class="bg-success padss"><i class="fa fa-user"></i> اطلاعات استاد </p>
			</br>
		<span class="fonts size">اطلاعات کلی استاد</span>
			<hr>
		<div class="clearfix"></div>

		  <div class="container-fluid fix">
			  	<div class="span6 borderso right">
			  	<div class="span5 pad inteach">
			  	<div class="span2">
			  			<img src="<?php echo $this->items->profilepic; ?>" class="pic img-circle" alt="<?php echo $this->items->nametich; ?>">
			  			</div>
			  		<div class="span3">
			  			<h1 class="fonts">
							<?php echo $this->items->nametich; ?>
			  			</h2>
			  				<div class="clearfix"></div>
			  			<div class="span11">	
			  			<span class="useron fonts">استاد</span>
			  			<span class="useronstate">
			  			 <?php
                                                                          if (htmlspecialchars((int)$this->items->term_id) > 0) {
                                                                              echo '<i class="fa fa-check-circle useronf "></i>';
                                                                          }else {
                                                                              echo '<i class="fa fa-ban useronf"></i>';
                                                                          }
                                                                  ?>
                                                                  	</span>
                                                                  		</div>
			  		</div>
			  	</div>
			  	<div class="clearfix"></div>
			  	<div class="back">
				  	<div class="span2 tell fonts"><i class="fa fa-phone" aria-hidden="true"></i> <?php echo $this->items->tell; ?>
				  	<div class="clearfix"></div>
				  	</div>
				  	<div class="span4 email"><i class="fa fa-envelope" aria-hidden="true"></i> <?php echo $this->items->email; ?></div>
				  	<div class="clearfix"></div>
			  	</div>
			  	<div class="clearfix"></div>
			  	<div class="back1">
				  	<div class="span2 shtich fonts"><i class="fa fa-plus-square" aria-hidden="true"></i> شماره استادی
				  	<div class="clearfix"></div>
				  	</div>
				  	<div class="span4 shtichnum"><?php echo $this->items->shtich; ?></div>
				  	<div class="clearfix"></div>
			  	</div>
			  	<div class="clearfix"></div>
			  	<div class="back">
				  	<div class="span2 tell fonts"><i class="fa fa-calculator" aria-hidden="true"></i> مدرک تحصیلی
				  	<div class="clearfix"></div>
				  	</div>
				  	<div class="span4 md"><?php echo $this->items->tichlicens; ?></div>
				  	<div class="clearfix"></div>
				  	
			  	</div>
			  	<div class="clearfix"></div>
			  		</br>
			  		<div class="fonts dis">
				  		<?php echo $this->items->dis; ?>
				  		<div class="clearfix"></div>
				  	</div>
			</div>
			  	<div class="span6 left">

<?php
if ((htmlspecialchars((int)$this->items->term_id) > 0) && ($this->items->cat_id != 0)) { ?>

<div class="back1 borderso fonts">
					  	<div class="span2 shtich fonts"><i class="fa fa-book" aria-hidden="true"></i> عنوان درس
					  	<div class="clearfix"></div>
					  	</div>
					  	<div class="span4 shtichnum"><i class="fa fa-calendar" aria-hidden="true"></i> تاریخ امتحان میانترم</div>
					  	<div class="clearfix"></div>
				  	</div>
						<div class="clearfix"></div>
						</br>
					<?php 	
						if ($this->books)
						{ 
							foreach ($this->books as $mian_term)
							{
							?>
								<div class="back2 borderso fonts">
									<div class="span4 shtich fonts op"> 
									<?php echo $mian_term->name;?>
									<div class="clearfix"></div>
									</div>
									<div class="span2 shtichnum green"> <?php echo $mian_term->qextime; ?></div>
									<div class="clearfix"></div>
								</div>
								</br>
				  	<?php    }
						}
				  	 ?>

</br>

				  	<div class="back1 borderso fonts">
					  	<div class="span2 shtich fonts"><i class="fa fa-book" aria-hidden="true"></i> عنوان درس
					  	<div class="clearfix"></div>
					  	</div>
					  	<div class="span4 shtichnum"><i class="fa fa-calendar" aria-hidden="true"></i> تاریخ امتحان پایان ترم</div>
					  	<div class="clearfix"></div>
				  	</div>
						<div class="clearfix"></div>
						</br>
						<?php 	
						if ($this->books)
						{ 
							foreach ($this->books as $payan_term)
							{
							?>
								<div class="back2 borderso fonts">
									<div class="span4 shtich fonts op"> <?php echo $payan_term->name; ?>
									<div class="clearfix"></div>
									</div>
									<div class="span2 shtichnum green"> <?php echo $payan_term->endextime; ?></div>
									<div class="clearfix"></div>
								</div>
								</br>
					<?php    }
						}
						 ?>



				  		<div class="bs-callout bs-callout-info col-sm-12" id="callout-helper-bg-specificity">
   	<h4 class="fonts">توجه کنید !!</h4>
    	<p class="fonts">

اطلاعات تکمیلی در مورد میانتر و فصل های ی که باید به وسیله دانشجو خوانده شود  به شرح زیر می باشد . باید این رابطه توجه ویژه ای داشته باشید این سرفصل ها به وسیله استاد مورد نظر انتخاب می گردد و برای هر ترم بر اساس نظر استاد مربوطه تغییر می کند    	
    	</p>
    	
<code class="cods">
<?php 
if ($this->books)
{ 
	foreach ($this->books as $mian_term_dis)
	{
	echo 'میانترم -> عنوان درسی :  '.$mian_term_dis->name.''; ?> اطلاعات تکمیلی : <?php echo ''.$mian_term_dis->qexdis.'</br></br>'; 
	}
}
		?>
</code>
</br>
    	<code class="cods">
    		 <?php 
	if ($this->books)
{ 
foreach ($this->books as $payan_term_dis)
{
	echo 'پایان ترم -> عنوان درسی : '.$payan_term_dis->name.''; ?> اطلاعات تکمیلی : <?php echo ''.$payan_term_dis->endexdis.'</br></br>'; 
}
}
																?>
    	</code>
</div>



<?php
                                                                          }else { ?>
                                                                          <div class="back3 borderso fonts">
                                                                          <i class="fa fa-ban useronf"></i>
						 <div class="clearfix"></div>
						 </br>
							استاد مورد نظر هیچ درسی در این ترم ندارد
							</div>
 <div class="clearfix"></div>

							<div class="bs-callout bs-callout-info col-sm-12" id="callout-helper-bg-specificity">
   	<h4 class="fonts">توجه !!</h4>
    	<p class="fonts">

اگر استاد مورد نظر در این ترم درس دارد و در سایت وارد نشده است یا به مشکل فنی برخورد کردید لطفا با مدیریت وب سایت تماس بگیرید. با تشکر 

    	</p>
    	
    	<code class="cods">
    	توجه کنید . اطلاع رسانی شما باعث حل مشکل می شود پس در این راه ما را حمایت کنید
    	</code>
</div>
                                                                          <?php } ?>

				  	


				</div>

		  </div><!-- container-fluid -->
<?php } ?>








<!-- 	<?php echo $this->items->name; ?>
	
	<?php echo $this->items->category; ?>  -->
