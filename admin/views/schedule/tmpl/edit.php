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
require_once JPATH_SITE .'/components/com_miniuniversity/helpers/jdf.php';
$app = JFactory::getApplication('site');
$id = $app->input->getInt('id');

$load= $this->getModel('schedule');
$getClass = $load->getClass($id);

$getTeacherClass = $load->getTeacherClass($id);

$getLessons = $load->getLesson($id)[0]; // get lessons of class

//function days() {}

echo '<br>';

$date = date_create();
// date_timestamp_get($date);
//echo $a= '&nbsp&nbsp&nbsp'.jdate("l  j  F  Y",date_timestamp_get($date));
$document 	= JFactory::getDocument(); 
//$document->addScript('https://code.jquery.com/jquery-1.12.4.js');

// Load stylesheet
		$document->addStyleSheet(JURI::root(true).'/administrator/components/com_miniuniversity/css/modal_form.css');
?>

<form action="<?php echo JRoute::_('index.php?option=com_miniuniversity&layout=edit&id=' . (int) $this->item->id); ?>"
    method="post" name="adminForm" id="adminForm" class="form-validate">
	<div class="form-horizontal">
		<div>
			<p id="message1"></p><br>
			<p id="message2"></p><br>
		روز	<p id="day"></p>
			
		نام درس<select id="lesson_id" style="width:120px">
				<option value="null">انتخاب درس</option>
				<?php 
					foreach ($getLessons as $lesson) {
						echo '<option value="'.$lesson->lesson_id.'" onclick='.'getTeachers('.$lesson->class_name.');'.'>'.$lesson->lesson_name.'</option>';
					}
				?>
			</select><br>
			
	نام استاد<div id="tName"> </div><br>
		
	نام بخش<div id="sName"> </div>
			
			<div id="time">
				
				<div id="start_time">
					زمان شروع :
			
					<?php  echo timeM('start'); ?>
					<?php  echo timeH('start'); ?>
				</div>
				
				<div id="end_time">
					زمان پایان:
					<?php  echo timeM('end'); ?>
					<?php  echo timeH('end'); ?>
				</div>
				
			</div><br>
			<input name="add" type="button" value="add" onClick="addData()"> 
		</div>
		<br>
	<?php echo '=====================================================================<br><br>';  ?>
		نام کلاس<?php  echo '  '.$getClass. '<br>';?>
	<?php echo '============<br><br>';  ?>	
		<select id="teach_id">
			<option value="null">یک استاد را انتخاب کنید</option>
			<option value="all"> همه اساتید این کلاس</option>
			<?php 
				foreach ($getTeacherClass as $teach){
					echo '<option value="'.$teach->teacher_id.'">'.$teach->teacher_name.'</option>';		
				}
			?>
		</select>
		<input name="add" type="button" value="show" onClick="ShowData()"> 		<br>
		<?php echo '=====================================================================<br><br>';?><br>
		<div id="sInfo"> </div><br>
		
		
			
	</div>
	<input type="hidden" name="task" value="schedule.edit" />
	<?php echo JHtml::_('form.token'); ?>
	 
</form>
<?php 

function timeM($str){
echo ' دقیقه<select id="'.$str.'timeM" style="width:110px">
<option value="null">انتخاب دقیقه</option>';
	for ($j = 0 ; $j <= 55 ; $j=$j+5  ) {
		if ($j < 10) 
			echo '<option value="0'.$j.'">'.$j.'</option>';
		else
			echo '<option value="'.$j.'">'.$j.'</option>';
	}
echo '</select>';
}


function timeH ($str) {
echo '	ساعت	<select id="'.$str.'timeH" style="width:110px">
<option value="null">انتخاب ساعت</option>';
	for ($m = 1 ; $m <= 24 ; $m++  ) {
		if ($m < 10) 
			echo '<option value="0'.$m.'">'.$m.'</option>';
		else if ($m == 24)
			echo '<option value="00">00</option>';
		else
			echo '<option value="'.$m.'">'.$m.'</option>';
	}
echo '</select>';	
}

?>

<!-- The Modal -==================================================================== -->
<div id="myModal" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
	  
    <div class="modal-header">
      <span class="close">×</span>
      <h2>ویرایش</h2>
    </div>
    
    <div class="modal-body">
		<p id="dayNames"></p>
		<p id="lessonName"></p>
      <div id="sectionName"></div>
		<div id="start_time">
			زمان شروع :
			<p id="timeHS"></p>
			<p id="timeMS"></p>
		</div>
				
		<div id="end_time">
			زمان پایان:
			<p id="timeHE"></p>
			<p id="timeME"></p>
		</div>
		<input type="hidden" id="teacherId" value="">
		<input type="hidden" id="oldData" value="">
		<input type="hidden" id="oldDayName" value="">
      <p><input id="save" type="button" value="save" onClick="save()"> </p> 
    </div>
   
  </div>

