<?php

namespace Dcg\Client\MembershipNumberState\Config;

class FileCreator {
    
    // file paths relative to the root project
    
    /**
     * @var string
     */
    private static $configFilePath = "config/membership-number-state-client.php";
    
    /**
     * @var string
     */
    private static $exampleConfigFilePath = "vendor/dcg/dcg-lib-membership-number-state-client/config.php";

    /**
     *  Copy package's config file to project
     */
    public static function createConfigFile () 
    {
        $configFile = self::$configFilePath;
        if (!file_exists($configFile)) {
            copy(self::$exampleConfigFilePath, $configFile);
        }
    }

}