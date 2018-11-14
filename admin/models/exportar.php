<?php
defined('_JEXEC') or die("Invalid access");
jimport('joomla.application.component.modellist');

//nomenclatura : nombreComponente+Model+nombreVista
//JModelList 
class ContigomasModelExportar extends JModelList
{
	public function getListQuery()
	{
		//Crea un nuevo objeto de consulta
		$db = JFactory::getDBO();
		$query = $db->getQuery(true);
		// Selecciona algunos campos
		$query->select('id, codigo,created, nombre, apellido1, apellido2, telefono, email, calle, numero, piso,codigopostal,municipio,provincia,terminos,base,regalo');
		// de nuestra tabla
		$query->from('#__contigomas');
		
		//columnas que se muestran, id  , ordenado asc...
		$orderCol	= $this->state->get('list.ordering', 'id');
		$orderDirn	= $this->state->get('list.direction', 'asc');
		
		$query->order($db->escape($orderCol.' '.$orderDirn));
		$db->setQuery($query);
		$respuesta = $db->execute();
		
		return $respuesta;
	}
    public function getExportar(){
        // Objetivo:
        // Crear un csv y guardarlo en una ruta segura.
        $respuesta = array();
        // Antes de hacer nada comprobamos que obtenemos la ruta segura y vemos si existe.
        $params = JComponentHelper::getParams('com_contigomas');
        $ruta_segura = $params->get('ruta_segura');
        $filename = "reports_" . date('Y-m-d') . ".csv";
        $respuesta['link']= $ruta_segura.'/'.$filename;
        if (is_dir($ruta_segura) || strlen(trim($ruta_segura)) == 0){
            $query = $this->getListQuery();
            if($query->num_rows > 0){
                $delimiter = ",";
                
                //create a file pointer
                //~ $f = fopen('php://memory', 'w');
                $f =  fopen($ruta_segura.'/'.$filename, 'w');
                //set column headers
                $fields = array('id','codigo','created', 'Nombre y Apellidos', 'telefono', 'email', 'calle', 'numero', 'piso','codigopostal','municipio','provincia','terminos','base','regalo');
                fputcsv($f, $fields, $delimiter);
                
                //output each row of the data, format line as csv and write to file pointer
                while($row = $query->fetch_assoc()){
                    $terminos = ($row['terminos'] == 1 ? 'OK' : 'KO');
                    $base = ($row['base'] == 1 ? 'OK' : 'KO'); 
                    switch ($row['regalo']) {
                        case '0':
                            $regalo = 'Vale Vivero';
                            break;
                        case '1':
                            $regalo = 'Vale Supermercado Gadis';
                            break;
                        case '2':
                            $regalo = 'Vale Repsol';
                            break;

                    }
                    $lineData = array(  $row['id'],
                                        $row['codigo'],
                                        $row['created'],
                                        $row['nombre'].' '.$row['apellido1'].' '.$row['apellido2'],
                                        $row['telefono'],
                                        $row['email'],
                                        $row['calle'],
                                        $row['numero'],
                                        $row['piso'],
                                        $row['codigopostal'],
                                        $row['municipio'],
                                        $row['provincia'],
                                        $terminos,
                                        $base,
                                        $regalo

                                    );
                    fputcsv($f, $lineData, $delimiter);
                }
                
                //move back to beginning of file
                fseek($f, 0);
                
                //set headers to download file rather than displayed
                $r = fpassthru($f);
                if ( $r=== FALSE){
                    // Error al crear fichero
                    $respuesta['creado'] = 'KO';
                    $respuesta['error'] = 'Error a la hora de escritura del fichero';

                } else {
                    $respuesta['creado'] = 'OK';

                };
                
            }
        } else {
            $respuesta['creado'] = 'KO';
            $respuesta['error'] = 'No es correcta la ruta segura:'.$ruta_segura;
            
            if (strlen(trim($ruta_segura)) == 0){
                $respuesta['error'] = 'No esta definida la ruta, vete opciones del componente';
            }
        }
        $respuesta['filename'] = $filename;
        //~ $respuesta['parametros'] = $params;
        return $respuesta;
    }

    public function getDescargar(){
        $respuesta = array();
        $respuesta['entro'] = 'Entro';
        return $respuesta;

    }

    
}
