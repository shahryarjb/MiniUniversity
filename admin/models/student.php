<?php
/**
 * @copyright   Copyright (C) 2016 Open Source Matters, Inc. All rights reserved. ( https://trangell.com )
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @subpackage  com_MiniUniversity
 */
defined('_JEXEC') or die('Restricted access');

class MiniUniversityModelStudent extends JModelAdmin
{
	public $comName = "miniuniver"; // *************** name of component *******************
	
	public function getTable($type = 'student', $prefix = 'MiniUniversityTable', $config = array())
	{
		return JTable::getInstance($type, $prefix, $config);
	}

	public function getForm($data = array(), $loadData = true)
	{
		
	}

	protected function loadFormData()
	{
		$data = JFactory::getApplication()->getUserState(
			'com_miniuniversity.edit.student.data',
			array()
		);

		if (empty($data)) {
			$data = $this->getItem();
		}
		
		return $data;
	}

	protected function canDelete($record) {
		if( !empty( $record->id ) ) {
			return JFactory::getUser()->authorise( "core.delete", "com_miniuniversity.message." . $record->id );
		}
	}
	
	public function loadData ($id) {
		
		$db = JFactory::getDbo();
		$query = $db->getQuery(true);

		$query->select('s.*');
		$query->from('#__'.$this->comName.'_student as s');
		$query->where('s.id = ' . $db->quote($id));
		$db->setQuery($query);
		$result = $db->loadObjectlist();
		return $result;
		
	}
	
	public function loadlesson () {
		$studentId = JRequest::getVar('studentId');
		$lessons = JRequest::getVar('lesson');
		
		$less =(explode(',', $lessons)); // joda kardan darsha
		
		//---------------------------------------------------------
		foreach ($less as $l){
			$teacher[] =(explode('-', $l)); 
		}
		// joda kardan teacher
		for ($j = 0 ; $j < count ($teacher) ; $j++ ){
			$ostad[] = $teacher[$j][0];
		}
		//---------------------------------------------------------
		
		for ($i = 0 ; $i < count($teacher) ; $i++ ) {
			$ls[] =(explode('_', $teacher[$i][1])); // joda kardan lesson and section
		}
		
		// joda kardane lesson id
		for ($m = 0 ; $m < count($ls) ; $m++ ) {
			$lesson[] =(explode('_', $ls[$m][0])); 
	 	}
		// joda kardane section id
		for ($v = 0 ; $v < count($ls) ; $v++ ) {
			$section[] =(explode('_', $ls[$v][1])); 
	 	}
		
		return array($ostad,$lesson,$section,$studentId);
	
	}
	
	public function getTeacher ($id) {
		
		$db = JFactory::getDbo();
		$query = $db->getQuery(true);

		$query->select('t.name');
		$query->from('#__'.$this->comName.'_teacher as t');
		$query->where('t.id = ' . $db->quote($id));
		$db->setQuery($query);
		$result = $db->loadResult();
		return $result;
		
	}
	
	public function getLesson ($id="") {
		
		$db = JFactory::getDbo();
		$query = $db->getQuery(true);

		$query->select('b.id as lesson_id,b.name as lesson_name');
		$query->from('#__'.$this->comName.'_book as b');
		
		if ($id != "") 
			$query->where('b.id = ' . $db->quote($id));
			
		$db->setQuery($query);
		$result = $db->loadObjectlist();
		
		return $result;
		
	}
	
