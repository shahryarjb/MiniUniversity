<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_miniuniversity
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

// No direct access
defined('_JEXEC') or die('Restricted access');
JHtml::_('behavior.formvalidation');

$app = JFactory::getApplication('site');
$id = $app->input->getInt('id');
$load= $this->getModel('class');
$teacherName = $load->getTeacherName();
if (isset($id)){
	$class = $load->getClass($id)[0];
	$notTeacherName = $load->getTeacherName2($class->teacher_id);
	$getTeacherLesson2= $load->getTeacherLesson2($class->teacher_id,$class->lesson_id);
}
$comName = "com_miniuniversity"; // *********esme component khod ra benevisid***********
$viewName = "class";

?>
<script> 
//===============================================
function board_message(){
	document.getElementById('boardMessage').innerHTML ="";
	<?php if (createMessage() != null){ ?>
	document.getElementById('boardMessage').innerHTML = '<?php echo JText::_(strtoupper($comName).'_MESSAGE5_BOARD'); ?>'+ '  ' + 
	'<?php echo createMessage(); ?>' + '  ' +'<?php echo JText::_(strtoupper($comName).'_MESSAGE6_BOARD'); ?>' ;	
	document.getElementById('boardMessage').style.color  = "green";
	<?php } ?>
}
//===============================================
</script>
<div id="boardMessage"><script>board_message();</script></div>
<form action="<?php echo JRoute::_('index.php?option=com_miniuniversity&layout=edit&id=' . (int) $this->item->id); ?>"
    method="post" name="adminForm" id="adminForm" class="form-validate">
	<div class="form-horizontal">
<?php if (!isset($id) or $id == 0) {?>		
نام کلاس<input name="class_name" id="class_name" type="text" value=""/><p id="msgName1"></p><br>
نام استاد <select id="teacher_name" size="1"> 
			<option value=""><?php echo 'نام استاد را انتخاب کنید'; ?></option>
			<?php foreach($teacherName  as $tn) {?>
				<option value="<?php echo $tn->id; ?>" onClick="showLesson()"><?php echo $tn->name; ?></option>
			<?php } ?>
		</select><p id="msgName2"></p><br>
نام درس  <div id="lesson"></div><p id="msgName3"> <br>
	<input type="button" name="save" class="save" value="<?php echo JText::_(strtoupper($comName.'_'.$viewName).'_SAVE_BUTTON'); ?>" onClick="Validation('save','<?php echo 0; ?>')">
	
<?php } //=================================================================================================================================
	else {?>
	نام کلاس<input name="class_name" id="class_name" type="text" value="<?php echo $class->class_name;?>"/><p id="msgName1"></p><br>
	 استاد <select id="teacher_name" size="1"> 
			<option value="<?php echo $class->teacher_id; ?>" selected="select"><?php echo $class->techer_name; ?></option>
			<?php foreach($notTeacherName  as $tn) {?>
				<option value="<?php echo $tn->id; ?>" onClick="showLesson()"><?php echo $tn->name; ?></option>
			<?php } ?>
		</select><p id="msgName2"></p><br>
		نام درس	<div id="lesson"></div> 
			<div id="father"><p id="son">
			<select id="lesson_name" size="1"> 
			<option value="<?php echo $class->lesson_id; ?>" selected="select"><?php echo $class->lesson_name; ?></option>
			<?php foreach($getTeacherLesson2  as $tn) {?>
				<option value="<?php echo $tn->id; ?>" ><?php echo $tn->name; ?></option>
			<?php } ?>
			</select>
			</p></div>
			<p id="msgName3"> <br>

	<input type="button" name="update" class="update" value="<?php echo JText::_(strtoupper($comName.'_'.$viewName).'_UPDATE_BUTTON'); ?>" onClick="Validation('update','<?php echo $id; ?>')">
<?php } ?>
  <div id="father"><p id="son"></p></div>
	</div>
	<input type="hidden" name="task" value="class.edit" />
	<?php echo JHtml::_('form.token'); ?>
</form>
<script>
	JQ = jQuery;
jQuery.noConflict();	
var comName = 'com_miniuniversity'; // **esme component khod ra benevisid**

JQ('.father').hide();
//====================================================================== 	
function showLesson() {

	var parent = document.getElementById("father");
	var child = document.getElementById("son");

	parent.removeChild(child);
	
	var techId = document.getElementById('teacher_name').value;
	
	JQ.ajax({
			type: 'POST',
			url: 'index.php?option='+ comName +'&view=class',
			data: {
				task: 'class.getLessons',
				techid: techId
			},
			success: function(data) {
				JQ("#lesson").after(data);
			},
			error: function(data) {
				alert('error');
			}
			
		}); 	
}
//=================================== save

 function sendData (className,teacherName,lessonName,status,pageId) {	
		JQ.ajax({
			type: 'POST',
			url: 'index.php?option='+ comName +'&view=class',
			data: {
				task: 'class.classSave',
				className: className,
				teacherName: teacherName,
				lessonName: lessonName,
				status: status,
				pageId: pageId
			},
			success: function(data) {
				if (status == "save"){
						window.location="index.php?option="+ comName +"&view=class&layout=edit&id="+data +"&mpage=sa";
						//alert(data);
				}
				else if (status == "update"){
					window.location="index.php?option="+ comName +"&view=class&layout=edit&id="+pageId +"&mpage=up";	
				}
			},
			error: function(data) {
				alert('error');
			}
			
		}); 

}
//=============================
//=====================================================================
function backToMain (dest) {
	window.location="index.php?option="+ comName +"&view=" + dest;	
}

//====================================================================
function Validation(status,pageId) {
	var errCounter = [];
	var className = document.getElementById('class_name').value;
	var teacherName = document.getElementById("teacher_name").value;
	var lessonName = document.getElementById("lesson_name").value;
	
	if (className == "" ){	
			document.getElementById('msgName1').innerHTML = 'this box is empty';
			document.getElementById('msgName1').style.color  = "red";
			errCounter.push(className);
	}
	else if (teacherName == "") {
		document.getElementById('msgName2').innerHTML = 'this box is empty';
		document.getElementById('msgName2').style.color  = "red";
		errCounter.push(teacherName);
	}
	else if (lessonName == "") {
		document.getElementById('msgName3').innerHTML = 'this box is empty';
		document.getElementById('msgName3').style.color  = "red";
		errCounter.push(lessonName);
	}
	else {
		document.getElementById('msgName1').innerHTML = "";
		document.getElementById('msgName2').innerHTML = "";
		document.getElementById('msgName3').innerHTML = "";
	}
	
	if(errCounter.length == 0 ){
		sendData (className,teacherName,lessonName,status,pageId);
	}
	
}
</script>


<?php
function createMessage(){
	$app 	= JFactory::getApplication();
	$myid = $app->input->getVar('mpage');
	if (!isset($myid)){
		$myid = null;
	}
	else if($myid == "re")
		$myid = "remove";
	else if($myid == "sa")
		$myid = "save";	
	else if($myid == "up")
		$myid = "up";
		
	return $myid;
}
?>
