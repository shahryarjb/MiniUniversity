<?php
/**
 * @copyright   Copyright (C) 2016 Open Source Matters, Inc. All rights reserved. ( https://trangell.com )
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @subpackage  com_MiniUniversity
 */
defined('_JEXEC') or die('Restricted access');
$upper_limit     = $lang->getUpperLimitSearchWord();
$maxlength       = $upper_limit;
$text            = htmlspecialchars(JText::_('COM_MINIUNIVERSITY_ENTER_TEACHER_NAME'));
$label           = htmlspecialchars(JText::_('MOD_SEARCH_LABEL_TEXT'));
 if (isset($this->params['bootstrap'])) {
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
  }else {
      JHtml::stylesheet(JURI::root().'components/com_miniuniversity/css/style.css');
      JHtml::stylesheet(JURI::root().'components/com_miniuniversity/css/bootstrap.min.css');
      JHtml::script(JURI::root().'components/com_miniuniversity/css/bootstrap.min.js');
      JHtml::stylesheet(JURI::root().'components/com_miniuniversity/css/font-awesome.css');
  }
$app 	= JFactory::getApplication();
//$model 	= $this->getModel('libcats');
?>
<p class="bg-success pads"><i class="fa fa-user"></i> <?php echo JText::_('COM_MINIUNIVERSITY_LIB_WELCOME');?> </p>
  <?php if (empty ($this->items)) {?>
          <p><?php echo JText::_('COM_MINIUNIVERSITY_LIB_EMPTY');?></p>
       <?php  } else { ?>
    <div class="container-fluid">
  <div class="row">  
          <?php foreach($this->items as $i => $item) { ?>

    <div class="col-md-3 tichcats">
       <a href="<?php echo JRoute::_('index.php?option=com_miniuniversity&view=libcat&id=' . str_replace(" ","-",$item->slug)); ?>">
      <img alt="<?php echo $item->libcatname; ?>" src="<?php echo htmlspecialchars($item->libcatpic); ?>" class="img-circle tichcats" />
      </a>
      <h3 class="tichcats">
       <a href="<?php echo JRoute::_('index.php?option=com_miniuniversity&view=libcat&id=' .  str_replace(" ","-",$item->slug) ); ?>"> <?php echo $item->libcatname; ?> </a>
      </h3> 
     <a href="<?php echo JRoute::_('index.php?option=com_miniuniversity&view=libcat&id=' .  str_replace(" ","-",$item->slug) ); ?>"> <button type="button" class="btn btn-danger tichcats">
        <?php echo JText::_('COM_MINIUNIVERSITY_MORE_INFO'); ?>
      </button>  </a>
    </div>
          <?php  } ?>
 </div>
</div>  
      <?php  }    ?>