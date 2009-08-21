<?php
/*
Plugin Name: Outbound Links
Plugin URI: http://www.satollo.net/plugins/outbound-links
Description: Forces all outbund link to open on a new window. Track outbound link clicks with Google Analytics.
Version: 1.1.0
Author: Satollo
Author URI: http://www.satollo.net
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

add_action('wp_footer', 'outl_wp_footer');
function outl_wp_footer()
{
    global $user_ID;
    
    $options = get_option('outl');

    if ($user_ID == '' || $options['track_admin'])
    {
        echo $options['footer'];
    }
        
    if ($options['target'] || $options['track'])
    {
        echo "\n" . '<script type="text/javascript">' . "\n<!--\n";
        echo 'var a=document.getElementsByTagName("a");var d=/^(http|https):\/\/([a-z-.0-9]+)[\/]{0,1}/i.exec(window.location);var il=new RegExp("^(http|https):\/\/"+d[2], "i");for(var i=0; i<a.length; i++) {if (!il.test(a[i].href) && a[i].href.toLowerCase().substring(0, 4) == "http") {' .
            ($options['target']?'a[i].target="_blank";':'');
            
            if ($options['track'] && ($user_ID == '' || $outl_options['track_admin']))
            {
                $tracker = $options['track_version']?'urchinTracker':'pageTracker._trackPageview';
                if ($options['track_prefix'] == '') $outl_options['track_prefix'] = '/out';
                if ($options['track_mode'])
                {
                    echo 'a[i].onclick=function(){' . $tracker . '("' . $options['track_prefix'] . '/"+this.href.replace(/^http:\/\/|https:\/\//i, "").split("/")[0])};';
                }
                else 
                {
                    echo 'a[i].onclick=function(){' . $tracker . '("' . $options['track_prefix'] . '/"+this.href.replace(/^http:\/\/|https:\/\//i, "").split("/").join("|"))};';
                }
            }
            echo '}}' . "\n";
        echo "//-->\n</script>\n";
    }
}

if (is_admin())
{
    add_action('admin_menu', 'outl_admin_menu');
    function outl_admin_menu()
    {
        add_options_page('Outbound Links', 'Outbound Links', 'manage_options', 'outbound-links/options.php');
    }
}
?>
