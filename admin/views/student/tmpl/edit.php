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
	
//require_once JPATH_SITE .'/components/com_miniuniversity/helpers/jdf.php';
$app = JFactory::getApplication('site');
$id = $app->input->getInt('id');

$load= $this->getModel('student');
$loadData = $load->loadData($id)[0];
$getLesson = $load->getLesson(); // gereftan dars ha
$getTerm = $load->getTerm(); // gereftan term ha

$document 	= JFactory::getDocument();
// Load stylesheet
	$document->addStyleSheet(JURI::root(true).'/administrator/components/com_miniuniversity/css/modal_form.css');
	
	//======================================================================================================================= for uploader
	//$document->addStyleSheet('//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css'); // Bootstrap styles
	$document->addStyleSheet(JURI::root(true).'/administrator/components/com_miniuniversity/css/style.css'); // Generic page styles
	$document->addStyleSheet('//blueimp.github.io/Gallery/css/blueimp-gallery.min.css'); // blueimp Gallery styles
	// CSS to style the file input field as button and adjust the Bootstrap progress bars
	$document->addStyleSheet(JURI::root(true).'/administrator/components/com_miniuniversity/css/jquery.fileupload.css'); 
	$document->addStyleSheet(JURI::root(true).'/administrator/components/com_miniuniversity/css/jquery.fileupload-ui.css'); 
	
// Joomla doesn't autoload JFile and JFolder
//JLoader::register('JFile', JPATH_LIBRARIES . '/joomla/filesystem/file.php');
//JLoader::register('JFolder', JPATH_LIBRARIES . '/joomla/filesystem/folder.php');

?>
<div id="output"> </div>

<form action="<?php echo JRoute::_('index.php?option=com_miniuniversity&layout=edit&id=' . (int) $this->item->id); ?>"
    method="post" name="adminForm" id="adminForm" class="form-validate">
	<div class="form-horizontal">
		 نام دانشجو<input id="st_name" type="text" value="<?php if (isset($loadData)) echo $loadData->name; ?>"> <br>
	نوع کاربر<input id="st_type" type="text" value="<?php if (isset($loadData)) echo $loadData->user_name; ?>"> <br>
	
	شماره دانشجویی<input id="st_id" type="text" value="<?php if (isset($loadData)) echo $loadData->student_id; ?>"> <br>
		ترم تحصیلی <?php
		
		if (isset($getTerm)) {
			$out = '<select id="termName">';
			foreach($getTerm as $t) {
				if ($loadData->term == $t->term_id )
					$out .= '<option value="'.$t->term_id.'" onClick="getTeachers(\''.$t->term_id.'\')" selected="selected">'.$t->term_name.'</option>';
				else 
					$out .= '<option value="'.$t->term_id.'" onClick="getTeachers(\''.$t->term_id.'\')">'.$t->term_name.'</option>';
			}
			$out .= '</select>';
			echo $out;
		}
		?> <br>
	
	<div ><?php 
	/*
				echo '<select id="lessonName">';
				foreach($getLesson as $lessons) {
						echo '<option value="'.$lessons->lesson_id.'" onClick="getTeachers(\''.$lessons->lesson_id.'\')">'.$lessons->lesson_name.'</option>';
					}
				echo '</select>';
		*/	 ?> 
	</div>
	نام استاد<div id="teacherName"></div>
	نام درس<div id="lessonsName"></div>
	نام بخش<div id="sectionName"></div>
			<input name="add" type="button" value="add" onClick="addData()"> 
	<p id="lesson"></p> <br><br>
	
	ایمیل<input id="st_email" type="text" value="<?php if (isset($loadData)) echo $loadData->email; ?>"> <br>
	شماره تماس<input id="st_phone" type="text" value="<?php if (isset($loadData)) echo $loadData->phone; ?>"> <br>
	
		
	</div>
	<input type="hidden" name="task" value="student.edit" />
	<?php echo JHtml::_('form.token'); ?>
	 
