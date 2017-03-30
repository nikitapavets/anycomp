<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Database extends Model
{
	const NO_SELECTED = 1;

    protected $guarded = [];

    public static function storeDb($name)
    {
        $className = static::class;
        $st = new $className;
        $st->name = $name;
        $st->save();
        return $st;
    }

	/**
	 * @param $id
	 * @return self
	 */
	public static function getById($id) {

		return self::find($id);
	}

	/**
	 * @param $name
	 * @return self
	 */
	public static function getByName($name) {

		return self::where('name', '=', $name)->first();
	}

	/**
	 * @return self[]
	 */
	public static function getAll() {

		return self::where('id', '!=', self::NO_SELECTED)
			->orderBy('name')
			->get();
	}

	/**
	 * @param int $id
	 * @param string $name
	 * @return self
	 */
	public static function updateDb($id, $name)
	{
		/**
		 * @var self $st
		 */
		$st = self::find($id);
		$st->name = $name;
		$st->save();
		return $st;
	}

	/**
	 * @param string $stringIds
	 */
	public static function unsetDb($stringIds) {

		$arrayIds = explode(',', $stringIds);

		foreach ($arrayIds as $id) {
			self::find($id)->delete();
		}
	}

	/**
	 * @return int
	 */
	public function getId() {

		return $this->id;
	}

	/**
	 * @param bool $details
	 * @return string
	 */
	public function getName($details = false) {

		if($this->isSelected()) {
			return $this->name;
		} else {
			return $details ? 'Выбор' : '';
		}
	}

	/**
	 * @param string $name
	 */
	public function setName($name)
    {
        $this->name = $name;
	}

	/**
	 * @return bool
	 */
	public function isSelected() {

		return $this->getId() != self::NO_SELECTED;
	}
}
