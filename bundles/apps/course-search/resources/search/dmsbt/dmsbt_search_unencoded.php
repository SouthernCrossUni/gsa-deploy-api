<?php
/**
 * @package dmsbt
 * @subpackage search
 */
/**
 * DMSBT Search Class.
 * 
 * This search class has been designed to allow developers to integrate
 * Google search into any PHP application with complete anonymity. It acheives
 * this by proxying all Google search appliance requests through this class.
 * 
 * Note that this class does not and will not ever attempt to perform any formatting
 * of the results or attempt to make changes to the way the google search works. Such
 * things can be accomplished by extending this class.
 * 
 * @author Timothy Chandler <tim.chandler@dmsbt.com>
 * @version 1.1
 * @since 28/01/2010
 */
require_once('dmsbt.php');
class dmsbt_search extends dmsbt
{
	/**
	 * @var string
	 * @access private
	 */
	private $protocol	='http';
	/**
	 * @var string
	 * @access private
	 */
	private $server		='www.google.com.au';
	/**
	 * @var string
	 * @access private
	 */
	private $client		='';
	
	/**
	 * @var array
	 * @access private
	 * Note that this param list does NOT include ANY query params.
	 */
	private $paramList	=array
	(
		'access','as_dt','as_epq','as_eq','as_filetype','as_ft','as_occt','as_oq','as_sitesearch',
		'entqr','entsp','filter','getfields','ie','lr','num','numgm','oe','output','partialfields','proxycustom',
		'proxyreload','proxystylesheet','requiredfields','site','sitesearch','sort','start','ud','GSA-skin'
	);
	/**
	 * @var array
	 * @access private
	 */
	private $JSFiles	=array('all','clicklog_compiled','common','xmlhttp','uri','cluster','suggest_js');
	/**
	 * @var unknown_type
	 * @access private
	 */
	private $params		=array();
	
	/**
	 * Class constructor. Handles initiation of class and automates requests for
	 * javascript files, clustering and suggesting.
	 * 
	 * @access public
	 * @return void
	 */
	public function __construct()
	{
		$args=func_get_args();
		call_user_func_array(array('parent','__construct'),$args);
		//Set the default values on all the params if they are not already set.
		foreach ($this->paramList as &$param)
		{
			//Note that we use @ to omit the NOTICE's that are
			//generated from the invalid value which we pass
			//to some of the params.
			if (isset($_GET[$param]))
			{
				@$this->{$param}=addslashes($_GET[$param]);
			}
			else
			{
				if (!isset($this->{$param}))@$this->{$param}='';
			}
		}
		//Handle any requests for the javascript files on the GSA.
		$this->handleJavascriptFileRequest();
		//Handle any requests for clustering.
		$this->handleClusteringRequest();
		//Handle any requests for suggesting.
		$this->handleSuggestRequest();
	}
	
