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
JHtml::_('behavior.formvalidator');
?>
<?php //echo JRoute::_('index.php?option=com_miniuniversity&view=search'); ?>
<p class="bg-success pads"><i class="fa fa-user"></i> <?php echo JText::_('COM_MINIUNIVERSITY_WELCOME');?> </p>

<!-- forme searchs -->

    <form action="<?php echo JRoute::_('index.php?option=com_miniuniversity&view=search');?>" method="post" class="form-validate">
    <div class="form-group col-sm-12 right">
         <input name="searchword" id="mod-search-searchword" maxlength="<?php echo $maxlength; ?>" class="col-sm-5 right" type="search" placeholder="<?php echo $text; ?>" />

        <select class="col-sm-2 right cap input-lg" name='term'>
        <option value=""><?php echo JText::_('COM_MINIUNIVERSITY_SELECT_TERM');?></option>
                     <?php foreach($this->terms as $i => $items) { ?>
                      <option value="<?php echo (int)$items->id;  ?>" class="validate-numeric"><?php echo htmlspecialchars($items->name);  ?></option>
                      <?php } ?>
            </select>

             <select class="col-sm-2 right cap input-lg" name="book">
             <option value=""><?php echo JText::_('COM_MINIUNIVERSITY_SELECT_COURSE');?></option>
                       <?php foreach($this->books as $i => $item) { ?>
                      <option value="<?php echo (int)$item->id;?>" class="validate-numeric"><?php echo htmlspecialchars($item->name);  ?></option>
                      <?php } ?>
                  </select>
          <div class="clearfix"></div>
          <!-- <?php echo JHtml::_( 'form.token' ); ?> -->
          <input type="submit" name="submit" value="<?php echo JText::_('COM_MINIUNIVERSITY_SEARCH');?>" class="validate btn btn-primary btn-lg right" />
      </div>
          </form>
                                                                        <!---  seraches ------>
                                                                        <div class="clearfix"></div>
  <div class="container-fluid">
  <div class="row">
      <?php if (empty ($this->items)) {?>
                <p><?php echo JText::_('COM_MINIUNIVERSITY_NO_CONTENT');?></p>
      <?php  } else { ?>
            
              <?php
foreach($this->items as $i => $item) { ?>
   
            <div class="col-md-3" style="margin-bottom: 10px;">
            <div class="container-fluid sbord" style="padding: 0;">
          
      <?php 
        if (!empty($item->profilepic)) {?>

            <a href="<?php echo JRoute::_('index.php?option=com_miniuniversity&view=teacher&id=' . str_replace(" ","-",$item->slug) ); ?>">
                <img src="<?php echo htmlspecialchars($item->profilepic); ?>" class="img-responsive" alt="<?php echo htmlspecialchars($item->name); ?>">
            </a>
                        <div class="clearfix"></div>
      <?php } ?>

                 <div class="col-sm-12 pad-shema">
                     <?php 
                     if (isset($this->params['star_teachers'])) {
                         if ($this->params['star_teachers'] == 1) {
                           echo '<i class="fa fa-star">22  </i>';
                      }
                     }
                           ?>
                           <button class="toltip" data-balloon-length="medium" data-balloon="<?php echo substr($item->dis,0, 230); ?>" data-balloon-pos="up"><i class="fa fa-info-circle"></i></button>
                           <div class="clearfix"></div>  
                 </div>
                              <div class="clearfix"></div>
                    <a href="<?php echo JRoute::_('index.php?option=com_miniuniversity&view=teacher&id=' . str_replace(" ","-",$item->slug) ); ?>">
                                   <h3 class="nametich"><?php echo htmlspecialchars($item->name); ?> </h3>
                    </a>	
                              <div class="clearfix"></div>							
			                     <span class="licens"><i class="fa fa-angle-double-left"></i> <?php  echo substr($item->tichlicens,0, 230) ?> </span>
                                            <div class="clearfix"></div>
                                            <div class="col-sm-12 rtlpad">
                                                <div class="col-md-1">
                                                                  <?php
                                                                          if (htmlspecialchars((int)$item->term_id) > 0) {
                                                                              echo '<i class="fa fa-check-circle"></i>';
                                                                          }else {
                                                                              echo '<i class="fa fa-ban"></i>';
                                                                          }
                                                                  ?>
                                                </div>  
                                                <div class="col-md-9 colortext"><i class="fa fa-angle-double-left"></i> <?php echo JText::_('COM_MINIUNIVERSITY_CURRENT_TERM'); ?></div>
                                            </div>
                                                <div class="clearfix"></div>
                                                <div class="col-sm-12 rtlpad">
                                                    <div class="col-md-1 img-circle int"><?php 
                                                    if ((int)$item->cat_id != 0 AND htmlspecialchars((int)$item->term_id) > 0){
                                                        $book_count =(explode(',', $item->cat_id)); 
                                                        echo count($book_count);?></div>  
											<?php	}
													else{
														echo '<i class="fa fa-ban"></i>';?></div>
											<?php	}
											?>
                                                    <div class="col-md-9 colortext"><i class="fa fa-angle-double-left"></i> <?php echo JText::_('COM_MINIUNIVERSITY_NUMBER_OF_COURSE'); ?></div>
                                                </div>
                                                     <div class="clearfix"></div>
                                                    <div class="col-sm-12">
                                                     <a href="<?php echo JRoute::_('index.php?option=com_miniuniversity&view=teacher&id=' .  str_replace(" ","-",$item->slug) ); ?>">
                                                        <button type="button" class="btn btn-primary btn-lg shyke"><?php echo JText::_('COM_MINIUNIVERSITY_MORE_INFO'); ?></button>
                                                        </a>
                                                    </div>
                                                             <div class="clearfix"></div>
              
            </div>
      </div>
  <?php
               }
                              }
?>

    </div>