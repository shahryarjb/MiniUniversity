<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_search
 *
 * @copyright   Copyright (C) 2005 - 2016 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

/**
 * Search Component Search Model
 *
 * @since  1.5
 */
class HelloWorldModelSearch extends JModelLegacy
{


	//================================
	protected $_data2 = null;

	/**
	 * Constructor
	 *
	 * @since 1.5
	 */
	public function __construct()
	{
		parent::__construct();

		// Get configuration
		$app    = JFactory::getApplication();
		$config = JFactory::getConfig();

		// Get parameters.
		$params = $app->getParams();
//print_r($params);
	
//===================== get data from form
        $keyword  = urldecode($app->input->getString('searchword'));
		$term=$app->input->get('term');
		$book=$app->input->get('book');
		$this->setData($keyword,$term,$book);
		
	}
//==========================================
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
			$query->from('#__scquiz_teacher AS t');
			
			if ($keyword != '')
			{
			  $like = $db->quote('%' . $keyword . '%');
			  $query->where('t.name LIKE' . $like);
			}
			
			if (!empty($term))
			{
			  $query->where('t.term_id = ' . $term);
			}
			
			if (!empty($book))
			{
			  $query->where('t.cat_id = ' . $book);	
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
			->from('#__scquiz_semester');
		$db->setQuery($query);
		$rows = $db->loadObjectList();
		
		return	$rows;
	}
		
	public static function reshte() {
		$db = JFactory::getDbo();
		$query = $db->getQuery(true);
		$query->select('id,name')
			->from('#__scquiz_book');
		$db->setQuery($query);
		$rows = $db->loadObjectList();
		
		return $rows;
	}	
	
	public function getListterm() {		

			$db    = JFactory::getDbo();
			$queryy = $db->getQuery(true);
			$queryy->select('*');
			$queryy->from('#__scquiz_semester');
			$db->setQuery($queryy);
			$result = $db->loadObjectList();
			return $result;
		}

	public function getListBook() {		

			$db    = JFactory::getDbo();
			$queryy = $db->getQuery(true);
			$queryy->select('*');
			$queryy->from('#__scquiz_book');
			$db->setQuery($queryy);
			$result = $db->loadObjectList();
			return $result;
		}

}
