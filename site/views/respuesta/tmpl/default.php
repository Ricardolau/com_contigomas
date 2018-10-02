<?php
// No direct access
defined('_JEXEC') or die('Restricted access');
JHtml::_('behavior.tooltip');
?>
<div class="contenido">
  <h1>
    <?php echo JText::_('COM_CODIGOMAS_RESPUESTA_TITULO');?>
  </h1>
  <p>
    <?php echo JText::_('COM_CONTIGOMAS_RESPUESTA_TITULO_SECUNDARIO');?>
  </p>
<?php
// Datos del formulario cubierto por si queremos meterlo.. 
$resultado = $this->resultado;
?>
<div>
    <?php echo JText::_('COM_CONTIGOMAS_RESPUESTA_TEXTO_SECUNDARIO');?>
</div>


</div>
