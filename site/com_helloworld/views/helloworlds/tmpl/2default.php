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
$upper_limit     = $lang->getUpperLimitSearchWord();
$maxlength       = $upper_limit;
$text            = htmlspecialchars(JText::_('نام استاد را وارد کنید'));
$label           = htmlspecialchars(JText::_('MOD_SEARCH_LABEL_TEXT'));
JHtml::stylesheet(JURI::root().'components/com_helloworld/css/style.css');
JHtml::stylesheet('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css');
JHtml::script('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js');
JHtml::stylesheet('https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css');
?>
<p class="bg-success pads"><i class="fa fa-user"></i> به سیستم نمایش میانترم و نمایه اساتید خوش آمدید </p>


<!-- forme searchs -->

    <form action="<?php echo JRoute::_('index.php?option=com_helloworld&view=search');?>" method="post" class="form-horizontal">
    <div class="form-group col-sm-12 right">
         <input name="searchword" id="mod-search-searchword" maxlength="<?php echo $maxlength; ?>" class="col-sm-5 right" type="search" placeholder="<?php echo $text; ?>" />

        <select class="col-sm-2 right cap input-lg" name='term'>
        <option value="">انتخاب ترم تحصیلی</option>
                     <?php foreach($this->terms as $i => $items) { ?>
                      <option value="<?php echo $items->id;  ?>"><?php echo $items->name;  ?></option>
                      <?php } ?>
            </select>

             <select class="col-sm-2 right cap input-lg" name="book">
             <option value="">انتخاب کتاب</option>
                       <?php foreach($this->books as $i => $item) { ?>
                      <option value="<?php echo $item->id;  ?>"><?php echo $item->name;  ?></option>
                      <?php } ?>
                  </select>
          <div class="clearfix"></div>
          <input type="submit" name="submit" value="جستجو" class="btn btn-primary btn-lg right" />
      </div>
          </form>
                                                                        <!---  seraches ------>
                                                                        <div class="clearfix"></div>
  <div class="container-fluid">
  <div class="row">
      <?php if (empty ($this->items)) {?>
                <p><?php echo JText::_('COM_HELLOWORLD_NO_CONTENT');?></p>
      <?php  } else { ?>
            
              <?php
foreach($this->items as $i => $item) { ?>
   
            <div class="col-md-3" style="margin-bottom: 10px;">
            <div class="container-fluid sbord" style="padding: 0;">
          
      <?php 
        if (!empty($item->profilepic)) {?>

            <a href="<?php echo JRoute::_('index.php?option=com_helloworld&view=helloworld&id=' . str_replace(" ","-",$item->slug) ); ?>">
                <img src="<?php echo $item->profilepic; ?>" class="img-responsive" alt="تست طراحی سایت">
            </a>
                        <div class="clearfix"></div>
      <?php } ?>

                 <div class="col-sm-12 pad-shema">
                           <i class="fa fa-star">22  </i>  
                           <button class="toltip" data-balloon-length="medium" data-balloon="<?php echo substr($item->dis,0, 230); ?>" data-balloon-pos="up"><i class="fa fa-info-circle"></i></button>
                           <div class="clearfix"></div>  
                 </div>
                              <div class="clearfix"></div>
                    <a href="<?php echo JRoute::_('index.php?option=com_helloworld&view=helloworld&id=' . str_replace(" ","-",$item->slug) ); ?>">
                                   <h3 class="nametich"><?php echo $item->name; ?> </h3>
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
                                                <div class="col-md-9 colortext"><i class="fa fa-angle-double-left"></i> وضعیت ترم جاری</div>
                                            </div>
                                                <div class="clearfix"></div>
                                                <div class="col-sm-12 rtlpad">
                                                    <div class="col-md-1 img-circle int">12</div>  
                                                    <div class="col-md-9 colortext"><i class="fa fa-angle-double-left"></i> تعداد دروس اخذ شده</div>
                                                </div>
                                                     <div class="clearfix"></div>
                                                    <div class="col-sm-12">
                                                     <a href="<?php echo JRoute::_('index.php?option=com_helloworld&view=helloworld&id=' .  str_replace(" ","-",$item->slug) ); ?>">
                                                        <button type="button" class="btn btn-primary btn-lg shyke">اطلاعات بیشتر</button>
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
      