	/**
	 * Class overloader for handling the "setting" of search parameters.
	 * 
	 * @access public
	 * @param $key
	 * @param $val
	 * @return void
	 */
	public function __set($key,$val)
	{
		$params=TRUE;
		$okVals=array();
		switch ($key)
		{
			case 'access':			$okVals=array('p','s','a');				break;
			case 'as_dt':			$okVals=array('i','e');					break;
			case 'as_epq':													break;
			case 'as_eq':													break;
			case 'as_filetype':												break;
			case 'as_ft':			$okVals=array('','i','e');				break;
			case 'as_occt':			$okVals=array('any','title','url');		break;
			case 'as_oq':													break;
			case 'as_sitesearch':											break;
			case 'entqr':			$okVals=array('0','1','2','3');			break;
			case 'entsp':			$okVals=array('0','a');					break;//TODO: Fix this - it's wrong. Values can be ie. a_mypolicy. Maybe look into doing a regex for this kinda thing.
			case 'filter':			$okVals=array('1','0','s','p');			break;
			case 'getfields':												break;
			case 'ie':														break;
			case 'lr':														break;
			case 'num':														break;//TODO:Hook this up with a method to make it more dynamic and easier to use.
			case 'numgm':			$okVals=array('0','1','2','3','4','5');	break;
			case 'oe':														break;
			case 'output':			$okVals=array('xml_no_dtd','xml');		break;
			case 'partialfields':											break;
			case 'proxycustom':												break;
			case 'proxyreload':		$okVals=array('1','0');					break;
			case 'proxystylesheet':											break;
			case 'requiredfields':											break;
			case 'site':													break;//TODO: Hook this up with a method to make it more dynamic and easier to use.
			case 'sitesearch':												break;
			case 'sort':													break;//TODO:Hook this up with a method to make it more dynamic and easier to use.
			case 'start':													break;//TODO:Hook this up with a method to make it more dynamic and easier to use.
			case 'ud':				$okVals=array('1','0');					break;
			case 'GSA-skin':												break;
			case 'webglobals':      $params=FALSE;							break;
		}
		if ($params) {
			$val=rawurlencode($val);
			if (isset($okVals[0]) && !in_array($val,$okVals))
			{
				trigger_error('Invalid default value for search parameter "'.$key.'". Valid values are "'.implode('","',$okVals).'".',E_USER_NOTICE);
				$val=$okVals[0];
			}
			$this->params[$key]=$val;
		} else {
			$this->$key=$val;
		}
	}
	
	/**
	 * Class overloader for handling the "getting" of search parameters.
	 * 
	 * @param $key
	 * @access public
	 * @return mixed
	 */
	public function __get($key)
	{
		return (isset($this->params[$key]))?$this->params[$key]:'';
	}
	
	/**
	 * Class overloader for handling the "checking" of a search parameters existance.
	 * 
	 * @param $key
	 * @return boolean
	 */
	public function __isset($key)
	{
		return isset($this->params[$key]);
	}
	
	/**
	 * Sets the protocol for the search.
	 * 
	 * @access public
	 * @param $protocol - Usually "https".
	 * @return $this
	 */
	public function setProtocol($protocol)
	{
		$this->protocol=$protocol;
		return $this;
	}
	
	/**
	 * Returns the protocol currently being used by this class.
	 * 
	 * @access public
	 * @return string
	 */
	public function getProtocol()
	{
		return $this_>protocol;
	}
	
	public function toggleOutageNotice($type) {
		switch($type) {
			case 'scu-public':
				header('Location: http://scu.edu.au/about/index.php/25/?gsa=notice');
				break;
			case 'squiz':
				header ('Location: http://search.scu.edu.au/courses/search-courses.php');
				break;
		}
	
	}
	
	/**
	 * Sets the server ip address or host name for the search.
	 * 
	 * @param $server - Can be an IP Address such as "192.0.32.10" or a host name such as "search.example.com".
	 * @access public
	 * @return $this
	 */
	public function setServer($server)
	{
		$this->server=$server;
		return $this;
	}
	
	/**
	 * Returns the server address currently being used by this class.
	 * 
	 * @access public
	 * @return string
	 */
	public function getServer()
	{
		return $this->server;
	}
	
	/**
	 * Sets the client the search will use. This must be set and must be a valid frontend in the GSA/Mini.
	 * 
	 * @param $client - A valid client name from the GSA/Mini.
	 * @access public
	 * @return $this
	 */
	public function setClient($client)
	{
		$this->client=$client;
		return $this;
	}
	
	/**
	 * Returns the client currently being used by this class.
	 * 
	 * @access public
	 * @return string
	 */
	public function getClient()
	{
		return $this->client;
	}
	
	/**
	 * Generates a URL based on the current settings of the class.
	 * 
	 * @access public
	 * @return string
	 */
	public function generateSearchURL()
	{
		$params='';
		foreach ($this->params as $key=>&$val)
		{
			if ($key=='proxystylesheet' && $this->output=='xml')continue;
			$params.='&'.$key.'='.$val;
		}
		return	$this->protocol.'://'.$this->server.'/search?client='.$this->client.$params;
	}
	
