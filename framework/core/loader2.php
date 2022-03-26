<?php

namespace Framework\Core;

Use Base\CoreAPI;
use App\Exceptions;
Use Utils\Logger;
Use Sys\FileSys;

Class Loader{
		protected static $count=0,$debug=1,$loaded=false,$output,$table;
		private static $ConstNames,$fileCount,$file,$files,$fullPath,$Keys,$tmp_path,$type;

		public static function __load($path,$type,array $fileArray,$recursive=false){
			if(self::$debug==true){
				Logger::__init('Loader',true);
				Logger::__msg('Loading '.$type.' from '.$path);
			}

			if(!is_dir($path)){
				return false;
			}

			$files		=	scandir($path);
			$fileCount	=	count($files);
			$ident		=	ucfirst($type);

			foreach($fileArray as $k => $value){
				$ConstName[]	=	$k;
				$Key[]			=	$value;
			}

			foreach($files as $file){
				if($file == '.' || $file == '..'){
					continue;
				}

				if(is_dir($path.$file) && $recursive){
					echo '<pre>';
					$objects = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($path), \RecursiveIteratorIterator::SELF_FIRST);

					foreach($objects as $name => $object){
						$var =  substr($name,-1);

						if($var == '.' || $var == '..'){
							continue;
						}

						echo $object.LB;
						$files[]=$name;
					}
					echo '<pre>';
#                    var_dump($files);
                    die;

                    foreach($files as $f){
                        if(empty(self::$tmp_path)){
                            $ext = pathinfo($f,PATHINFO_EXTENSION);

                            if($ext == 'php'){
                                $fileList[]=$f;
                                echo 'Added file '.$f.LB;
                            }
                            else{
                                self::$tmp_path=$path.$f.DS;
                                echo 'Tmp path set to '.self::$tmp_path.LB;
                            }

                        }
                        else{
                            self::$tmp_path='';
                        }

                        if(!empty(self::$tmp_path)){
                            self::__load(self::$tmp_path,$type,$fileList);
                        }
                    }
				}
				else{
					if(is_file($path.$file)){
						self::$count=self::$count=1;

						$ext = pathinfo($file,PATHINFO_EXTENSION);

						if($ext == 'php'){
							list($fileName,$filetype,$ext)=explode('.',$file);

							$fullPath = $path.$file;

							if($type == 'helper'){
								if(in_array($fileName,$fileArray)){
									if(self::$debug==true){
										Logger::__msg(__METHOD__.': '.$type.' '.$fileName.' included');
									}
									include($fullPath);
								}
								else{
									if(self::$debug==true){
										Logger::__msg(__METHOD__.': '.$type.' '.$fileName.' skipped');
									}
								}
							}
							elseif($type == 'config'){
								if(in_array($fileName,$fileArray)){
									for($i=0;$i <= $fileCount;$i++){
										if(
											array_key_exists($i,$ConstName)
											&& !is_numeric($ConstName[$i])
											&& $fileName==$Key[$i]
										){
#											echo 'Key is: '.$Key[$i].LB;
#											echo 'ConstName is: '.$ConstName[$i].LB;
#											echo 'File count is: '.$fileCount.LB;
											self::__set_constant(strtoupper($ConstName[$i]),$ident,$fullPath);

											if(self::$debug==true){
												Logger::__msg(__METHOD__.': '.$type.' '.$fileName.' included as Const '.$ConstName[$i]);
											}
										}

									}

									if(self::$loaded == false){
										self::__set_constant(strtoupper($fileName),$ident,$fullPath);

										if(self::$debug==true){
											Logger::__msg(__METHOD__.': '.$type.' '.$fileName.' included as '.strtoupper($fileName));
										}
									}
								}
								else{
									if(self::$debug==true){
										Logger::__msg(__METHOD__.': '.$type.' '.$fileName.' skipped');
									}
								}
							}
							else{
								die('
									Invalid loader type defined. Defined type is: <b>'.$type.'</b>'.LB.
									'Thrown on file ('.$fileName.') on line '.__LINE__
								);
							}
						}
					}
				}
				self::$loaded=false;
			}
		}
		private static function __set_constant($data,$type,$path){
			if($type=='helper'){}
			elseif($type=='config'){
				define($data,include($path));
			}

			self::$loaded=true;
		}
		// Load library classes
		public function library($lib){
			//echo 'Loading lib ('.$lib.')..<br>';
			if (file_exists(LIB_PATH . $lib . '.class.php')) {
				include LIB_PATH . $lib . 'class.php';
			}
		}
	}
?>
