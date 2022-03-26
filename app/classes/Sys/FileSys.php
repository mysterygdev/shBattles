<?php
	Namespace Sys;

	Use Utils\{Data,Table};
	Use Settings\Paging\PageData;

	Class FileSys{

		public static $data,$file;
		private static $database,$fn,$method_name,$mode,$src,$err=array(),$error=false,$output;

		public static function _get_img($dir,$width,$height=false){
			$ret = NULL;
			$contents = scandir($dir);

			foreach($contents as $file){
				$ext = pathinfo($file,PATHINFO_EXTENSION);

				@list($filename,$f_width,$f_height) = explode("_",$file);

				$h	=	$f_height;
				$w	=	substr($f_width,0,3);

				if($ext == "jpg" || $ext == "png"){
					if($h == $height){
						if($w == $width){
							$ret.=$file;
						}
					}
					elseif($w == $width){
						$ret.=$file;
					}
				}
			}
			return $ret;
		}
		public static function _get_img_diag($dir,$width,$height=false){
			$ret = NULL;
			$contents = scandir($dir);

			echo '<ul>';
			foreach ($contents as $file){
				$ext = pathinfo($file,PATHINFO_EXTENSION);

				@list($filename,$f_width,$f_height) = explode("_",$file);

				$h	=	$f_height;
				$w	=	substr($f_width,0,3);

				if($ext == "jpg" || $ext == "png"){
					if($height == $h){
						$ret.='entered height check';
						if($h == $height && $h !== NULL && $h !== ""){
							if($w == $width && $w !== NULL && $w !== ""){
								$ret.=$file;
							}
						}
					}
					elseif($width == $w){
						$ret.='entered width check';
						if($w == $width && $w !== NULL && $w !== ""){
							$ret.=$file;
						}
					}
					else{
						$ret.='<li>Image width is invalid.</li>';
						$ret.='<li>Valid image height for this component is <b>'.$height.'</b>.</li>';
						$ret.='<li>Valid image width for this component is <b>'.$width.'</b>.</li>';
						$ret.='<li>Detected height <b>'.$h.'</b> and width <b>'.$w.'</b>.</li>';
						$ret.='<li>Targeted dir is <b>'.$dir.'</b>.</li>';
					}
				}
			}
			echo '</ul>';
			return $ret;
		}
		# Upcoming Events Image (Home Page)
		public static function ds_U_E_IMG($dir){
			$height	=	"370";
			$width	=	"275";

			return self::_get_img($dir,$width,$height);
			//return $this->get_IMAGE($dir,$height,$width);
			//return $this->get_IMG_DIAG($dir,$height,$width);
		}
		# Topic Image (Blog)
		public function ds_T_IMG($dir){
			$height	=	"350";
			$width	=	"850";

			return $this->get_IMAGE($dir,$width);
			//return $this->get_IMAGE($dir,$height,$width);
			//return $this->get_IMG_DIAG($dir,$width);
		}
		public function list_zipfiles($mydirectory){
			// directory we want to scan
			$dircontents = scandir($mydirectory);

			// list the contents
			echo '<ul>';
			foreach ($dircontents as $file) {
				$extension = pathinfo($file, PATHINFO_EXTENSION);
				if ($extension == 'zip') {
					echo "<li>$file </li>";
				}
			}
			echo '</ul>';
		}
		public function list_php_files($mydirectory){
			// directory we want to scan
			$files = scandir($mydirectory);

			// list the contents
			echo '<ul>';
			foreach ($files as $file) {
				$extension = pathinfo($file, PATHINFO_EXTENSION);
				if($extension == 'php'){
					echo "<li>$file </li>";
				}
			}
			echo '</ul>';
		}
		public function _validate(){
			$file	=	$this->src.$this->fn;

			switch($this->mode){
				case	1	:
					# Validate
					if(is_file($file)){
						$this->output	=	'<td class="tac">'.$this->Tpl->_do_alert_text('2','FSRW-0x01').'</td>';
						return true;
					}
					else{
						$this->output	=	'<td class="tac">'.$this->Tpl->_do_alert_text('3','FSRW-0x02').'</td>';
						return false;
					}
				break;
				case	2	:
					# Read Test
					if(is_readable($file)){
						$this->output	=	'<td class="tac">'.$this->Tpl->_do_alert_text('2','FSRW-0x01').'</td>';
						return true;
					}
					else{
						$this->output	=	'<td class="tac">'.$this->Tpl->_do_alert_text('3','FSRW-0x02').'</td>';
						return false;
					}
				break;
				case	3	:
					# Write Test
					if(is_file($file) && is_writable($file)){
						$this->output	=	'<td class="tac">'.$this->Tpl->_do_alert_text('2','FSRW-0x01').'</td>';
						return true;
					}
					else{
						$this->output	=	'<td class="tac">'.$this->Tpl->_do_alert_text('3','FSRW-0x02').'</td>';
						return false;
					}
				break;
			}
		}
		# READABLE METHODS
		public function _read_gateway(){
			$return = false;

			$file = $this->PPo->GW_LOGFILE();
			$msg = "File is writeable\n";

			if(is_writable($file)){
				if(!$handle = fopen($file,'a')){
					$this->GW_STATUS	=	"Unable to open $file for writing...";
					return false;
				}
				if(fwrite($handle,$msg) === false){
					$this->GW_STATUS	=	"Unable to write to file $file...";
					return false;
				}else{
					$this->GW_STATUS	=	"Success, $msg was written to $file...";
					return true;
				}
				fclose($handle);
			}else{
				$this->GW_STATUS	=	"$file is not writable...";
				return false;
			}
		#	return $return;
		}
		public function _read_ipn(){
			$return = false;

			$file = $this->PPo->IPN_LOGFILE();
			$msg = "File is writeable\n";

			if(is_writable($file)){
				if(!$handle = fopen($file,'a')) {
					$this->IPN_STATUS	=	"Unable to open $file for writing...";
					return false;
				}
				if(fwrite($handle,$msg) === false){
					$this->IPN_STATUS	=	"Unable to write to file $file...";
					return false;
				}else{
					$this->IPN_STATUS	=	"Success, $msg was written to $file...";
					return true;
				}

				fclose($handle);
			}else{
				$this->IPN_STATUS	=	"$file is not writable...";
				return false;
			}
			#return $return;
		}
		public function _read_pages_2($source,$filename){
			$ret = false;

			$file = $source.$filename;
			$msg = "File is writeable\n";

			if(is_writable($file)){
				if(!$handle = fopen($file,'a')) {
					$this->Status	=	"Unable to open $file for writing...";
				}
				if(fwrite($handle,$msg) === false){
					$this->Status	=	"Unable to write to file $file...";
				}else{
					$this->Status	=	"Success, $msg was written to $file...";
					$ret = true;
				}

				fclose($handle);
			}else{
				$this->Status	=	"$file is not writable...";
			}
		#	return $ret;
		}
		public function _read_pages(){
			$file = $this->src.$this->fn;

			if(is_file($file) && is_readable($file)){
				return $this->Tpl->_do_alert_text('2','FSR-0x01');
			}
			else{
				return $this->Tpl->_do_alert_text('3','FSR-0x02');
			}
		}
		# WRITABLE METHODS
		private function _write_pages_test(){
			$file = $this->src.$this->fn;

			if(is_file($file) && is_writable($file)){
				return $this->Tpl->_do_alert_text('2','FSW-0x01');
			}
			else{
				return $this->Tpl->_do_alert_text('3','FSW-0x02');
			}
		}
		public static function _is_writable($path,$file=''){
			if(!is_writable($path.$file)){
				return ' NOT OK';
			}
			else{
				return 'OK';
			}
		}
		public static function __download_recovery_key($path,$key){
			$f_name='recovery_key.txt';

			if(self::__write_file($path,$f_name,$key)==true){
				header("Content-type: text/plain");
				header("Content-Disposition: attachment; filename=".$path.$f_name);
			}
			else{
				return 'Download failed..';
			}

		}
		private static function __write_file($path,$f_name,$key){
			$file		=	$path.$f_name;

			$success	=	'File is writeable\n';
			$success_1	=	'';
			$error		=	'';
			$text		=	false;

			$msg_0		=	'Unable to open '.$file.' for writing'.LB;
			$msg_1		=	'Unable to write to '.$file.LB;
			$msg_2		=	'Colors data has been successfully written to <b>'.$file.'</b>'.LB;
			$msg_3		=	$file.' is not writable'.LB;

			if(is_writable($file)){

				if(!$handle = fopen($file,'w')){
					$d = opendir($uri);

					while(false!==($f=@readdir($d))){
						$dName=$d.$f;

						$table["body"][]='<td>'.$uri.'</td>';
						if(is_dir($dName)){
							$table["status"][]='<td class="badge badge-success">Exists</td>';
						}
						else{
							$table["status"][]='<td class="badge badge-warning">Missing</td>';
						}
					}
				}
			}

			\Utils\Table::verify_dirs_table(get_called_class(),$table);
			exit;
		}
		public static function __is_file($file){
			if(is_file($file)){
				return true;
			}
			return false;
		}
		public static function __file_exists($file){
			if(file_exists($file)){
				return true;
			}
			return false;
		}
		public static function __get_zone(){
			$zone_default	=	"Unknown";
			$zone			=	((!isset(PageData["zone"])) || (isset(PageData["zone"]) && (PageData["zone"]==="")) ) ? $zone_default : PageData["zone"];

			return $zone;
		}
		public static function PathIterator($path){
			foreach(new \DirectoryIterator($path) as $fileInfo){
				if($fileInfo->isDot()) continue;
				$files[]=$fileInfo->getFilename();
			}

			return $files;
		}
		public static function PathIteratorRecursive($path){
			foreach(new \RecursiveDirectoryIterator($path) as $fileInfo){
				$files[]=$fileInfo->getFilename();
			}

			foreach($files As $fileList){
				if($fileList == '.' || $fileList == '..'){
					continue;
				}
				$list[]=$fileList;
			}

			return $list;
		}
		public static function _uni_images($ImageType){
			if($ImageType == "STYLE_AJAX"){$ret=Dirs["UI_STYLES_DIR"].Style[PageData["Zone"]."_STYLE_NAME"].FS.'Images'.FS.'Ajax'.FS;}
			if($ImageType == "THEME_AJAX"){$ret=Dirs["UI_THEMES_DIR"].Theme[PageData["Zone"]."_THEME_NAME"].FS.'Images'.FS.'Ajax'.FS;}
			if($ImageType == "STYLE_ICON"){$ret=Dirs["UI_STYLES_DIR"].Style[PageData["Zone"]."_STYLE_NAME"].FS.'Images'.FS.'Icon'.FS;}
			if($ImageType == "THEME_ICON"){$ret=Dirs["UI_THEMES_DIR"].Theme[PageData["Zone"]."_THEME_NAME"].FS.'Images'.FS.'Icon'.FS;}
			if($ImageType == "STYLE_HEADER"){$ret=Dirs["UI_STYLES_DIR"].Style[PageData["Zone"]."_STYLE_NAME"].FS.'Images'.FS.'Header'.FS;}
			if($ImageType == "THEME_HEADER"){$ret=Dirs["UI_THEMES_DIR"].Theme[PageData["Zone"]."_THEME_NAME"].FS.'Images'.FS.'Header'.FS;}
			if($ImageType == "STYLE_MISC"){$ret=Dirs["UI_STYLES_DIR"].Style[PageData["Zone"]."_STYLE_NAME"].FS.'Images'.FS.'Misc'.FS;}
			if($ImageType == "THEME_MISC"){$ret=Dirs["UI_THEMES_DIR"].Theme[PageData["Zone"]."_THEME_NAME"].FS.'Images'.FS.'Misc'.FS;}
			if($ImageType == "STYLE_WP"){$ret=Dirs["UI_STYLES_DIR"].Style[PageData["Zone"]."_STYLE_NAME"].FS.'Images'.FS.'Wallpaper'.FS;}
			if($ImageType == "THEME_WP"){$ret=Dirs["UI_THEMES_DIR"].Theme[PageData["Zone"]."_THEME_NAME"].FS.'Images'.FS.'Wallpaper'.FS;}
			if($ImageType == "STYLE_IMG"){$ret=Dirs["UI_THEMES_DIR"].Theme[PageData["Zone"]."_THEME_NAME"].FS.'Images'.FS;}
			if($ImageType == "THEME_IMG"){$ret=Dirs["UI_THEMES_DIR"].Theme[PageData["Zone"]."_THEME_NAME"].FS.'Images'.FS;}

			if(isset($ret)){
				$ret=Data::_sanitize_uri($ret);

				return $ret;
			}
			else{
				throw new \Exceptions\SystemException('Unable to return null value for image type: '.$ImageType,0,0,__FILE__,__LINE__);
			}
		}
	}
?>
