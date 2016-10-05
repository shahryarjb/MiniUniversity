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
$load= $this->getModel('section');
$lessonName = $load->getLessonesName();

if (isset($id)){
	$section = $load->getSection($id)[0];
	$notLessonName = $load->getLessonesName2($section->lesson_id);
	$getTeacherClass2= $load->getTeacherClass2($section->lesson_id,$section->teacher_id);
}

$comName = "com_miniuniversity"; // *********esme component khod ra benevisid***********
$viewName = "section";

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
 نام بخش<input name="section_name" id="section_name" type="text" value=""/><p id="msgName1"></p><br>
نام درس <select id="lesson_name" size="1"> 
			<option value=""><?php echo 'نام درس را انتخاب کنید'; ?></option>
			<?php foreach($lessonName  as $tn) {?>
				<option value="<?php echo $tn->lesson_id; ?>" onClick="showTeacher()"><?php echo $tn->lesson_name; ?></option>
			<?php } ?>
		</select><p id="msgName2"></p><br>
نام استاد <div id="teachers"></div><p id="msgName3"> <br>
	<input type="button" name="save" class="save" value="<?php echo JText::_(strtoupper($comName.'_'.$viewName).'_SAVE_BUTTON'); ?>" onClick="Validation('save','<?php echo 0; ?>')">
	
<?php } //=================================================================================================================================
	else {?>
	 نام بخش<input name="section_name" id="section_name" type="text" value="<?php echo $section->section_name;?>"/><p id="msgName1"></p><br>
	 نام درس <select id="lesson_name" size="1"> 
			<option value="<?php echo $section->lesson_id; ?>" onClick="showTeacher()" selected="select"><?php echo $section->lesson_name; ?></option>
			<?php foreach($notLessonName  as $tn) {?>
				<option value="<?php echo $tn->lesson_id; ?>" onClick="showTeacher()"><?php echo $tn->lesson_name; ?></option>
			<?php } ?>
		</select><p id="msgName2"></p><br>
	نام  استاد	<div id="teachers"></div> 
			<div id="father"><p id="son">
			<select id="teacher_name" size="1"> 
			<option value="<?php echo $section->teacher_id; ?>" selected="select"><?php echo $section->teacher_name; ?></option>
			<?php foreach($getTeacherClass2  as $tn) {?>
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
function showTeacher() {

	var parent = document.getElementById("father");
	var child = document.getElementById("son");
	parent.removeChild(child);
	
	var lessonId = document.getElementById('lesson_name').value;
	
	//alert(classId); ok
	
	JQ.ajax({
			type: 'POST',
			url: 'index.php?option='+ comName +'&view=section',
			data: {
				task: 'section.getTeachers',
				lessonid: lessonId
			},
			success: function(data) {
				JQ("#teachers").after(data);
			},
			error: function(data) {
				alert('error');
			}
			
		}); 
		
	
}
//=================================== save

 function sendData (sectionName,lessonName,teacherName,status,pageId) {	
		JQ.ajax({
			type: 'POST',
			url: 'index.php?option='+ comName +'&view=section',
			data: {
				task: 'section.sectionSave',
				sectionName: sectionName,
				lessonId: lessonName,
				teacherName: teacherName,
				status: status,
				pageId: pageId
			},
			success: function(data) {
				if (status == "save"){
						window.location="index.php?option="+ comName +"&view=section&layout=edit&id="+data +"&mpage=sa";
				}
				else if (status == "update"){
					window.location="index.php?option="+ comName +"&view=section&layout=edit&id="+pageId +"&mpage=up";	
				}
			},
			error: function(data) {
				alert('error');
			}
			
		}); 

}
//=====================================================================
function backToMain (dest) {
	window.location="index.php?option="+ comName +"&view=" + dest;	
}

//====================================================================
function Validation(status,pageId) {
	var errCounter = [];
	var sectionName = document.getElementById('section_name').value;
	var lessonName = document.getElementById("lesson_name").value;
	var teacherName = document.getElementById("teacher_name").value;
	
	if (sectionName == "" ){	
			document.getElementById('msgName1').innerHTML = 'this box is empty';
			document.getElementById('msgName1').style.color  = "red";
			errCounter.push(sectionName);
	}
	else if (lessonName == "") {
		document.getElementById('msgName2').innerHTML = 'this box is empty';
		document.getElementById('msgName2').style.color  = "red";
		errCounter.push(lessonName);
	}
	else if (teacherName == "") {
		document.getElementById('msgName3').innerHTML = 'this box is empty';
		document.getElementById('msgName3').style.color  = "red";
		errCounter.push(teacherName);
	}
	else {
		document.getElementById('msgName1').innerHTML = "";
		document.getElementById('msgName2').innerHTML = "";
		document.getElementById('msgName3').innerHTML = "";
	}
	
	if(errCounter.length == 0 ){
		sendData (sectionName,lessonName,teacherName,status,pageId);
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
