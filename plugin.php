<?php
/*
Plugin Name: Outbound Links
Plugin URI: http://www.satollo.com/english/wordpress/outbound-links/
Description: This plugin uses the Google Analytics service to track all the outbound links the visitors click on the blog. it can add a "target black" to such a links.
Version: 1.0
Author: Satollo
Author URI: http://www.satollo.com/english/
Disclaimer: Use at your own risk. No warranty expressed or implied is provided.
*/

/*	Copyright 2008 Satollo (email: satollo@gmail.com)

	This program is free software; you can redistribute it and/or modify
	it under the terms of the GNU General Public License as published by
	the Free Software Foundation; either version 2 of the License, or
	(at your option) any later version.

	This program is distributed in the hope that it will be useful,
	but WITHOUT ANY WARRANTY; without even the implied warranty of
	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	GNU General Public License for more details.

	You should have received a copy of the GNU General Public License
	along with this program; if not, write to the Free Software
	Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
*/

$outl_options = get_option('outl');

add_action('wp_footer', 'outl_wp_footer');
function outl_wp_footer()
{
    global $outl_options;
    //echo $outl_options['footer'];
    if ($outl_options['target'] || $outl_options['track'])
    {
        echo '<script type="text/javascript">' . "\n";
        echo 'var a=document.getElementsByTagName("a");var d=/^(http|https):\/\/([a-z-.0-9]+)[\/]{0,1}/i.exec(window.location);var il=new RegExp("^(http|https):\/\/"+d[2], "i");for(var i=0; i<a.length; i++) {if (!il.test(a[i].href)) {' .
            ($outl_options['target']?'a[i].target="_blank";':'') .
            ($outl_options['track']?'a[i].onclick=function(){urchinTracker("/out/"+this.href.replace(/^http:\/\/|https:\/\//i, "").split("/").join("|"))};':'') .
            '}}' . "\n";
        echo '</script>';
    }
}

add_action('admin_head', 'outl_admin_head');
function outl_admin_head()
{
    add_options_page('Outbound Links', 'Outbound Links', 'manage_options', 'outbound-links/options.php');
}
?>
