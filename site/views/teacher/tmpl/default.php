<?php
/**
 * @copyright   Copyright (C) 2016 Open Source Matters, Inc. All rights reserved. ( https://trangell.com )
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @subpackage  com_MiniUniversity
 */
defined('_JEXEC') or die('Restricted access');
    if ($this->params['bootstrap'] == 1) {
        JHtml::stylesheet(JURI::root().'components/com_miniuniversity/css/style.css');
        JHtml::stylesheet('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css');
        JHtml::script('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js');
        JHtml::stylesheet('https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css');
    }else {
        JHtml::stylesheet(JURI::root().'components/com_miniuniversity/css/style.css');
        JHtml::stylesheet(JURI::root().'components/com_miniuniversity/css/bootstrap.min.css');
        JHtml::script(JURI::root().'components/com_miniuniversity/css/bootstrap.min.js');
        JHtml::stylesheet(JURI::root().'components/com_miniuniversity/css/font-awesome.css');
    }
require_once JPATH_SITE .'/components/com_miniuniversity/helpers/jdf.php';

	if (!empty($this->items->nametich)) {
			$browserbar=  JText::_("COM_MINIUNIVERSITY_TEACHER_INFO").": " .htmlspecialchars($this->items->nametich);
		} else {
		$browserbar=JText::_("COM_MINIUNIVERSITY_TEACHER_NOT_FOUND");	
	}

		$document = JFactory::getDocument();
		$document->setTitle($browserbar);
		$time_stamp = $this->getModel('teacher'); 
?>
<?php
  if (empty($this->items->tichid) or $this->items->published == 0) { 
	  
	  ?>
  <p class="bg-danger pads"><i class="fa fa-bolt" aria-hidden="true"></i> <?php echo JText::_("COM_MINIUNIVERSITY_TEACHER_NOT_FOUND_OR_NOT_EXSIT"); ?> </p>
<div class="bs-callout bs-callout-info col-sm-12" id="callout-helper-bg-specificity">
   	<h4 class="fonts"><?php echo JText::_("COM_MINIUNIVERSITY_ATTENTION"); ?></h4>
    	<p class="fonts"><?php echo JText::_("COM_MINIUNIVERSITY_TEACHER_ERROR1"); ?></p>
    	<code class="cods"><?php echo JText::_("COM_MINIUNIVERSITY_TEACHER_ERROR2"); ?></code>
</div>

<?php }else { ?>
		<p class="bg-success padss"><i class="fa fa-user"></i> <?php echo JText::_("COM_MINIUNIVERSITY_TEACHER_INFO"); ?> </p>
			</br>
		<span class="fonts size"><?php echo JText::_("COM_MINIUNIVERSITY_TEACHER_MAIN_INFO"); ?></span>
			<hr>
		<div class="clearfix"></div>

		  <div class="container-fluid fix">
			  	<div class="span6 borderso right">
			  	<div class="span5 pad inteach">
			  	<div class="span2">
			  			<img src="<?php echo htmlspecialchars($this->items->profilepic); ?>" class="pic img-circle" alt="<?php echo htmlspecialchars($this->items->nametich); ?>">
			  			</div>
			  		<div class="span3">
			  			<h1 class="fonts">
							<?php echo htmlspecialchars($this->items->nametich); ?>
			  			</h2>
			  				<div class="clearfix"></div>
			  			<div class="span11">	
			  			<span class="useron fonts"><?php echo JText::_("COM_MINIUNIVERSITY_TEACHER"); ?></span>
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
				  	<div class="span2 tell fonts"><i class="fa fa-phone" aria-hidden="true"></i> <?php echo htmlspecialchars($this->items->tell); ?>
				  	<div class="clearfix"></div>
				  	</div>
				  	<div class="span4 email"><i class="fa fa-envelope" aria-hidden="true"></i> <?php echo htmlspecialchars($this->items->email); ?></div>
				  	<div class="clearfix"></div>
			  	</div>
			  	<div class="clearfix"></div>
			  	<div class="back1">
				  	<div class="span2 shtich fonts"><i class="fa fa-plus-square" aria-hidden="true"></i> <?php echo JText::_("COM_MINIUNIVERSITY_TEACHER_CALLNUMBER"); ?>
				  	<div class="clearfix"></div>
				  	</div>
				  	<div class="span4 shtichnum"><?php echo htmlspecialchars($this->items->shtich); ?></div>
				  	<div class="clearfix"></div>
			  	</div>
			  	<div class="clearfix"></div>
			  	<div class="back">
				  	<div class="span2 tell fonts"> <?php echo JText::_("COM_MINIUNIVERSITY_TEACHER_LICENSE"); ?>
				  	<div class="clearfix"></div>
				  	</div>
				  	<div class="span4 md"><?php echo htmlspecialchars($this->items->tichlicens); ?></div>
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
					  	<div class="span2 shtich fonts"><i class="fa fa-book" aria-hidden="true"></i> <?php echo JText::_("COM_MINIUNIVERSITY_COURSE_NAME"); ?>
					  	<div class="clearfix"></div>
					  	</div>
					  	<div class="span4 shtichnum"><i class="fa fa-calendar" aria-hidden="true"></i> <?php echo JText::_("COM_MINIUNIVERSITY_MIANTERM_TIME"); ?></div>
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
									<?php echo htmlspecialchars($mian_term->name);?>
									<div class="clearfix"></div>
									</div>
									<div class="span2 shtichnum green">
									<?php
									if ($this->params['date_type'] == 0) {
										echo jdate("o:m:j",$time_stamp->convert_date_to_unix($mian_term->qextime));
									}else {
										echo htmlspecialchars($mian_term->qextime);
									}
									?>
									</div>
									<div class="clearfix"></div>
								</div>
								</br>
				  	<?php    }
						}
				  	 ?>

