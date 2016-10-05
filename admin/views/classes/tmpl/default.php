<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_miniuniversity
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

// No direct access to this file
defined('_JEXEC') or die('Restricted Access');

JHtml::_('formbehavior.chosen', 'select');

$comName = "com_miniuniversity"; // *********** name component shoma ******************
$listOrder     = $this->escape($this->filter_order);
$listDirn      = $this->escape($this->filter_order_Dir);
//call the method
 

echo "</br>";
?>
<form action="index.php?option=com_miniuniversity&view=classes" method="post" id="adminForm" name="adminForm">
	<div class="row-fluid">
		<div class="span6">

		<!---- cod search va  ..... khode joomla  -->
			<?php echo JText::_('COM_MINIUNIVERSITY_CLASSES_FILTER'); ?>
			<?php
				echo JLayoutHelper::render(
					'joomla.searchtools.default',
					array('view' => $this)
				);
			?>
		<!---- cod search va  ..... khode joomla  -->
		</div>
	</div>
	<table class="table table-striped table-hover">
		<thead>
		<tr>
		<!---- header balaye filde -->
			<th width="1%"><?php echo JText::_('COM_MINIUNIVERSITY_NUM'); ?></th>
			<th width="2%">
				<?php echo '<input type="checkbox" onclick="javascript:checkAlll()" id="checkAll"> '; ?>
			</th>
			<th width="20%">
				<?php echo JHtml::_('grid.sort', 'COM_MINIUNIVERSITY_CLASS_NAME', 'class_name', $listDirn, $listOrder); ?>
			</th>
			<th width="10%">
				<?php echo JHtml::_('grid.sort','COM_MINIUNIVERSITY_TEACHER_NAME' , 'teacher_name', $listDirn, $listOrder); ?>
			</th>
			<th width="5%">
				<?php echo JHtml::_('grid.sort', 'COM_MINIUNIVERSITY_LESSON_NAME', 'lesson_name', $listDirn, $listOrder); ?>
			</th>
			
		<!---- header balaye filde -->
		</tr>
		</thead>
		<tfoot>
			<tr>
				<td colspan="5">
					<?php echo $this->pagination->getListFooter(); ?>
				</td>
			</tr>
		</tfoot>
		<tbody>
			<?php if (!empty($this->items)) : ?>
				<?php foreach ($this->items as $i => $row) :
					$link = JRoute::_('index.php?option=com_miniuniversity&task=class.edit&id=' . $row->id);
				?>
					<tr>
						<td><?php echo $this->pagination->getRowOffset($i); ?></td>
						<td>
							<?php echo '<input type="checkbox"  class="checkBoxx" id="ch'. ($i+1).'" value="'. $row->id  .'" check="">'; ?>
						</td>
						<td>
							<a href="<?php echo $link; ?>" title="<?php echo JText::_('COM_MINIUNIVERSITY_EDIT_CLASS'); ?>">
							<?php echo $row->class_name; ?>
							</a>
						</td>
						<td>
							<?php echo $row->teacher_name; ?>
						</td>
						<td align="center">
							<?php echo $row->lesson_name; ?>
						</td>
						
					</tr>
				<?php endforeach; ?>
			<?php endif; ?>
		</tbody>
	</table>
	<input type="hidden" name="task" value=""/>
	<input type="hidden" name="boxchecked" value="0"/>
	<input type="hidden" name="filter_order" value="<?php echo $listOrder; ?>"/>
	<input type="hidden" name="filter_order_Dir" value="<?php echo $listDirn; ?>"/>
	<?php echo JHtml::_('form.token'); ?>
</form>
<script>
//===================================================================== edit
var comName = "com_miniuniversity";  //******* bejay dashboard esme component  *******
jQuery.noConflict();
	JQ = jQuery;
//=========================
//=====================================================================
function checkAlll(){

	var mvalue = document.getElementsByClassName("checkBoxx");
	for(var j=0; j<mvalue.length; j++) {
		if (!mvalue[j].checked ){
			mvalue[j].checked = true;	
		}
		else {
			mvalue[j].checked = false;	
		}
	}
	
}
//=====================================================================
function editAttrib(status) {
	
	var mvalue = document.getElementsByClassName("checkBoxx");
	var values = '';
	var tempArray = [];
	for(var j=0; j<mvalue.length; j++) {
		if (mvalue[j].checked ){
			values += mvalue[j].value;
			values += ',';
			tempArray.push(mvalue[j].value);
		}
	}
	
	values = values.slice(0, -1);
	
	if (tempArray.length == 1) {
			window.location="index.php?option="+ comName +"&view="+ status +"&layout=edit&id=" + values;
	}
	else if (tempArray.length > 1 ) { 
		message1();
	}
	else {
		message2();
	}
}
//===================================================================== delete
function deleteAttrib (status) { 
	var mvalue = document.getElementsByClassName("checkBoxx");
	var values = '';

	for(var j=0; j<mvalue.length; j++) {
		if (mvalue[j].checked ){
			values += mvalue[j].value;
			values += ',';
		}
	}
	values = values.slice(0, -1);
if (values != "") {	
	JQ.ajax({
				type: 'POST',
				url: 'index.php?option='+ comName +'&view='+ status ,
				data: {
					task: status +'.deleteAtrrib',
					pageId: values
				},
				success: function(data) {
						window.location="index.php?option="+ comName +"&view="+ status + "&mpage=re";
				},
				error: function(data) {
					alert('error');
				}
			
			}); 
}
else {
	message2();
}

}
///========================================== message
function message1(){
	alert('<?php echo JText::_(strtoupper($comName).'_CLASS_ERROR1'); ?>');
}

function message2(){
	alert('<?php echo JText::_(strtoupper($comName).'_CLASS_ERROR2'); ?>');
}

</script>
