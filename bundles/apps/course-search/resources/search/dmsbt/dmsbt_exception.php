<?php
/**
 * @package dmsbt
 */
/**
 * DMSBT exception handler.
 * 
 * Note that this is simply a placeholder. However, all DMSBT classes
 * should be throwing dmsbt_exception's because in the future this
 * class can be used to give greater control over exceptions.
 * 
 * @author Timothy Chandler <tim.chandler@dmsbt.com>
 * @version 1.0
 * @since 06/11/2009
 */
class dmsbt_exception extends Exception
{
	public function outputHTML()
	{
		$output		='';
		$template	=<<<HTML
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>PHP Exception</title>
		<style type="text/css">
		body
		{
			margin:		0px;
			padding:	0px;
		}
		
		blockquote
		{
			color:		red;
			font-weight:bold;
		}
		</style>
	</head>
	<body>
		<h1>Exception</h1>
		<h2>Message</h2>
			<blockquote>{MESSAGE}</blockquote>
		<hr />
		<h2>File</h2>
			<b>Filename: </b>{FILE_FILENAME}<br />
			<b>Class: </b>{FILE_CLASS}<br />
			<b>Line: {FILE_LINE}<br />
			<b>Stack Trace:<b><br />
			<pre>{TRACE}</pre>
		<hr />
	</body>
</html>
HTML;
		$trace	=$this->getTrace();
		$output	=str_replace
		(
			array
			(
				'{MESSAGE}',
				'{FILE_FILENAME}',
				'{FILE_CLASS}',
				'{FILE_LINE}',
				'{TRACE}'
			),
			array
			(
				$this->getMessage()	,
				$this->getFile(),
				$trace[0]['class'] || 'N/A',
				$this->getLine(),
				print_r($trace,true)
			),
			$template
		);
		exit($output);
	}
}
?>