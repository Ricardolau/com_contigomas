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
	
                $S = $this->get('exportar');
                
                echo '<pre>';
                print_r($S);
                echo '</pre>';
                // Check for errors.
                if (count($errors = $this->get('Errors'))) 
                {
                        JError::raiseError(500, implode('<br />', $errors));
                        return false;
                }
                
               
 
                // Display the template
                parent::display($tpl);
        }
 
       
       
}
