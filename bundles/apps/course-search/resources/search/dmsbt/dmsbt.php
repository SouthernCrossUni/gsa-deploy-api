<?php
/**
 * @package dmsbt
 */
/**
 * Main DMSBT class. Used primarily as a bootstrap for now,
 * but with the idea to be extended upon in the future.
 * 
 * Most DMSBT classes should extend this one.
 * 
 * @author Timothy Chandler <tim.chandler@dmsbt.com>
 * @version 1.1
 * @since 28/01/2010
 */
require_once('dmsbt_exception.php');
require_once('dmsbt_config.php');
class dmsbt
{
	/**
	 * @var dmsbt_config
	 * @access private
	 */
	private $configFile	=null;
	/**
	 * @var string
	 * @access private
	 */
	public $config		=null;
	
	/**
	 * Class constructor. Should be called by all classes extending this class.
	 * 
	 * Note, in addition to parsing the config, this class will also define _ as
	 * the directory seperator for simpler and shorter syntax.
	 * 
	 * @access public
	 * @param $configFile - The config file to process. Should be the path to the file.
	 * @return void
	 */
	public function __construct($configFile=false)
	{
		if (!defined('_'))define('_',DIRECTORY_SEPARATOR);
		if ($configFile)
		{
			$this->configFile	=$configFile;
			$this->config		=new dmsbt_config($this->configFile);
		}
		@session_start();
	}
}
?>