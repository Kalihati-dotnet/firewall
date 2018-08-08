<?php
namespace NV\Firewall;

class Firewall {
    private static $_instance;

	public static function getInstance() {
		if(!isset(self::$_instance)) {
			self::$_instance = new static();
		}
		return self::$_instance;
    }

    public function __construct(){
		$this->xss_attact();
	}
    private function xss_attact(){
		$ct_rules = array( 'http\:\/\/', 'https\:\/\/', 'cmd=', '&cmd', 'exec', 'concat', './', '../',  'http:', 'h%20ttp:', 'ht%20tp:', 'htt%20p:', 'http%20:', 'https:', 'h%20ttps:', 'ht%20tps:', 'htt%20ps:', 'http%20s:', 'https%20:', 'ftp:', 'f%20tp:', 'ft%20p:', 'ftp%20:', 'ftps:', 'f%20tps:', 'ft%20ps:', 'ftp%20s:', 'ftps%20:', '.php?url=' );
		$check    = str_replace($ct_rules, '*', $this->php_firewall_get_env('QUERY_STRING'));
		if( $this->php_firewall_get_env('QUERY_STRING') != $check ) {
            // here some logic that you want to do
           
		}
    }
    
    private function getIP(){
        if($this->php_firewall_get_env('HTTP_X_FORWARDED_FOR')) {
            return $this->php_firewall_get_env('HTTP_X_FORWARDED_FOR');
        } elseif ($this->php_firewall_get_env('HTTP_CLIENT_IP')) {
            return $this->php_firewall_get_env('HTTP_CLIENT_IP');
        } else {
            return $this->php_firewall_get_env('REMOTE_ADDR');
        }
        return '';
    }

    private function php_firewall_get_env($st_var){
        if(isset($_SERVER[$st_var])) {
            return strip_tags( $_SERVER[$st_var] );
        } elseif(isset($_ENV[$st_var])) {
            return strip_tags( $_ENV[$st_var] );
        } elseif(getenv($st_var)) {
            return strip_tags( getenv($st_var) );
        } elseif(function_exists('apache_getenv') && apache_getenv($st_var, true)){
            return strip_tags( apache_getenv($st_var, true) );
        }
        return '';
    }

}