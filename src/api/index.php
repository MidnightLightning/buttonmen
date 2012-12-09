<?php
/**
 * API Initialization
 * @package ButtonWeavers
 * @subpackage API
 */

///// Bootstrap /////
define('APP_DIR', dirname(__DIR__));
require_once(APP_DIR.'/lib/bootstrap.php');

$d = new ButtonWeavers\Engine\BMDie();