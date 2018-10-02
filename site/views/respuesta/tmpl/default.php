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
    <?php echo JText::_('COM_CONTIGOMAS_RESPUESTA_TEXTO_SECUNDARIO');?>
  </p>
<?php
// Datos del formulario cubierto por si queremos meterlo.. 
$resultado = $this->resultado;
?>
<ol>
    <li>Recibirás un e-mail en las próximas horas con tu número de promoción personal</li>
    <li>Guárdalo y comunícaselo a tu referidos</li>
    <li>Tus referidos nos comunicarán el número de promoción y cerrarán la venta</li>
    <li>Ambos recibiréis el obsequio en los siguientes días</li>
</ol>


</div>
