<?php
defined( '_JEXEC') or die( 'Restricted access');
//~ jimport( 'joomla.application.component.view');
//~ echo '<br/> ************************************************************** <br/>';
//~ echo '<br/> * Estoy en view.html.php de vista1 / Voy a crear Class 		 * <br/>';
//~ echo '<br/> ************************************************************** <br/>';

class ContigomasViewRespuesta extends JViewLegacy
{
	protected $resultado;
	//protected $item;
	//	protected $state;
	
	function display($tpl = null)
	{
        $ControlSession     = JFactory::getSession();
        if (empty($ControlSession->get('id_contigomas'))){
            // Si no existe , entonces comprobamos para crear registro
            $this->resultado = $this->get('Comprobar');
        } else {
            // Ya existe, registro puede ser un refresco de pagina o
            // que pulso en enviar_email
            $insert = $ControlSession->get('id_contigomas');
            // Modelo que voy utilizar..
            $model = $this->getModel('respuesta');
            
            $r = $model->getObtenerId($insert);

            $this->resultado = $r['item'];
           
            // Ahora debería saber si fue porque pulso email o por refresco.
            if ( JRequest::getVar('task')!== 'enviar_email'){
                // Mostrramos advertencia que ya tenemos registro.
                $error = array( 'type' => 'warning',
                                    'texto'  => 'Tu registro ya fue grabado una vez, si quier enviar otro , cierra el navegador y vuelve intentarlo'
                            );
                JFactory::getApplication()->enqueueMessage($error['texto'], $error['type']);
            } else {
                // Hemos pulsado el boton de enviar_email ( lo indica la url) ...
                 $r = $model->getEnviarEmail($insert);
                 if (isset($r['error'])){
                    // Hubo un error
                    JFactory::getApplication()->enqueueMessage($r['error']['texto'], $r['error']['type']);
                 } else {
                    // No hay error de envio por lo entendemos que es correcto.
                    $aviso = array( 'type' => 'info',
                                    'texto'  => 'El email fue enviado correctamente.'
                            );
                    JFactory::getApplication()->enqueueMessage($aviso['texto'], $aviso['type']);
                }
                 
            }
            
        }
		//display de la vista
		parent::display($tpl);
         //~ echo '<pre>';
            //~ print_r($this);
            //~ echo '</pre>';
	}
	
}
