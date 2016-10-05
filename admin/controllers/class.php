<?php
/**
 * @copyright   Copyright (C) 2016 Open Source Matters, Inc. All rights reserved. ( https://trangell.com )
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @subpackage  com_MiniUniversity
 */
defined('_JEXEC') or die('Restricted access');

class MiniUniversityControllerClass extends JControllerForm {

	protected function allowAdd($data = array()) {
		return parent::allowAdd($data);
	}

	protected function allowEdit($data = array(), $key = 'id') {
		$id = isset( $data[ $key ] ) ? $data[ $key ] : 0;
		if( !empty( $id ) ) {
			return JFactory::getUser()->authorise( "core.edit", "com_miniuniversity.message." . $id );
		}
	}
	
	protected function postSaveHook(JModelLegacy &$model, $validData = array()) {
		if(isset($validData['cat_id'])){
		$data['cat_id'] = implode(',', $validData['cat_id']);
		
		return $model->save($data);
		}
	}
	
	public function getLessons() {
		$app 	= JFactory::getApplication();
		$model 	= $this->getModel('class');
		$m = $model->getTeacherLesson();

		echo '<div id="father"><p id="son">';
		echo '<select id="lesson_name">';
		foreach ($m as $tl) {
			echo '<option value="'.$tl->id.'">'.$tl->name.'</option>';
		}
		echo '</select>';
		echo '</p></div>';
		$app->close();
	}
	
	public function classSave() {
		$app 	= JFactory::getApplication();
		$model 	= $this->getModel('class');
		$m = $model->classSaves();
		echo $m->id;
		$app->close();
	}
}
