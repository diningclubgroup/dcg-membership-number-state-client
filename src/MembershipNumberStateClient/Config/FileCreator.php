<?php

namespace Dcg\Client\MembershipNumberState\Config;

class FileCreator {

	/**
	 *  Copy package's config file to project
	 */
	public static function createConfigFile ($event)
	{
		$vendorDir = $event->getComposer()->getConfig()->get('vendor-dir');
		$configDir = dirname($vendorDir). DIRECTORY_SEPARATOR . 'config';
		$configFile = $configDir . DIRECTORY_SEPARATOR . 'membership-number-state-client.php';
		$exampleFile = $vendorDir . DIRECTORY_SEPARATOR . 'dcg'. DIRECTORY_SEPARATOR .'dcg-lib-membership-number-state-client' . DIRECTORY_SEPARATOR . 'config.php';

		if (!file_exists($configDir)) {
			mkdir($configDir);
		}
		if (!file_exists($configFile)) {
			copy($exampleFile, $configFile);
		}
	}

}