</form>
<!-- The Modal -==================================================================== -->
<div id="myModal" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
	  
    <div class="modal-header">
      <span class="close">×</span>
      <h2>ویرایش</h2>
    </div>
    
    <div class="modal-body">
		<div ><?php 
				echo '<select id="lessonName">';
				foreach($getLesson as $lessons) {
						echo '<option value="'.$lessons->lesson_id.'" onClick="getTeachers(\''.$lessons->lesson_id.'\')">'.$lessons->lesson_name.'</option>';
					}
				echo '</select>';
			?> </div>
		<div id="teacherName"> </div>
		<div id="sectionName"> </div>

		<input type="hidden" id="id" value="">
		<input type="hidden" id="student_id" value="">
		<input type="hidden" id="term" value="">
		<input type="hidden" id="lessons" value="">
      <p><input id="save" type="button" value="save" onClick="save()"> </p> 
    </div>
   
  </div>

</div>
<?php //==============================================================================================================================?>
	<?php //==============================================================================================================================?>
	
    <!-- The file upload form used as target for the file upload widget -->
    <form id="fileupload" action="//jquery-file-upload.appspot.com/" method="POST" enctype="multipart/form-data">
        <!-- Redirect browsers with JavaScript disabled to the origin page -->
        <noscript><input type="hidden" name="redirect" value="https://blueimp.github.io/jQuery-File-Upload/"></noscript>
        <!-- The fileupload-buttonbar contains buttons to add/delete files and start/cancel the upload -->
        <div class="row fileupload-buttonbar">
            <div class="col-lg-7">
                <!-- The fileinput-button span is used to style the file input field as button -->
                <span class="btn btn-success fileinput-button">
                    <i class="glyphicon glyphicon-plus"></i>
                    <span>Add files...</span>
                    <input type="file" name="files[]" multiple>
                </span>
                <button type="submit" class="btn btn-primary start">
                    <i class="glyphicon glyphicon-upload"></i>
                    <span>Start upload</span>
                </button>
                <button type="reset" class="btn btn-warning cancel">
                    <i class="glyphicon glyphicon-ban-circle"></i>
                    <span>Cancel upload</span>
                </button>
                <button type="button" class="btn btn-danger delete">
                    <i class="glyphicon glyphicon-trash"></i>
                    <span>Delete</span>
                </button>
                <input type="checkbox" class="toggle">
                <!-- The global file processing state -->
                <span class="fileupload-process"></span>
            </div>
            <!-- The global progress state -->
            <div class="col-lg-5 fileupload-progress fade">
                <!-- The global progress bar -->
                <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100">
                    <div class="progress-bar progress-bar-success" style="width:0%;"></div>
                </div>
                <!-- The extended global progress state -->
                <div class="progress-extended">&nbsp;</div>
            </div>
        </div>
        <!-- The table listing the files available for upload/download -->
        <table role="presentation" class="table table-striped"><tbody class="files"></tbody></table>
    </form>
    <br>
    
</div>
<!-- The blueimp Gallery widget -->
<div id="blueimp-gallery" class="blueimp-gallery blueimp-gallery-controls" data-filter=":even">
    <div class="slides"></div>
    <h3 class="title"></h3>
    <a class="prev">‹</a>
    <a class="next">›</a>
    <a class="close">×</a>
    <a class="play-pause"></a>
    <ol class="indicator"></ol>
</div>
عکس دانشجو
	<?php //==============================================================================================================================?>
	<?php //==============================================================================================================================?>
<script>
		JQ = jQuery;
jQuery.noConflict();
var comName = 'com_miniuniversity'; // **esme component khod ra benevisid**
//==================================================
function loadLessons () {
	var lesson = '<?php echo $loadData->lessons; ?>';
	var studentId = '<?php echo $id; ?>';
	JQ.ajax({
			type: 'POST',
			url: 'index.php?option='+ comName +'&view=student',
			data: {
				task: 'student.loadLessons',
				studentId: studentId,
				lesson: lesson
			},
			success: function(data) {
						JQ("#lesson").html(data);
						//alert(data);
			},
			error: function(data) {
				alert('error');
			}

		}); 
	
	
	
}
loadLessons();