	/**
	 * Generates a query string.
	 * 
	 * @return string
	 */
	public function generateQueryString($query,$queryType='q')
	{
		$queryString='';
		foreach ($this->params as $key=>&$val)
		{
			if ($key=='proxystylesheet' && $this->output=='xml')continue;
			$queryString.='&'.$key.'='.$val;
		}
		return $queryString.'&'.$queryType.'='.$query;
	}
	
	public function &parseQueryString($queryString)
	{
		$arrayQuery=array();
		$fragments=explode('&',$queryString);
		for ($i=0,$j=count($fragments); $i<$j; $i++)
		{
			if (empty($fragments[$i]))continue;
			list($key,$val)=explode('=',$fragments[$i],2);
			$arrayQuery[$key]=$val;
		}
		return $arrayQuery;
	}
	
	/**
	 * Performs a query on the Search Appliance and returns a resut.
	 * 
	 * Note that if $query is not parsed to this function, it will automagically
	 * figure out whch type of search is being requested and base the query on that.
	 * 
	 * * If $_GET['q'] is set, it will do a standard search query.<br />
	 * * If $_GET['as_q'] is set, it will do an advanced search query.<br />
	 * * If $_GET['as_lq'] is set, it will do a link search query.
	 * 
	 * @param $query - Optional. Force a query using the 'q' parameter.
	 * @access public
	 * @return string
	 */
	public function query($query=null, $allow_empty = false)
	{
		$q		=false;
		$result	=false;
		if (is_null($query))
		{
			if (isset($_GET['q']))
			{
				$q		='q';
				$query	=$_GET['q'];
			}
			else if (isset($_GET['as_q']))
			{
				$q		='as_q';
				$query	=$_GET['as_q'];
			}
			else if (isset($_GET['as_lq']))
			{
				$q		='as_lq';
				$query	=$_GET['as_lq'];
			}
		}
		else if (!empty($query))
		{
			$q='q';
		}
//if ($_SERVER['HTTP_X_FORWARDED_FOR'] == '10.133.26.82') {
//	echo 'q:'.$q.' $query:'.$query;
//$q = ' ';$query = ' ';
//echo $this->generateSearchURL().'&'.$q.'='.rawurlencode(htmlspecialchars_decode($query));
//}
//if ($_SERVER['HTTP_X_FORWARDED_FOR'] == '10.133.26.82') {
//	echo 'url:'.$this->generateSearchURL().'&'.$q.'='.rawurlencode(htmlspecialchars_decode($query));
//}
		if ($q || $allow_empty)
		{
			if ($this->output=='xml')
			{
				$result=simplexml_load_file($this->generateSearchURL().'&'.$q.'='.rawurlencode(htmlspecialchars_decode($query)));
			}
			else
			{
				$result=@file_get_contents($this->generateSearchURL().'&'.$q.'='.rawurlencode(htmlspecialchars_decode($query)));
				
				if (!$result) {
					$type = (preg_match('!course|unit!', $_SERVER['SCRIPT_FILENAME'])) ? 'squiz' : 'scu-public';
					$this->toggleOutageNotice($type);
				}
				
			}
		}
		return $result;
	}
	
