<?php
// No direct access
defined('_JEXEC') or die('Restricted access');
JHtml::_('behavior.tooltip');
$resultado = $this->resultado;; 
?>
 <div class="contenido contigomas">
   <div class="category-name" style="margin-top: 40px;">
        <h2><?php echo JText::_('COM_CONTIGOMAS_FIELD_CONFIG_TEXTO_SECUNDARIO_LABEL');?></h2>
        <h1> 
            <?php echo JText::_('COM_CODIGOMAS_FIELD_CONFIG_TEXTO_PRINCIPAL_LABEL');?>
        </h1>
    </div>
    <div class="pasos">
        <div id="paso_1" class="paso Activa">
            <span class="titulo">PASO 1</span>
            <p><?php echo JText::_('COM_CONTIGOMAS_PASO1_DESC');?></p>
        </div>
        <div id="paso_2" class="paso Activa">
            <span class="titulo">PASO 2</span>
              <p><?php echo JText::_('COM_CONTIGOMAS_PASO2_DESC');?></p>
        </div>
        <div id="paso_3" class="paso Activa">
            <span class="titulo">PASO 3</span>
             <p><?php echo JText::_('COM_CONTIGOMAS_PASO3_DESC');?></p>
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

                <div class="btn-email">
                <form id="cotigomas-email" action="<?php echo JRoute::_('index.php'); ?>" method="get">
                <button class="button validate" type="submit"><?php echo JText::_('COM_CONTIGOMAS_CONTIGOMAS_ENVIO_EMAIL'); ?></button>
					<input type="hidden" name="option" value="com_contigomas" />
					<?php // El siguiente input, añade task a objeto controller y indica la controlador expecifico y funcion ;?>
					<input type="hidden" name="task" value="submit" />
					<?php echo JHtml::_( 'form.token' ); ?>
                </form>
            </div>

                
                <?php

            } else  {
                echo '<h3>'.JText::_('COM_CODIGOMAS_RESPUESTA_TITULO_KO').'</h3>';
                echo '<p>'.JText::_('COM_CONTIGOMAS_RESPUESTA_TITULO_SECUNDARIO_KO').'</p>';
            }
            ?>
        </div>
   
    </div>
</div>