//============================================================================================
function delData(Id , studentId, term, currentLessons) {
	var x = confirm('are you sure?');
	//-------------------------------------------------------------
	if (x) {
		JQ.ajax({
			type: 'POST',
			url: 'index.php?option='+ comName +'&view=student',
			data: {
				task: 'student.delData',
				Id: Id,
				studentId: studentId,
				term: term,
				currentLessons: currentLessons
			},
			success: function(data) {
				//		loadLessons();
			},
			error: function(data) {
				alert('error');
			}

		}); 
	}
}
//=============================================================================================
function editData(id, student_id, term , lesson) {
	
	var modal = document.getElementById('myModal');
	var span = document.getElementsByClassName("close")[0];
	
		modal.style.display = "block";
	//---------------------------------
		document.getElementById('id').value = id; 
		document.getElementById('student_id').value = student_id; 
		document.getElementById('term').value = term; 
		document.getElementById('lessons').value = lesson; 
	//---------------------------------

	

	// When the user clicks on <span> (x), close the modal
	span.onclick = function() {
		modal.style.display = "none";
	}

	
/*
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
	*/
	//-------------------------------------------------------------
}
function getTeachers(id){
	var parent = document.getElementById("teacherName");
	var child = document.getElementById("teachName");
	if (parent != null && parent != undefined)
		if (child != null && child != undefined)
			parent.removeChild(child);
		
	JQ.ajax({
		type: 'POST',
		url: 'index.php?option='+ comName +'&view=student',
		data: {
			task: 'student.getTeachers',
			termId: id
		},
		success: function(data) {
			JQ("#teacherName").html(data);
		},
		error: function(data) {
			alert('error');
		}
	}); 
	
}
	
//--------------------------------------------------------------------------------------------------
function getLessons(id){
	var parent = document.getElementById("lessonsName");
	var child = document.getElementById("lName");
	if (parent != null && parent != undefined)
		if (child != null && child != undefined)
			parent.removeChild(child);
		
	JQ.ajax({
		type: 'POST',
		url: 'index.php?option='+ comName +'&view=student',
		data: {
			task: 'student.getLessons',
			teacherId: id
		},
		success: function(data) {
			JQ("#lessonsName").html(data);
		},
		error: function(data) {
			alert('error');
		}
	}); 
}
//--------------------------------------------------------------------------------------------------
function getSection(lessonId , teacherId){
	
	var parent = document.getElementById("sectionName");
	var child = document.getElementById("sName");
	if (parent != null && parent != undefined)
		if (child != null && child != undefined)
			parent.removeChild(child);
		
	JQ.ajax({
		type: 'POST',
		url: 'index.php?option='+ comName +'&view=student',
		data: {
			task: 'student.getSections',
			lessonId: lessonId,
			teacherId: teacherId
		},
		success: function(data) {
			JQ("#sectionName").html(data);
		},
		error: function(data) {
			alert('error');
		}
	}); 
	
}
//----------------------------------------------------------------------------------------------------
function addData(){
	
	var  termId = document.getElementById('termName').value;
	var stId = '<?php echo $id; ?>';
	//---------------------------------------------
	var  name = document.getElementById('st_name').value;
	var  studentId = document.getElementById('studentId').value;
	var  email = document.getElementById('st_email').value;
	var  phone = document.getElementById('st_phone').value;
	//---------------------------------------------
	
	var teacherId = document.getElementById('tName').value;
	var lessonId = document.getElementById('leName').value;
	var sectionId = document.getElementById('seName').value;
	
	var lesson = teacherId + '-' + lessonId + '_' + sectionId;
	
//	alert(termId+' '+studentId+' '+teacherId+' '+lessonId+' '+sectionId);
	
	JQ.ajax({
		type: 'POST',
		url: 'index.php?option='+ comName +'&view=student',
		data: {
			task: 'student.addData',
			termId: termId,
			stId: stId,
			lesson: lesson,
			name: name,
			studentId: studentId,
			email: email,
			phone: phone
		},
		success: function(data) {
			JQ("#sectionName").html(data);
		},
		error: function(data) {
			alert('error');
		}
	}); 
	
}

</script>

