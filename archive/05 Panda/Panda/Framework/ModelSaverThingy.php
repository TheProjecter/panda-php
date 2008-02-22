<?php 

class Panda_Framework_ModelSaverThingy
{
	public static function getTableName(Panda_Framework_Model $model)
	{
		$parts = explode(get_class($model));
		return strtolower($parts[ count($parts) - 1 ]);
	}
	
	public static function save($data) 
	{
		if (is_array($data)) {
			self::saveBatch($data);
		}
		else {
			
		}
	}
}

?>