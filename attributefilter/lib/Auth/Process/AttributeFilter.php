<?php


/**
 * This module controls what attributes can be released to a specified sp.
 * 
 *  
 * @author Riccardo G. Valzorio <riccardo.valzorio@gmail.com>
 *
 */
class sspmod_attributefilter_Auth_Process_AttributeFilter extends SimpleSAML_Auth_ProcessingFilter {


	/**
	 * Policy list loaded from configuration file
	 */
	private $policy_list = array();


	/**
	 * Construct
	 */
	public function __construct() {
		$config = SimpleSAML_Configuration::getConfig('module_attfilter.php');
		$this->policy_list = $config->toArray();
		
	}

	/* (non-PHPdoc)
	 * @see SimpleSAML_Auth_ProcessingFilter::process()
	 */
	public function process(&$request) {
								
		$entityID = $request['core:SP'];
		$attributes =& $request['Attributes'];
		$attr_map = $this->setAttrMap();
		
		$attrs_to_release = array();
		
		if (is_array($this->policy_list[$entityID])) {
			foreach ($attributes as $attr => $value) {				
				//removing urn
				if (array_key_exists($attr, $attr_map)) {
					$norm_attr = $attr_map[$attr];
				} else { 
					$norm_attr = $attr;
				}
				if (in_array($norm_attr, $this->policy_list[$entityID])) {
					$attrs_to_release[$attr] = $attributes[$attr];
				}
			}
			$attributes = $attrs_to_release;
		} 
	}
	
	/**
	 * Function that returns an array with attribute mapping
	 * 
	 * @param String $attributemap
	 * @return array
	 */
	private function setAttrMap($attributemap='removeurnprefix') {
		$config = SimpleSAML_Configuration::getInstance();
		include($config->getPathValue('attributemap', 'attributemap/') . $attributemap . '.php');
		return $attributemap;
	}
}

?>
