<?php

defined('JPATH_BASE') or die;

jimport('joomla.html.html');

JFormHelper::loadFieldClass('list');
require_once (JPATH_ADMINISTRATOR.DS.'components'.DS.'com_containercode'.DS.'helpers'.DS.'query.php' );

/**
 * Form Field class.
 */
class JFormFieldContainercodetype extends JFormFieldList
{
	/**
	 * The field type.
	 *
	 * @var		string
	 */
	public $type = 'Containercodetype';

	/**
	 * Method to get a list of options for a list input.
	 *
	 * @return	array		An array of JHtml options.
	 */
	protected function getOptions()
	{
		$db		= &JFactory::getDbo();
		$query	= new JQuery;

		$query->select('id AS value, type_code AS text');
		$query->from('#__containercode_sizecode_type');
		$query->order('type_code DESC');

		// Get the options.
		$db->setQuery($query->__toString());

		$options = $db->loadObjectList();

		// Check for a database error.
		if ($db->getErrorNum()) {
			JError::raiseWarning(500, $db->getErrorMsg());
		}


		$options	= array_merge(
			parent::getOptions(),
			$options
		);

		return $options;
	}
}