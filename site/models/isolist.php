<?php

global $alt_libdir;
JLoader::import('joomla.application.component.modellist', $alt_libdir);
jimport('joomla.application.component.helper');

JTable::addIncludePath(JPATH_ROOT.'/administrator/components/com_containercode/tables');

class ContainercodeModelIsolist extends JModelList
{
	public function __construct($config = array())
	{		
	
		parent::__construct($config);		
	}
	
	public function getISOList(){
             $db =& JFactory::getDBO();
//            $sql = "SELECT CONCAT(a.code_char, b.code_char, c.type_code ) FROM `jos_containercode_sizecode_firstchar` AS a, `jos_containercode_sizecode_secondchar` AS b, `jos_containercode_sizecode_type` AS c WHERE a.published>0 AND b.published >0 AND c.published>0";
            $fields = array(
                $db->nameQuote('a.code_char'),
                $db->nameQuote('b.code_char'),
                $db->nameQuote('c.type_code')
            );
            $tblName = '#__containercode_sizecode_firstchar';
            $sql = 'SELECT CONCAT('.implode(', ', $fields).') FROM '.
                    $db->nameQuote('#__containercode_sizecode_firstchar').' AS a, '.
                    $db->nameQuote('#__containercode_sizecode_secondchar').' AS b, '.
                    $db->nameQuote('#__containercode_sizecode_type').' AS c '.
                    'WHERE '.
                    $db->nameQuote('a.published').' >0 AND '.
                    $db->nameQuote('b.published').' >0 AND '.
                    $db->nameQuote('c.published').' >0';
//            print $sql;exit;
            $db->setQuery($sql);
            $result = $db->loadResultArray();
            return $result;
        }

	
}