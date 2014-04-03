<?php

/**
 * Task to clean out all {@link MultiFormSession} objects from the database.
 * 
 * Setup Instructions:
 * You need to create an automated task for your system (cronjobs on unix)
 * which triggers the run() method through cli-script.php:
 * /your/path/sapphire/cli-script.php MultiFormPurgeTask/run
 * 
 * @package multiform
 */


class MultiFormPurgeTask extends BuildTask {
    protected $title = "Delets Steps & Session from MultiForm"; // title of the script
    protected $description = 'Go through all MultiFormSession records that are older than the days specified in $session_expiry_days and delete them.'; // description of what it does
    public static $session_expiry_days = 5;
    function run($request) { 
		$sessions = $this->getExpiredSessions();
		$delCount = 0;
		if($sessions) foreach($sessions as $session) {
			// X if($session->delete()) $delCount++;
			$session->delete();
 			$delCount++;
		}
        $this->debugMessage($delCount . ' session records deleted that were older than ' . self::$session_expiry_days . ' days.'); 
    } 
	/**
	 * Return all MultiFormSession database records that are older than
	 * the days specified in $session_expiry_days
	 *
	 * @return DataObjectSet
	 */
	protected function getExpiredSessions() {
		return DataObject::get(
			'MultiFormSession',
			"DATEDIFF(NOW(), \"MultiFormSession\".\"Created\") > " . self::$session_expiry_days
		);
	}
    protected function debugMessage($msg) { 
        if(!SapphireTest::is_running_test()) { 
            Debug::message($msg); 
        }
    }
}
