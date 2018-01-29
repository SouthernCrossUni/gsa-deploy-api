<?php
/**
 * @package dmsbt
 */
/**
 * DMSBT config parser and handler.
 * 
 * Since version 1.2, this class is equipped with smart
 * config caching.
 * 
 * Since version 1.3, this class now uses dmsbt_configItem
 * instead of ArrayObject.
 * 
 * @author Timothy Chandler <tim.chandler@dmsbt.com>
 * @version 1.3
 * @since 12/01/2010
 */
class dmsbt_config
{
	/**
	 * @var string
	 * @access private
	 */
	private $file	=null;
	/**
	 * @var object
	 * @access private
	 */
	private $config	=null;
	/**
	 * @var boolean
	 * @access private
	 */
	private $cache	=true;
	
	/**
	 * Class constructor. Will call {@link parseConfig()} automatically.
	 * 
	 * @param $file - The file to parse. This should be a filepath.
	 * @return void
	 */
	public function __construct($file)
	{
		if (!isset($GLOBALS['dmsbt_config']))
		{
			$GLOBALS['dmsbt_config']=array('cache'=>array());
		}
		$this->file		=realpath($file);
		$this->config	=new dmsbt_configItem;
		$this->parseConfig();
	}
	
	/**
	 * Class overloader for getting config items from {@link $config}.
	 * 
	 * @access public
	 * @param $key - The key of the config item to return.
	 * @return mixed
	 */
	public function __get($key)
	{
		return $this->config[$key];
	}
	
	/**
	 * Class overloader for checking if a config item is set within {@link $config}.
	 * 
	 * @access public
	 * @param $key - The key of the config item to check.
	 * @return mixed
	 * @since 1.1
	 */
	public function __isset($key)
	{
		return isset($this->config[$key]);
	}
	
	/**
	 * Class overloader for blocking changing of config at run-time.
	 * 
	 * @access public
	 * @param $key - Cannot be used.
	 * @param $val - Cannot be used.
	 * @return void
	 * @throws dmsbt_exception
	 */
	public function __set($key,$val)
	{
		throw new dmsbt_exception('Unable to change config during run-time. Change the config file "'.$this->file.'" instead.');
	}
	
	/**
	 * This method holds the logic require to determin which parser
	 * is requerd to parse whatever config is in need of parsing.
	 * 
	 * @access private
	 * @return $this self
	 */
	private function parseConfig()
	{
		if ($this->cache && isset($GLOBALS['dmsbt_config']['cache'][$this->file]))
		{
			//The config reference SHOULD be an object, but JUST IN CASE it itsn't, we explicitly tell it to give back a reference.
			$this->config=&$GLOBALS['dmsbt_config']['cache'][$this->file];
		}
		else
		{
			$info=pathinfo($this->file);
			switch ($info['extension'])
			{
				case 'php':
				{
					include($this->file);
					if (!isset($config))
					{
						throw new dmsbt_exception('PHP based config files must save config into an array named $config.');
					}
					else
					{
						$this->config=$this->parseArrayConfigBlock($config);
					}
					break;
				}
				case 'xml':
				{
					$this->config=$this->parseSimpleXMLElementConfigBlock(simplexml_load_file($this->file));
					break;
				}
				case 'ini':
				{
					$this->config=$this->parseArrayConfigBlock(parse_ini_file($this->file,true));
					break;
				}
			}
			if ($this->cache)
			{
				$GLOBALS['dmsbt_config']['cache'][$this->file]=&$this->config;
			}
		}
		return $this;
	}
	
	/**
	 * This method will return config from an array.
	 * 
	 * Note - This method is recursive.
	 * 
	 * @access private
	 * @param $array - The config block to be parsed.
	 * @return mixed
	 */
	private function parseArrayConfigBlock($array=array())
	{
		$return=array();
		foreach ($array as $key=>$val)
		{
			if (is_array($val))
			{
				$return[$key]=$this->parseArrayConfigBlock($val);
			}
			else
			{
				$return[$key]=$val;
			}
		}
		return new dmsbt_configItem($return);
	}
	
	/**
	 * This method will parse config from an xml document.
	 * 
	 * Note - This method is recursive.
	 * 
	 * @access private
	 * @param $object - The SimpleXMLElement to be parsed.
	 * @return mixed
	 */
	private function parseSimpleXMLElementConfigBlock(SimpleXMLElement $object)
	{
		$return=new stdClass;
		foreach ($object as $key=>$val)
		{
			if ($val instanceof SimpleXMLElement)
			{
				$return->{$key}=$this->parseArrayConfigBlock((array)$val);
			}
			else
			{
				$val=(string)$val;
				if ($val=='true')
				{
					$val=true;
				}
				else if ($val=='false')
				{
					$val=false;
				}
				else if ($val=='null')
				{
					$val=null;
				}
				else
				{
					$return->{$key}=$val;
				}
			}
		}
		return $return;
	}
	
	/**
	 * Enables caching of the config by filepath.
	 * 
	 * By enabling this, this class keeps a memory of all the config
	 * files that have been used by itself and other instances of itself.
	 * This allows this class to reuse the same config files without creating
	 * new objects and wasting memory and time initating the class.
	 * 
	 * @access public
	 * @return $this self
	 * @since 1.2
	 */
	public function enableCache()
	{
		$this->cache=true;
		return $this;
	}
	
	/**
	 * Disables caching of the config by filepath.
	 * 
	 * @access public
	 * @return $this self
	 * @since 1.2
	 */
	public function disableCache()
	{
		$this->cache=false;
		return $this;
	}
}
/**
 * DMSBT config item object.
 * 
 * This allows config to be used like this:
 * 
 * $this->config->foo['bar']
 * OR
 * $this->config->foo->bar
 * 
 * Both examples are valid.
 * 
 * @author Timothy Chandler <tim.chandler@dmsbt.com>
 * @version 1.0
 * @since 12/01/2010
 */
class dmsbt_configItem extends ArrayObject
{
	public function __get($key)
	{
		return $this[$key];
	}
}
?>