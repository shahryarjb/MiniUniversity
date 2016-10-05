<?php
/**
 * @copyright   Copyright (C) 2016 Open Source Matters, Inc. All rights reserved. ( https://trangell.com )
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @subpackage  com_MiniUniversity
 */
defined('_JEXEC') or die('Restricted access');

class MiniUniversityControllerSchedule extends JControllerForm {

	protected function allowAdd($data = array()) {
		return parent::allowAdd($data);
	}

	protected function allowEdit($data = array(), $key = 'id') {
		$id = isset( $data[ $key ] ) ? $data[ $key ] : 0;
		if( !empty( $id ) ) {
			return JFactory::getUser()->authorise( "core.edit", "com_miniuniversity.message." . $id );
		}
	}	
	//======================================================================================
	public function getTeachers() {
		$app 	= JFactory::getApplication();
		$model 	= $this->getModel('schedule');
		$m = $model->getTeacher();
		
		$out = '<p id="cTeacher">'; // nabayad dar haleghe bashad
		$out .= '<select id="teacher_name" style="width:110px">';
		$out .= '<option value="null" selected="select">انتخاب استاد</option>';
		foreach ($m as $t){
			$out .= '<option value="'.$t->teacher_id.'" onClick="getSection(\'null\',\'null\',\'null\',\'null\')">'.$t->teacher_name.'</option>';
		}
		$out .= '</select>';
		$out .= '</p>';// nabayad dar haleghe bashad
		echo $out;
		
		$app->close();
	}
	//======================================================================================
	public function getSections() {
		$app 	= JFactory::getApplication();
		$model 	= $this->getModel('schedule');
		$m = $model->getSection();

		$out = '<p id="cSection">'; 
		$out .= '<select id="section_name" style="width:110px">';
		if ($m[1] == null)
			$out .= '<option value="null" selected="select">بخش</option>';
		foreach ($m[0] as $t){
			if ($m[1] != null && $t->section_id == $m[1]){
				$out .= '<option value="'.$m[1].'" selected="selected">'.$m[2].'</option>';	
			}
			else
				$out .= '<option value="'.$t->section_id.'">'.$t->section_name.'</option>';
		}
		$out .= '</select>';
		$out .= '</p>';
		echo $out;
		
		$app->close();
	}
	
