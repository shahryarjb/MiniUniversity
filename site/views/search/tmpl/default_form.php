<?php
/**
 * @copyright   Copyright (C) 2016 Open Source Matters, Inc. All rights reserved. ( https://trangell.com )
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @subpackage  com_MiniUniversity
 */

defined('_JEXEC') or die;

JHtml::_('bootstrap.tooltip');

$lang = JFactory::getLanguage();
$upper_limit = $lang->getUpperLimitSearchWord();
JHtml::stylesheet(JURI::root().'components/com_helloworld/css/style.css');
JHtml::stylesheet('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css');
JHtml::script('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js');
JHtml::stylesheet('https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css');
?>
<form id="searchForm" action="<?php echo JRoute::_('index.php?option=com_helloworld&view=search');?>" method="post" class="form-horizontal">

		<div class="form-group col-sm-12 right">
			
		<input type="text" name="searchword" placeholder="<?php echo JText::_('لطفا نام استاد مورد نظر را وارد نمایید'); ?>" id="search-searchword" size="10" maxlength="<?php echo $upper_limit; ?>" value="" class="col-sm-5 right pad" />
						<?php echo $this->term; ?>
						<?php echo $this->reshte; ?>

			<div class="clearfix"></div>
			<button name="Search"  class="btn btn-primary btn-lg right" title="<?php echo JHtml::tooltipText('جتسجو');?>"><span class="icon-search"></span><?php echo JText::_('جستجو'); ?></button>
			
		</div>
		<div class="clearfix"></div>


<?php //if ($this->total > 0) : ?>

	<div class="form-limit">
		<label for="limit">
			<?php //echo JText::_('JGLOBAL_DISPLAY_NUM'); ?>
		</label>
		<?php //echo $this->pagination->getLimitBox(); ?>
	</div>
<p class="counter">
		<?php //echo $this->pagination->getPagesCounter(); ?>
	</p>

<?php //endif; 

?>

</form>
