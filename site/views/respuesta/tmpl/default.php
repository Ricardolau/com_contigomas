<?php
// No direct access
defined('_JEXEC') or die('Restricted access');
JHtml::_('behavior.tooltip');
$r= $this->resultado;
$resultado = $r['jform']; 
?>
 <div class="contenido contigomas">
   <div class="category-name" style="margin-top: 40px;">
        <h2><?php echo JText::_('COM_CONTIGOMAS_FIELD_CONFIG_TEXTO_SECUNDARIO_LABEL');?></h2>
        <h1> 
            <?php // opc del componente PROBLEMA: solo tiene acceso el administrador
                //params esta asignado en la view.html para poder recoger los parametros de opc dl componente
            //	echo '************'.$this->params->get('page_heading').'<br/>';
                
                 echo JText::_('COM_CODIGOMAS_FIELD_CONFIG_TEXTO_PRINCIPAL_LABEL');

                ?>
        </h1>
    </div>
        
    <div class="respuesta_contigomas">
        <?php
        if ( isset($resultado['codigo']) ){
            echo '<h3>'.JText::_('COM_CODIGOMAS_RESPUESTA_TITULO_OK').'</h3>';
            echo '<p>'.JText::_('COM_COTIGOMAS_TEXTO_CODIGOPROMOCIONAL').'</p>';
            ?>
            <div class="columna-verde" style="display: table;margin:10px auto;">
            <h5 style="margin-top:5px;"><?php echo $resultado['codigo'] ;?></h5>
            </div>
            <?php
            echo '<p>'.JText::_('COM_CONTIGOMAS_RESPUESTA_TITULO_SECUNDARIO_OK').'</p>';
            echo '<p>'.JText::_('COM_CONTIGOMAS_RESPUESTA_TEXTO_OK').'</p>';
            ?>
            <div class="contigomas_eslogan">
            <?php echo '<h4>'.JText::_('COM_CONTIGOMAS_ESLOGAN').'</h4>';?>
            </div>
            <?php

        } else  {
            echo '<h3>'.JText::_('COM_CODIGOMAS_RESPUESTA_TITULO_KO').'</h3>';
            echo '<p>'.JText::_('COM_CONTIGOMAS_RESPUESTA_TITULO_SECUNDARIO_KO').'</p>';
        }
        ?>
    </div>
   
</div>
