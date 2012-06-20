<?php

/**
 * @version     $Id$
 * @copyright   Copyright 2011 Stilero AB. All rights re-served.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
//No direct access
defined('_JEXEC) or die;');
jimport('joomla.html.html');
?>
<form action="index.php" method="post">
    <input name="q" maxlength="5" alt="<?php echo JText::_('SEARCH'); ?>" class="inputbox" 
           type="text" size="20" value="<?php echo JText::_('SEARCH'); ?>" 
           onblur="if(this.value=='') this.value='<?php echo JText::_('SEARCH') ?>';" 
           onfocus="if(this.value=='<?php echo JText::_('SEARCH') ?>') this.value='';"
           />
    <input name="btn" type="submit" value="<?php echo JText::_('SEARCH') ?>" />
    <input type="hidden" name="task" value="result" />
    <input type="hidden" name="view" value="<?php echo JRequest::getVar('view'); ?>" />
    <input type="hidden" name="option" value="<?php echo JRequest::getVar('option'); ?>" />
    <input type="hidden" name="Itemid" value="<?php echo JRequest::getInt('Itemid'); ?>" /> 
    <?php echo JHTML::_('form.token'); ?>
</form>
