<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted Access');
?>

<?php 

foreach($this->items as $i => $item): ?>
	<tr class="row<?php echo $i % 2; ?>">
		<td>
			<?php echo JHtml::_('grid.id', $i, $item->id); ?>
		</td>
		<td>
			<?php echo $item->id; ?>
		</td>	
		<td>
			<?php echo $item->codigo; ?>
		</td>		
		<td>
			<?php echo $item->created; ?>
		</td>	
		<td>
			<?php echo $item->nombre.' '.$item->apellido1.' '.  $item->apellido2; ?>
		</td>
		<td>
			<?php echo $item->codigopostal; ?>
		</td>
		<td>
			<?php echo $item->telefono; ?>
		</td>
		<td>
			<?php echo $item->email; ?>
		</td>
		<td>
			<?php echo $item->municipio; ?>
		</td>
		<td>
			<?php echo $item->provincia; ?>
		</td>
		<td>
			<?php echo $item->terminos; ?>
		</td>
        <td>
			<?php echo $item->base; ?>
		</td>
        <td>
			<?php echo $item->regalo; ?>
		</td>
        
        
	</tr>
<?php endforeach; ?>
<!--JHTML :: _ es una función auxiliar capaz de mostrar varios salida HTML.
 En este caso, se mostrará una casilla de verificación para el elemento.
-->
