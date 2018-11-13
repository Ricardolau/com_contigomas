<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');
 
// import Joomla view library
jimport('joomla.application.component.view');
 
 //~ echo '<pre>';
 //~ print_r($this);
 //~ echo '</pre>';
 
class ContigomasViewRegistro extends JViewLegacy
{
        /*** display method of Hello view
         * @return void  */
        public function display($tpl = null) 
        {
					
                // get the Data
                $form = $this->get('Form');
                $item = $this->get('Item');
 
                // Check for errors.
                if (count($errors = $this->get('Errors'))) 
                {
                        JError::raiseError(500, implode('<br />', $errors));
                        return false;
                }
                // Assign the Data
                $this->form = $form;
                $this->item = $item;
 
                // Set the toolbar
                $this->addToolBar();
 
                // Display the template
                parent::display($tpl);
        }
 
        /**
         * Setting the toolbar
         */
        protected function addToolBar() 
        {
                $input = JFactory::getApplication()->input;
                $input->set('hidemainmenu', true);
                $isNew = ($this->item->id == 0);
                //si el articulo a editar es nuevo pone un titulo
                // y si es para editar pone el titulo de editar
                JToolBarHelper::title($isNew ?   JText::_('COM_CONTIGOMAS_MANAGER_REGISTRO_NEW')
                                             :  JText::_('COM_CONTIGOMAS_MANAGER_REGISTRO_EDIT'));
                JToolBarHelper::save('registro.save');
                JToolBarHelper::cancel('registro.cancel', $isNew ? 'cancelar' //'JTOOLBAR_CANCEL'
                                                                   : 'cerrar'); //'JTOOLBAR_CLOSE');
        }
}
