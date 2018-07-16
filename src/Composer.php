<?php
namespace Dcg\Client\MembershipNumberState;

/**
 * Composer
 */
class Composer
{
	public static function postPackageInstall($event)
	{
		error_log(__METHOD__.' '.get_class($event));

		// do stuff
	}
}