<?php
/**
 * @copyright   Copyright (C) 2016 Open Source Matters, Inc. All rights reserved. ( https://trangell.com )
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @subpackage  com_MiniUniversity
 */
defined('_JEXEC') or die('Restricted access');

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
		$badchars = array('#', '>', '<', '\\');
		$searchword = trim(str_replace($badchars, '', $this->input->getString('searchword', null, 'post')));

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
 return  '<script>alert("aaaaaaaaaaaaaaa");</script>';

		if ($post['limit'] === null)
		{
			unset($post['limit']);
		}

		

		$post['Itemid'] = $this->input->getInt('Itemid');

		$app  = JFactory::getApplication();
		$menu = $app->getMenu();
		$item = $menu->getItem($post['Itemid']);

		if ($item->component != 'com_helloworld' || $item->query['view'] != 'search')
		{
			$item = $menu->getItems('component', 'com_helloworld', true);

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
