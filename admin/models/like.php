<?php
/**
 * @copyright   Copyright (C) 2016 Open Source Matters, Inc. All rights reserved. ( https://trangell.com )
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @subpackage  com_MiniUniversity
 */
defined('_JEXEC') or die('Restricted access');

class MiniUniversityModelLike extends JModelAdmin
{

	public function getTable($type = 'like', $prefix = 'MiniUniversityTable', $config = array())
	{
		return JTable::getInstance($type, $prefix, $config);
	}

	public function getForm($data = array(), $loadData = true)
	{
		$form = $this->loadForm(
			'com_miniuniversity.like',
			'like',
			array(
				'control' => 'jform',
				'load_data' => $loadData
			)
		);

		if (empty($form))
		{
			return false;
		}

		return $form;
	}


	protected function loadFormData()
	{
		$data = JFactory::getApplication()->getUserState(
			'com_miniuniversity.edit.like.data',
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
}