</div>


<script>
		JQ = jQuery;
jQuery.noConflict();
var comName = 'com_miniuniversity'; // **esme component khod ra benevisid**
//===========================================================================

function dayss(dayName) {
	switch(dayName) {
		case 'Saturday':
			var dayName2 = "شنبه";
		break;
		case 'Sunday':
			var dayName2 ="یکشنبه";
		break;
		case 'Monday':
			var dayName2 ="دوشنبه";
		break;
		case 'Tuesday':
			var dayName2 ="سه شنبه";
		break;
		case 'Wednesday':
			var dayName2 ="چهارشنبه";
		break;
		case 'Thurusday':
			var dayName2 ="پنج شنبه";
		break;
		case 'Friday':
			var dayName2 ="جمعه";
		break;
	}
	var sat="شنبه";
	var sun="یکشنبه";
	var mon="دوشنبه";
	var tue="سه شنبه";
	var wed="چهارشنبه";
	var thu="پنج شنبه";
	var fri="جمعه";
	
	var days1= '<select id="days" style="width:100px">';
	var days2=		'<option value="null" selected="selected">انتخاب روز</option>';
	var days3=		'<option value="Saturday">'+ sat +'</option>'+
					'<option value="Sunday">'+ sun +'</option>'+
					'<option value="Monday">'+ mon +'</option>'+
					'<option value="Tuesday">'+ tue + '</option>'+
					'<option value="Wednesday">'+ wed +'</option>'+
					'<option value="Thurusday">'+ thu +'</option>'+
					'<option value="Friday">'+ fri +'</option>';
	var days4= '</select>';
	
	if (dayName == undefined) {
		document.getElementById('day').innerHTML = days1 + days2 + days3 + days4;	
	}
	else {
		days =  '<select id="edays" style="width:100px">' + '<option value="'+ dayName +'" selected="selected">'+ dayName2 +'</option>' + days3 + days4;
		document.getElementById('dayNames').innerHTML = days;	
	}	
	
}
dayss();
//==================================================================
function ShowData () {
	
	var teacherId=  document.getElementById('teach_id').value;
	if (teacherId != "null") {
		var classId= '<?php echo $id ; ?>';

		var parent = document.getElementById("sInfo");
		var child = document.getElementById("showInfo");
		if (child != null)
			parent.removeChild(child);
		
		JQ.ajax({
			type: 'POST',
			url: 'index.php?option='+ comName +'&view=schedule',
			data: {
				task: 'schedule.ShowData',
				teacherId: teacherId,
				classId: classId
			},
			success: function(data) {
						JQ("#sInfo").html(data);
			},
			error: function(data) {
				alert('error');
			}

		}); 
	}
	else {
		alert('یک استاد را انتخاب کنید');
	}
}

//===========================================================================
function getTeachers (className) {
	var lessonId = document.getElementById('lesson_id').value;

	var parent = document.getElementById("tName");
	var child = document.getElementById("cTeacher");
	if (child != null)
		parent.removeChild(child);
	
	JQ.ajax({
		type: 'POST',
		url: 'index.php?option='+ comName +'&view=schedule',
		data: {
			task: 'schedule.getTeachers',
			lessonId: lessonId,
			className: className
		},
		success: function(data) {
					JQ("#tName").html(data);
		},
		error: function(data) {
			alert('error');
		}

	}); 

}
//===============================================================
function getSection (lessonId , teacherId , sectionId, sectionName) {
	
	if (lessonId == 'null' && teacherId == 'null' && sectionId == 'null' && sectionName == 'null') {
		var checkLid = null;
		var checkTid = null;
		var lessonId=  document.getElementById('lesson_id').value;
		var teacherId=  document.getElementById('teacher_name').value;
		var parent = document.getElementById("sName"); 
		var child = document.getElementById("cSection");
	}
	else { 
		var checkLid = 'not null';
		var checkTid = 'not null';
		var parent = document.getElementById("sectionName");
		var child = document.getElementById("cSection");
	}
	
	if (parent != null && child != null){
		parent.removeChild(child);
	}
	
	JQ.ajax({
		type: 'POST',
		url: 'index.php?option='+ comName +'&view=schedule',
		data: {
			task: 'schedule.getSections',
			lessonId: lessonId,
			teacherId: teacherId,
			sectionId: sectionId,
			sectionName: sectionName
		},
		success: function(data) {
			if (checkLid == null && checkTid == null)
				JQ("#sName").html(data);
			else 
				JQ("#sectionName").html(data);
		},
		error: function(data) {
			alert('error');
		}

	}); 
	
	
}

