<?php


/**
 * This module controls what attributes can be released by default, to a specified
 * EntityID or by using a regular expression based on the EntityID
 * 
 * @author Riccardo G. Valzorio <riccardo.valzorio@gmail.com>/<valzorio@cilea.it>
 *
 */
class sspmod_attributepolicy_Auth_Process_AttributePolicy extends SimpleSAML_Auth_ProcessingFilter {


	/**
	 * Policy list loaded from configuration file
	 */
	private $policy_list = array();


	/**
	 * Construct
	 */
	public function __construct() {
		$config = SimpleSAML_Configuration::getConfig('module_attributepolicy.php');
		$this->policy_list = $config->toArray();
		
		assert(is_array($this->policy_list));

		if (!isset($this->policy_list)) {
			throw new Exeption('Error in loading policies. Check configuration file!');
		}
	}

	/* (non-PHPdoc)
	 * @see SimpleSAML_Auth_ProcessingFilter::process()
	 */
	public function process(&$request) {
								
		$entityID = $request['core:SP'];
		$attributes =& $request['Attributes'];
		$attr_map = $this->setAttrMap();
		
		$attrs_to_release = array();
		
		if (isset($this->policy_list[$entityID]) || isset($this->policy_list['default']) || isset($this->policy_list['regexp']) ) {
			foreach ($attributes as $attr => $value) {				
				//removing urn
				if (array_key_exists($attr, $attr_map)) {
					$norm_attr = $attr_map[$attr];
				} else { 
					$norm_attr = $attr;
				}
				
				//Checking 'default' release policy
				if (isset($this->policy_list['default']) && in_array($norm_attr, $this->policy_list['default'])) {
					$attrs_to_release[$attr] = $attributes[$attr];
				}
				
				//Checking EntityID release policy
				if (isset($this->policy_list[$entityID]) && in_array($norm_attr, $this->policy_list[$entityID])) {
					$attrs_to_release[$attr] = $attributes[$attr];
				}

				//check regexp on entityID
				if (isset($this->policy_list['regexp'])) {
					foreach ($this->policy_list['regexp'] as $pattern => $attr_regexp_array) {
						if (preg_match($pattern,$entityID)) {
							foreach ($attr_regexp_array as $attr_regexp) {
								if ($attr_regexp == $norm_attr) {
									$attrs_to_release[$attr] = $attributes[$attr];
								}
							}
						}
					}	
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
