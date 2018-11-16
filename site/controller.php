<?php
defined( '_JEXEC' ) or die( 'Restricted access' );
//~ jimport('joomla.application.component.controller');

class ContigomasController extends JControllerLegacy
{	
	public $resultado; // Es donde quiero guardar el dato que envia el formulario	
	public function display($cachable = false, $urlparams = false)
	{
		/* Iniciamos variable */
		/* La variables $cachable y $ urlparams , si las imprimimos con 
		 * print_r siempre es 1 , ya que la ponemos en falso.
		 * Si le quito = false , da un error ya que no recibe parametro el display.
		 * */
	//	echo '<br/> Controler general -> funcion display <br/>';
		$cachable = true;
		
		//programar una vista por defecto si no se establece
		$input = JFactory::getApplication()->input;
		//set establece y get toma
		//~ $input->set('view', $input->getCmd('view', 'contigomas'));
		/* La linea anterior la cambio , ya que no hace falta, ya que
		 * al venir la primera vez ya viene con contigomas 
		 * y al volver trae la vista por defecto.
		 * */
       
		if  ($input->getCmd('view') == 'contigomas')
		{
            // La vista contigomas podemos llegar de varias forma.
            // Incluso podemos llegar una vez cubierto el formulario , es decir
            // ya tenemos un registro realizado por lo que debemos controlarlo.
            $ControlSession     = JFactory::getSession();
            if ($ControlSession->get('id_contigomas')){
                // Quiere decir que ya hizo un registro
                // por lo que cambiamos la vista.
                JRequest::setVar('view', 'respuesta');
            }
           
		}
		
					
		 
		return parent::display($this);

	}
	public function submit()
	{

		// Initialise variables.
		$input = JFactory::getApplication()->input;
        $data = $input->getArray($_POST);

		//~ // Get the data from POST
        $this->resultado = JRequest::getVar('jform', array(), 'get', 'array');
		$this->set('view', $input->getCmd('view', 'respuesta')); 
			
		return ;
	}	
		
	public function enviar_email()
	{
		// Initialise variables.
		$input = JFactory::getApplication()->input;
        $data = $input->getArray($_POST);
        
		//~ // Get the data from POST
        //~ $this->resultado = JRequest::getVar('jform', array(), 'get', 'array');
		$this->set('view', $input->getCmd('view', 'respuesta')); 
        $this->display();
		return ;
	}	
		


}
