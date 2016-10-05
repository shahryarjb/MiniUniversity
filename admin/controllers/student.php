<?php
/**
 * @copyright   Copyright (C) 2016 Open Source Matters, Inc. All rights reserved. ( https://trangell.com )
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @subpackage  com_MiniUniversity
 */
defined('_JEXEC') or die('Restricted access');

class MiniUniversityControllerStudent extends JControllerForm {

	protected function allowAdd($data = array()) {
		return parent::allowAdd($data);
	}

	protected function allowEdit($data = array(), $key = 'id') {
		$id = isset( $data[ $key ] ) ? $data[ $key ] : 0;
		if( !empty( $id ) ) {
			return JFactory::getUser()->authorise( "core.edit", "com_miniuniversity.message." . $id );
		}
	}	
	
	public function loadLessons () {
		$app 	= JFactory::getApplication();
		$model 	= $this->getModel('student');
		$loadlesson = $model->loadlesson();

		$studentInfo = $model->loadData($loadlesson[3])[0];
	

		$tech = 'نام استاد'	;
		$les = 'نام درس';
		$sec= 'نام بخش';

		for ($f = 0 ; $f < count($loadlesson[0]) ; $f++){
			$currentLessons = $loadlesson[0][$f].'-'.$loadlesson[1][$f][0].'_'.$loadlesson[2][$f][0];
			
			echo $tech.' => '.$model->getTeacher($loadlesson[0][$f]);
			echo '=='.$les.' => '.$model->getLesson($loadlesson[1][$f][0])[0]->lesson_name;
			echo '=='.$sec.' => '.$model->getSection($loadlesson[2][$f][0]);
			echo '<input name="edit" value="edit" type="button" id="edit" onClick="editData(\''.
										$studentInfo->id.'\',\''.$studentInfo->student_id.'\',\''.$studentInfo->term.'\',\''.$currentLessons.'\')"> ';
			echo '<input name="remove" value="remove" type="button" onClick="delData(\''.$studentInfo->id.'\',\''.$studentInfo->student_id.'\',\''.$studentInfo->term.'\',\''.$currentLessons.'\')"> ';
			echo '<br>';
		}
	
		$app->close();
		
		
	}
	//=================================================== delete data
	public function delData() {
		$app 	= JFactory::getApplication();
		$model 	= $this->getModel('student');
		$addData = $model->delData2();
		
		$app->close();
		
	}
	//=================================================== 
	public function getTeachers() {
		$app 	= JFactory::getApplication();
		$model 	= $this->getModel('student');
		$teach = $model->getTeach();

		if ($teach != "" && $teach != null){
			$out = '<p id="teachName">'; 
			$out .= '<select id="tName">';
			$out .= '<option id="null" selected="selected">انتخاب استاد</option>';
			foreach ($teach as $t ){
				$out .= '<option id="'.$t->teacher_id.'" onClick="getLessons('.$t->teacher_id.')" value="'.$t->teacher_id.'">'.$t->teacher_name.'</option>';
			}
			$out .= '</select>';
			$out .= '</p>';
		
			echo $out;
		}
		else {
			echo 'برای این ترم استادی تعریف نشده است';
		}

		$app->close();
		
	}
	//======================================================
	public function getLessons() {
		$app 	= JFactory::getApplication();
		$model 	= $this->getModel('student');
		$lessons = $model->getTeacherBook();

		if ($lessons[0] != "" && $lessons != null){
			$out = '<p id="lName">'; 
			$out .= '<select id="leName">';
			$out .= '<option id="null" selected="selected">انتخاب درس</option>';
			foreach ($lessons[0] as $t ){
				$out .= '<option id="'.$t->lesson_id.'" onClick="getSection(\''.$t->lesson_id.'\',\''.$lessons[1].'\')" value="'.$t->lesson_id.'">'.$t->lesson_name.'</option>';
			}
			$out .= '</select>';
			$out .= '</p>';
		
			echo $out;
		}
		else {
			echo 'برای این استاد درسی تعریف نشد';
		}

		$app->close();
		
	}
	//======================================================
	public function getSections() {
		$app 	= JFactory::getApplication();
		$model 	= $this->getModel('student');
		$sections = $model->getSections();

		if ($sections != "" && $sections != null){
			$out = '<p id="sName">'; 
			$out .= '<select id="seName">';
			$out .= '<option id="null" selected="selected">انتخاب بخش</option>';
			foreach ($sections as $s ){
				$out .= '<option id="'.$s->section_id.'" value="'.$s->section_id.'">'.$s->section_name.'</option>';
			}
			$out .= '</select>';
			$out .= '</p>';
		
			echo $out;
		}
		else {
			echo 'برای این درس بخشی تعریف نشده است';
		}

		$app->close();
		
	}
	//======================================================
	public function addData() {
		$app 	= JFactory::getApplication();
		$model 	= $this->getModel('student');
		$addData = $model->addData();
		
		$app->close();
		
	}
	//======================================================
	public function storeDatas() {
		$app 	= JFactory::getApplication();
		$model 	= $this->getModel('student');
		$addData = $model->storeData();
		
		$app->close();
		
	}
}
