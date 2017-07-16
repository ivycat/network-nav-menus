=== Network Nav Menus ===
Contributors: ivycat, sewmyheadon, bradyvercher, rdall
Tags: multisite, nav menus, navigation, network
Requires at least: 3.0.1
Tested up to: 3.4
Stable tag: 1.0.1
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Assign navigation menus from the main site in a WordPress multisite network to theme locations in sub-sites.

== Description ==

The Network Nav Menu is a plugin that allows you to set one site as the main menu and then on all subsites you can choose that menu as the networked menu and it will appear as a menu in your subsite.

== Installation ==

This plugin works off of the `register_nav_menus` function. [For more on that function info see the Theme Developer Handbook](https://developer.wordpress.org/themes/functionality/navigation-menus/)"register nav menus page on the developer handbook"

You set up your menu array in your function file of the theme(s) you have in your themes folder the same way you would on for a single site install For example:
`register_nav_menus( array( 'global' => 'Global Navigation Menu' )`

Then you would call that menu on each theme file you want.

 `wp_nav_menu( array( 'theme_location' => 'header-menu' )`

Once set up the menu you want to use for your network wide menu in the initial  install of WordPress menu admin. You can then go to the subsite and under Appearance their should be another menu option called "Network Menus" You can then choose the menu you want for the network wide menu from the list of menus you have created on that initial install.

1. Upload **Network-Nav-Menus** to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
1. Place `<?php do_action('plugin_name_hook'); ?>` in your templates

== Frequently Asked Questions ==

*Q:* Do I still need to configure my site to call this menu in each subsite?

*A:* Yes

*Q:* Can I choose which site is my Network Wide Menu comes from

*A:* No, the Network Wide Menu can only be set by intial install.

*Q* Is there a site that is currently using this plugin?

*A* Yes this plugin was initially built for [Art Wolfe](http://artwolfe.com/ "Website of Art Wolfe") and as of April / 2015 the only site where you can see it implemented.

An answer to that question.

= What about foo bar? =

Answer to foo bar dilemma.

== Screenshots ==

1. This screen shot description corresponds to screenshot-1.(png|jpg|jpeg|gif). Note that the screenshot is taken from
the /assets directory or the directory that contains the stable readme.txt (tags or trunk). Screenshots in the /assets
directory take precedence. For example, `/assets/screenshot-1.png` would win over `/tags/4.3/screenshot-1.png`
(or jpg, jpeg, gif).
2. This is the second screen shot

== Changelog ==

= 1.0 =
* Initial Commit

== Upgrade Notice ==

= 1.0 =
Upgrade notices describe the reason a user should upgrade.  No more than 300 characters.

= 0.5 =
This version fixes a security related bug.  Upgrade immediately.

== Arbitrary section ==

You may provide arbitrary sections, in the same format as the ones above.  This may be of use for extremely complicated
plugins where more information needs to be conveyed that doesn't fit into the categories of "description" or
"installation."  Arbitrary sections will be shown below the built-in sections outlined above.
