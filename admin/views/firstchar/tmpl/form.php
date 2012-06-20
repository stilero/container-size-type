<?php
// no direct access
defined('_JEXEC') or die('Restricted access');
JHtml::_('behavior.tooltip');
JHtml::_('behavior.formvalidation');

// Set toolbar items for the page
$edit		= JRequest::getVar('edit', true);
$text = !$edit ? JText::_( 'New' ) : JText::_( 'Edit' );
JToolBarHelper::title(   JText::_( 'Firstchar' ).': <small><small>[ ' . $text.' ]</small></small>' );
JToolBarHelper::apply();
JToolBarHelper::save();
if (!$edit) {
	JToolBarHelper::cancel();
} else {
	// for existing items the button is renamed `close`
	JToolBarHelper::cancel( 'cancel', 'Close' );
}
?>

<script language="javascript" type="text/javascript">
<?php 
$jv = new JVersion();
if ($jv->RELEASE < 1.6): ?>

function submitbutton(task)
{
    var form = document.adminForm;
    if (task == 'cancel' || document.formvalidator.isValid(form)) {
		submitform(task);
	}
}
<?php else: ?>

Joomla.submitbutton = function(task)
{
	if (task == 'cancel' || document.formvalidator.isValid(document.id('adminForm'))) {
		Joomla.submitform(task, document.getElementById('adminForm'));
	}
}

<?php endif; ?>
</script>

	 	<form method="post" action="index.php" id="adminForm" name="adminForm">
	 	<div class="col width-70 fltlft">
		  <fieldset class="adminform">
			<legend><?php echo JText::_( 'Details' ); ?></legend>
							
				<?php echo $this->form->getLabel('code_char'); ?>
				
				<?php echo $this->form->getInput('code_char');  ?>
					
				<?php echo $this->form->getLabel('cont_length_mm'); ?>
				
				<?php echo $this->form->getInput('cont_length_mm');  ?>
					
				<?php echo $this->form->getLabel('cont_length_ft'); ?>
				
				<?php echo $this->form->getInput('cont_length_ft');  ?>
					
		
				<div class="clr"></div>
					
					
				<?php echo $this->form->getLabel('description'); ?>
				
					
				<div class="clr"></div>
					
				<?php echo $this->form->getInput('description');  ?>
					
							
				<?php echo $this->form->getLabel('published'); ?>
				
				<?php echo $this->form->getInput('published');  ?>
			
						
          </fieldset>                      
        </div>
        <div class="col width-30 fltrt">
		        
			<fieldset class="adminform">
				<legend><?php echo JText::_( 'Parameters' ); ?></legend>
							
				<?php echo $this->form->getLabel('access'); ?>
				
				<?php echo $this->form->getInput('access');  ?>
					
				<?php echo $this->form->getLabel('modified'); ?>
				
				<?php echo $this->form->getInput('modified');  ?>
					
				<?php echo $this->form->getLabel('created_by'); ?>
				
				<?php echo $this->form->getInput('created_by');  ?>
					
				<?php echo $this->form->getLabel('created'); ?>
				
				<?php echo $this->form->getInput('created');  ?>
								
			</fieldset>
			        

        </div>                   
		<input type="hidden" name="option" value="com_containercode" />
	    <input type="hidden" name="cid[]" value="<?php echo $this->item->id ?>" />
		<input type="hidden" name="task" value="" />
		<input type="hidden" name="view" value="firstchar" />
		<?php echo JHTML::_( 'form.token' ); ?>
	</form>