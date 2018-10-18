<?php

// No direct access
defined('_JEXEC') or die;

			
class ContigomasModelRespuesta extends JModelList
{
	
	public function getComprobar()
	{
			
			$jinput = JFactory::getApplication()->input; 
            
            $data = $jinput->getArray($_POST);
            
            // Ahora creamos codigo.
            $codigo =$this->obtenerCodigo($data['jform']);
            $control = $this->comprobarCodigo($codigo);
           
            if ($control == 0 ){
                // Añdimos el codigo a data, para mandar grabar ya que no existe ese codigo.
                $codigo = array('codigo' => $codigo);
                $data['jform']= $data['jform']+$codigo;
                $insertar = $this->getInsertQuery($data['jform']);
            } else {
                // hubo un error en buscar por lo que añadimos mensaje ...
                $insertar   = 1;
            
            }
            
            if ($insertar > 0){
                // Fue correcto, me envio tb el codigo
                $this->avisos($control);;
            }
            
			return $data;
			
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
		if ($db->getErrorNum()){
			$respuesta = 1;
		}else{
			$respuesta = 0;
		}
      return $respuesta; 
	}


    public function avisos($respuesta){
            if ($respuesta > 0) {
                // hubo un error, o se envio el formulario dos veces...
                $texto = 'El registro ya existe o hubo error al insertar, por favor ponte en contacto con el responsable de la web';
                $typeAlerta = 'warning';
                
            } 
            // enviamos el mensaje.
            JFactory::getApplication()->enqueueMessage($texto, $typeAlerta);




    }

    
}
