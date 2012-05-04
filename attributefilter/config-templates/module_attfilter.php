<?php

/* 
 * Attributefilter configuration file. 
 * 
 * Define the EntityID and the attributes to release to the specifed EntityID
 * 
 */

$config = array(

	/* EntityID --> */
	'https://sso.cilea.it/simplesaml/module.php/saml/sp/metadata.php/saml2' =>
	array('mail','eduPersonTargetedID'), /* <-- Attributes to release */
		
/*	'https://my.entity.id' => array('attributes','to','release'),
 	'https://my.entity.id/2' => array('more','attributes','to','release'), */
);