<?php
defined( '_JEXEC' ) or die( 'Restricted access' );
//~ jimport('joomla.application.component.controller');
//echo ' 30 Entre en controlador general';

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
			//~ echo '<br/> Controler general -> funcion display-->  En if contigomas <br/>';
		}
		if  ($input->getCmd('view') == 'vista1')
		{
			//~ $this->prueba = "Entro";
			
			
			//~ echo '<br/> ************************************************************** <br/>';
			//~ echo '<br/> Controler general -> funcion display-->  En if  vista1 <br/>';
			//~ echo '<br/> ************************************************************** <br/>';
			//~ $id = $_GET['id'];
			//~ echo ' Imprimo ID:'.$id;
			//~ $this->comprobar($id);
			
			/* La cuestión es que  si va comprobar y toma datos, pero no sabemos 
			 * como enviarlo al objeto creado por la view.vista1
			 * Si embargo en el fichero codigorecibo.php de raiz si muestra el objeto.
			 * por lo que entiendo que si lo supieramos instancias entonces si podríamos 
			 * recuperarlo.
			 * */
		}
					
		 
		return parent::display($this);

	}
	public function submit()
	{

		// Initialise variables.
		$input = JFactory::getApplication()->input;

		//~ // Get the data from POST
        
        $this->resultado = JRequest::getVar('jform', array(), 'get', 'array');
		$this->set('view', $input->getCmd('view', 'respuesta')); 
			
			return ;
	}	
		
	


}
