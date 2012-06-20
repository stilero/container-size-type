<?php
// no direct access
defined('_JEXEC') or die('Restricted access');
?>
<div class="componentheading<?php echo $this->escape($this->params->get('pageclass_sfx')); ?>"><h2><?php echo $this->params->get('page_title');  ?></h2></div>

<div class="contentpane">
    <h3><?php echo JText::_('ISO_CODES'); ?></h3>
    <table>
<?$i=0;?>    
<?php foreach ($this->isocodes as $isocode) : 
    if($i==0){
        echo '<tr>';
        $i=0;
    }
	$link = JRoute::_('index.php?view=search&q='. $isocode);	
        $i++;
	?>
	<td width="10"><a href="<?php echo $link ?>"><?php  echo $isocode; ?></a></td>
    <?php if ($i==15){
        echo '</tr>';
        $i=0;
    }?>
<?php endforeach; ?>
<?php if($i!=0) print'</tr>'; ?>
    </table>
</div>