	public function getSection ($id) {
		
		$db = JFactory::getDbo();
		$query = $db->getQuery(true);

		$query->select('s.section_name');
		$query->from('#__'.$this->comName.'_section as s');
		$query->where('s.id = ' . $db->quote($id));
		$db->setQuery($query);
		$result = $db->loadResult();
		return $result;
		
	}
	//============================================================================ delete data
	public function delData2() {
		
		$Id = JRequest::getVar('Id');
		$studentId = JRequest::getVar('studentId');
		$term =  JRequest::getVar('term');
		$dataInfo =  explode(',',JRequest::getVar('currentLessons')); // 1-12_14 // convert to array
		
		$getData = explode(',',$this::searchData($Id ,$studentId, $term));  // gereftane data baray on rooz // 15*12-0830_1150,17*13-1230_1500,14*12-1615_1900

		$newData = implode(',',array_diff($getData,$dataInfo)); // hazf kardan reshete morde nazar va tabdil be string
		
		
		$db = JFactory::getDbo();
		$query = $db->getQuery(true);
			
		$fields = array($db->quoteName('lessons') . ' = ' . $db->quote($newData));
		// Conditions for which records should be updated.
		$conditions = array(
							$db->quoteName('id') . ' = '.$Id.'',
							$db->quoteName('student_id') . ' = '.$studentId.'',
							$db->quoteName('term') . ' = '.$term.''
							);
		$query->update($db->quoteName('#__'.$this->comName.'_student'));
		$query->set($fields);
		$query->where($conditions);

		$db->setQuery($query);
		try { 
			$db->execute(); 
		} 
		catch (RuntimeException $e) { 
			echo $e->getMessage(); 
		}
				
	}
	//=====================
	public function searchData($Id ,$studentId, $term) {
		$db = JFactory::getDbo();
		$query = $db->getQuery(true);

		$query->select('s.Lessons');
		$query->from('#__'.$this->comName.'_student as s');
		$query->where('s.id = ' . $db->quote($Id));
		$query->where('s.student_id = ' . $db->quote($studentId));
		$query->where('s.term = ' . $db->quote($term));
		$db->setQuery($query);
		$result = $db->loadResult();
		
		return $result;
		
	}
		//====================================================================================================
	public function getTeach() {
		$termId = JRequest::getVar('termId');
	
		$db = JFactory::getDbo();
		$query = $db->getQuery(true);
 
		$query->select('t.id as teacher_id , t.name as teacher_name');
		$query->from('#__'.$this->comName.'_teacher as t');
		$query->where('t.term_id =  ' . $db->quote($termId));
		
		$db->setQuery($query);
		$result = $db->loadObjectlist();

		return $result;
		
	}
	//====================================
	public function getTeacherBook(){ //get cat id
		$teacherId = JRequest::getVar('teacherId');
		
		$db = JFactory::getDbo();
		$query = $db->getQuery(true);

		$query->select('t.cat_id');
		$query->from('#__'.$this->comName.'_teacher as t');
		$query->where('t.id =  ' . $db->quote($teacherId));
		$db->setQuery($query);
		$result = $db->loadObjectlist();
		//------------------------- gereftan name dars ha
		
			$cat_id =(explode(',', $result[0]->cat_id));
			
			$db1    = JFactory::getDbo();
			$query1 = $db1->getQuery(true);
			
			
			$ids = join(',',$cat_id);  
			
			$query1->select('b.id as  lesson_id , b.name as lesson_name');
			$query1->from('#__miniuniver_book as b');
			$query1->where(('id') . ' IN (' . $ids .')');
			$db1->setQuery($query1);
			$data = $db1->loadObjectList();
	
		return array($data,$teacherId);
	}
	//======================================================================================================
	public function getTerm	()	{ //get all term
		
		$db = JFactory::getDbo();
		$query = $db->getQuery(true);

		$query->select('s.id as term_id , s.name as term_name');
		$query->from('#__'.$this->comName.'_semester as s');
		$db->setQuery($query);
		$result = $db->loadObjectlist();
		
		return $result;
	}
	
	//=======================================================================================================
	public function getSections	()	{ //get section
		$lessonId = JRequest::getVar('lessonId');
		$teacherId = JRequest::getVar('teacherId');
		
		
		$db = JFactory::getDbo();
		$query = $db->getQuery(true);

		$query->select('s.id as section_id , s.section_name');
		$query->from('#__'.$this->comName.'_section as s');
		$query->where('s.lesson_id =  ' . $db->quote($lessonId));
		$query->where('s.teacher_id =  ' . $db->quote($teacherId));
		$db->setQuery($query);
		$result = $db->loadObjectlist();

		return $result;
	}
	//=======================================================================================================
	public function addData() {
		
		$termId = JRequest::getVar('termId'); 
		$stId = JRequest::getVar('stId'); 
		$newLesson = JRequest::getVar('lesson'); 
		//------------------------------------------
		$name = JRequest::getVar('name'); 
		$studentId = JRequest::getVar('studentId'); 
		$email = JRequest::getVar('email'); 
		$phone = JRequest::getVar('phone'); 
		//------------------------------------------
	
		$getOldLessons = $this::searchData($stId ,$studentId, $termId);
		
		preg_match('/'.$newLesson.'/', $getOldLessons,$result);

		if (isset($result) && $result != null) {
			echo '<script>alert("داده تکراری");</script>';
		}
		else {
			$db = JFactory::getDbo();
			$query = $db->getQuery(true);
			
			if (isset($getOldLessons)  or $newLesson != null) {// ========================= update
				if ($getOldLessons != "")
					$newData = $getOldLessons .','. $newLesson;
				else
					$newData = $newLesson;	
				
				$fields = array($db->quoteName('lessons') . ' = ' . $db->quote($newData));
				$conditions = array($db->quoteName('id') . ' = '.$studentId.'' ,$db->quoteName('term') . ' = '.$termId.'');
				$query->update($db->quoteName('#__'.$this->comName.'_student'));
				$query->set($fields);
				$query->where($conditions);
			}
			else { // ========================= insert
				$newData = $newLesson;	
				
			//	$columns = array($);
				$values = array($db->quote($classId), $db->quote($teacherId), $db->quote($newData));
				$query->insert($db->quoteName('#__'.$this->comName.'_student'));
				$query->columns($db->quoteName($columns));
				$query->values(implode(',', $values));
			}
			
			$db->setQuery($query);
			try { 
				$db->execute(); 
			} 
			catch (RuntimeException $e) { 
				echo $e->getMessage(); 
			}	

		}


	}
	//============================================================================================
	public function storeData() {
		$name = JRequest::getVar('name'); 
		
		$db = JFactory::getDbo();
		$query = $db->getQuery(true);
		
		$columns = array('pic_name');
		$values = array($db->quote($name));
		$query->insert($db->quoteName('#__'.$this->comName.'_upload_files'));
		$query->columns($db->quoteName($columns));
		$query->values(implode(',', $values));
		$db->setQuery($query);
		try { 
			$db->execute(); 
		} 
		catch (RuntimeException $e) { 
			echo $e->getMessage(); 
		}	
		
		
	}
	
}
