<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');
 
// import Joomla controlleradmin library
jimport('joomla.application.component.controlleradmin');
 
/**
 * HelloWorlds Controller
 */
class ContigomasControllerExportar extends JControllerAdmin
{
	/**
	 * Proxy for getModel.
	 * @since	2.5
	 */
	 //cualquier btn toolbar vendra al controlador y leera la funcion del modelo
	 //para asi usar sus funciones y llevarlas a cabo (acciones)
	 //voy al modelo vista que es donde tengo las funciones getTable, getForm, loadForm
	public function getModel($name = 'Exportar', $prefix = 'ContigomasModel') 
	{
		$model = parent::getModel($name, $prefix, array('ignore_request' => true));
		return $model;
	}
}
