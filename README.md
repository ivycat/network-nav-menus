# Network Nav Menus 
**Contributors:** ivycat, sewmyheadon, bradyvercher, rdall  
**Tags:** multisite, nav menus, navigation, network  
**Requires at least:** 3.0.1  
**Tested up to:** 4.8  
**Stable tag:** 1.0.1  
**License:** GPLv2 or later  
**License URI:** http://www.gnu.org/licenses/gpl-2.0.html  

Assign navigation menus from the main site in a WordPress multisite network to theme locations in sub-sites.


## Description 

Network Nav Menus allows you to designate a menu from the main site in a WordPress multisite network as the networked menu and it will appear as an available menu in your sub-sites.


## Installation 

This plugin works off of the `register_nav_menus` function. [For more on that function info see the Theme Developer Handbook](https://developer.wordpress.org/themes/functionality/navigation-menus/) register nav menus page on the developer handbook"

You set up your menu array in your function file of the theme(s) you have in your themes folder the same way you would on for a single site install For example:
`register_nav_menus( array( 'global' => 'Global Navigation Menu' )`

Then you would call that menu on each theme file you want.

 `wp_nav_menu( array( 'theme_location' => 'header-menu' )`

Once you have created the the menu you want to use for your Network Nav Menu, you can then designate it as the menu you want for the Network Nav Menu from the list of available menus in the primary site.

You can then go to any sub-site under **Appearance > Menus** and there will be another menu option called "Network Menus." 

1. Upload **Network-Nav-Menus** to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress


## Frequently Asked Questions 


### *Q:* Do I still need to configure my site to call this menu in each sub-site? 

*A:* Yes


### *Q:* Can I choose which site my Network Nav Menu comes from? 

*A:* No, the Network Nav Menu can only be set in the primary site.


### *Q:* Is there a site that is currently using this plugin? 

*A:* Yes this plugin was initially built for [Art Wolfe](http://artwolfe.com/ "Website of Art Wolfe") and as of April / 2015 the only site where you can see it implemented.


### *Q:* How can I contribute, report bugs, or suggest features?

*A:* Visit the [Network Nav Menu GitHub repository](https://github.com/ivycat/Network-Nav-Menus).


## Changelog 


### 1.0.1 
* Documentation updates
* Minor code cleanup


### 1.0 
* Initial Commit


## Upgrade Notice 


### 1.0.1 
Better documentation.
