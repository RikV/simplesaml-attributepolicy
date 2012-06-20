AttributePolicy Module
=====================

	Author: Riccardo G. Valzorio 
	Contact: riccardo.valzorio@gmail.com ~ valzorio@cilea.it
	Last update: 20 June 2012

**Intro**

This module controls which attributes can be released by default, to a specified EntityID 
or by using a regular expression based on the EntityID.

This module is different from attributelimit module because attributes in metadata are not considered!!

**Installation**

* Copy the module in "modules" folder

* Create "enable" file

		# touch /your/simplesaml/installation/modules/attributepolicy/enable

* Copy configuration template in "config" folder

		# cp /[...]/modules/attributepolicy/config-template/module_attributefilter.php /[...]/config

* Load the module in config.php (authproc.idp array)

		'authproc.idp' => array(
		[...]
			90 => 'attributepolicy:AttributePolicy',
		[...]
		),

**Warning**

This module is still in development, feel free to contact me for any suggestion/bug ...
