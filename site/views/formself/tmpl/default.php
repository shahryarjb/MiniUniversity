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
if (($session->get('successfull') != null)) {
        echo JText::_('رزرو شما با موفقیت ثبت شد !' )."</p>";
} 
if (($session->get('empty_field') != null)) {
        echo JText::_('همه فیلدها را پر نکرده اید !' )."</p>";
}  
if (($session->get('stunum') != null)) {
        echo JText::_('لطفا از حروف در شماره دانشجویی استفاده نکنید !' )."</p>";
}
if (($session->get('badchar_name') != null)) {
        echo JText::_('لطفا از کاراکترهای درست برای وارد کردن نام استفاده کنید !' )."</p>";
} 
if (($session->get('badchar_family') != null)) {
        echo JText::_('لطفا از کاراکترهای درست برای وارد کردن نام خانوادگی استفاده کنید !' )."</p>";
} 
if (($session->get('past_date') != null)) {
        echo JText::_('نمیتوانید تاریخ قبل از امروز را انتخاب کنید !' )."</p>";
}
if (($session->get('past_date_re') != null)) {
        echo JText::_('نمیتوانید تاریخ قبل از امروز را انتخاب کنید !' )."</p>";
}
if (($session->get('end_date') != null)) {
        echo JText::_('نمیتوانید بیش از ۵ روز انتخاب کنید !' )."</p>";
}    
?>    


    
<h2>فرم سلف</h2>
<form class="form-validate" action="<?php echo JRoute::_('index.php'); ?>" method="post" id="formself" name="formself">
    <fieldset>
        <dl>
     
            <dt><?php echo $this->form->getLabel('stu_num'); ?></dt>
            <dd><?php echo $this->form->getInput('stu_num'); ?></dd>
            <dt></dt><dd></dd>   
        
            <dt><?php echo $this->form->getLabel('name'); ?></dt>
            <dd><?php echo $this->form->getInput('name'); ?></dd>
            <dt></dt><dd></dd>       
            
            <dt><?php echo $this->form->getLabel('family'); ?></dt>
            <dd><?php echo $this->form->getInput('family'); ?></dd>
            <dt></dt><dd></dd>
            
            <div class="bg-success pads"><?php echo"حداکثر زمان رزرو ژتون ۵ روز می باشد."; ?></div>

     
          <dt><?php echo $this->form->getLabel('first_day'); ?></dt>
            <dd><?php echo $this->form->getInput('first_day'); ?></dd>
            <dt></dt><dd></dd>
            
            <dt><?php echo $this->form->getLabel('last_day'); ?></dt>
            <dd><?php echo $this->form->getInput('last_day'); ?></dd>
            <dt></dt><dd></dd>
            
            
            <dt><?php echo $this->form->getLabel('paid'); ?></dt>
            <dd><?php echo $this->form->getInput('paid'); ?></dd>
            <dt></dt><dd></dd>
            
            <dt><?php echo $this->form->getLabel('tracking_num'); ?></dt>
            <dd><?php echo $this->form->getInput('tracking_num'); ?></dd>
            <dt></dt><dd></dd>
            
            <dt><?php echo $this->form->getLabel('ip'); ?></dt>
            <dd><?php echo $this->form->getInput('ip'); ?></dd>
            <dt></dt><dd></dd>
            
            <?php $ip = rand(1, 100);
             ?>
            <dt><input type="hidden" name="random_num" value=""/></dt>
            <dt></dt><dd></dd>
            
           
            <!-- get the book id from url  -->
           
            
            <dt></dt>
            
            <dd><input type="hidden" name="option" value="com_miniuniversity" />
                <input type="hidden" name="task" value="formself.submit" />
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
if ($session->isActive('past_date')) {
        $session->clear('past_date');
}
if ($session->isActive('past_date_re')) {
        $session->clear('past_date_re');
}
if ($session->isActive('end_date')) {
        $session->clear('end_date');
}
if ($session->isActive('empty_field')) {
        $session->clear('empty_field');
}
if ($session->isActive('badchar_name')) {
        $session->clear('badchar_name');
}
if ($session->isActive('badchar_family')) {
        $session->clear('badchar_family');
}
if ($session->isActive('stunum')) {
        $session->clear('stunum');
}
if ($session->isActive('successfull')) {
        $session->clear('successfull');
}
?>