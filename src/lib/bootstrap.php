<?php
namespace ButtonWeavers;

/**
 * Simple Exception wrapper
 * 
 * Used to catch specific type of exception 
 * @package ButtonWeavers
 * @subpackage Global Libraraies
 */
class EngineFileNotFoundException extends \Exception {
	
}


/**
 * Take a class name and try and find the source file
 * 
 * Designed to be used with the spl_autoload_register() function to capture calls for classes that don't exist
 * When a class is requested in the format of "\ButtonWeavers\Engine\NameOfClass",
 * Looks for a file named "APP_DIR/engine/NameOfClass.php" and loads it (PSR-0 format)
 * @package ButtonWeavers
 * @subpackage Global Libraraies
 * @param string $name Fully-qualified name (FQN; i.e. including namespaces for PHP 5.3) of the class being requested
 * @return boolean If the FQN is not a ButtonWeavers file (doesn't start with "\ButtonWeavers"), it returns false for other autoloaders to pick up. Otherwise loads the file and returns true
 * @throws EngineFileNotFoundException If the requested class is a ButtonWeavers class, but the associated file isn't found
 */
function autoload($name) {
	$name = ltrim($name, '\\');
	$pieces = explode("\\", $name);
        if (strtolower($pieces[0]) == 'buttonweavers') {
			$filename = '';
			$tmpName = substr($name, 14); // Trim off leading '\buttonweavers'
			if (($pos = strripos($tmpName, '\\')) !== false) {
				$namespace = substr($tmpName, 0, $pos);
				$tmpName = substr($tmpName, $pos+1);
				$filename = strtolower(str_replace('\\', DIRECTORY_SEPARATOR, $namespace)) . DIRECTORY_SEPARATOR;
			}
			$filename .= str_replace('_', DIRECTORY_SEPARATOR, $tmpName) . '.php';
			$filename = APP_DIR . DIRECTORY_SEPARATOR . $filename;
			
			if (function_exists('stream_resolve_include_path')) {
				// PHP >= 5.3.2
				if (($found = stream_resolve_include_path($filename)) === false) throw new EngineFileNotFoundException("Classname {$name} cannot be found since {$filename} is missing from ".get_include_path());
			} else {
				// PHP < 5.3.2
				$paths = explode(PATH_SEPARATOR, get_include_path());
				$found = false;
				foreach($paths as $p) {
					$fullname = $p.DIRECTORY_SEPARATOR.$filename;
					if(file_exists($fullname)) {
						$found = $fullname;
						break;
					}
				}
				if ($found === false) throw new EngineFileNotFoundException("Classname {$name} cannot be found since {$filename} is missing from ".get_include_path());
			}

			require_once($found);
			return true;
        }
        return false; // Only autoload for ButtonWeaver files; return, rather than Except to allow other autoloaders to pick up

}
spl_autoload_register('\ButtonWeavers\autoload'); // Register autoloader