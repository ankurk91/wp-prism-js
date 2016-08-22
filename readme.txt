=== Prism Syntax Highlighter ===
Tags: syntax highlighter, prism, light weight, simple, free
Requires at least: 3.8.0
Tested up to: 4.6.0
Stable tag: 2.0.0
License: MIT
License URI: https://opensource.org/licenses/MIT
Contributors: ankurk91

Prism syntax highlighter controller plugin for WordPress.

== Description ==
Prism is a lightweight, extensible syntax highlighter, built with modern web standards in mind.
This plugin lets you control and use this awesome library in to your WordPress site.


** Comes with 6 Official themes **

= Available Languages at this time =
* HTML
* CSS
* C-Like
* Java Script
* PHP
* SQL


= Comes with 7 Official Plugins =
* AutoLinker
* FileHighlight
* Line Highlight
* Line Numbers
* Show Invisibles
* Show Language
* WebPlatform Docs

= Additional Features =
* Tiny MCE (editor) Assistant Button to quick insert code to posts.
* Load (enqueue) Prism files (css+js) to post pages only

> <strong>Notice -</strong><br>
> This plugin is no longer maintained. Sorry about that.<br>
> I have no time to update/sync this plugin with original Prism [repo](https://github.com/PrismJS/prism).

== Installation ==
0. Remove existing syntax highlighter or disable them.
1. Search for 'ank prism for wp' in WordPress Plugin Directory and Download the .zip file & extract it.
2. Upload the folder `ank-prism-for-wp` to the `/wp-content/plugins/` directory
3. Activate the plugin through the 'Plugins List' page in WordPress Admin Area.
4. Configure this plugin via Settings-->Prism For WP
5. Enjoy the awesomeness.


== Frequently Asked Questions ==

= What this plugin actually do ? =

This plugin allow you to select from available themes, languages and plugins.
Then create (pack) JS and CSS files, store them on disk and enqueue them to front end.
Everything will be served from local server.

= Where can i find a working demo ? =

Just ahead to http://prismjs.com for demos and instructions.

= Who is the original developer of Prism Library ? =

* This JS library is developed by : [Lea Verou](http://lea.verou.me/)
* With the many other Contributors : [Listed here](https://github.com/LeaVerou/prism/contributors)
* Hosted at : [Prismjs.com](http://www.prismjs.com)

= Changes does not reflect after saving settings ? =

Are you using some Cache/Performance plugin (eg:WP Super Cache/W3 Total Cache/BWP Minify) ?

Then flush your WP cache and refresh target page.

= Where does it store settings and options ? =

WP Database->wp-options->ank_prism_for_wp.
Uses a Single Row, stored in array for faster access.

= What if i uninstall/remove this plugin? =

No worry! It will remove its traces from database upon uninstall.


= This Plugin is unable to write js/css files . =

Each time you save new settings , this plugin write processed js and css code to two separate files.
There may be some chance that plugin unable to create/write these files. These files are essential to front end.

Possible reason are ->

* Not enough permission to write a file.
* Plugin malfunction (my fault).
* You hosting provider has disabled File Handling Function via php.ini (rare).

How to resolve ->

* Login to your website via your FTP client software. (eg: FileZilla)
  and change file permission of this plugin folder.


= Did you test it with old version of WordPress ? =

No, tested with v4.6.0+ (latest as of now) only. So i recommend you to upgrade to latest WordPress today.


= Have you changed anything in Prism source files =

No, each and every file is in its original state.



== Upgrade Notice ==

Please install v2.0.0 as minimum.

== Screenshots ==
1. Plugin Option Page Screen
2. Tiny MCE Pop-up box
3. Final output on front-end

== Changelog ==

= 2.0.0 =
* Refactor code a lot
* Write dynamic files in out folder

= 1.7.0 =
* Updated links

= 1.6.2 =
* Tested upto WordPress 4.3.1
* Updated notes - No longer maintained

= 1.6.1 =
* Minor bug fixes
* Improved form handling

= 1.6 =
* Security and speed improvements
* Assistant Button is available for Custom Post types as well

= 1.5 =
* Updated modules from original site

= 1.4 =
* Option to disable Tiny MCE button.
* Option to load Prism files only to Post (Single) Pages.
* Plugin Code optimization and cleanup

= 1.3 =
* Add assistant button to Tiny MCE (editor) that will lets user quickly insert code without any tutorial.
* Released to WordPress

= 1.2 =
* Improved docs and site links.
* Language selection on Option Page has been improved. Take care of dependencies.
* Minify CSS before writing to file.

= 1.1 =
* Quick Bug fix: Rename prism-php.php to prism-php.js

= 1.0 =
* First public release on GitHub
* Submitted to WordPress


== Arbitrary section ==
Nothing in this section, Read FAQ.
