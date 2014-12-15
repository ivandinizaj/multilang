<?php

class Lang
{

	public static $langs 	 = ['pt','en'];
	public static $lang 	 = 'en';
	public static $param 	 = 1;
	public static $variaveis = []; 	//local 
	public static $time 	 = 7; 	//quantidade

	public static function init()
	{
		$lang = self::checklang();

		self::import($lang);
	}

	/**
	 * Pega
	 * 
	 * @return [type] [description]
	 */
	public static function get($name)
	{

		if( isset( self::$variaveis[$name] ) )
			return self::$variaveis[$name];
		else{
			$msg = 'Índice '.$name.' inexistente em '.self::$lang.'.php';
			trigger_error($msg,E_USER_ERROR);
		}
	}

	/**
	 * Importa o arquivo com um array com os índices e valores
	 * 
	 * @return [type] [description]
	 */
	public static function import($lang)
	{

		$file_lang = PATH_LANG.'/'.$lang.'.php';


		if( is_readable($file_lang) )
			self::$variaveis = include $file_lang;
		else 
			return false;
	}

	/**
	 * Salva Cookie e caso já existe é feito
	 * @param  [type] $lang [description]
	 * @return [type]       [description]
	 */
	public static function saveLang($lang)
	{
		if(isset( $_COOKIE['lang_default'] ) )
			setcookie('lang_default');
		
		setcookie('lang_default', $lang, time()+3600+(self::$time * 24));
	}

	/**
	 * Redireicionar para a página que deseja
	 * Caminho tem que ser absoluto ex: /fb/login
	 * 
	 * @return void
	 */
	public static function redirect($page)
	{
		header('Location:'.$page);
	}

	/**
	 * Saber qual o idioma definido pelo usuário 
	 * Caso o usuário não escolha nada irá pegar o 
	 * idioma do navegador.
	 * 
	 * @return [type] [description]
	 */
	public static function checklang()
	{
		$request = trim( parse_url( $_SERVER['REQUEST_URI'], PHP_URL_PATH), "/" );
		$params  = explode('/',$request);

		/**
		 * Verifica se na URL no primeiro parâmetro foi 
		 * definido algum idioma. Pois não irá atribuir o valor padrão
		 * do navegador do usuário
		 */
		if( isset($params[self::$param]) ? ( $params[self::$param] == '' ? false : true) : false )		
			$lang = strtolower( $params[self::$param] );
		

		else if( isset($_COOKIE['lang_default']) )
			$lang = $_COOKIE['lang_default'];

		else
			$lang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'],0,2);
		

		/**
		 * Verifica se o idioma escolhido é válido no array
		 * que foi setado inicialmente e salva no cookies o idioma escolhido
		 */
		if( in_array( $lang, self::$langs ) ){
			self::$lang = $lang;
			self::saveLang($lang);
			return $lang;
		}


		return self::redirect( BASE_URL.'/'.self::$lang );

	}

}
