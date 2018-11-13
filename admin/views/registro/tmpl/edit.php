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
?>

<form action="<?php echo JRoute::_('index.php?option=com_contigomas&layout=edit&id='.(int) $this->item->id); ?>"
      method="post" name="adminForm" id="adminForm">
        <fieldset class="adminform">
                <legend><?php echo JText::_( 'COM_CONTIGOMAS_DETAILS' ); ?></legend>
                <div class="form-horizontal">
					<?php foreach($this->form->getFieldset() as $field): ?>
                        <div class="control-group">
							<div class="control-label">
							<?php echo $field->label;?>
							</div>
							<div class="controls">
							<?php echo $field->input;?>
							</div>
                        </div>
					<?php  endforeach; ?>
                </div>
        </fieldset>
        <div>
                <input type="hidden" name="task" value="registro.edit" />
                <?php echo JHtml::_('form.token'); ?>
        </div>
</form>
