<?php
/*
    Plugin Name: Linkedin Share Button
    Plugin URI: http://salayhin.info
    Description: Linkedin Share Button
    Version: 1.0
    Author: Sirajus Salayhin
    Author URI: http://salayhin.info

    License: Copyright 2012  Sirajus Salayhin  (email : salayhin@gmail.com)

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

function linkedin_share($content) {

	if ( is_single() ) {

		$protocol = $_SERVER['HTTPS'] == 'on' ? 'https' : 'http';

		$sc_page_url = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];

	    $post_id = get_the_ID();

		$sc_page_title = get_the_title($post_id);

$content .= '<p><script src="http://platform.linkedin.com/in.js" type="text/javascript"></script>
<script type="IN/Share" data-counter="right"></script></p>';

		}

	return $content;
}

add_action('the_content','linkedin_share');

?>