</br>

				  	<div class="back1 borderso fonts">
					  	<div class="span2 shtich fonts"><i class="fa fa-book" aria-hidden="true"></i> <?php echo JText::_("COM_MINIUNIVERSITY_COURSE_NAME"); ?>
					  	<div class="clearfix"></div>
					  	</div>
					  	<div class="span4 shtichnum"><i class="fa fa-calendar" aria-hidden="true"></i> <?php echo JText::_("COM_MINIUNIVERSITY_PAYANTERM_TIME"); ?> </div>
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
									<div class="span4 shtich fonts op"> <?php echo htmlspecialchars($payan_term->name); ?>
									<div class="clearfix"></div>
									</div>
									<div class="span2 shtichnum green">
										<?php
									if ($this->params['date_type'] == 0) {
					echo jdate("o:m:j",$time_stamp->convert_date_to_unix($payan_term->endextime));
									}else {
										echo htmlspecialchars($payan_term->endextime);
									}?>
									</div>
									<div class="clearfix"></div>
								</div>
								</br>
					<?php    }
						}
						 ?>



				  		<div class="bs-callout bs-callout-info col-sm-12" id="callout-helper-bg-specificity">
   	<h4 class="fonts"><?php echo JText::_("COM_MINIUNIVERSITY_ATTENTION"); ?></h4>
    	<p class="fonts">
<?php echo JText::_("COM_MINIUNIVERSITY_MIANTERM_INFO"); ?>	
    	</p>
    	
<code class="cods">
<?php 
if ($this->books)
{ 
	foreach ($this->books as $mian_term_dis)
	{
	echo JText::_("COM_MINIUNIVERSITY_MIANTERM_COURSE_NAME").$mian_term_dis->name.''. JText::_("COM_MINIUNIVERSITY_GENERAL_INFO") . ''.htmlspecialchars($mian_term_dis->qexdis).'</br></br>'; 
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
	echo JText::_("COM_MINIUNIVERSITY_PAYANTERM_COURSE_NAME").htmlspecialchars($payan_term_dis->name).''. JText::_("COM_MINIUNIVERSITY_GENERAL_INFO") .''.htmlspecialchars($payan_term_dis->endexdis).'</br></br>'; 
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
							<? echo JText::_("COM_MINIUNIVERSITY_TEACHER_NOT_HAVE_COURSE");?>
							</div>
 <div class="clearfix"></div>

							<div class="bs-callout bs-callout-info col-sm-12" id="callout-helper-bg-specificity">
   	<h4 class="fonts"><?php echo JText::_("COM_MINIUNIVERSITY_ATTENTION"); ?></h4>
    	<p class="fonts">

<?php echo JText::_("COM_MINIUNIVERSITY_GENERAL_ERROR3"); ?>
    	</p>
    	
    	<code class="cods">
    	<?php echo JText::_("COM_MINIUNIVERSITY_GENERAL_ERROR4"); ?>
    	</code>
</div>
                                                                          <?php } ?>

				  	


				</div>

		  </div><!-- container-fluid -->
<?php } ?>
