<?php

defined('_JEXEC') or die;

function miniuniversityBuildRoute(&$query)
{
	$segments = array();
	
	if ((isset($query['view'])) && ($query['view'] == 'search') )
	{
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

function miniuniversityParseRoute($segments)
{
	$vars = array();
	
	if ($segments[0] != 'search')
	{	
	$vars['view']= 'teacher';
	$id = explode(':', $segments[0]);
	$vars['id'] = (int) $id[0];
       }
       
       return $vars;
}

