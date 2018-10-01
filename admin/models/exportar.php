<?php
defined('_JEXEC') or die("Invalid access");
jimport('joomla.application.component.modellist');

//nomenclatura : nombreComponente+Model+nombreVista
//JModelList 
class ContigomasModelExportar extends JModelList
{
	protected function getListQuery()
	{
		//Crea un nuevo objeto de consulta
		$db = JFactory::getDBO();
		$query = $db->getQuery(true);
		// Selecciona algunos campos
		$query->select('id, codigo,created, nombre, apellidos, dni, telefono, email, calle, numero, piso,codigopostal,municipio,provincia,aceptar');
		// de nuestra tabla
		$query->from('#__contigomas');
		
		//columnas que se muestran, id  , ordenado asc...
		$orderCol	= $this->state->get('list.ordering', 'id');
		$orderDirn	= $this->state->get('list.direction', 'asc');
		//~ if ($orderCol == 'a.ordering' || $orderCol == 'category_title') {
			//~ $orderCol = 'c.title '.$orderDirn.', a.ordering';
		//~ }
		$query->order($db->escape($orderCol.' '.$orderDirn));
		
		
		
		return $query;
	}
    protected function getExportar(){
        $query = $this->getListQuery();
        if($query->num_rows > 0){
            $delimiter = ",";
            $filename = "members_" . date('Y-m-d') . ".csv";
            
            //create a file pointer
            $f = fopen('php://memory', 'w');
            
            //set column headers
            $fields = array('id', 'nombre', 'aoellidos', 'dni', 'telefono', 'email');
            fputcsv($f, $fields, $delimiter);
            
            //output each row of the data, format line as csv and write to file pointer
            while($row = $query->fetch_assoc()){
                $status = ($row['status'] == '1')?'Active':'Inactive';
                $lineData = array($row['id'], $row['name'], $row['email'], $row['phone'], $row['created'], $status);
                fputcsv($f, $lineData, $delimiter);
            }
            
            //move back to beginning of file
            fseek($f, 0);
            
            //set headers to download file rather than displayed
            header('Content-Type: text/csv');
            header('Content-Disposition: attachment; filename="' . $filename . '";');
            
            //output all remaining data on a file pointer
            fpassthru($f);
        }
    }

    
}
