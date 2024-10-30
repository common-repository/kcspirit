<?php


/*
    Plugin Name: KCSpirit
    Plugin URI: http://www.machinespirit.net/acegiak
    Description: Launch effects or games when entering codes like the konami code with keyboard on site.
    Version: 1.1.1
    Author: Ashton McAllan
    Author URI: http://www.machinespirit.net/acegiak
    License: GPLv2
*/

/*  Copyright 2011 Ashton McAllan (email : acegiak@machinespirit.net)
    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.
    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
    GNU General Public License for more details.
    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA 02110-1301 USA
*/

$kcsdefaults =  array(
'jseffect'=> "
/*	Examples: Uncoment to use. Don't run all of them at once.	*/
/*	katamari game from kathack.com
s=document.createElement('script');s.src='http://kathack.com/js/kh.js';document.body.appendChild(s);	*/
/*	asteroidslike from kickassapp.com
s=document.createElement('script');s.src='http://hi.kickassapp.com/kickass.js';document.body.appendChild(s);	*/
/*	Default Example: Alert and Capitalize page:	*/
alert('KONAMI POWER!');
jQuery('body').css('text-transform','uppercase');"
,
'keycombo'=>"38,38,40,40,37,39,37,39,66,65,13");
function kcspiritscript() {
	global $kcsdefaults;
    if( wp_script_is( 'jquery', 'done' ) ) {
?>
<script type="text/javascript">
function kcspirit(){<?php $kcso = get_option('kcspiritOption',$kcsdefaults );echo $kcso['jseffect']; ?>}
jQuery(document).ready(function(){window.kc=0;jQuery(document).keydown(function(e){
window.kc=e.which==(new Array(<?php $kcso = get_option('kcspiritOption',$kcsdefaults );echo $kcso['keycombo']; ?>))[window.kc]?window.kc+1:0;if(window.kc><?php $kcso = get_option('kcspiritOption',$kcsdefaults );echo count(explode(',',$kcso['keycombo']))-1;?>){window.kc=0;kcspirit()}})})
</script>
<?php
}}
add_action('wp_head','kcspiritscript');
function register_kcsettings() {
	//register our settings
	register_setting( 'kcspirit-settings-group', 'kcspiritOption' );
	add_settings_section('kcspirit_main', 'KCSpirit Settings', 'kcspirit_option_text', 'kcspirit');
	add_settings_field('key_combo_string', 'Key Combo', 'kcspirit_combo_string', 'kcspirit', 'kcspirit_main');
	add_settings_field('js_effect_string', 'Javascript Effect', 'js_effect_display_string', 'kcspirit', 'kcspirit_main');
}

function kcspirit_option_text() {
echo '<p>Configure KCSpirit here.</p>';
}



function js_effect_display_string() {
        global $kcsdefaults;
$options = get_option('kcspiritOption',$kcsdefaults );
echo "Javascript to be executed when the combo is performed.<br/><textarea id='js_effect_string' name='kcspiritOption[jseffect]' cols='100' rows='10'>{$options['jseffect']}</textarea>";
}


function kcspirit_combo_string() {
        global $kcsdefaults;
$options = get_option('kcspiritOption',$kcsdefaults );
echo "Comma delimited list of javascript keycodes.<br/><input id='key_combo_string' name='kcspiritOption[keycombo]' size='40' type='text' value='{$options['keycombo']}'/>";
}

add_action('admin_menu', 'kcspirit_create_menu');

function kcspirit_create_menu() {

	//create new top-level menu
	add_menu_page('KCSpirit Plugin Settings', 'KCSpirit Settings', 'administrator', __FILE__, 'kcspirit_settings_page',plugins_url('/images/start.png', __FILE__));

	//call register settings function
	add_action( 'admin_init', 'register_kcsettings' );
}






function kcspirit_settings_page() {
?>
<div>
<h2>KCSpirit Options</h2>
Options relating to the Custom Plugin.
<form action="options.php" method="post">
<?php settings_fields('kcspirit-settings-group'); ?>
<?php do_settings_sections('kcspirit'); ?>
 
<input name="Submit" type="submit" value="<?php esc_attr_e('Save Changes'); ?>" />
</form></div>
<?php }


?>
