<?php
/**
 * @copyright   Copyright (C) 2016 Open Source Matters, Inc. All rights reserved. ( https://trangell.com )
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @subpackage  com_MiniUniversity
 */
defined('_JEXEC') or die('Restricted access');


class MiniUniversityModelSection extends JModelAdmin {
	public $comName = "miniuniver"; // *************** name of component *******************
	
	public function getTable($type = 'section', $prefix = 'MiniUniversityTable', $config = array())
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
			'com_miniuniversity.edit.section.data',
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
	public function getSection ($id) {
			$db = JFactory::getDbo();
			$query = $db->getQuery(true);

			
			$query->select('s.section_name,s.lesson_id,s.teacher_id,b.name as lesson_name ,t.name as teacher_name');
			$query->from('#__'.$this->comName.'_section as s');
			$query->where('s.id = ' . $db->quote($id));
			$query->leftJoin('#__'.$this->comName.'_book b ON b.id = s.lesson_id');
			$query->leftJoin('#__'.$this->comName.'_teacher t ON t.id = s.teacher_id');
			$db->setQuery($query);
			$result = $db->loadObjectlist();
			return $result;	
	}
//=====================================================================	
	public function getLessonesName ($name="") {
		$db = JFactory::getDbo();
		$query = $db->getQuery(true);

		$query->select('c.id,c.lesson_id,c.teacher_id,b.name as lesson_name');			
		$query->from('#__'.$this->comName.'_class as c');
		$query->leftJoin('#__'.$this->comName.'_book b ON b.id = c.lesson_id');
		if ($name != ""){
			$query->where('c.class_name LIKE '. $db->quote($name));
			
		}
		else {
			$query->group('c.lesson_id');
		}
		$db->setQuery($query);
		$result = $db->loadObjectlist();
		return $result;	
	}
	//-------------
	public function getLessonesName2 ($id) {
			$db = JFactory::getDbo();
			$query = $db->getQuery(true);

			$query->select('b.id as lesson_id,b.name as lesson_name');
			$query->from('#__'.$this->comName.'_book as b');
			$query->where('b.id != '. $db->quote($id));
			
			$db->setQuery($query);
			$result = $db->loadObjectlist();
			return $result;	
	}
//=====================================================================	
	public function getTeacher() {

		$lessonId = JRequest::getVar('lessonid');

		$db    = JFactory::getDbo();
		$query = $db->getQuery(true);

		$query->select('c.teacher_id,t.name as teacher_name');
		$query->from('#__'.$this->comName.'_class as c');
		$query->leftJoin('#__'.$this->comName.'_teacher t ON t.id = c.teacher_id');
		$query->where('c.lesson_id = '. $lessonId);
		$query->group('c.teacher_id');
		$db->setQuery($query);
		$data = $db->loadObjectList();

		return $data;

	}
	//------------------------
	public function getTeacherClass2 ($lessonId , $teacherId) {
		
		$db1    = JFactory::getDbo();
		$query1 = $db1->getQuery(true);
		
		$query1->select('c.teacher_id');
		$query1->from('#__'.$this->comName.'_class as c');
		$query1->where('c.lesson_id  = '. $db1->quote($lessonId));
		$db1->setQuery($query1);
		$teacherIds = $db1->loadObjectlist();
		
		$teachID = "";
		foreach($teacherIds as $i => $ti){
			$teachID.= $ti->teacher_id. ',';	
		}
		$teachID = trim($teachID, ',');
		
		$arra1 =(explode(',', $teachID));
		$arra2 =(explode(',', $teacherId));
		
		$totalTeacher = array_diff ($arra1,$arra2); // compare two array 
	
		if(count($totalTeacher) > 0) {
			$ids = join(',',$totalTeacher);  
			
			$db    = JFactory::getDbo();
			$query = $db->getQuery(true);	
			$query->select('t.id,t.name');
			$query->from('#__'.$this->comName.'_teacher as t');
			$query->where(('id') . ' IN (' . $ids .')');
			$db->setQuery($query);
			$data = $db->loadObjectList();
			return $data;
		}
		
		
	}
//=======================================================================	
function sectionsSaves() {
		
		$sName = JRequest::getVar('sectionName');
		$lName = JRequest::getVar('lessonId');
		$tName = JRequest::getVar('teacherName');
		$status = JRequest::getVar('status');
		$pId = JRequest::getVar('pageId');
		//======================================================================== save
		if ($status == "save") {
			$db = JFactory::getDbo();
			$query = $db->getQuery(true);

			$columns = array('section_name', 'lesson_id' , 'teacher_id');
			$values = array($db->quote($sName), $db->quote($lName), $db->quote($tName));

			$query->insert($db->quoteName('#__'.$this->comName.'_section'));
			$query->columns($db->quoteName($columns));
			$query->values(implode(',', $values));

			$db->setQuery($query);
			try { 
				$db->execute(); 
			} 
			catch (RuntimeException $e) { 
				echo $e->getMessage(); 
			}
			$sectionId = MiniUniversityModelSection::loadId($sName,$lName,$tName);
		
		}
		//======================================================================== update
		else {
			$db = JFactory::getDbo();
			$query = $db->getQuery(true);
			// Fields to update.
			$fields = array(
				$db->quoteName('section_name') . ' = ' . $db->quote($sName),
				$db->quoteName('lesson_id') . ' = ' . $db->quote($lName),
				$db->quoteName('teacher_id') . ' = ' . $db->quote($tName)
			);
			// Conditions for which records should be updated.
			$conditions = array($db->quoteName('id') . ' = '.$pId.'');
			$query->update($db->quoteName('#__'.$this->comName.'_section'));
			$query->set($fields);
			$query->where($conditions);
			
			$db->setQuery($query);
			try { 
				$db->execute(); 
			} 
				catch (RuntimeException $e) { 
				echo $e->getMessage(); 
			}
			$sectionId = 	$pId ; 
		}

	return $sectionId;
}

//============================================ load id 
	function loadId ($sName,$lName,$tName) {
	
			$db = JFactory::getDbo();
			$query = $db->getQuery(true);

			$query->select('s.id');
			$query->from('#__'.$this->comName.'_section as s');
			$query->where('s.section_name LIKE ' . $db->quote($sName));
			$query->where('s.lesson_id LIKE ' . $db->quote($lName));
			$query->where('s.teacher_id LIKE ' . $db->quote($tName));
			$db->setQuery($query);
			$result = $db->loadObject();
			return $result;
		}
//=============================================
}
