<?php
	namespace Utils;
	class Arrays{
		public static function _object2array($object){
			$return = NULL;

			if(is_array($object)){
				foreach($object as $key => $value)
				$return[$key] = self::_object2array($value);
			}
			else{
				$var = get_object_vars($object);

				if($var){
					foreach($var as $key => $value)
						$return[$key] = ($key && !$value) ? NULL : self::_object2array($value);
					}
					else{
						return $object;
					}
			}

			return $return;
		}
		public static function objToArray($obj){
			// Not an object or array
			if (!is_object($obj) && !is_array($obj)) {
				return $obj;
			}
			// Parse array
			foreach ($obj as $key => $value) {
				$arr[$key] = self::objToArray($value);
			}
			// Return parsed array
			return $arr;
		}
		public static function array_flatten($array){
			if(!is_array($array)){
				return false;
			}

			$result = array();

			foreach($array as $key=>$value){
				if(is_array($value)){
					$result = array_merge($result,self::array_flatten($value));
				}
				else{
					$result[$key] = $value;
				}
			}

			return $result;
		}
		public static function recursive_convert_array_to_obj($arr,$indexed=false){
			if(is_array($arr)){
				$new_arr	=	array();
				foreach($arr as $k=>$v){
					if($indexed==true){
						if(is_integer($k)){
							$new_arr['Index'][$k] = self::recursive_convert_array_to_obj($v);
						}
						else{
							$new_arr[$k] = self::recursive_convert_array_to_obj($v);
						}
					}
					else{
						$new_arr[$k] = self::recursive_convert_array_to_obj($v);
					}
				}

				return (object)$new_arr;
			}

			# else maintain the type of $arr
			return $arr;
		}
		public static function __cleanup_obj($obj,$indexed=false){
			// $obj > Object to be cleaned
			// $indexed > if array has named indexes = true|false
			$obj = self::objToArray($obj);
			$obj = self::array_flatten($obj);
			$obj = self::recursive_convert_array_to_obj($obj,$indexed);

			return $obj;
		}
		public static function __isStaff(){
			return [
				'16',
				'32',
				'48',
				'64',
				'80',
				'128'
			];
		}
	}
?>
