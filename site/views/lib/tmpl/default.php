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
?>

<?php 
if(empty($this->items->libid)) {
	$browserbar = JText::_("COM_MINIUNIVERSITY_TEACHER_NOT_FOUND");
	$document   = JFactory::getDocument();
	$document->setTitle($browserbar);	
?>
	
	 <p class="bg-danger pads"><i class="fa fa-bolt" aria-hidden="true"></i> <?php echo JText::_("COM_MINIUNIVERSITY_LIB_NOT_FOUND_OR_NOT_EXSIT"); ?> </p>
<div class="bs-callout bs-callout-info col-sm-12" id="callout-helper-bg-specificity">
   	<h4 class="fonts"><?php echo JText::_("COM_MINIUNIVERSITY_ATTENTION"); ?></h4>
    	<p class="fonts"><?php echo JText::_("COM_MINIUNIVERSITY_TEACHER_ERROR1"); ?></p>
    	<code class="cods"><?php echo JText::_("COM_MINIUNIVERSITY_TEACHER_ERROR2"); ?></code>
</div>
<?php  
}else {
	$browserbar=  JText::_("COM_MINIUNIVERSITY_LIBE_TXT_INFO").": " .htmlspecialchars($this->items->namelib);
	$document   = JFactory::getDocument();
	$document->setTitle($browserbar);	
?>
<?php $time_stamp = $this->getModel('lib'); ?> 

<p class="bg-success padss"><i class="fa fa-user"></i> <?php echo JText::_("COM_MINIUNIVERSITY_VIEW_LIB_DETAILS"); ?> </p>
	</br>
		<span class="fonts size"><?php echo JText::_("COM_MINIUNIVERSITY_LIB_DETAILS"); ?></span>
			<hr>
		<div class="clearfix"></div>
		<div class="container-fluid fix lib">
		<div class="span3 libssorce">
			        <?php if(!empty($this->items->libpics)){ ?>
        			    <img src="<?php echo htmlspecialchars($this->items->bookpic); ?>" class="img-responsive" alt="<?php echo htmlspecialchars($this->items->namelib); ?>">
			        <?php } else {?>
		 <img src="media/com_miniuniversity/images/no_image.jpg" class="img-responsive" alt="هیچ عکسی آپلود نشده است">
                    <?php } ?>
		</div>	
		<div class="span5 libssorce">	
				<span class="textlib">
					<?php echo htmlspecialchars($this->items->author). "-" . htmlspecialchars($this->items->namelib); ?>
				</span>	

			<div class="clearfix"></div>
			    <?php if(!empty($this->items->translator)) { ?>
				<span class="textlibtranslator">
					<?php echo "مترجم : " . htmlspecialchars($this->items->translator); ?>
				</span>	
				<?php } ?>
			<div class="clearfix"></div>
				<div class="span5 publish">
					<div class="span3 publish right"><?php echo JText::_("COM_MINIUNIVERSITY_LIB_BOOK_EXISTS"); ?></div>
					<?php 
					if (!empty($this->items->published)) { ?>
						<div class="span2 publish left"><i class="fa fa-check-circle"></i></div>
					<?php }else { ?>
						<div class="span2 publish left"><i class="fa fa-ban"></i></div>
					<?php } ?>
					
				</div>
					
				<div class="clearfix"></div>
				<div class="span5 publish notop">
					<div class="span3 publish right"><?php echo JText::_("COM_MINIUNIVERSITY_LIB_BOOK_AUTHOR"); ?></div>
					<div class="span2 publish lefts"><?php echo htmlspecialchars($this->items->author); ?></div>
				</div>
				
				<div class="clearfix"></div>
				<div class="span5 publish notops">
					<div class="span3 publish right"><?php echo JText::_("COM_MINIUNIVERSITY_LIB_BOOK_ISBN"); ?></div>
					<div class="span2 publish lefts"><?php echo htmlspecialchars($this->items->isbn); ?></div>
				</div>
				
				<div class="clearfix"></div>
				<div class="span5 publish notope">
					<div class="span3 publish right"><?php echo JText::_("COM_MINIUNIVERSITY_LIB_BOOK_CAT"); ?></div>
					<div class="span2 publish lefts"><?php echo htmlspecialchars($this->items->category); ?></div>
				</div>
				
		</div>	
		<div class="span4 libssorces">
			<div class="backlibs">
					  	<div class="span2 shtich fonts"><i class="fa fa-user" aria-hidden="true"></i> <?php echo JText::_("COM_MINIUNIVERSITY_STUDENT_NUMBER"); ?>
					  	<div class="clearfix"></div>
					  	</div>
					  	<div class="span2 shtichnum"><i class="fa fa-calendar" aria-hidden="true"></i> <?php echo JText::_("COM_MINIUNIVERSITY_RETURN_DATE"); ?></div>
					  	<div class="clearfix"></div>
				  	</div>
						<div class="clearfix"></div>
						</br>
					
				<?php
					if ($this->libresvs){
							foreach ($this->libresvs as $reserv){
								?>
									<div class="back2">
									<div class="span2 shtich fonts op"> 
									<?php echo htmlspecialchars($reserv->last_transferee);?>
									<div class="clearfix"></div>
									</div>
									<div class="span2 shtichnum green">
										<?php
						if ($this->params['date_type'] == 0) {
							echo jdate("o:m:j",$time_stamp->convert_date_to_unix($reserv->return_date));
						}else {
							echo htmlspecialchars($reserv->return_date);
						}
							?>
							</div>
									<div class="clearfix"></div>
								</div>
								</br>
							<?php }
							}else {
								echo JText::_("COM_MINIUNIVERSITY_SHOW_NOT_RESERVED");
							}  

				?>
		</div>	
	<!--</div>-->
		</div><!--container-fluid fix end-->
				<div class="clearfix"></div>
				<div class="container-fluid fix end">
				<span class="dislibs">
				<?php echo $this->items->dis; ?>				
				</span>
			</div>
			<?php } ?>