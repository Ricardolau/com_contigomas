<?php
defined( '_JEXEC' ) or die( 'Restricted access' );
//~ jimport('joomla.application.component.controller');

//es obligatorio que herede JController
class ContigomasController extends JControllerLegacy
{	
	
	public function display($cachable = false, $urlparams = false) 
	{

        require_once JPATH_COMPONENT . '/helpers/contigomas.php';

		//programar una vista por defecto si no se establece
		$input = JFactory::getApplication()->input;
		//set establece y get toma
		$view= $input->set('view', $input->getCmd('view', 'contigomas'));
		
		
		//ESTO NO ME HACE NADA
			// Compruebe formulario de edición .
		if ($view == 'registro' && $layout == 'edit' && !$this->checkEditId('com_contigomas.edit.registro', $id)) 
		{
			
			$this->setRedirect(JRoute::_('index.php?option=com_contigomas&view=contigomas', false));
			return false;
		}
		
		
		
		// call parent behavior
//		parent::display($cachable);
	
		parent::display();
	}
}