	//=================================
	public function ShowData() {
		
		$app 	= JFactory::getApplication();
		$model 	= $this->getModel('schedule');
		$getSchedule = $model->ShowData();
		if ($getSchedule[0]!= null and $getSchedule[1]!= null and $getSchedule[2]!= null) {

			if($getSchedule != null){	
				
				for($j=0 ; $j < count($getSchedule[1]) ; $j++ ) {
					
					echo '<br>';
					echo '<br>';
					echo 'نام استاد'.' '. $getSchedule[1][$j];
					echo '<br>';
					echo '<br>';

					if (isset($getSchedule[0][$j]) and $getSchedule[0][$j] !=null and $getSchedule[0][$j] != "") {
			
						foreach($getSchedule[0][$j] as $key => $days){
							//if (isset($getSchedule[0][$j]) and $getSchedule[0][$j] != "") {
								switch($key){
									case 'Saturday':
										echo 'شنبه'.'==>';
										$info = $getSchedule[2]['Saturday'];
									break;
									case 'Sunday':
										echo 'یکشنبه'.'==>';
										$info = $getSchedule[2]['Sunday'];
									break;
									case 'Monday':
										echo 'دوشنبه'.'==>';
										$info = $getSchedule[2]['Monday'];
									break;
									case 'Tuesday':
										echo 'سه شنبه'.'==>';
										$info = $getSchedule[2]['Tuesday'];
									break;
									case 'Wednesday':
										echo 'چهار شنبه'.'==>';
										$info = $getSchedule[2]['Wednesday'];
									break;
									case 'Thurusday':
										echo 'پنج شنبه'.'==>';
										$info = $getSchedule[2]['Thurusday'];
									break;
									case 'Friday':
										echo 'جمعه'.'==>';
										$info = $getSchedule[2]['Friday'];
									break;
								}
								for ($i = 0 ; $i < count($days) ; $i++) {
									
									echo $days[$i];	
									if($getSchedule[3] != 'all'){
										if ($model->getTimeBook($info[$i])[1] != null) {
									
											foreach ($model->getTimeBook($info[$i])[1] as $inf){
													$lesson = explode(',',$inf['lesson']);
													$section = explode(',',$inf['section']);
													$timeStart = $inf['timeStart'];
													$timeEnd = $inf['timeEnd'];
				
											}
										}
										//echo '<input name="edit" value="edit" type="button" id="edit" onClick="editData(\''.$getSchedule[3].'\',\''.$key.'\',\''.$info[$i].'\')"> ';
										echo '<input name="edit" value="edit" type="button" id="edit" onClick="editData(\''.
										$getSchedule[3].'\',\''.$key.'\',\''.$lesson[0].'\',\''.$lesson[1].'\',\''.
										$section[0].'\',\''.$section[1].'\',\''.$timeStart.'\',\''.$timeEnd.'\')"> ';
										echo '<input name="remove" value="remove" type="button" onClick="delData(\''.$getSchedule[4].'\',\''.$getSchedule[3].'\',\''.$key.'\',\''.$info[$i].'\')"> ';
									}
										
									echo ' //// ';
								}
								echo '<br>=====================================================================<br>';
						//	} // end if
							//else {
						//		echo 'برای استاد مورد نظر در کلاس جاری برنامه ای تعریف نشده است';
						//	}
						} // end for
					} // end if
					else {
						echo 'برای استاد مورد نظر در کلاس جاری برنامه ای تعریف نشده است';
					}
					echo '<br>=====================================================================<br>';
					echo '<br>=====================================================================<br>';
				}
			}
			else {
				echo 'برای استاد مورد نظر در کلاس جاری برنامه ای تعریف نشده است';
			}	
		}
		else {
			echo 'هیچ برنامه های برای این کلاس تعریف نشد است';
		}
		$app->close();
	}
	//====================================================================================== add data
	public function addData() {
		$app 	= JFactory::getApplication();
		$model 	= $this->getModel('schedule');
		$addData = $model->addData();
		
		$app->close();
		
	}
	//=================================================== delete data
	public function delData() {
		$app 	= JFactory::getApplication();
		$model 	= $this->getModel('schedule');
		$addData = $model->delData2();
		
		$app->close();
		
	}
	//=================================
	public function getLesson() {
		$app 	= JFactory::getApplication();
		$model 	= $this->getModel('schedule');
		$addData = $model->getLesson();
		
		$out ='<select id="lesson_Name" class="lesson_Name">';
		foreach ($addData[0] as $ad) {	
			if ($ad->lesson_id == $addData[1]){
				/*
				echo '<option value="'.$ad->lesson_id.'" selected="selected" onClick="getSection(\''.$ad->lesson_id.'\',\''.$addData[2].'\',\''.$addData[3].'\',\''.$addData[4].'\')">'.$ad->lesson_name.'</option>';	
				else 
				echo '<option value="'.$ad->lesson_id.'" onClick="getSection(\''.$ad->lesson_id.'\',\''.$addData[2].'\',\''.$addData[3].'\',\''.$addData[4].'\')">'.$ad->lesson_name.'</option>';	
				*/
				$out .= '<option value="'.$ad->lesson_id.'" selected="selected" onClick="getSection(\''.$addData[1].'\',\''.$addData[2].'\')">'.$ad->lesson_name.'</option>';	
			}
			else { 
				$out .= '<option value="'.$ad->lesson_id.'" onClick="getSection(\''.$ad->lesson_id.'\',\''.$addData[2].'\')">'.$ad->lesson_name.'</option>';	
			}
		}
		$out .= '</select>';
		
		echo $out;
		
		$app->close();
		
	}
	//================================================
	public function saveData() {
		$app 	= JFactory::getApplication();
		$model 	= $this->getModel('schedule');
		$addData = $model->saveData();
		$app->close();
	}
}
