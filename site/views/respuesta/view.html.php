<?php
defined( '_JEXEC') or die( 'Restricted access');
//~ jimport( 'joomla.application.component.view');
//~ echo '<br/> ************************************************************** <br/>';
//~ echo '<br/> * Estoy en view.html.php de vista1 / Voy a crear Class 		 * <br/>';
//~ echo '<br/> ************************************************************** <br/>';

class ContigomasViewRespuesta extends JViewLegacy
{
	protected $resultado;
	//protected $item;
	//	protected $state;
	
	function display($tpl = null)
	{
		
		//~ $app   = JFactory::getApplication();
		//~ $resultado = JRequest::getVar('jform', array(), 'get', 'array');
		//~ echo '<br/> ************************************************************** <br/>';
		//~ echo '<br/> * vista1-> view.html.php y funcion display					 * <br/>';
		//~ echo '<br/> ************************************************************** <br/>';
		//~ 
		$this->resultado = $this->get('Comprobar');
		
		//display de la vista
		parent::display($tpl);
	}
	
}
