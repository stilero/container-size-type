<?php

/**
 * @version     $Id$
 * @copyright   Copyright 2011 Stilero AB. All rights re-served.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
//No direct access
defined('_JEXEC) or die;');
$cont = $this->get('contInfo');
?>
<?php if( isset($cont['iso']) && isset($cont['group_desc']) ){ ?>
<h3><?php echo $cont['iso'].' - '.$cont['group_desc']; ?></h3>
<?php }else{ ?>
<h3><?php echo $cont['iso'].' - '.JText::_('NON_ISO_TYPE'); ?></h3>
<?php } ?>
<?php if( isset($cont['main_charact']) ): ?>
<div id="group_desc">
    <p><?php echo $cont['main_charact']; ?></p>
</div>
<?php endif; ?>
<h4><?php echo JText::_('MEASUREMENTS'); ?></h4>
<?php if( isset($cont['cont_length_mm']) ): ?>
<div class="cont_mea">
    <?php echo JText::_('LENGTH').': '.
            $cont['cont_length_ft'].' ft ('.
            $cont['cont_length_mm'].' mm)'; 
    ?>
</div>
<?php endif; ?> 
<?php if( isset($cont['cont_height_mm']) ): ?>
<div class="cont_mea">
    <?php echo JText::_('HEIGHT').': '.
            $cont['cont_height_ft'].' ft ('.
            $cont['cont_height_mm'].' mm)'; 
    ?>
</div>
<div class="cont_mea">
    <?php echo JText::_('WIDTH').': '.
            $cont['cont_width_ft'].'ft ('.
            $cont['cont_width_mm'].' mm)'; 
    ?>
</div>
<?php endif; ?> 