	/**
	 * Outputs Javascript which is used to enhance the google search results
	 * and overall experience.
	 * 
	 * Multiple javascript files can be requested at once and function will merge
	 * the files into one response, saving the overheads of multiple requests.
	 * 
	 * To request multiple javascript files, seperate the name of each javascript
	 * file with a pipe ( | ), character and leave off the .js part.
	 * 
	 * Valid files are: all, clicklog_compiled, common, xmlhttp, uri, cluster and suggest_js.
	 * 
	 * Note that by listing all files, a special compressed file 'all', containing all
	 * the javascript files will be returned. You can also request 'all' for the
	 * same result.
	 * 
	 * Note that this is automatically done when the class detects the presence of
	 * $_GET['js'] and it is a true value (ie '1' or 'true').
	 * 
	 * @access public
	 * @return void - Exits. Does not return.
	 */
	public function handleJavascriptFileRequest()
	{
		if (!empty($_GET['js']))
		{
			$basePath				=dirname(__FILE__)._.'js'._;
			$jsFiles				=addslashes($_GET['js']);
			$jsFiles				=str_replace('||','|',explode('|',$jsFiles));
			if (!end($jsFiles))		array_pop($jsFiles);
			if (!reset($jsFiles))	array_shift($jsFiles);
			if ($jsFiles[0]=='all')
			{
				$allFiles=file_get_contents($basePath.'all.js');
			}
			else
			{
				$found		=0;
				$fileCount	=count($this->JSFiles)-1;
				for ($i=0,$j=count($jsFiles); $i<$j; $i++)
				{
					if (in_array($jsFiles[$i],$this->JSFiles))
					{
						$found++;
					}
				}
				if ($found==$fileCount)
				{
					$allFiles=file_get_contents($basePath.'all.js');
				}
				else
				{
					$allFiles				='';
					for ($i=0,$j=count($jsFiles); $i<$j; $i++)
					{
						$filePath=$basePath.$jsFiles[$i].'.js';
						if (in_array($jsFiles[$i],$this->JSFiles) && is_file($filePath))
						{
							$allFiles.=file_get_contents($filePath);
						}
					}
				}
			}
			$allFiles=str_replace
			(
				array('/cluster?',	'/suggest',		'/search?'),
				array('?cluster=1&','?suggest=1&',	'?'),
				$allFiles
			);
			ob_start();
			ob_implicit_flush(0);
			header('content-type:text/javascript');
			print $allFiles;
			ob_end_flush();
			exit();
		}
	}
	
	/**
	 * Outputs either JSON, XML or HTML, depending out what the coutput value is ($_GET['coutput']).
	 * This is consumed by the google clustering javascript.
	 * 
	 * Note that this is automatically done when the class detects the presence of
	 * $_GET['cluster'] and it is a true value (ie '1' or 'true').
	 * 
	 * @access public
	 * @return void - Exits. Does not return.
	 */
	public function handleClusteringRequest()
	{
		if (isset($_GET['cluster']) && (bool)(int)$_GET['cluster'])
		{
			$params=$_GET;
			$params['client']=$this->getClient();
			$contents=file_get_contents
			(
				$this->protocol.'://'.$this->server.'/cluster',
				null,
				stream_context_create
				(
					array
					(
						'http'=>array
						(
							'method'	=>'POST',
							'header'	=>'Content-Type:application/x-www-form-urlencoded',
							'content'	=>http_build_query($params)
						)
					)
				)
			);
			ob_start();
			ob_implicit_flush(0);
			if ($_GET['coutput']=='json')
			{
				header('content-type:application/x-json');
			}
			else if ($_GET['coutput']=='xml')
			{
				header('content-type:application/xml');
			}
			else
			{
				header('content-type:text/html');
			}
			print $contents;
			ob_end_flush();
			exit();
		}
	}
	
	/**
	 * Outputs a JSON response with suggestions to be consumed by the google suggest javascript.
	 * 
	 * Note that this is automatically done when the class detects the presence of
	 * $_GET['suggest'] and it is a true value (ie '1' or 'true').
	 *  
	 * @access public
	 * @return void - Exits. Does not return.
	 */
	public function handleSuggestRequest()
	{
		if (!empty($_GET['suggest']) && (bool)(int)$_GET['suggest'])
		{
			$contents=file_get_contents($this->protocol.'://'.$this->server.'/suggest?'.http_build_query($_GET));
			ob_start();
			ob_implicit_flush(0);
			header('content-type:application/x-json');
			print $contents;
			ob_end_flush();
			exit();
		}
	}
}
?>