<script id="template-upload" type="text/x-tmpl">
{% for (var i=0, file; file=o.files[i]; i++) { %}
    <tr class="template-upload fade">
        <td>
            <span class="preview"></span>
        </td>
        <td>
            <p class="name">{%=file.name%}</p>
            <strong class="error text-danger"></strong>
        </td>
        <td>
            <p class="size">Processing...</p>
            <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0"><div class="progress-bar progress-bar-success" style="width:0%;"></div></div>
        </td>
        <td>
            {% if (!i && !o.options.autoUpload) { %}
                <button class="btn btn-primary start" disabled>
                    <i class="glyphicon glyphicon-upload"></i>
                    <span>Start</span>
                </button>
            {% } %}
            {% if (!i) { %}
                <button class="btn btn-warning cancel">
                    <i class="glyphicon glyphicon-ban-circle"></i>
                    <span>Cancel</span>
                </button>
            {% } %}
        </td>
    </tr>
{% } %}
</script>
<!-- The template to display files available for download -->
<script id="template-download" type="text/x-tmpl">
{% for (var i=0, file; file=o.files[i]; i++) { %}
    <tr class="template-download fade">
        <td>
            <span class="preview">
                {% if (file.thumbnailUrl) { %}
                    <a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" data-gallery><img src="{%=file.thumbnailUrl%}"></a>
                {% } %}
            </span>
        </td>
        <td>
            <p class="name">
                {% if (file.url) { %}
                    <a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" {%=file.thumbnailUrl?'data-gallery':''%}>{%=file.name%}</a>
                {% } else { %}
                    <span>{%=file.name%}</span>
                {% } %}
            </p>
            {% if (file.error) { %}
                <div><span class="label label-danger">Error</span> {%=file.error%}</div>
            {% } %}
        </td>
        <td>
            <span class="size">{%=o.formatFileSize(file.size)%}</span>
        </td>
        <td>
            {% if (file.deleteUrl) { %}
                <button class="btn btn-danger delete" data-type="{%=file.deleteType%}" data-url="{%=file.deleteUrl%}"{% if (file.deleteWithCredentials) { %} data-xhr-fields='{"withCredentials":true}'{% } %}>
                    <i class="glyphicon glyphicon-trash"></i>
                    <span>Delete</span>
                </button>
                <input type="checkbox" name="delete" value="1" class="toggle">
            {% } else { %}
                <button class="btn btn-warning cancel">
                    <i class="glyphicon glyphicon-ban-circle"></i>
                    <span>Cancel</span>
                </button>
            {% } %}
        </td>
    </tr>
{% } %}
</script>
<?php
$document 	= JFactory::getDocument(); 
// Load javascript
	$document->addScript('https://code.jquery.com/jquery-1.12.4.js');
	
	//======================================================================================================================= for uploader
	$document->addScript('//ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js');
	// The jQuery UI widget factory, can be omitted if jQuery UI is already included
	$document->addScript(JURI::root(true).'/administrator/components/com_miniuniversity/js/jquery.ui.widget.js');
	// The Templates plugin is included to render the upload/download listings
	$document->addScript('//blueimp.github.io/JavaScript-Templates/js/tmpl.min.js');
	// The Load Image plugin is included for the preview images and image resizing functionality
	$document->addScript('//blueimp.github.io/JavaScript-Load-Image/js/load-image.all.min.js');
	// The Canvas to Blob plugin is included for image resizing functionality
	$document->addScript('//blueimp.github.io/JavaScript-Canvas-to-Blob/js/canvas-to-blob.min.js');
	// Bootstrap JS is not required, but included for the responsive demo navigation
	//$document->addScript('//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js');
	// blueimp Gallery script
	$document->addScript('//blueimp.github.io/Gallery/js/jquery.blueimp-gallery.min.js');
	// The Iframe Transport is required for browsers without support for XHR file uploads
	$document->addScript(JURI::root(true).'/administrator/components/com_miniuniversity/js/jquery.iframe-transport.js');
	// The basic File Upload plugin
	$document->addScript(JURI::root(true).'/administrator/components/com_miniuniversity/js/jquery.fileupload.js');
	// The File Upload processing plugin
	$document->addScript(JURI::root(true).'/administrator/components/com_miniuniversity/js/jquery.fileupload-process.js');
	// The File Upload image preview & resize plugin
	$document->addScript(JURI::root(true).'/administrator/components/com_miniuniversity/js/jquery.fileupload-image.js');
	// The File Upload audio preview plugin
	$document->addScript(JURI::root(true).'/administrator/components/com_miniuniversity/js/jquery.fileupload-audio.js');
	// The File Upload video preview plugin
	$document->addScript(JURI::root(true).'/administrator/components/com_miniuniversity/js/jquery.fileupload-video.js');
	// The File Upload validation plugin
	$document->addScript(JURI::root(true).'/administrator/components/com_miniuniversity/js/jquery.fileupload-validate.js');
	// The File Upload user interface plugin
	$document->addScript(JURI::root(true).'/administrator/components/com_miniuniversity/js/jquery.fileupload-ui.js');
	// The main application script
	$document->addScript(JURI::root(true).'/administrator/components/com_miniuniversity/js/main.js');
	//======================================================================================================================= for uploader


?>
