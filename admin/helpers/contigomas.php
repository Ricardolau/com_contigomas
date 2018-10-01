<?php
// No permitir acceso directo al archivo
defined('_JEXEC') or die;

/**
 * Ayuda del componente Vehiculo.
 */
class ContigomasHelper extends JHelperContent
{
        /**
         * Configurar la barra de enlaces.
         */
        public static function addSubmenu($submenu) 
        {
			$document = JFactory::getDocument();
			
           
            /* Mas opciones para Exportar tablas */

			JSubMenuHelper::addEntry('<h2 class="nav-header">Herramientas y otros</h2>');
            JSubMenuHelper::addEntry('Esportar tabla','index.php?option=com_contigomas&view=exportar&extension=com_contigomas', $submenu == 'exportar');
            


        }
}
