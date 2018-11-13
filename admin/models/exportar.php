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
        // Antes de hacer nada comprobamos que exista la ruta segura.
        $ruta_segura = '/home/solucion40/w3ww';
        $filename = "reports_" . date('Y-m-d') . ".csv";

        if (is_dir($ruta_segura)){
            $query = $this->getListQuery();
            if($query->num_rows > 0){
                $delimiter = ",";
                
                //create a file pointer
                //~ $f = fopen('php://memory', 'w');
                $f =  fopen($ruta_segura.'/'.$filename, 'w');
                //set column headers
                $fields = array('id','codigo','created', 'nombre', 'apellido1', 'apellido2', 'telefono', 'email', 'calle', 'numero', 'piso','codigopostal','municipio','provincia','terminos','regalo','base');
                fputcsv($f, $fields, $delimiter);
                
                //output each row of the data, format line as csv and write to file pointer
                while($row = $query->fetch_assoc()){
                    $lineData = array($row['id'], $row['nombre'], $row['email'], $row['telefono']);
                    fputcsv($f, $lineData, $delimiter);
                }
                
                //move back to beginning of file
                fseek($f, 0);
                
                //set headers to download file rather than displayed
                
                if (fpassthru($f) === FALSE){
                    // Error al crear fichero
                    $respuesta['creado'] = 'KO';
                    $respuesta['error'] = 'Error a la hora de escritura del fichero';

                } else {
                    $respuesta['creado'] = 'OK';

                };
                
            }
        } else {
            $respuesta['creado'] = 'KO';
            $respuesta['error'] = 'No es correcta la ruta segura';
        }
        $respuesta['filename'] = $filename;

        return $respuesta;
    }

    
}
