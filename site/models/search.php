<?php

global $alt_libdir;
JLoader::import('joomla.application.component.modellist', $alt_libdir);
jimport('joomla.application.component.helper');

JTable::addIncludePath(JPATH_ROOT.'/administrator/components/com_containercode/tables');

class ContainercodeModelSearch extends JModelList
{
	public function __construct($config = array())
	{		
	
		parent::__construct($config);		
	}
	
        public function queryContainer($isoCode){
            $sanitizedISO = preg_replace( '[^0-9A-V]', '', strtoupper($isoCode));
            if ( count($sanitizedISO) < 1  ){
                return $contInfo = array('error'=>  JText::_('NOT_ISO'));
            }
            $contInfo = array('iso'=>$sanitizedISO);
            $char1 = substr($isoCode, 0, 1);
            $char2 = substr($isoCode, 1, 1);            
            $typeChar = substr($isoCode, 2, 2);
            $len = $this->_fetchContainerLength($char1);
            $width = $this->_fetchContainerWidthHeight($char2);
            $type = $this->_fetchContainerType($typeChar);
            if( isset($len[0]) ){
                $contInfo = array_merge($contInfo, $len[0]);
            }else{
                return $contInfo = array('error'=>  JText::_('NOT_ISO'));
            }
            if( isset($width[0]) ){
                $contInfo = array_merge($contInfo, $width[0]);
            }
            if( isset($type[0]) ){
                $contInfo = array_merge($contInfo, $type[0]);
            }
            if (!isset($width[0]) && !isset($type[0]) ){
                $contInfo = array('error'=>  JText::_('NOT_ISO'));
            }
            return $contInfo;
        }
        
        private function _fetchContainerLength($codeChar){
            $fields = array(
                'cont_length_mm',
                'cont_length_ft'
            );
            $whereParts = array(
                'code_char' => $codeChar
            );
            $tblName = '#__containercode_sizecode_firstchar';
            $result = $this->_queryDB($fields, $whereParts, $tblName);
            return $result;
        }
        
        private function _fetchContainerWidthHeight($codeChar){
            $fields = array(
                'cont_height_mm',
                'cont_height_ft',
                'cont_width_mm',
                'cont_width_ft'
            );
            $whereParts = array(
                'code_char' => $codeChar
            );
            $tblName = '#__containercode_sizecode_secondchar';
            $result = $this->_queryDB($fields, $whereParts, $tblName);
            return $result;
        }
        
        private function _fetchContainerType($codeChar){
            $fields = array(
                'type_group_id',
                'group_desc',
                'main_charact'
            );
            $whereParts = array(
                'type_code' => $codeChar
            );
            $tblName = '#__containercode_sizecode_type';
            $result = $this->_queryDB($fields, $whereParts, $tblName);
            return $result;
        }
        
        private function _queryDB($fieldsArray, $whereArray, $tableName){
            $db =& JFactory::getDBO();
            $whereParts = $whereArray;
            $sql = 'SELECT ';
            for($i = 0; $i<count($fieldsArray); $i++){
                $fieldsArray[$i] = $db->nameQuote($fieldsArray[$i]);
            }
            $sql .= implode(', ', $fieldsArray);
            $sql .= ' FROM '. $db->nameQuote($tableName);
            $sql .= ' WHERE ';
            $whereArray = array();
            foreach ($whereParts as $key => $value) {
                $whereArray[] = $db->nameQuote($key).'='.$db->quote($value);
            }
            $sql .= implode(' AND ', $whereArray);
            $db->setQuery($sql);
            $result = $db->loadAssocList();
            return $result;
        }
        
	protected function populateState($ordering = null, $direction = null)
	{
			parent::populateState();
			$app = JFactory::getApplication();
			$id = JRequest::getVar('id', 0, '', 'int');
			$this->setState('firstcharlist.id', $id);			
	}

	protected function getStoreId($id = '')
	{
		// Compile the store id.
		$id	.= ':'.$this->getState('firstcharlist.id');

		return parent::getStoreId($id);
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
        
        protected function _getWidthList(){
            $fields = array(
                'code_char',
            );
            $whereParts = array();
            $tblName = '#__containercode_sizecode_secondchar';
            $result = $this->_queryDB($fields, $whereParts, $tblName);
            return $result;
        }
        
        protected function _getTypeList(){
            $fields = array(
                'type_code',
            );
            $whereParts = array();
            $tblName = '#__containercode_sizecode_type';
            $result = $this->_queryDB($fields, $whereParts, $tblName);
            return $result;
        }
        
	/**
	 * Method to get a JDatabaseQuery object for retrieving the data set from a database.
	 *
	 * @return	object	A JDatabaseQuery object to retrieve the data set.
	 */
	protected function getListQuery()
	{
		
		//check the version
		$jv = new JVersion();
		if ($jv->RELEASE < 1.6) {
			$query = & $this->query;	
		} else {
				$db		= $this->getDbo();
				$query	= $db->getQuery(true);			
		}
	
		$catid = (int) $this->getState('authorlist.id', 1);		
		$query->select('a.*');
		$query->from('#__containercode_sizecode_firstchar as a');	
		$query->where('a.published>0');					
		return $query;
	}	
}