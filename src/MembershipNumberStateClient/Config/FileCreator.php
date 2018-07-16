<?php

namespace Dcg\Client\MembershipNumberState\Config;

class FileCreator {

    /**
     *  Copy package's config file to project
     */
    public static function createConfigFile ($event)
    {
		$vendorDir = $event->getComposer()->getConfig()->get('vendor-dir');
		$configFile = $vendorDir.'/../config/membership-number-state-client.php';
		$exampleFile = $vendorDir.'/dcg/dcg-lib-membership-number-state-client/config.php';

        if (!file_exists($configFile)) {
            copy($exampleFile, $configFile);
        }
    }

}