<?php
	namespace Utils;

	use Monolog\Logger as Log;
	use Monolog\Handler\StreamHandler;
	use Monolog\Formatter\LineFormatter;

	class Logger{

		private static $dateFormat,$formatter,$log_dir,$logger,$output,$stream;

		public static function __init($channel,$formatted=false){
			// Set logs path
			self::$log_dir=LOGS_PATH."/app.log";
			// Load handler
			self::__init_handler($formatted);
			// Load logger
			self::__init_logger($channel);
		}
		private static function __init_handler($formatted=false){
			// Create a handler
			self::$stream = new StreamHandler(self::$log_dir, Log::DEBUG);
			if($formatted==true){
				self::__formatted();
				self::$stream->setFormatter(self::$formatter);
			}
		}
		private static function __init_logger($channel){
			// bind to a logger object
			self::$logger = new Log($channel);
			self::$logger->pushHandler(self::$stream);
		}
		public static function __msg($message){
			self::$logger->info($message);
		}
		public static function __log($message,$level){
			switch($level){
				case	'DEBUG'		:
				case	'INFO'		:
				case	'NOTICE'	:
				case	'WARNING '	:
				case	'ERROR'		:
				case	'CRITICAL'	:
				case	'ALERT'		:
				case	'EMERGENCY'	:
			}
		}
		private static function __formatted(){
			// Default date format is "Y-m-d\TH:i:sP"
			//self::$dateFormat = "Y n j, g:i a";
			self::$dateFormat = "m/d/y H:i:s";
			// the default output format is "[%datetime%] %channel%.%level_name%: %message% %context% %extra%\n"
			// we now change the default output format according to our needs.
			self::$output = "%datetime% > %channel%.%level_name% > %message%\n";
			// finally, create a formatter
			self::$formatter = new LineFormatter(self::$output,self::$dateFormat);
		}
		public static function __reset(){
			self::$logger->reset();
		}
	}
