<?php

// No direct access
defined('_JEXEC') or die;
//~ jimport('joomla.application.component.modelform');
//~ echo '<br/>Entro en modelo codigorecibo.php<br/>';

class ContigomasModelContigomas extends JModelForm
{
		protected $view_item = 'contigomas';
	
	public function getForm($data = array(), $loadData = true)
	{
		// Get the form.
		$form = $this->loadForm('com_contigomas.contigomas', 'contigomas', array('control' => 'jform', 'load_data' => true));
		if (empty($form)) {
			return false;
		}
		// Ahora deberíamos tener nos datos para cargar el formulario.
		//~ echo '<pre>';
		//~ print_r($form);
		//~ echo '</pre>';
		
		return $form;
	}
	
	protected function loadFormData()
	{
		$data = (array)JFactory::getApplication()->getUserState('com_contigomas.contigomas.data', array());
		// Llegamos aquí al antes de mostrar el formulario.
		// realmente no se que hace, o que sentido tiene... 
		// ya $data esta vació siempre.
		//~ echo '<pre>';
		//~ print_r($data);
		//~ echo '</pre>';

		return $data;
	}
	//~ public function getInsertQuery($datos){
		//~ $db = JFactory::getDBO();
		//~ $query = $db->getQuery(true);
		
		//~ $fecha='"'.date("Y-m-d H:i:s").'"';

		
		//~ $nombre=substr($datos['nombre'], 0, 1);
		
		//~ $apellidos=explode(" ", $datos['apellidos']);
		//~ $apellido1=substr($apellidos[0], 0, 1); 
		//~ $apellido2=substr($apellidos[1], 0, 1); 
		//~ $amd=date("Ymd");
		//~ $hm=date("Hi");
		
		//~ $codigo=$nombre.$apellido1.$apellido2.$amd.$hm;
		//~ $query='insert into #__contigomas (codigo, nombre, apellidos, dni, telefono, email, 
		//~ calle, numero, piso, codigopostal, municipio, provincia, aceptar, created,  modified) VALUES (
		//~ "'.$codigo.'", "'.$datos['nombre'].'", "'.$datos['apellidos'].'", "'.$datos['dni'].'", "'.$datos['telefono'].'", "'.$datos['email'].'", 
		//~ "'.$datos['calle'].'", "'.$datos['numero'].'", "'.$datos['piso'].'", "'.$datos['codigoPostal'].'", "'.$datos['municipio'].'", 
		//~ "'.$datos['provincia'].'", "'.$datos['terminos'].'", '.$fecha.', '.$fecha.')';
		//~ $db->setQuery($query);
		//~ $db->execute();
		//~ if ($db->getErrorNum()){
			//~ $mensaje="Error al insertar los datos";
		//~ }else{
			//~ $mensaje="Datos insertados con éxito";
		//~ }
      //~ return $mensaje; 
	//~ }
	
	
}
