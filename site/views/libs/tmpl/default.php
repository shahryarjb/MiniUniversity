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
$app 	= JFactory::getApplication();
$model 	= $this->getModel('libs');
?>
<p class="bg-success pads"><i class="fa fa-user"></i> <?php echo JText::_('COM_MINIUNIVERSITY_LIB_WELCOME');?> </p>    
     <div class="clearfix"></div>
  <div class="container-fluid">
  <div class="row">
      <?php if (empty ($this->items)) {?>
                <p><?php echo JText::_('COM_MINIUNIVERSITY_LIB_EMPTY');?></p>
      <?php  } else { ?>
            
              <?php
foreach($this->items as $i => $item) { ?>
   
            <div class="col-md-3" style="margin-bottom: 10px;">
            <div class="container-fluid sbord" style="padding: 0;">
          
      <?php 
        if (!empty($item->libspics)) {?>

            <a href="<?php echo JRoute::_('index.php?option=com_miniuniversity&view=lib&id=' . str_replace(" ","-",$item->slug) ); ?>">
                
                  <img src="<?php echo htmlspecialchars($item->libspics); ?>" class="img-responsive" alt="<?php echo htmlspecialchars($item->name); ?>">
                <?php } else { ?>
       <a href="<?php echo JRoute::_('index.php?option=com_miniuniversity&view=lib&id=' . str_replace(" ","-",$item->slug) ); ?>">
                   <img src="media/com_miniuniversity/images/no_image.jpg" class="img-responsive" alt="هیچ عکسی نیست">
                <?php } ?>
            </a>
                        <div class="clearfix"></div>
      

                 <div class="col-sm-12 pad-shema-lib">
                     <?php 
                     if ($this->params['count_resv_libs'] == 1) { ?>
                     <i class="fa fa-calculator" aria-hidden="true">
                         <?php 
							$BookResCont = $model->TotalResBook($item->id);
							echo count($BookResCont); 
						 ?>
                     </i>
                     <?php } ?>
                           <button class="toltip" data-balloon-length="medium" data-balloon="<?php echo substr(htmlspecialchars($item->dis),0, 230); ?>" data-balloon-pos="up"><i class="fa fa-info-circle"></i></button>
                           <div class="clearfix"></div>  
                 </div>
                              <div class="clearfix"></div>
                    <a href="<?php echo JRoute::_('index.php?option=com_miniuniversity&view=lib&id=' . str_replace(" ","-",$item->slug) ); ?>">
                                   <h3 class="nametich"><?php echo htmlspecialchars($item->name); ?> </h3>
                    </a>	
                              <div class="clearfix"></div>							
			                     <span class="licens"><i class="fa fa-angle-double-left"></i> <?php echo JText::_('COM_MINIUNIVERSITY_LIB_BOOK_AUTHOR');?> : <?php  echo substr($item->author,0, 230) ?> </span>
                                  <div class="clearfix"></div>
                                 
                                  <span class="licens"><?php if (!empty($item->translator)){ ?><i class="fa fa-angle-double-left"></i><?php  echo JText::_('COM_MINIUNIVERSITY_TRANSLATOR');?> : <?php  echo substr($item->translator,0, 230); }?> </span>          
                            
                                            <div class="clearfix"></div>
                                            <div class="col-sm-12 rtlpad">
                                                <div class="col-md-1">
                                                                  <?php
                                                                          if ($item->published == 1) {
                                                                              echo '<i class="fa fa-check-circle"></i>';
                                                                          }else {
                                                                              echo '<i class="fa fa-ban"></i>';
                                                                          }
                                                                  ?>
                                                </div>  
                                                <div class="col-md-9 colortext"><i class="fa fa-angle-double-left"></i> <?php echo JText::_('COM_MINIUNIVERSITY_LIB_EXISTS'); ?></div>
                                            </div>
                                                <div class="clearfix"></div>
                                                </br>
                                                <div class="col-sm-12">
                                                        <div class="col-md-6 isbs">
                                                       <?php echo (int)$item->isbn; ?>
                                                        </div>
                                                        
                                                        <div class="col-md-6 isbntext">
                                                        شابک
                                                        </div>
                                                        
                                                </div>
                                                 <div class="clearfix"></div>
                                                 </br>
                                                <div class="col-sm-12">
                                                        <div class="col-md-6 isbs">
                                                            <?php 
                                                            if (empty($item->category)) {
                                                                echo "ندارد";
                                                            }else {
                                                                echo htmlspecialchars($item->category);
                                                            }
                                                            ?>
                                                        </div>
                                                        
                                                        <div class="col-md-6 isbntext">
                                                        موضوع
                                                        </div>
                                                        
                                                </div>
                                                     <div class="clearfix"></div>
                                                    <div class="col-sm-12">
                                                     <a href="<?php echo JRoute::_('index.php?option=com_miniuniversity&view=lib&id=' .  str_replace(" ","-",$item->slug) ); ?>">
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
