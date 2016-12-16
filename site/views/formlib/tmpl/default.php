<?php
// no direct access to this file
defined('_JEXEC') or die('Restricted access');

JHtml::_('behavior.keepalive');
JHtml::_('behavior.formvalidation');
JHtml::_('behavior.tooltip');
JHtml::stylesheet(JURI::root().'components/com_miniuniversity/css/style.css');

?>




                 
<?php 
$session = JFactory::getSession();

$app = JFactory::getApplication('site');
$resv = $app->input->getInt('resv'); 
if(!empty($resv)){
    
  
    if (($session->get('searchbadnch') != null)) {
        echo JText::_('لطفا از کاراکتر های مجاز برای نام استفاده کنید !!' )."</p>";
    }

    if (($session->get('searchbadfch') != null)) {
        echo JText::_('لطفا از کاراکتر های مجاز برای نام خانوادگی استفاده کنید !!' )."</p>";
    }

    if (($session->get('stunum') != null)) {
        echo JText::_('لطفا از حروف در شماره دانشجویی استفاده نکنید !' )."</p>";
    } 
        
    if (($session->get('date') != null)) {
        echo JText::_('بیش از ۱۰ روز انتخاب کردید.' )."</p>";
    }
    
     if (($session->get('past_date') != null)) {
        echo JText::_('نمی توانید تاریخ رزرو را قبل از تاریخ امروز انتخاب کنید !' )."</p>";
    }
    
   if (($session->get('past_date_re') != null)) {
        echo JText::_('نمی توانید تاریخ بازگردانی را قبل از تاریخ امروز انتخاب کنید !' )."</p>";
    }

    if (($session->get('emptyfield') != null)) {
        echo JText::_('تمام فیلدها را پر نکرده اید !' )."</p>";
    }
    
    
    
?>
    
<h2>فرم رزرو</h2>
<form class="form-validate" action="<?php echo JRoute::_('index.php'); ?>" method="post" id="formlib" name="formlib">
    <fieldset>
        <dl>
     
            <dd><input type="hidden" name="resv" value="<?php echo $resv; ?>"/>     
        
            <dt><?php echo $this->form->getLabel('name'); ?></dt>
            <dd><?php echo $this->form->getInput('name'); ?></dd>
            <dt></dt><dd></dd>       
            
            <dt><?php echo $this->form->getLabel('family'); ?></dt>
            <dd><?php echo $this->form->getInput('family'); ?></dd>
            <dt></dt><dd></dd>
            
            <dt><?php echo $this->form->getLabel('last_transferee'); ?></dt>
            <dd><?php echo $this->form->getInput('last_transferee'); ?></dd>
            <dt></dt><dd></dd>
            
            <div class="bg-success pads"><?php echo"حداکثر زمان رزرو یک کتاب ۱۰ روز می باشد."; ?></div>
            
            <dt><?php echo $this->form->getLabel('res_date'); ?></dt>
            <dd><?php echo $this->form->getInput('res_date'); ?></dd>
            <dt></dt><dd></dd>
            
            <dt><?php echo $this->form->getLabel('return_date'); ?></dt>
            <dd><?php echo $this->form->getInput('return_date'); ?></dd>
            <dt></dt><dd></dd>
            
            <!-- get the book id from url  -->
           
            
            <dt></dt>
            
            <dd><input type="hidden" name="option" value="com_miniuniversity" />
                <input type="hidden" name="task" value="formlib.submit" />
            </dd>
            <dt></dt>
            <dd><button type="submit" class="button"><?php echo JText::_('submit'); ?></button>
                <?php echo JHtml::_('form.token'); ?>
            <dd>

          
             
      </dl>
   </fieldset>
</form>
<div class="clr"></div> 
<?php

} else if (($session->get('date') != null) || ($session->get('past_date') != null) || ($session->get('stunum') != null) || ($session->get('searchbadfch') != null) || ($session->get('searchbadnch') != null) || ($session->get('emptyfield') != null) || ($session->get('past_date_re') != null)) {
       // header('Location: ' . $_SERVER['HTTP_REFERER']);
       // exit;
        $app = JFactory::getApplication(); 
        $link = $_SERVER['HTTP_REFERER']; 
        $msg = 'به صفحه فرم بازگشتید ! احتمال خطا در ارسال فرم شما وجود دارد !'; 
        $app->redirect($link, $msg, $msgType='message');

 } else {
    $link = "index.php?option=com_miniuniversity&view=libs"; 
    $msg = 'به صفحه کتابخانه بازگشتید !'; 
    $app->redirect($link, $msg, $msgType='message');	
} 


//-----------------------------------clear sessions

if ($session->isActive('date')) {
        $session->clear('date');
}  
if ($session->isActive('stunum')) {
        $session->clear('stunum');
}
if ($session->isActive('searchbadfch')) {
        $session->clear('searchbadfch');
}
if ($session->isActive('searchbadnch')) {
        $session->clear('searchbadnch');
}
if ($session->isActive('emptyfield')) {
        $session->clear('emptyfield');
}
if ($session->isActive('past_date')) {
        $session->clear('past_date');
}
if ($session->isActive('past_date_re')) {
        $session->clear('past_date_re');
}
?>
         