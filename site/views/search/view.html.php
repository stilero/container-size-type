<?php
/**
* @version		$Id: default_viewlist.php 96 2011-08-11 06:59:32Z michel $
* @package		Containercode
* @subpackage 	Views
* @copyright	Copyright (C) 2012, . All rights reserved.
* @license #
*/

// no direct access
defined('_JEXEC') or die('Restricted access');

jimport('joomla.application.component.view');

 
class ContainercodeViewSearch  extends JView 
{
	public function display($tpl = null)
	{
		
		$app = &JFactory::getApplication('site');
		$document	= &JFactory::getDocument();
		$uri 		= &JFactory::getURI();
		$user 		= &JFactory::getUser();
		$pagination	= &$this->get('pagination');
		$params		= $app ->getParams();				
		$menus	= &JSite::getMenu();
		
		$menu	= $menus->getActive();
		if (is_object( $menu )) {
			$menu_params = $menus->getParams($menu->id) ;
			if (!$menu_params->get( 'page_title')) {
				$params->set('page_title', 'Containercode');
			}
		}		
				
		$items = $this->get( 'Items' );
		$this->assignRef( 'items', $items);

		$this->assignRef('params', $params);
		$this->assignRef('pagination', $pagination);
		
		parent::display($tpl);
	}
        
        public function result(){
            $searchPhrase = JRequest::getVar('q');
            $model =& $this->getModel();
            $containerInfo = $model->queryContainer($searchPhrase);
            $this->assignRef('contInfo', $containerInfo);
            if(!isset($containerInfo['error'])){
                $this->assignRef('isocodes', $isoCodes);
                parent::display('results');
            }else{
                parent::display('error');
            }
            
        }
}
?>