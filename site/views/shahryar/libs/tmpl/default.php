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
$session = JFactory::getSession();
$app  = JFactory::getApplication();
$model  = $this->getModel('libs');
?>
<p class="bg-success pads"><i class="fa fa-user"></i> <?php echo JText::_('COM_MINIUNIVERSITY_LIB_WELCOME');?> </p>    
     
<!-- get user groups -->
<?php
  $user = JFactory::getUser();
  $usergroup = $user->getAuthorisedGroups();
      
?>

<!-- show warnings -->
<?php foreach($this->warning as $i => $item) {
      $users = JFactory::getUser();
      $usergroups = $users->getAuthorisedGroups();
      if (!$users->guest) {
         $userIds = $users->get( 'id' );
      }

      
         if(strtotime($item->begin_date) <= strtotime(date("Y/m/d")) && strtotime(date("Y/m/d")) <= strtotime($item->end_date)) {
            if($item->place == 2 || $item->place == 7 || $item->place == 8 && in_array($item->usergroups_id, $usergroup) || $item->place == 9 && $item->user_id == $user->id && !$users->guest && !empty($userIds)){
              switch ($item->kind){
                case 0: ?>
                  <p class="bg-success pads">
                  <?php echo "etelaiie : "; echo htmlspecialchars($item->content); ?>
                  <?php break; ?>
                  </p>

                <?php case 1: ?>
                  <p class="bg-success pads">
                  <?php echo "khata : "; echo htmlspecialchars($item->content); ?>
                  </p>
                  <?php break; 

                case 2: ?>
                  <p class="bg-success pads">
                  <?php echo "hoshdar : "; echo htmlspecialchars($item->content); ?>
                  </p>
                  <?php break; 

                default:
                  echo "نوع اطلاعیه مشخص نشده است";
              } 
            } 
          } 
      
}
?>


<!-- SESSIONS -->
<?php 


if (($session->get('emptybook') != null)) {
    echo "<p class='erse bg-danger'><i class='fa fa-bell-slash-o' aria-hidden='true'></i>".JText::_('دسترسی شما غیر مجاز هست. اطلاعات کاربری شما در سیستم ثبت گردیده.' )."</p>";
    }
if (($session->get('successfull') != null)) {
    echo "<p class='erse bg-danger'><i class='fa fa-bell-slash-o' aria-hidden='true'></i>".JText::_('رزرو شما با موفقیت ثبت شد.' )."</p>";
  }
 
if ($session->isActive('successfull')) {
    $session->clear('successfull');
  }
if ($session->isActive('emptybook')) {
    $session->clear('emptybook');
}  
?>

<!-- End Of SESSIONS -->
 
     
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

            <a href="<?php echo JRoute::_('index.php?option=com_miniuniversity&view=lib&catid='.$item->catslug.'&id='.str_replace(" ","-",$item->slug)); ?>">
                
                  <img src="<?php echo htmlspecialchars($item->libspics); ?>" class="img-responsive" alt="<?php echo htmlspecialchars($item->name); ?>">
                <?php } else { ?>
                   <a href="<?php echo JRoute::_('index.php?option=com_miniuniversity&view=lib&catid='.$item->catslug.'&id='.str_replace(" ","-",$item->slug)); ?>">
                   <img src="media/com_miniuniversity/images/no_image.jpg" class="img-responsive" alt="هیچ عکسی نیست">
                <?php } ?>
            </a>
                        <div class="clearfix"></div>
      

                <div class="col-sm-12 pad-shema-lib">
                     <?php 
                     if (isset($this->params['count_resv_libs'])) {                     
                     if ($this->params['count_resv_libs'] == 1) { ?>
                     <i class="fa fa-calculator" aria-hidden="true">
                         <?php 
							$BookResCont = $model->TotalResBook($item->id);
							echo count($BookResCont); 
						 ?>
                     </i>
                     <?php } }?>
                           <button class="toltip" data-balloon-length="medium" data-balloon="<?php echo substr(htmlspecialchars($item->dis),0, 230); ?>" data-balloon-pos="up"><i class="fa fa-info-circle"></i></button>
                           <div class="clearfix"></div>  
                 </div>
                              <div class="clearfix"></div>
                    <a href="<?php echo JRoute::_('index.php?option=com_miniuniversity&view=lib&catid='.$item->catslug.'&id='.str_replace(" ","-",$item->slug)); ?>">
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
</form>

