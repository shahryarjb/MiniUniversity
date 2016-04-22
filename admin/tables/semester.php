<?php
/**
 * @copyright   Copyright (C) 2016 Open Source Matters, Inc. All rights reserved. ( https://trangell.com )
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @subpackage  com_MiniUniversity
 */
defined('_JEXEC') or die('Restricted access');

class HelloWorldTableSemester extends JTable
{

	function __construct(&$db)
	{
		parent::__construct('#__scquiz_semester', 'id', $db);
	}

	public function bind($array, $ignore = '')
	{
		if (isset($array['params']) && is_array($array['params']))
		{
			$parameter = new JRegistry;
			$array['params'] = (string)$parameter;
		}

		// Bind the rules.
		if (isset($array['rules']) && is_array($array['rules']))
		{
			$rules = new JAccessRules($array['rules']);
			$this->setRules($rules);
		} 

		return parent::bind($array, $ignore);
	}

	public function load($pk = null, $reset = true)
	{
		if (parent::load($pk, $reset))
		{
			$params = new JRegistry;
			//$params->loadString($this->params, 'JSON');

			$this->params = $params;
			return true;
		}
		else
		{
			return false;
		} 
	}

	protected function _getAssetName()
	{
		$k = $this->_tbl_key;
		return 'com_helloworld.message.'.(int) $this->$k;
	}

	protected function _getAssetTitle()
	{
		return $this->path;
	}

	protected function _getAssetParentId(JTable $table = NULL, $id = NULL)
	{
		$assetParent = JTable::getInstance('Asset');
		$assetParentId = $assetParent->getRootId();

		if (($this->catid)&& !empty($this->catid))
		{
			$assetParent->loadByName('com_helloworld.category.' . (int) $this->catid);
		}
		else
		{
			$assetParent->loadByName('com_helloworld');
		}

		if ($assetParent->id)
		{
			$assetParentId=$assetParent->id;
		}
		return $assetParentId;
	}
}
