<?php
// no direct access
defined('_JEXEC') or die('Restricted access');

  JToolBarHelper::title( JText::_( 'Type Code' ), 'generic.png' );
  JToolBarHelper::publishList();
  JToolBarHelper::unpublishList();
  JToolBarHelper::deleteList();
  JToolBarHelper::editListX();
  JToolBarHelper::addNewX();
  JToolBarHelper::preferences('com_containercode', '550');  
?>

<form action="index.php?option=com_containercode&amp;view=type" method="post" name="adminForm">
	<table>
		<tr>
			<td align="left" width="100%">
				<?php echo JText::_( 'Filter' ); ?>:
				<input type="text" name="search" id="search" value="<?php echo $this->lists['search'];?>" class="text_area" onchange="document.adminForm.submit();" />
				<button onclick="this.form.submit();"><?php echo JText::_( 'Go' ); ?></button>
				<button onclick="document.getElementById('search').value='';this.form.submit();"><?php echo JText::_( 'Reset' ); ?></button>
			</td>
			<td nowrap="nowrap">			
				<?php
 				  	echo $this->lists['state'];
  				?>  				
			</td>
		</tr>		
	</table>
<div id="editcell">
	<table class="adminlist">
		<thead>
			<tr>
				<th width="5">
					<?php echo JText::_( 'NUM' ); ?>
				</th>
				<th width="20">				
					<input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo count( $this->items ); ?>);" />
				</th>			

				<th class="title" width="5">
					<?php echo JHTML::_('grid.sort', 'Code', 'a.type_code', $this->lists['order_Dir'], $this->lists['order'] ); ?>
				</th>								
                                <th class="title" width ="5">
					<?php echo JHTML::_('grid.sort', 'Group', 'a.type_group_id', $this->lists['order_Dir'], $this->lists['order'] ); ?>
				</th>
                                <th class="title">
					<?php echo JHTML::_('grid.sort', 'Group Desc', 'a.group_desc', $this->lists['order_Dir'], $this->lists['order'] ); ?>
				</th>
                                <th class="title">
					<?php echo JHTML::_('grid.sort', 'Characteristics', 'a.main_charact', $this->lists['order_Dir'], $this->lists['order'] ); ?>
				</th>								<th class="title">
					<?php echo JHTML::_('grid.sort', 'Published', 'a.published', $this->lists['order_Dir'], $this->lists['order'] ); ?>
				</th>								<th class="title">
					<?php echo JHTML::_('grid.sort', 'Id', 'a.id', $this->lists['order_Dir'], $this->lists['order'] ); ?>
				</th>				
			</tr>
		</thead>
		<tfoot>
		<tr>
			<td colspan="12">
				<?php echo $this->pagination->getListFooter(); ?>
			</td>
		</tr>
	</tfoot>
	<tbody>
<?php
  $k = 0;
  if (count( $this->items ) > 0 ):
  
  for ($i=0, $n=count( $this->items ); $i < $n; $i++):
  
  	$row = &$this->items[$i];
 	$onclick = "";
  	
    if (JRequest::getVar('function', null)) {
    	$onclick= "onclick=\"window.parent.jSelectType_id('".$row->id."', '".$this->escape($row->type_code)."', '','id')\" ";
    }  	
    
 	$link = JRoute::_( 'index.php?option=com_containercode&view=type&task=edit&cid[]='. $row->id );
 	$row->id = $row->id; 	
 	$checked = JHTML::_('grid.id', $i, $row->id); 	
  	$published = JHTML::_('grid.published', $row, $i ); 	
 	
  ?>
	<tr class="<?php echo "row$k"; ?>">
		
		<td align="center"><?php echo $this->pagination->getRowOffset($i); ?>.</td>
        
        <td><?php echo $checked  ?></td>	

        <td>
							
							<a <?php echo $onclick; ?>href="<?php echo $link; ?>"><?php echo $row->type_code; ?></a>
 									
		</td>
        <td><?php echo $row->type_group_id ?></td>
        <td><?php echo $row->group_desc ?></td> 
        <td><?php echo $row->main_charact ?></td>
        <td><?php echo $published ?></td>
        <td><?php echo $row->id ?></td>		
	</tr>
<?php
  $k = 1 - $k;
  endfor;
  else:
  ?>
	<tr>
		<td colspan="12">
			<?php echo JText::_( 'There are no items present' ); ?>
		</td>
	</tr>
	<?php
  endif;
  ?>
</tbody>
</table>
</div>
<input type="hidden" name="option" value="com_containercode" />
<input type="hidden" name="task" value="type" />
<input type="hidden" name="view" value="type" />
<input type="hidden" name="boxchecked" value="0" />
<input type="hidden" name="filter_order" value="<?php echo $this->lists['order']; ?>" />
<input type="hidden" name="filter_order_Dir" value="" />
<?php echo JHTML::_( 'form.token' ); ?>
</form>  	