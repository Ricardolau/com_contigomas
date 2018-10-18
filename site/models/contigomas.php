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
	
	
}
