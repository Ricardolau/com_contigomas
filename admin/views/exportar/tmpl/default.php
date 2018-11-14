<?php
/*
echo $this->mensaje;
echo '<pre>';
	 print_r($this);
echo '</pre>';
*/
// No direct access
defined('_JEXEC') or die('Restricted access');
JHtml::_('behavior.tooltip');
echo '<h2>';
echo ' Descarga de registros de componente CONTIGO MAS';
echo '</h2>';
$document = JFactory::getDocument();

if ($this->respuesta['creado'] == 'OK'){
    
    echo '<div class="tab-description alert alert-info"> Correcta la creacion del CSv</div>';
    
echo '<a href="./apisv/descarga.php?fichero='.$this->respuesta['filename'].'"</a>Descargar</a>';

} else {
    echo '<div class="tab-description alert alert-warning"> Error a la hora crear CSv</div>';

    echo '<pre>';
        print_r($this->respuesta);
    echo '</pre>';
}

?>


