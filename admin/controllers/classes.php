<?php
/**
 * @copyright   Copyright (C) 2016 Open Source Matters, Inc. All rights reserved. ( https://trangell.com )
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @subpackage  com_MiniUniversity
 */
defined('_JEXEC') or die('Restricted access');

class MiniUniversityControllerClasses extends JControllerAdmin {
	public function getModel($name = 'class', $prefix = 'MiniUniversityModel', $config = array('ignore_request' => true))
	{
		$model = parent::getModel($name, $prefix, $config);

		return $model;
	}
	
	public function deleteAtrrib() {
		
		$app 	= JFactory::getApplication();
		$model 	= $this->getModel('classes');
		$m = $model->deleteAttribs();

		$app->close();
	}
}
