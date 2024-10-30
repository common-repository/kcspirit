=== Plugin Name ===
Contributors: acegiak
Donate link: http://machinespirit.net/acegiak/2012/12/13/kcspirit/
Tags: javascript,gadgets,games,distractions,easter egg
Requires at least: 2.0.2
Tested up to: 3.5
Stable tag: trunk

Add a secret keycombo to your site!

== Description ==

KCSpirit allows you to add a secret key combination like the konami code to trigger an easteregg or similar on your site.

== Installation ==

1. Create the directories `/wp-content/plugins/kcspirit` and `/wp-content/plugins/kcspirit/images`
2. Upload `kcspirit.php` to the `/wp-content/plugins/kcspirit` directory
3. Upload `images/start.png` to the `/wp-content/plugins/kcspirit/images` directory
4. Activate the plugin through the 'Plugins' menu in WordPress

== Frequently Asked Questions ==

= How do I change the Key Combination? =

In the options page change the comma separated list of javascript keycodes. The new list must be in order the keys should be pressed.


= How do I change the what the combination does? =

Change the javascript in the Javascript Effect box in the options page. This is the code that will be executed. There are three examples provided by default, two of these are commented out.

== Changelog ==

= 1.0 =
* Initial Release
