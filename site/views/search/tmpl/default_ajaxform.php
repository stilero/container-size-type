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
<div id="someID">
    <form id="ajaxForm">
        <input id="ajaxInput" name="q" maxlength="5" alt="<?php echo JText::_('SEARCH'); ?>" class="inputbox" 
           type="text" size="20" value="<?php echo JText::_('SEARCH'); ?>" 
       />
        <input type="button" id="ajaxButton" value="<?php echo JText::_('SEARCH') ?>" />
        <input type="hidden" name="option" value="<?php echo JRequest::getVar('option'); ?>" />
        <input type="hidden" name="view" value="<?php echo JRequest::getVar('view'); ?>" />
        <input type="hidden" name="format" value="raw" />
    </form>
</div>
<?php
$script = <<<SCRIPT
var ajaxFunction = function(){
    new Ajax(
        'index.php',
        {
            data: $('ajaxForm'),
            method: 'post',
            update: 'someID'
        }
     ).request();
}

window.addEvent('domready', function(){
    $('ajaxButton').addEvent('click', ajaxFunction);
});
SCRIPT;
JHTML::_('behavior.mootools');
$document =& JFactory::getDocument();
$document->addScriptDeclaration($script);
?>