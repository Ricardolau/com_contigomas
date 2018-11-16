<?php
define('JOOMLA_MINIMUM_PHP', '5.3.10');

$resultado ='No';
$respuesta = array();
if (version_compare(PHP_VERSION, JOOMLA_MINIMUM_PHP, '<'))
{
	die('Your host needs to use PHP ' . JOOMLA_MINIMUM_PHP . ' or higher to run this version of Joomla!');
}

/**
 * Constant that is checked in included files to prevent direct access.
 * define() is used in the installation folder rather than "const" to not error for PHP 5.2 and lower
 */
define('_JEXEC', 1);
define('JPATH_BASE','./../../');// Ya sabemos ruta porque lo tenemos instalado en administrador/apisv 
if (!defined('_JDEFINES'))
{
	require_once JPATH_BASE . '/includes/defines.php';
}


require_once JPATH_BASE .'/includes/framework.php';

// require_once JPATH_BASE . '/includes/helper.php';
// require_once JPATH_BASE . '/includes/toolbar.php';
$Configuracion =  JFactory::getConfig();

$app = JFactory::getApplication('site');
$componentParams = JComponentHelper::getParams('com_contigomas');
//~ $plugin = JPluginHelper::getPlugin('system', 'apisv'); 

//~ $pluginParams = new JRegistry();
//~ $pluginParams->loadString($plugin->params);
//~ $clave = $pluginParams->get('clave_apisv');

$method = $_SERVER['REQUEST_METHOD'];
 
// tendremos que tratar esta variable para obtener el recurso adecuado de nuestro modelo.
$resource = $_SERVER['REQUEST_URI'];

// Dependiendo del método de la petición ejecutaremos la acción correspondiente.
//~ if (gettype($plugin) === 'object') {
    switch ($method) {
        case 'GET':
            // código para método GET
            //~ $output = fopen( "/home/solucion40/reports_2018-11-13.csv",'r');
            //~ fclose($output);
            if ($_GET['fichero']){
                $filename = $_GET['fichero'];
                $params = JComponentHelper::getParams('com_contigomas');
                $ruta_segura = $params->get('ruta_segura');
                $ruta_completa = $ruta_segura.'/'.$filename;
                if (file_exists ($ruta_completa)){
                    // Se debería bloquear el acceso si no esta logueado, es decir obtener la SESSION..
                    // para asi solo poder hacer la peticion desde administrator
                    header("Content-Type: application/force-download");
                    header('Content-Disposition: attachment; filename='.$filename);
                    header("Content-Length: ".filesize($ruta_completa));
                    readfile($ruta_completa);
                    // no puedo imprimir nada.. por eso cancelo. sino da un fallo
                    exit();
                } else {
                    // Si no existe el fichero indicamos error en nueva pestaña..
                    echo '<pre>';
                    echo ' Error no existe el fichero '.$filename;
                    echo '</pre>';
                }
            }
            break;
        case 'POST':
            // código para método POST
            break;

    }
//~ }


