<?php

// No direct access
defined('_JEXEC') or die;

			
class ContigomasModelRespuesta extends JModelList
{
	public function getComprobar()
	{
			$resultado = array();
            $insert = 0;
            $codigo = '';
            $jinput = JFactory::getApplication()->input;   
            $data = $jinput->getArray($_POST);
            $ControlSession     = JFactory::getSession();
            // Comprobamos realmente si llegamos del jform
            if ( isset($data['jform'])){
                // Ahora creamos codigo.
                $codigo =$this->obtenerCodigo($data['jform']);
                // Comprobamos si esta repetido el codigo
                $control = $this->comprobarCodigo($codigo);
                
                    // Se acaba de enviar el formulario y el codigo es generado es correcto
                    if ($control == 0 ){
                        // Añadimos el codigo a data, para mandar grabar ya que no existe ese codigo.
                        $data['jform']['codigo'] = $codigo;
                        $insert = $this->getInsertQuery($data['jform']);
                        // Si la respuesta 0 quiere decir que no inserto.
                        if ($insert === 0){
                            // Hubo un error al insertar
                            $error = array( 'type' => 'danner',
                                    'texto'  => 'Hubo un error al insertar el registro:'.json_encode($data['jform'])
                                    );
                        } else {
                            // Fue correcta insertar por lo que guardamos en sesion el id_contigomas
                            // Asi evitamos que con la mis session pueda duplicarse.
                            $ControlSession->set('id_contigomas',$insert);

                        }
                    } else {
                        // Quiere decir que el código ya existe por lo que no creamos
                        $error = array( 'type' => 'warning',
                                        'texto'  => 'Duplicado de codigo:'.$codigo
                                );
                    }
            }
            
            
            if ($insert >0 ) {
                $r = $this->getObtenerId($insert);
                if (isset ($r['error'])){
                    // hubo un error en la consulta.
                    $resultado['id'] = $insert;
                    $resultado['codigo'] = $codigo;
                    $error = array('type'=>'dannder','texto' => $r['error']);
                    $resultado['error'][] =$error;
                } else {
                    $resultado = $r['item'];
                }
            } else {
                $resultado = $data['jform'];
                $resultado['id'] = $insert;
                $resultado['codigo'] = $codigo;
            }
            if (isset($error)){
                // Hubo errores, añado los avisos
                $this->avisos($error);
                $resultado['error'][] =$error;
            }
                        
			return $resultado;
			
	}

    public function obtenerCodigo($datos){
        // Objetivo es obtener el codigo que vamos utilizar y comprobar que no existe , si existe no podemos grabarlo.
        $resultado = array();
        $nombre=substr($datos['nombre'], 0, 1);
        //~ $apellidos=explode(" ", $datos['apellidos']);
        $apellido1=substr($datos['apellido1'], 0, 1); 
        // Comprobamos si exite apellido 2, sino existe le ponemos un X
        if (!isset($datos['apellido2'])){
            $apellido2 = 'X';
        } else {
            $apellido2=substr($datos['apellido2'], 0, 1); 
        }
        
        $amd=date("Ymd");
		$hm=date("Hi");
        $codigo=$nombre.$apellido1.$apellido2.$amd.$hm;

        return $codigo;

        
    }
    public function comprobarCodigo($codigo){
        // Consultamos que no exista.
        $db = JFactory::getDBO();
		$query = $db->getQuery(true);
        $query->select('id, codigo,created, nombre, apellido1, apellido2, telefono, email, calle, numero, piso,codigopostal,municipio,provincia,terminos,base,regalo')
		->from('#__contigomas')
        ->where( $db->quoteName('codigo').' = "'.$codigo.'"');
        //~ $query = 'Select id, codigo from #__contigomas where codigo = "'.$codigo.'"';

        $db->setQuery($query);
		$db->execute();
        $resultado = $db->execute();
        
        return $resultado->num_rows;
    }
    
