<?php
/**
 * @copyright   Copyright (C) 2016 Open Source Matters, Inc. All rights reserved. ( https://trangell.com )
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @subpackage  com_MiniUniversity
 */
defined('_JEXEC') or die('Restricted access');


class MiniUniversityModelClass extends JModelAdmin
{
	public $comName = "miniuniver"; // *************** name of component *******************
	
	public function getTable($type = 'class', $prefix = 'MiniUniversityTable', $config = array())
	{
		return JTable::getInstance($type, $prefix, $config);
	}

	public function getForm($data = array(), $loadData = true)
	{
		
	}

//=====================================================================
	protected function loadFormData()
	{
		$data = JFactory::getApplication()->getUserState(
			'com_miniuniversity.edit.class.data',
			array()
		);

		if (empty($data)) {
			$data = $this->getItem();
		}

		return $data;
	}
//=====================================================================
	protected function canDelete($record) {
		if( !empty( $record->id ) ) {
			return JFactory::getUser()->authorise( "core.delete", "com_miniuniversity.message." . $record->id );
		}
	}
	
//=====================================================================
	public function getClass ($id) {
			$db = JFactory::getDbo();
			$query = $db->getQuery(true);

			$query->select('c.class_name,c.teacher_id,c.lesson_id,t.name as techer_name,b.name as lesson_name');
			$query->from('#__'.$this->comName.'_class as c');
			$query->where('c.id = ' . $db->quote($id));
			$query->leftJoin('#__'.$this->comName.'_teacher t ON t.id = c.teacher_id');
			$query->leftJoin('#__'.$this->comName.'_book b ON b.id = c.lesson_id');
			$db->setQuery($query);
			$result = $db->loadObjectlist();
			return $result;	
	}
//=====================================================================	
	public function getTeacherName ($id="") {
			$db = JFactory::getDbo();
			$query = $db->getQuery(true);

			$query->select('t.id,t.name,t.cat_id');
			$query->from('#__'.$this->comName.'_teacher as t');
			if ($id != ""){
				$query->where('t.id = '. $db->quote($id));
			}
			$db->setQuery($query);
			$result = $db->loadObjectlist();
			return $result;	
	}
	//-------------
	public function getTeacherName2 ($id) {
			$db = JFactory::getDbo();
			$query = $db->getQuery(true);

			$query->select('t.id,t.name,t.cat_id');
			$query->from('#__'.$this->comName.'_teacher as t');
			$query->where('t.id != '. $db->quote($id));
		
			$db->setQuery($query);
			$result = $db->loadObjectlist();
			return $result;	
	}
//=====================================================================	
	public function getTeacherLesson () {
		
		$techId = JRequest::getVar('techid');
		$catId  = MiniUniversityModelClass::getTeacherName($techId)[0]->cat_id;
		
		if (!empty($catId)) {
			$cat_id =(explode(',', $catId));
			$db    = JFactory::getDbo();
			$query = $db->getQuery(true);
			$ids = join(',',$cat_id);  	
			$query->select('b.id,b.name');
			$query->from('#__'.$this->comName.'_book as b');
			$query->where(('id') . ' IN (' . $ids .')');
			$db->setQuery($query);
			$data = $db->loadObjectList();
	    }
	    else {
			$data= NUll;
		}
		
		return $data;
		
	}
	//------------------------
	public function getTeacherLesson2 ($teacherId,$lessonId) {
	
		$db1    = JFactory::getDbo();
		$query1 = $db1->getQuery(true);
		
		$query1->select('t.id,t.name,t.cat_id');
		$query1->from('#__'.$this->comName.'_teacher as t');
		$query1->where('t.id = '. $db1->quote($teacherId));
		$db1->setQuery($query1);
		$lessonesId = $db1->loadObjectlist()[0]->cat_id;
		$arra1 =(explode(',', $lessonesId));
		$arra2 =(explode(',', $lessonId));
		
		$totalLesson = array_diff ($arra1,$arra2); // compare two array 
		
		if(count($totalLesson) > 0) {
			$ats = implode(" ",$totalLesson); // convert array to string
			$sta = explode(" ",$ats); // convert string to array
			$ids = join(',',$sta); 
			$db    = JFactory::getDbo();
			$query = $db->getQuery(true);	
			$query->select('b.id,b.name');
			$query->from('#__'.$this->comName.'_book as b');
			$query->where(('id') . ' IN (' . $ids .')');
			$db->setQuery($query);
			$data = $db->loadObjectList();
			return $data;
		}
	}
//=====================================================================================================	
//=====================================================================================================	
	function classSaves() {
		
		$cName = JRequest::getVar('className');
		$tName = JRequest::getVar('teacherName');
		$lName = JRequest::getVar('lessonName');
		$status = JRequest::getVar('status');
		$pId = JRequest::getVar('pageId');
		//======================================================================== save
		if ($status == "save") {
			$db = JFactory::getDbo();
			$query = $db->getQuery(true);

			$columns = array('class_name', 'teacher_id' , 'lesson_id');
			$values = array($db->quote($cName), $db->quote($tName), $db->quote($lName));

			$query->insert($db->quoteName('#__'.$this->comName.'_class'));
			$query->columns($db->quoteName($columns));
			$query->values(implode(',', $values));

			$db->setQuery($query);
			try { 
				$db->execute(); 
			} 
			catch (RuntimeException $e) { 
				echo $e->getMessage(); 
			}
			$classId = MiniUniversityModelClass::loadId($cName,$tName,$lName);
		
		}
		//======================================================================== update
		else {
			$db = JFactory::getDbo();
			$query = $db->getQuery(true);
			// Fields to update.
			$fields = array(
				$db->quoteName('class_name') . ' = ' . $db->quote($cName),
				$db->quoteName('teacher_id') . ' = ' . $db->quote($tName),
				$db->quoteName('lesson_id') . ' = ' . $db->quote($lName)
			);
			// Conditions for which records should be updated.
			$conditions = array($db->quoteName('id') . ' = '.$pId.'');
			$query->update($db->quoteName('#__'.$this->comName.'_class'));
			$query->set($fields);
			$query->where($conditions);
			
			$db->setQuery($query);
			try { 
				$db->execute(); 
			} 
				catch (RuntimeException $e) { 
				echo $e->getMessage(); 
			}
			$classId = 	$pId ; 
		}
	
		

	return $classId;
}


//============================================ load id 
	function loadId ($cName,$tName,$lName) {
	
			$db = JFactory::getDbo();
			$query = $db->getQuery(true);

			$query->select('id');
			$query->from('#__'.$this->comName.'_class as c');
			$query->where('c.class_name LIKE' . $db->quote($cName));
			$query->where('c.teacher_id LIKE' . $db->quote($tName));
			$query->where('c.lesson_id LIKE' . $db->quote($lName));
			$db->setQuery($query);
			$result = $db->loadObject();
			return $result;
		}
}
