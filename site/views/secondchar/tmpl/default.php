<?php
// no direct access
defined('_JEXEC') or die('Restricted access');
?>
<div class="componentheading<?php echo $this->escape($this->params->get('pageclass_sfx')); ?>"><h2><?php echo $this->params->get('page_title');  ?></h2></div>
<h3><?php echo $this->item->code_char; ?></h3>
<div class="contentpane">
	<div><h4>Some interesting informations</h4></div>
	
	<div>
		Code_char: <?php echo $this->item->code_char; ?>
	</div>
	<div>
		Created: <?php echo $this->item->created; ?>
	</div>
	<div>
		Published: <?php echo $this->item->published; ?>
	</div>
	<div>
		Id: <?php echo $this->item->id; ?>
	</div>

</div>