    public function getInsertQuery($datos){

        $fecha=date("Y-m-d H:i:s");
        $id = 0;
        $db = JFactory::getDBO();
		$query = $db->getQuery(true);
		// Como el check termino no es obligatorio, entonces voy a comprobar que existe, para evirta nocite.
        if (!isset($datos['terminos'])){
            $datos['terminos']= 0;
        }
		        
		$query='insert into #__contigomas (codigo, nombre, apellido1, apellido2, telefono, email, 
		calle, numero, piso, codigopostal, municipio, provincia, terminos,base,regalo, created,  modified) VALUES (
		"'.$datos['codigo'].'", "'.$datos['nombre'].'", "'.$datos['apellido1'].'", "'.$datos['apellido2'].'", "'.$datos['telefono'].'", "'.$datos['email'].'", 
		"'.$datos['calle'].'", "'.$datos['numero'].'", "'.$datos['piso'].'", "'.$datos['codigoPostal'].'", "'.$datos['municipio'].'", 
		"'.$datos['provincia'].'", "'.$datos['terminos'].'", '.'"'.$datos['base'].'", '.'"'.$datos['regalo'].'","'.$fecha.'", "'.$fecha.'")';
		$db->setQuery($query);
		$db->execute();
        $id= $db->insertid();
        if ($db->getErrorNum()){
			$id = 0;
		}
      return $id; 
	}


    public function avisos($error){
            if (gettype($error) == 'array') {
                // hubo un error, o se envio el formulario dos veces...
                $texto = $error['texto'];
                $typeAlerta = $error['type'];
                
            } 
            // enviamos el mensaje.
            JFactory::getApplication()->enqueueMessage($texto, $typeAlerta);

    }


    public function getObtenerId($id=null){
        // Obtener registro.    
        if ($id === null){
            $id = 0;
        }
        // Consultamos que no exista.
        $resultado = array();
        $db = JFactory::getDBO();
		$query = $db->getQuery(true);
        try{
            $query->select('id, codigo,created, nombre, apellido1, apellido2, telefono, email, calle, numero, piso,codigopostal,municipio,provincia,terminos,base,regalo')
            ->from('#__contigomas')
            ->where( $db->quoteName('id').' = "'.$id.'"');

            $db->setQuery($query);
            $db->execute();
            
            $resultado['item']=$db->loadAssoc();
        }catch (Exception $e) {
                $resultado['error']=$e->getMessage();
        }
        
        return $resultado;
    }


    public function getEnviarEmail($id){
        // Objetivo:
        // Enviar email con el codigo al que lo registro.
        $respuesta =  array( 'estado' =>'KO');
        $r= $this->getObtenerId($id);
        // Comprobamos si datos son correctos
        if (isset($r['item'])){
            if (trim ($r['item']['email']) ==''){
                // Error , esta vacio el email.
                $error = array( 'type' => 'warning',
                                'texto'  => 'Hubo un error al comprobar los datos del registro:'.$id.' ponte en contacto con nosotros y comentanosl'
                            );
                $this->avisos($error);
                $respuesta['error'] = $error;

            }
        }
        $r = $this->enviarEmail($r['item']);
        $respuesta['estado'] = $r;
        
        
        return $respuesta;

    }


    static function enviarEmail($datos)
	{

        	// Creamos distanatarios que puede ser un array
			$destinatario = $datos['email'];
			/* http://docs.joomla.org/Sending_email_from_extensions  */
        	// Antes de enviar tenemos que saber que hay email...
        	$mail = JFactory::getMailer();
			// Creamos el body del mensaje bien ...
                $body = '<h3>'.JText::_('COM_CODIGOMAS_RESPUESTA_TITULO_OK').'</h3>';
                $body .='<p>'.JText::_('COM_COTIGOMAS_TEXTO_CODIGOPROMOCIONAL').'</p>';
                 $body .= '<div class="columna-verde" style="margin:10px;">
                <h5 style="margin-top:5px;font-size:3em">'.$datos['codigo'].'</h5></div>';
            
				$body .= '<b>'. 'Hola '.'</b>:'.$datos['nombre'].' '.$datos['apellido1'].' '.$datos['apellido2'].'<br/>';
				$body .= '<p>'.JTEXT::_('COM_CONTIGOMAS_ENVIO_EMAIL_GRACIAS').'<br/>';
                $body .= '<b>'.' Ref:'.'</b>:'.$datos['id'].'<br/>';
               
				// Creo que para mandar por SMTP tengo añadir usuario y contraseña
				// Que la obtendo con ...
				$app = JFactory::getApplication();
				$mailfrom = $app->get('mailfrom');
				$fromname = $app->get('fromname');
				$sitename = $app->get('sitename');
				// Montamos subjecto con nombre formulario y asunto puesto.
				$subject = 'Web:'.$sitename .' - Envio Codigo ';

				// Ahora montamos el correo para enviarlos.
				$mail->isHTML(true); // Indicamos que el body puede tener html
				$mail->addRecipient($destinatario);
				//$mail->addReplyTo(array($email, $name));
				$mail->setSender(array($mailfrom, $fromname));
				$mail->setSubject($subject);
				$mail->setBody($body);


				// Envio de email
				$sent = $mail->Send();
				// Contestación de envio.
				if ( $sent !== true ) {
					/*echo '<pre>';
					print_r ($destinatario);
					echo '</pre>';*/
					$resultado = 'KO';

				} else {
					// Para añadir al array el resultado correcto.
					$resultado= 'OK';
				}


		return $resultado;
	}

    
    
}
