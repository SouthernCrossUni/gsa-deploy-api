<?php

/**
 * 
 * @author Timothy Chandler <tim.chandler@dmsbt.com>
 * @version 1.0
 */
require_once('dmsbt/dmsbt_search_unencoded.php');
class scu_search extends dmsbt_search
{
	private $collections = array
	(
		'staff' => array
		(
			'scu',
			'courses',
			'staff_directory',
			'student',
			'staff'
		),
		'student' => array
		(
			'scu',
			'courses',
			'staff_directory',
			'student'
		),
		'public' => array
		(
			'scu',
			'courses',
			'staff_directory'
		)
	);
	
	private $role = null;
	public $show_collections = true;
	
	
	
	
	public function __construct()
	{
		if (!defined('_'))define('_',DIRECTORY_SEPARATOR);
		//gsa.scu.edu.au
		$this->setProtocol('https');
		$this->setServer('site-search.scu.edu.au');
		$this->setClient('scu_xhtml');
		
		$this->output			=(isset($_GET['output']))			?$_GET['output']			:'xml_no_dtd';
		$this->proxystylesheet	=(isset($_GET['proxystylesheet']))	?$_GET['proxystylesheet']	:'scu_xhtml';
		$this->proxycustom		=(isset($_GET['proxycustom']))		?$_GET['proxycustom']		:'<HOME>';
		$this->proxyreload		=1;
		$this->sort				='date:D:L:d1';
		$this->entqr			=3;
		$this->oe				='UTF-8';
		$this->ie				='UTF-8';
		$this->ud				=1;
		
		$this->role				= self::get_users_role();
		
		parent::__construct();
	}
	
	public function get_collection_nums($sites) {
		
		$c = array();
		
		foreach ($sites as $site) {
			
			foreach ($this->collections[$this->role] as $key => $val) {
				
				if ($val == $site) {
					
					$c[] = $key;
					
				}
				
			}
			
		}
		
		return implode(',', $c); 
		
	}
	
	
	public function get_users_role() {
		
		if (empty($this->role)) {
			
			if (isset($_SERVER['REMOTE_USER'])) {
				$user = $_SERVER['REMOTE_USER'];
				$affil = roll_lookup($user);
			} 
			
			switch ($affil) {
				case "staff"   : $this->role = 'staff'; break;
				case "student" : $this->role = 'student'; break;
				default 	   : $this->role = 'public'; break;
			}
			
		}
		
		return $this->role;
		
	}
	
