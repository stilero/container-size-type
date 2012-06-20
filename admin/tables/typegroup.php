<?php
/**
* @version		$Id:typegroup.php  1 2012-03-16 11:19:06Z Stilero Webdesign $
* @package		Containercode
* @subpackage 	Tables
* @copyright	Copyright (C) 2012, Daniel Eliasson Stilero Webdesign. All rights reserved.
* @license #http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
*/

// no direct access
defined('_JEXEC') or die('Restricted access');

/**
* Jimtawl TableTypegroup class
*
* @package		Containercode
* @subpackage	Tables
*/
class TableTypegroup extends JTable
{
	
   /** @var int id- Primary Key  **/
   public $id = null;

   /** @var varchar type_group_code  **/
   public $type_group_code = null;

   /** @var tinyint published  **/
   public $published = null;

   /** @var datetime created  **/
   public $created = null;

   /** @var int created_by  **/
   public $created_by = null;

   /** @var datetime modified  **/
   public $modified = null;

   /** @var int modified_by  **/
   public $modified_by = null;

   /** @var tinyint access  **/
   public $access = "1";

   /** @var text type_desc  **/
   public $type_desc = null;




	/**
	 * Constructor
	 *
	 * @param object Database connector object
	 * @since 1.0
	 */
	public function __construct(& $db) 
	{
		parent::__construct('#__containercode_sizecode_typegroup', 'id', $db);
	}

	/**
	* Overloaded bind function
	*
	* @acces public
	* @param array $hash named array
	* @return null|string	null is operation was satisfactory, otherwise returns an error
	* @see JTable:bind
	* @since 1.5
	*/
	public function bind($array, $ignore = '')
	{ 
		
		return parent::bind($array, $ignore);		
	}

	/**
	 * Overloaded check method to ensure data integrity
	 *
	 * @access public
	 * @return boolean True on success
	 * @since 1.0
	 */
	public function check()
	{		
		if (!$this->created) {
			$date = JFactory::getDate();
			$this->created = $date->toFormat("%Y-%m-%d %H:%M:%S");
		}

		/** check for valid name */
		/**
		if (trim($this->type_group_code) == '') {
			$this->setError(JText::_('Your Typegroup must contain a type_group_code.')); 
			return false;
		}
		**/		

		return true;
	}
}