//===================================================================
function addData() {
	var classId = '<?php echo $id ; ?>';
	//-------------------------------------------------------------
	var days=  document.getElementById('days').value;
	var m = "";
	if (days == 'null') {
		m += 'روز نمی تواند خالی باشد'+'<br>';
		var action = false ;
	}
	//-------------------------------------------------------------
	var lessonId=  document.getElementById('lesson_id').value;
	if (lessonId == 'null'){
		if (days == 'null')
			m += 'نام درس نمی تواند خالی باشد'+'<br>';
		else 
			m = 'نام درس نمی تواند خالی باشد'+'<br>';
			
		var action = false ;
	}
	//-------------------------------------------------------------
	var teacherId=  document.getElementById('teacher_name');
	if (teacherId == null || teacherId.value == "null"){
		if (lessonId == 'null')
			m += 'نام استاد نمی تواند خالی باشد'+'<br>';
		else if (days == "null")
			m += 'نام استاد نمی تواند خالی باشد'+'<br>';
		else 
			m = 'نام استاد نمی تواند خالی باشد'+'<br>';
			
		var action = false ;
	}
	else {
		teacherId = teacherId.value;
	}
	//-------------------------------------------------------------
	var sectionId=  document.getElementById('section_name');
	if (sectionId == null){
		if (teacherId != null)
			m += 'نام بخش نمی تواند خالی باشد'+'<br>';
		else 
			m += 'نام بخش نمی تواند خالی باشد'+'<br>';
			
		var action = false ;
	}
	else {
		sectionId = sectionId.value;
	}
	
	
	//-------------------------------------------------------------
	var startTimeM=  document.getElementById('starttimeM').value;
	var startTimeH=  document.getElementById('starttimeH').value;
	
	var endTimeM=  document.getElementById('endtimeM').value;
	var endTimeH=  document.getElementById('endtimeH').value;
	
	var timStart = startTimeH + startTimeM;
	if (timStart == "nullnull") {
		var t = 'زمان شروع نمی تواند خالی باشد'+'<br>';
		var action = false ;
	}

	var timEnd = endTimeH + endTimeM;
	if (timEnd == "nullnull") {
		if (timStart == "nullnull") 
			t += 'زمان پایان نمی تواند خالی باشد'+'<br>';
		else 
			t = 'زمان پایان نمی تواند خالی باشد';
		var action = false ;
	}
	
	var scheduleTime = timStart+'_'+timEnd;
	//-------------------------------------------------------------
	
if (m != null ) {
	JQ("#message1").html(m);
}
else {
	JQ("#message1").html('');
}

if (t != null ) {
	JQ("#message2").html(t);
}
else if (timEnd < timStart){
	JQ("#message2").html('زمان شروع نمی تواند جلوتر از زمان پایان باشد');
	var action = false ;
}
else {
	JQ("#message2").html("");
}

if (action != false) {
	JQ.ajax({
		type: 'POST',
		url: 'index.php?option='+ comName +'&view=schedule',
		data: {
			task: 'schedule.addData',
			days: days,
			teacherId: teacherId,
			sectionId: sectionId,
			lessonId: lessonId,
			scheduleTime: scheduleTime,
			classId: classId
		},
		success: function(data) {
					JQ("#message1").html('یک رکورد به استاد مورد نظر اضافه شد');
					
		},
		error: function(data) {
			alert('error');
		}

	}); 
}
	
	
}
//============================================================================================
function delData(classId , teacherId, dayName, dataInfo) {
	var x = confirm('are you sure?');
	//-------------------------------------------------------------
	if (x) {
		JQ.ajax({
			type: 'POST',
			url: 'index.php?option='+ comName +'&view=schedule',
			data: {
				task: 'schedule.delData',
				classId: classId,
				teacherId: teacherId,
				dayName: dayName,
				dataInfo: dataInfo
			},
			success: function(data) {
						ShowData();
			},
			error: function(data) {
				alert('error');
			}

		}); 
	}
}
//=============================================================================================
function editData(teacherId, dayName, lessonId, lessonName, sectionId, sectionName, timeStart, timeEnd) {

	getSection(lessonId , teacherId , sectionId, sectionName);
	
	var modal = document.getElementById('myModal');
	var span = document.getElementsByClassName("close")[0];
	var a= JQ('.lesson_Name').length;
	
	while (a > 0){
		if (a > 0){
			document.getElementById("lesson_Name").remove();
		}
		a--;
	}
	var b= JQ('.lesson_Name').length;
	if (b == 0 )
		modal.style.display = "block";
	
	//---------------------------------
	var timeS = timeStart.split(":"); 
	var timeE = timeEnd.split(":"); 
	
	document.getElementById("timeHS").innerHTML = timeH('S',timeS[0]);
	document.getElementById("timeMS").innerHTML = timeM('S',timeS[1]);
	
	document.getElementById("timeHE").innerHTML = timeH('E',timeE[0]);
	document.getElementById("timeME").innerHTML = timeM('E',timeE[1]);
	//--------------------------------------------------
	dayss(dayName);
	//--------------------------------------------------
	
	document.getElementById('teacherId').value = teacherId; // set teacher id for update
	
	//==================
	oldData = sectionId + '*' + lessonId  + '-' + timeS[0]+ timeS[1] +'_' + timeE[0] + timeE[1];
	document.getElementById('oldData').value = oldData; 
	document.getElementById('oldDayName').value = dayName; 
	//==================
	

	// When the user clicks on <span> (x), close the modal
	span.onclick = function() {
		modal.style.display = "none";
	}

	

	//-------------------------------------------------------------
	JQ.ajax({
		type: 'POST',
		url: 'index.php?option='+ comName +'&view=schedule',
		data: {
			task: 'schedule.getLesson',
			classId: <?php echo $id; ?>,
			teacherId: teacherId,
			lessonId: lessonId,
			sectionId: sectionId,
			sectionName: sectionName
				
		},
		success: function(data) {
			JQ("#lessonName").after(data);	
		},
		error: function(data) {
			alert('error');
		}
	}); 
	//-------------------------------------------------------------
}
//==========================================================================================
function save(){
	var teacherId =		document.getElementById('teacherId').value;
	var dayNames =		document.getElementById('edays').value;
	var lessonID = 	document.getElementById('lesson_Name').value;
	var sectionID =	document.getElementById('section_name').value;
	var modal = document.getElementById('myModal');
		
		//start_time
	var timeHS = 	document.getElementById('StimeH').value;
	var timeMS=	document.getElementById('StimeM').value;
	var timeStart = timeHS + timeMS ;
		//end_time
	var timeHE =	document.getElementById('EtimeH').value;
	var timeME=	document.getElementById('EtimeM').value;
	var timeEnd = timeHE + timeME ;
	//-------------------------------------------
	var oldDayName = document.getElementById('oldDayName').value;
	
	var oldData = document.getElementById('oldData').value;
	var newData = sectionID + '*' + lessonID + '-' + timeStart + '_' + timeEnd ;
	
	if (teacherId != 'null' && dayNames != 'null' && lessonID !='null' && sectionID !='null' &&  timeStart != 'null' && timeEnd != 'null') {
		if (timeEnd > timeStart){
			if (dayNames != oldDayName || newData != oldData) {
			
				JQ.ajax({
					type: 'POST',
					url: 'index.php?option='+ comName +'&view=schedule',
					data: {
						task: 'schedule.saveData',
						classId: <?php echo $id; ?>,
						teacherId: teacherId,
						dayNames: dayNames,
						oldDayName: oldDayName,
						oldData: oldData,
						newData: newData
					},
					success: function(data) {
						ShowData();
					},
					error: function(data) {
						alert('error');
					}
				}); 
				
				modal.style.display = "none"; // close form
			}
		}
		else {
			alert('زمان شروع نمی تواند جلوتر از زمان پایان باشد');
		}
	}
	
	
	
	
}
//==========================================================================================
function timeM(str,tmin = null){
	var str =  ' دقیقه<select id="' + str +'timeM" style="width:110px">';
	
	if (tmin != null) 
		str += '<option value="' + tmin +'" selected="selected">'+ tmin +'</option>';
	else
		str += '<option value="null">انتخاب دقیقه</option>';
	
	for (var j = 0 ; j <= 55 ; j=j+5  ) {
		if (j < 10) 
			str += '<option value="0' + j +'">'+ j +'</option>';
		else
			str += '<option value="'+ j +'">'+ j +'</option>';
	}

str += '</select>';

return str;
}
//-------------------------------------------------------------------------------------
function timeH(str,thour = null){
	var str =  ' ساعت<select id="' + str +'timeH" style="width:110px">';
	if (thour != null) 
		str += '<option value="' + thour +'" selected="selected">'+ thour +'</option>';
	else
		str +='<option value="null">انتخاب ساعت</option>';
	
	for (var m = 1 ; m <= 24 ; m = m+1  ) {
		if (m < 10) 
			str += '<option value="0'+ m +'">'+ m +'</option>';
		else if (m == 24)
			str += '<option value="00">00</option>';
		else
			str += '<option value="'+ m +'">'+ m +'</option>';
	}

str += '</select>';

return str;
}

//=============================================================================

</script>