	public function get_collections($query) {
	
		$role = (empty($this->role)) ? self::get_users_role() : $this->role;
					
		if (!isset($this->collections[$role])) {
			$role = 'public';
		}
		
		$auth_warning = ($role == 'public') ? '<span id="login-link"><a href="http://study.scu.edu.au/search?'.$_SERVER['QUERY_STRING'].'"><img src="gfx/lock.png" style="margin-bottom: -3px;" alt="login icon" />&nbsp;Login</a> to search more</span>' : '';
		
		if (empty($_GET['c'])) {
			
			//Hide error because the variable may not exist.
			if (@$_GET['c']!=='0') {
				$activeCollections=array_keys($this->collections[$role]);
				$activeCollections[0]='0';
			} else {
				$activeCollections=array('0');
			}
			
		} else {
			$activeCollections=explode(',',$_GET['c']);
		}
		
		// Seems to be used if there is an empty spot on either end? Why???
//		$end	= end($activeCollections);
//		$start	= reset($activeCollections);
//		if (!$end && $end!=='0')			array_pop($activeCollections);
//		if (!$start && $start!=='0')		array_shift($activeCollections);


//	<input type="hidden" id="collectionsForm_start" name="start" value="{$this->start}" />
//	<input type="hidden" id="collectionsForm_num" name="num" value="{$this->num}" />
		
		$clusterBoxHTML					=<<<HTML
<div id="collections">
	<h3>Collections</h3>
	<form id="collectionsForm" method="get" action="?">
	<input type="hidden" id="collectionsForm_q" name="q" value="{$query}" />
	<input type="hidden" id="collectionsForm_c" name="c" value="" />
		<ul>
HTML;
		for ($i=0,$j=count($this->collections[$role]); $i<$j; $i++)
		{
			$checked = (in_array($i,$activeCollections)) ? 'checked="checked"' : ' ';
			$label = ucwords(str_replace('_',' ',$this->collections[$role][$i]));
			$label = ($label == 'Scu') ? 'All '.strtoupper($label) : $label;
			$label = ($label == 'Rss') ? strtoupper($label) : $label;
			$clusterBoxHTML.='<li><label><input type="checkbox" value="'.$i.'" '.$checked.'/>'.$label.'</label></li>';
		}
		$clusterBoxHTML.='
		</ul>
	</form>';
		
		$clusterBoxHTML .= $auth_warning;

		$clusterBoxHTML.=<<<HTML
</div>
<!--<script type="text/javascript" src="http://www.google.com/jsapi"></script>-->
<script type="text/javascript" src="/resources/js/ext/ext-core-3_0_0.js"></script>
<script type="text/javascript">
//google.load('ext-core','3.0.0');
//google.setOnLoadCallback
//(
//	function()
//	{
		var collectionsForm=Ext.get('collectionsForm');
		collectionsForm.on
		(
			'click',
			function(event,target)
			{
				if (target.type=='checkbox')
				{
					var	value=[],
						checkboxes=collectionsForm.select('input[type="checkbox"]');
					for (var i=0,j=checkboxes.elements.length; i<j; i++)
					{
						checkboxes.elements[i].disabled=true;
						if (checkboxes.elements[i].checked)
						{
							value.push(checkboxes.elements[i].value);
						}
					}
					Ext.get('collectionsForm_c').dom.value=value.join();
					collectionsForm.dom.submit();
				}
			}
		);
//	}
//);
</script>
HTML;

		$collections=array(); 
		for ($i=0,$j=count($activeCollections); $i<$j; $i++) {
			$collections[]=$this->collections[$role][$activeCollections[$i]];
		}
		$this->site=implode('|',$collections);
		
		return $clusterBoxHTML;
	
	}
	
	public function query($query=NULL)
	{
		
		$role = (empty($this->role)) ? self::get_users_role() : $this->role;
		
		if (empty($query)) {
			if (!empty($_GET['q'])) {
				$query=$_GET['q'];
			} else if (!empty($_GET['as_q'])) {
				$query=$_GET['as_q'];
			} else if (!empty($_GET['as_lq'])) {
				$query=$_GET['as_lq'];
			} else {
				$query = '';
			}
		}
		
		// Fix up internal GSA links that include the site parameter
		// First, check if allowed for that site
		// Then, convert it to a collection index id thingy
		if (!empty($_GET['site']) && !isset($_GET['c'])) {
			
			$requested_sites = explode('|', $_GET['site']);
			
			if (!empty($requested_sites)) {
				foreach ($requested_sites as $req_site) {
						 
					if (!empty($this->collections[$role])) {
						foreach ($this->collections[$role] as $c_id => $collection) {
							if ($collection == $req_site) {
								
								$_GET['c'] .= (strlen($_GET['c']) == 0) ? $c_id : ','.$c_id;
							}
						}
					}
					
				}
			}
			
		}
		
		if ($this->output != 'xml') {
			
			$clusterBoxHTML = self::get_collections($query);
			
			if (empty($this->site)) {
				$this->site = implode('|', $this->collections[$role]);
			}
			
			$result = parent::query($query);
			
			if ($this->show_collections) {
				
				// If no clusering div stick it in somewhere.
				if (strstr($result, '<div id="clustering">') === false) {
					return str_replace('<div id="er">',$clusterBoxHTML.'<div id="er">', $result);
				} else {
					return str_replace('<div id="clustering">',$clusterBoxHTML.'<div id="clustering" rel="foo">', $result);	
				}
			
			} else {
				
				return str_replace('<div id="clustering">','<div id="clustering" style="display: none;">', $result);	
				
			}
			
		}  
			
		// Make absolutely sure it is not empty, otherwise the GSA will return all results
		if (empty($this->site)) {
			$this->site = implode('|', $this->collections[$role]);
		}
		if (empty($this->site)) {
			$this->site = implode('|', $this->collections['public']);
		}
		
		return parent::query($query);
	}
}
?>