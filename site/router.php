<?php

defined('_JEXEC') or die;

class MiniuniversityRouter 
{
	public function build(&$query) {
		$segments = array();
		
		$app = JFactory::getApplication();
       		$menu = $app->getMenu();
		$id    =   $menu->getActive()->id;

		$db= JFactory::getDbo();
		$dbquery = $db->getQuery(true);
		

		$dbquery->select('id');
		$dbquery->from($db->quoteName('#__menu'));
		$like = ('%' . $db->escape( 'view=search', true ) . '%' );
		$dbquery->where('link LIKE' . $db->quote( $like, false));
 
		$db->setQuery($dbquery);
		$searchId = $db->loadResult();
		
		if (($query['view'] == 'search') && (count($query) == 3)) {
			$segments [] = $query['view'];	 
		}
		
		elseif ($id == $searchId) {
			
			$segments [] = $query['view'];	 
		}
	
		if (isset($query['id'])) 
		{
			$segments [] = $query['id'];
			unset ($query['id']);
		}

		
	   unset ($query['view']);
		return $segments;
	}
	
public function parse(&$segments) {

       $vars = array();
       $app = JFactory::getApplication();
       $menu = $app->getMenu();
       $item = $menu->getActive();
       // Count segments
       $count = count($segments);
       // Handle View and Identifier

	   switch ($item->query['view']) {
		
			case 'search':
			{
				
				//$vars['view'] = 'search'; // 
				
				
				break;
			}
			
			case 'cards':
			{
				$vars['view'] = 'cards';
				break;
			}
			
			case 'teachers':
			{
				if ($count == 1)
				{
				$vars['view'] = 'teacher';
				$id = explode(':', $segments[$count-1]);
				$vars['id'] = (int) $id[0];
				}

				break;
			}
			case 'libs':
			{
				if ($count == 1)
				{
				$vars['view'] = 'lib';
				$id = explode(':', $segments[$count-1]);
				$vars['id'] = (int) $id[0];
				}

				break;
			}
		}
	
			
		switch($segments[0])
		{
			
			case 'search':
				{
				$vars['view']= 'search'; 
				
				break;
				}
			
			case 'card':
				{
				$vars['view']= 'card';
				break;
				}
				
			case 'teacher':
				{
				$vars['view']= 'teacher';
				$id = explode(':', $segments[1]);
				$vars['id'] = (int) $id[0];
				break;
				}
			case 'lib':
				{
				$vars['view']= 'lib';
				$id = explode(':', $segments[1]);
				$vars['id'] = (int) $id[0];
				break;
				}
				
		}  
	return $vars;
	}

}

function miniuniversityBuildRoute(&$query) {
$router = new MiniuniversityRouter;

	return $router->build($query);
}

function miniuniversityParseRoute($segments) {
	$router = new MiniuniversityRouter;

	return $router->parse($segments);
}
