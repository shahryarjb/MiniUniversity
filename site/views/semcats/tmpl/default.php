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


<div class="container-fluid">
  <div class="row">
    <div class="col-md-12">
      <table class="table table-hover">
        <thead>

          <tr>
            <th>
              #
            </th>
            <th style="font-weight: normal;">
              تیتر
            </th>
            <th style="font-weight: normal;">
              تاریخ شروع امتحانات
            </th>
            <th style="font-weight: normal;">
              تاریخ پایان امتحانات
            </th>
          </tr>
        </thead>
        <tbody>

        <?php if (empty ($this->items)) {?>
          <p><?php echo JText::_('COM_MINIUNIVERSITY_LIB_EMPTY');?></p>
       <?php  } else { 
                       $i = 1;
          ?>
          <?php foreach($this->items as $i => $item) {  
            $b = $i+1;
          if ($b % 2 != 0) { ?>
          <tr class="active">
          <?php
                        } else { ?>
          <tr>
                        <?php }
            ?>
            <td>
              <?php echo $i+1; ?>
            </td>
            <td>
               <a href="<?php echo JRoute::_('index.php?option=com_miniuniversity&view=semcat&id=' .  str_replace(" ","-",$item->slug) ); ?>"> <?php  echo $item->semcatname; ?> </a>
            </td>
            <td>
              <?php  echo $item->termtimes; ?>
            </td>
            <td>
              <?php  echo $item->termtimeex; ?>
            </td>
            </tr>

          <?php } // end of if
          } // end of foreach loop 
       ?>
        </tbody>
      </table>
    </div>
  </div>
</div>