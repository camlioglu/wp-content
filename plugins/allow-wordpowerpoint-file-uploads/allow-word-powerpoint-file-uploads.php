<?php
/*
	Plugin Name: Allow Word/Powerpoint/Excel file uploads
	Plugin URI: http://gis.yohman.com/2010/10/wordpress-plugin-to-allow-wordmicrosoft-file-uploads/
	Description:This is a super simple plug-in that allows for uploading powerpoint (ppt, pptx), word (doc, docx) and Excel (xls, xlsx) files using the media uploader.
	Version: 1.1.1
	Author: yohman
	Author URI: http://gis.yohman.com
	License: GPL2
*/

/*  Copyright 2010  yohda 

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

// Add the filter
add_filter('upload_mimes', 'yohman_custom_upload_mimes');

// Function to add mime types
function yohman_custom_upload_mimes ( $existing_mimes=array() ) {
	// add your extension to the array
	$existing_mimes['pptx'] = 'application/vnd.openxmlformats-officedocument.presentationml.presentation';
	$existing_mimes['ppt'] = 'application/vnd.ms-powerpoint';
	$existing_mimes['doc'] = 'application/msword';
	$existing_mimes['docx'] = 'application/vnd.openxmlformats-officedocument.wordprocessingml.document';
	$existing_mimes['xls'] = 'application/vnd.ms-excel';
	$existing_mimes['xlsx'] = 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet';
	
	// add as many as you like
	return $existing_mimes;
}

?>