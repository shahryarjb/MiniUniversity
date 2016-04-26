<?php
/**
 * @copyright   Copyright (C) 2016 Open Source Matters, Inc. All rights reserved. ( https://trangell.com )
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @subpackage  com_MiniUniversity
 */

defined('_JEXEC') or die;

class MiniUniversityModelSearch extends JModelLegacy
{


	//================================
	protected $_data2 = null;

	public function __construct()
	{
		parent::__construct();

		$app    = JFactory::getApplication();
		$config = JFactory::getConfig();

		$params = $app->getParams();	
        		$keyword  = urldecode($app->input->getString('searchword'));
		//$term=$app->input->get('term', 0 ,'INT');
        		$term=$app->input->getInt('term');
		$book=$app->input->getInt('book');
		$this->setData($keyword,$term,$book);
		
	}
public function setData($keyword,$term,$book) {
	$this->setState('searchword', $keyword);
	$this->setState('term', $term);
	$this->setState('book', $book);
}

	public function getData() {   
	$keyword = $this->getState('searchword');
	$term = $this->getState('term');
    	$book = $this->getState('book');
    

		$db = JFactory::getDbo();
		$query = $db->getQuery(true);
		
	if (($keyword != '') or ($term != '')  or ( $book != '') )
	{
			$query->select('t.*,CASE WHEN CHAR_LENGTH(t.name) THEN CONCAT_WS(":", t.id, t.name) ELSE t.name END as slug');
			$query->from('#__miniuniver_teacher AS t');
			
			if ($keyword != '')
			{
			  $like = $db->quote('%' . $keyword . '%');
			  $query->where('t.name LIKE' . $like);
			}
			
			if (!empty($term))
			{
			  $scrut = $db->escape(intval($term));
			  $query->where('t.term_id = ' . $scrut);
			}
			
			if (!empty($book))
			{
			$scrub = $db->escape(intval($book));
			  $query->where('FIND_IN_SET('.$scrub.',t.cat_id)');	
			}
			$db->setQuery($query);
			$rows = $db->loadObjectList();
			
			return	$rows;	
	}	
}



	public static function term() {
		$db = JFactory::getDbo();
		$query = $db->getQuery(true);
		$query->select('id,name')
			->from('#__miniuniver_semester');
		$db->setQuery($query);
		$rows = $db->loadObjectList();
		
		return	$rows;
	}
		
	public static function reshte() {
		$db = JFactory::getDbo();
		$query = $db->getQuery(true);
		$query->select('id,name')
			->from('#__miniuniver_book');
		$db->setQuery($query);
		$rows = $db->loadObjectList();
		
		return $rows;
	}	
	
	public function getListterm() {		

			$db    = JFactory::getDbo();
			$queryy = $db->getQuery(true);
			$queryy->select('*');
			$queryy->from('#__miniuniver_semester');
			$db->setQuery($queryy);
			$result = $db->loadObjectList();
			return $result;
		}

	public function getListBook() {		

			$db    = JFactory::getDbo();
			$queryy = $db->getQuery(true);
			$queryy->select('*');
			$queryy->from('#__miniuniver_book');
			$db->setQuery($queryy);
			$result = $db->loadObjectList();
			return $result;
		}

}
