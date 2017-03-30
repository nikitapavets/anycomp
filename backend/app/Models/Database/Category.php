<?php

namespace App\Models\Database;

use App\Models\Database;

class Category extends Database
{
    /**
     * @param string $systemName
     * @return self
     */
    public static function getBySystemName($systemName)
    {
        return self::where('system_name', '=', $systemName)->first();
    }

	/**
	 * @return string
	 */
	public function getSystemName()
	{
		return $this->system_name;
	}

	/**
	 * @param string $systemName
	 */
	public function setSystemName($systemName)
	{
		$this->system_name = $systemName;
	}
}
