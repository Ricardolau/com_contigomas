<?php

// No direct access
defined('_JEXEC') or die;

			
class ContigomasModelRespuesta extends JModelList
{
	
	public function getComprobar()
	{
			
			$jinput = JFactory::getApplication()->input; 
            
            $data = $jinput->getArray($_POST);
            // Ahora montamos codigo.
            $arrayCodigo =$this->obtenerCodigo($data['jform']);
            if ($arrayCodigo['buscar'] == 0 ){
                // Solo mando grabar si fue correcta la busqueda , no encontro..
                $insertar = $this->getInsertQuery($data['jform']); 
            } else {
                // hubo un error en buscar por lo que añadimos mensaje ...
                $insertar   = $arrayCodigo['buscar'];
            }
            $this->avisos($insertar);
            if ($insertar == 0){
                // Fue correcto, me envio tb el codigo
                $data['codigo'] = $arrayCodigo['codigo'];
            }
            
			return $data;
			
	}

    public function obtenerCodigo($datos){
        // Objetivo es obtener el codigo que vamos utilizar y comprobar que no existe , si existe no podemos grabarlo.
        $resultado = array();
        $fecha='"'.date("Y-m-d H:i:s").'"';
        $nombre=substr($datos['nombre'], 0, 1);
        //~ $apellidos=explode(" ", $datos['apellidos']);
        $apellido1=substr($datos['apellido1'], 0, 1); 
        $apellido2=substr($datos['apellido2'], 0, 1); 
        //~ if ( count($apellidos) >1) {
       		//~ $apellido2=substr($apellidos[1], 0, 1); 
        //~ } else {
            //~ $apellido2= '';
        //~ }
        
        $amd=date("Ymd");
		$hm=date("Hi");
        $codigo=$nombre.$apellido1.$apellido2.$amd.$hm;
        $buscar = $this->comprobarCodigo($codigo);
        if ($buscar == 0){
            // Si resultado es mayor 0 , entonces es que existe... (error)
            $resultado['codigo'] = $codigo;
        }
        $resultado['buscar'] = $buscar;
        
        return $resultado;
    }
    public function comprobarCodigo($codigo){
        // Consultamos que no exista.
        $db = JFactory::getDBO();
		$query = $db->getQuery(true);
        $query->select('id, codigo,created, nombre, apellido1, apellido2, telefono, email, calle, numero, piso,codigopostal,municipio,provincia,aceptar')
		->from('#__contigomas')
        ->where( $db->quoteName('codigo').' = "'.$codigo.'"');
        //~ $query = 'Select id, codigo from #__contigomas where codigo = "'.$codigo.'"';

        $db->setQuery($query);
		$db->execute();
        $resultado = $db->execute();
        
        return $resultado->num_rows;
    }
    
    public function getInsertQuery($datos){
		$db = JFactory::getDBO();
		$query = $db->getQuery(true);
		
		$fecha='"'.date("Y-m-d H:i:s").'"';
		
		$nombre=substr($datos['nombre'], 0, 1);
		$apellido1=substr($datos['apellido1'], 0, 1);
		$apellido2=substr($datos['apellido2'], 0, 1);
		//~ $apellidos=explode(" ", $datos['apellidos']);
        //~ if ( count($apellidos) >1) {
            //~ $apellido2=substr($apellidos[1], 0, 1); 
        //~ } else {
            //~ $apellido2= '';
        //~ }
        //~ $apellido1=substr($apellidos[0], 0, 1); 
        
        //~ $expresion = '/^[9|6|7][0-9]{8}$/';
        //~ $bandera=0;
        //~ if(preg_match($expresion, $datos['telefono'])){ 
			//~ $bandera=1;
			//~ $texto="El teléfono no es correcto";
			//~ return $texto;
		//~ }else{
			 //~ $bandera=0;
		//~ } 
        
		$amd=date("Ymd");
		$hm=date("Hi");
		
		$codigo=$nombre.$apellido1.$apellido2.$amd.$hm;
		
		$query='insert into #__contigomas (codigo, nombre, apellido1, apellido2, telefono, email, 
		calle, numero, piso, codigopostal, municipio, provincia, aceptar, created,  modified) VALUES (
		"'.$codigo.'", "'.$datos['nombre'].'", "'.$datos['apellido1'].'", "'.$datos['apellido2'].'", "'.$datos['telefono'].'", "'.$datos['email'].'", 
		"'.$datos['calle'].'", "'.$datos['numero'].'", "'.$datos['piso'].'", "'.$datos['codigoPostal'].'", "'.$datos['municipio'].'", 
		"'.$datos['provincia'].'", "'.$datos['terminos'].'", '.$fecha.', '.$fecha.')';
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
                
            } else {
                $texto = 'El registro grabado correctamente';
                $typeAlerta = 'notice';
                

            }
            // enviamos el mensaje.
            JFactory::getApplication()->enqueueMessage($texto, $typeAlerta);




    }

    
}
