AttributeFilter Module
=====================

	Author: Riccardo G. Valzorio 
	Contact: riccardo.valzorio@gmail.com ~ valzorio@cilea.it
	Last update: 7 May 2012

**Intro**

This module allows to chose what attributes release to a specified Service Provider.

**Installation**

* Copy the module in "modules" folder

* Create "enable" file

		# touch /your/simplesaml/installation/modules/attributefilter/enable

* Copy configuration template in "config" folder

		# cp /[...]/modules/attributefilter/config-template/module_attributefilter.php /[...]/config

* Load the module in config.php (authproc.idp array)

		'authproc.idp' => array(
		[...]
			90 => 'attributefilter:AttributeFilter',
		[...]
		),

**Warning**

This module is still in development, feel free to contact me for any suggestion/bug ...
