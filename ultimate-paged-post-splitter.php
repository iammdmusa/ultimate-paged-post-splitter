<?php
/**
*
	Plugin Name:	Ultimate Paged Post splitter
 	Description:	The Content Splitter for page & post both.This Plugin is Recommended for Large scale type post or page content and Tutorials blogs or News site.
	Plugin URI:
 	Author:			Md Musa
	Author URI:		http://shuvomusa.me
 	Version:		1.0.0
*
*/

$currentFile = __FILE__;
$currentFolder = dirname($currentFile);
    require_once $folderIncludes . '/includes/upps-enqueue-scripts.php';
    require_once $folderIncludes . '/includes/upps-functions.php';
    require_once $folderIncludes . '/includes/upps-setting-options.php';
