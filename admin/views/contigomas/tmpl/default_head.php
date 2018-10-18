<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted Access');
// Definimos texto de cabeceras vista listado
$listOrder      = $this->escape($this->state->get('list.ordering', 'id'));
$listDirn       = $this->escape($this->state->get('list.direction', 'asc'));
?>

<tr>

	<th width="1%">
		<input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo count($this->items); ?>);" />
	</th>
	<th width="2%">
		<?php echo  JHTML::_('grid.sort', 'Id', 'id', $listDirn, $listOrder); ?>
	</th>	
	<th width="5%">
		<?php echo  JHTML::_('grid.sort', 'Código', 'codigo', $listDirn, $listOrder); ?>
	</th>		
	<th width="2%">
		<?php echo  JHTML::_('grid.sort', 'Fecha', 'created', $listDirn, $listOrder); ?>
	</th>			
	<th width="15%">
		<?php echo  'Nombre Completo'; ?>
	</th>
	<th width="5%">
		<?php echo  JHTML::_('grid.sort', 'Codigo Postal', 'codigopostal', $listDirn, $listOrder); ?>
	</th>
	
	<th width="5%">
		<?php echo  JHTML::_('grid.sort', 'Teléfono', 'telefono', $listDirn, $listOrder); ?>
	</th>
	<th width="5%">
		<?php echo  JHTML::_('grid.sort', 'EMAIL', 'email', $listDirn, $listOrder); ?>
	</th>
	
	<th width="5%">
		<?php echo  JHTML::_('grid.sort', 'Municipio', 'municipio', $listDirn, $listOrder); ?>
	</th>
	<th width="5%">
		<?php echo  JHTML::_('grid.sort', 'Provincia', 'provincia', $listDirn, $listOrder); ?>
	</th>
    <th width="5%">
		<?php echo  JHTML::_('grid.sort', 'Terminos', 'terminos', $listDirn, $listOrder); ?>
	</th>
    <th width="5%">
		<?php echo  JHTML::_('grid.sort', 'Base', 'base', $listDirn, $listOrder); ?>
	</th>
	<th width="5%">
		<?php echo  JHTML::_('grid.sort', 'Regalo', 'regalo', $listDirn, $listOrder); ?>
	</th>
	
</tr>
