<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');
 
// import Joomla view library
jimport('joomla.application.component.view');
 
 //~ echo '<pre>';
 //~ print_r($this);
 //~ echo '</pre>';
 
class ContigomasViewExportar extends JViewLegacy
{
        /*** display method of Hello view
         * @return void  */
        public function display($tpl = null) 
        {
				ContigomasHelper::addSubmenu('exportar');
                // Obtenemos parametros
                
                $this->respuesta = $this->get('exportar');
                
                // Check for errors.
                if (count($errors = $this->get('Errors'))) 
                {
                        JError::raiseError(500, implode('<br />', $errors));
                        return false;
                }
                
                 // Set the toolbar
                $this->addToolBar();
 
                // Display the template
                parent::display($tpl);
        }
 
       protected function addToolBar() 
        {
                
                //si el articulo a editar es nuevo pone un titulo
                // y si es para editar pone el titulo de editar
                JToolBarHelper::title(JText::_('COM_CODIGOMAS_MANAGER_EXPORTAR'));
                
        }
       
}
