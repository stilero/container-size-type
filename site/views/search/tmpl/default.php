<?php
// no direct access
defined('_JEXEC') or die('Restricted access');
?>
<div class="componentheading<?php echo $this->escape($this->params->get('pageclass_sfx')); ?>"><h2><?php echo $this->params->get('page_title');  ?></h2></div>

<div class="contentpane">
    <?php
    $searchPhrase = JRequest::getVar('q');
    if(isset($searchPhrase)){
        if(JRequest::getVar('format')!='raw'){
            JRequest::checkToken() or jexit('Invalid token');
        }
        $this->result();
    }else{ ?>
        <h3><?php echo JText::_('SEARCH_CONT_ISO'); ?></h3>
        <p><?php echo JText::_('SEARCH_CONT_ISO_DESC');?></p>
        <?php
        echo $this->loadTemplate('searchform');
        //echo $this->loadTemplate('ajaxform');



    }
    ?>    
</div>