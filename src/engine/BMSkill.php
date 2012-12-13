<?php

/*
 * BMSkill: Used to modify the operation of BMDie
 *
 * @author: Julian Lighton
 */

class BMSkill {
    protected static $instance = array();

    private function __construct() {
        // You can't instantiate me; I'm a Singleton!
    }
    
    static function getInstance() {
        $class = get_called_class();
        if (!isset(static::$instance[$class])) {
            echo $class."\n";
            static::$instance[$class] = new $class;
        }
        return static::$instance[$class];
    }
}

class BMSkillShadow extends BMSkill
{
	public $name = "Shadow";
    public $abbrev = "s";

    public $hooked_methods = array("attack_list");

	public function attack_list($args)
	{
		$list = &$args[0];

        $redundant = FALSE;

		foreach ($list as $i => $att)
		{
			if ($att == "Power")
			{
				unset($list[$i]);
			}
            if ($att == "Shadow") {
                $redundant = TRUE;
            }
		}

        if (!$redundant) {
            $list[] = "Shadow";
        }

	}
}

?>
