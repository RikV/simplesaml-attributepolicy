<?php

/* 
 * AttributePolicy configuration file. 
 * 
 * Define the attributes to release:
 * - by default
 * - by EntityID
 * - by a regular expression based on EntityID
 * 
 */

$config = array(

	/* Default Policy */
	'default' => array('eduPersonTargetedID'),

	/* EntityID Policy */
	'https://sso.cilea.it/simplesaml/module.php/saml/sp/metadata.php/saml2' => array('uid'),
	
	/* Regexp on EntityID */
	'regexp' => array(
		'/.*\.cilea.it.*/' => array('uid','mail'),
	// 	'/.*.garr.it.*/' => array('myattr'),
	),
);