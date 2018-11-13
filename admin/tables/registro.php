<?php
// No direct access
defined('_JEXEC') or die;

/**
 * @package		Joomla.Administrator
 * @subpackage	com_newsfeeds
 */
 //~ echo '<br/> estoy en TABLES--> vista.php ';
class ContigomasTableRegistro extends JTable
{
	/**
	 * Constructor
	 *
	 * @param JDatabase A database connector object
	 * y guardar los registros en bbdd
	 */
	public function __construct(&$db)
	{
		 //~ echo '<br/> Tables-> vista.php -> constructor	  ';
		 //~ echo '<br/> bd '.(int)$db;
		 //~ echo '<br/> ************************************************************** <br/>';
	        //~ echo '<pre>';
          //~ print_r($this);
     //~ echo '</pre>';
		
		parent::__construct('#__contigomas', 'id', $db);
	}


/**
	 * Overriden JTable::store to set modified data and user id.
	 *
	 * @param	boolean	True to update fields even if they are null.
	 * @return	boolean	True on success.
	 * @since	1.6
	 */
////funcion que crea fecha cuando se añade un registro
	public function store($updateNulls = false)
	{
		//~ echo 'zzz funcion store --> updateNulls '.$updateNulls;
		 //~ echo '<br/> tables VISTA.php -> funcion store para guardar fecha al añadir registro	  ';
		$date	= JFactory::getDate();
		if ($this->id)
		{
			// Existing item
			$this->modified		= $date->toSql();
			
		} 
		else 
		{	// Un campo de alimentación creada y created_by se puede ajustar por el usuario,
							// Por lo que no tocamos cualquiera de ellos si están ajustados .
				if (!intval($this->created)) {
				$this->created = $date->toSql();
			}
		}
		
		
		/////////////////////////////////////////////////////////////////////////////
		/*		COMPROBAR QUE EL CODIGO al editar NO SE REPITA EN LA BBDD	*/
		$table = JTable::getInstance('Registro', 'ContigomasTable');
        
		//~ if  ($table->load(array('codigo'=>$this->codigo)) && ($table->codigo != $this->codigo || $this->codigo==0)) {
			//~ $this->setError('El codigo no se puede repetir');//JText::_('COM_WEBLINKS_ERROR_UNIQUE_ALIAS'));
			
			//~ return false;
		//~ }
		/////////////////////////////////////////////////////////////////////////
		return parent::store($updateNulls);
	}
	

}
