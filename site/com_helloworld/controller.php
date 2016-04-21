<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_helloworld
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

/**
 * Hello World Component Controller
 *
 * @since  0.0.1
 */
class HelloWorldController extends JControllerLegacy
{
	public function display($cachable = false, $urlparams = false) {
		
		$document = JFactory::getDocument();
		$vName = $this->input->get('view', 'search');
		$this->input->set('view', $vName);
		
		parent::display($cachable , $urlparams);
	return $this;
		}
		
		public function search()
	    {
		// Slashes cause errors, <> get stripped anyway later on. # causes problems.
		$badchars = array('#', '>', '<', '\\');
		$searchword = trim(str_replace($badchars, '', $this->input->getString('searchword', null, 'post')));

		// If searchword enclosed in double quotes, strip quotes and do exact match
		if (substr($searchword, 0, 1) == '"' && substr($searchword, -1) == '"')
		{
			$post['searchword'] = substr($searchword, 1, -1);
			$this->input->set('searchphrase', 'exact');
		}
		else
		{
			$post['searchword'] = $searchword;
		}
 $post['term'] = $this->input->getString('term');
 //echo  '<script>alert("$post["term"]");</script>';
 return  '<script>alert("aaaaaaaaaaaaaaa");</script>';
 
		//$post['ordering']     = $this->input->getWord('ordering', null, 'post');
		//$post['searchphrase'] = $this->input->getWord('searchphrase', 'all', 'post');
		//$post['limit']        = $this->input->getUInt('limit', null, 'post');

		if ($post['limit'] === null)
		{
			unset($post['limit']);
		}

		

		// The Itemid from the request, we will use this if it's a search page or if there is no search page available
		$post['Itemid'] = $this->input->getInt('Itemid');

		// Set Itemid id for links from menu
		$app  = JFactory::getApplication();
		$menu = $app->getMenu();
		$item = $menu->getItem($post['Itemid']);

		// The request Item is not a search page so we need to find one
		if ($item->component != 'com_helloworld' || $item->query['view'] != 'search')
		{
			// Get item based on component, not link. link is not reliable.
			$item = $menu->getItems('component', 'com_helloworld', true);

			// If we found a search page, use that.
			if (!empty($item))
			{
				$post['Itemid'] = $item->id;
			}
		}

		unset($post['task']);
		unset($post['submit']);

		$uri = JUri::getInstance();
		$uri->setQuery($post);
		$uri->setVar('option', 'com_helloworld&view=search');

		$this->setRedirect(JRoute::_('index.php' . $uri->toString(array('query', 'fragment')), false));
	    }
}
