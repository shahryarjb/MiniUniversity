<?php

defined('_JEXEC') or die;

class MiniuniversityRouter 
{
	public function build(&$query) {
		$segments = array();
       
       if (isset($query['id']))
       {
                $segments[] = $query['id'];
                unset($query['id']);
       };
       unset($query['view']);
       return $segments;
	}
//--------------------------------------------------------------------------------------
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
				$vars['view'] = 'search';
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
       return $vars;
	}
}
//=========================================================================================
	function miniuniversityBuildRoute(&$query) {
		$router = new MiniuniversityRouter;

		return $router->build($query);
	}
	//-------------------------------------------------------------
	function miniuniversityParseRoute($segments) {
		$router = new MiniuniversityRouter;

		return $router->parse($segments);
	}

