<?php
/**
 * @copyright   Copyright (C) 2016 Open Source Matters, Inc. All rights reserved. ( https://trangell.com )
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @subpackage  com_MiniUniversity
 */
defined('_JEXEC') or die('Restricted access');
$upper_limit     = $lang->getUpperLimitSearchWord();
$maxlength       = $upper_limit;
$text            = htmlspecialchars(JText::_('نام استاد را وارد کنید'));
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
$session = JFactory::getSession();
JHtml::_('behavior.formvalidator');
// JSession::checkToken( 'post' ) or die( 'Invalid Token' );
?>

<!-- forme searchs -->


    <form action="<?php echo JRoute::_('index.php?option=com_miniuniversity&view=search');?>" method="post" class="form-validate">
    <div class="form-group col-sm-12 right">
       
         
        <?php  if(preg_match('/teachers/i', $_SERVER['HTTP_REFERER'])) { ?>
        <input name="searchword" id="mod-search-searchword" maxlength="40" class="col-sm-5 right" type="search" placeholder="<?php echo $text; ?>" />
        <select class="col-sm-2 right cap input-lg" name='term'>
        <option value=""><?php echo JText::_('COM_MINIUNIVERSITY_SELECT_TERM');?></option>
                     <?php foreach($this->terms as $i => $items) { ?>
                      <option value="<?php echo $items->id;  ?>" class="validate-numeric"><?php echo $items->name;  ?></option>
                      <?php } ?>
            </select>

             <select class="col-sm-2 right cap input-lg" name="book">
             <option value=""><?php echo JText::_('COM_MINIUNIVERSITY_SELECT_COURSE');?></option>
                       <?php foreach($this->books as $i => $item) { ?>
                      <option value="<?php echo $item->id;  ?>" class="validate-numeric"><?php echo $item->name;  ?></option>
                      <?php } ?>
                  </select>
             <?php } else if(preg_match('/libs/i', $_SERVER['HTTP_REFERER'])){ ?>     
              <input name="searchwordlib" id="mod-search-searchword" maxlength="40" class="col-sm-5 right" type="search" placeholder="<?php echo $text; ?>" />
        <select class="col-sm-2 right cap input-lg" name='libcat'>
        <option value=""><?php echo JText::_('COM_MINIUNIVERSITY_SELECT_TERM');?></option>
                     <?php foreach($this->libcats as $i => $items) { ?>
                      <option value="<?php echo $items->id;  ?>" class="validate-numeric"><?php echo $items->name;  ?></option>
                      <?php } ?>
            </select>
            <?php } ?>    
          <div class="clearfix"></div>
          <!-- <?php echo JHtml::_( 'form.token' ); ?> -->
          <input type="submit" name="submit" value="<?php echo JText::_('COM_MINIUNIVERSITY_SEARCH');?>" class="validate btn btn-primary btn-lg right" />
      </div>
          </form>
          
    
                                                                        <!---  seraches ------>
                                                                        <div class="clearfix"></div>

                                                                        	<?php if (($this->output) != null) { 
		echo $this->output;
	}else {
		echo "<p class='erse bg-danger'><i class='fa fa-bell-slash-o' aria-hidden='true'></i>".JText::_('COM_MINIUNIVERSITY_SEARCH_NOT_FOUND' )."</p>";
	} ?>


  <?php 
  if (($session->get('searchbadch') != null)) {
    echo "<p class='erse bg-danger'><i class='fa fa-bell-slash-o' aria-hidden='true'></i>".JText::_('لطفا از کاراکتر های مجاز استفاده کنید !!' )."</p>";
  }

  if ($session->isActive('searchbadch')) {
    $session->clear('searchbadch');
  }
  

  ?>