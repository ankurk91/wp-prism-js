=== Prism Syntax Highlighter ===
Tags: syntax highlighter, prism, light weight, simple, free
Requires at least: 3.8.0
Tested up to: 4.7.4
Stable tag: 3.0.0
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
* Ruby
* SQL
* C
* ABAP
* ActionScript
* Ada
* Apache Configuration
* APL
* Applescript
* AsciiDoc
* ASP.NET (C#)
* AutoIt
* AutoHotkey
* Bash
* BASIC
* Batch
* Bison
* Brainfuck
* Bro
* C#
* C++
* CoffeeScript
* Crystal
* D
* Dart
* Diff
* Django/Jinja2
* Docker
* Eiffel
* Elixir
* Erlang
* F#
* Fortran
* Gherkin
* Git
* GLSL
* Go
* GraphQL
* Groovy
* Haml
* Handlebars
* Haskell
* Haxe
* HTTP
* Icon
* Inform 7
* Ini
* J
* Jade
* Java
* Jolie
* JSON
* Julia
* Keyman
* Kotlin
* LaTex
* Less
* LiveScript
* LOLCODE
* Lua
* Makefile
* Markdown
* MATLAB
* MEL
* Mizar
* Monkey
* NASM
* nginx
* Nim
* Nix
* Objective-C
* OCaml
* Oz
* PARI/GP
* Parser
* Pascal
* Perl
* PowerShell
* Processing
* Prolog
* .properties
* Protocol Buffers
* Puppet
* Pure
* Python
* Q
* Qore
* R
* React JSX
* Reason
* reST (reStructuredText)
* Rip
* Roboconf
* Rust
* SAS
* Sass (Sass)
* Sass (Scss)
* Scala
* Scheme
* Smalltalk
* Smarty
* Stylus
* Swift
* Tcl
* Textile
* Twig
* TypeScript
* Verilog
* VHDL
* vim
* Wiki markup
* Xojo (REALbasic)
* YAML

= Comes with 16 Official Plugins =
* AutoLinker
* FileHighlight
* Line Highlight
* Line Numbers
* Show Invisibles
* Show Language
* WebPlatform Docs
* Autoloader 
* Command Line
* Copy to Clipboard
* Preview: Base
* Preview: Angle
* Preview: Color
* Preview: Easing
* Preview: Gradient
* Preview: Time

= Additional Features =
* Tiny MCE (editor) Assistant Button to quickly insert code to posts.
* Load (enqueue) Prism files (CSS+js) to post pages only

== Installation ==
0. Remove any existing syntax highlighter or disable them.
1. Search for 'ank prism for wp' in WordPress Plugin Directory and Download the .zip file & extract it.
2. Upload the folder `ank-prism-for-wp` to the `/wp-content/plugins/` directory
3. Activate the plugin through the 'Plugins List' page in WordPress Admin Area.
4. Configure this plugin via Settings-->Prism For WP
5. Enjoy the awesomeness.


== Frequently Asked Questions ==

= What does this plugin actually do? =

This plugin allows you to select from available themes, languages and plugins.
It then creates JS and CSS files, stores them on the server and enqueues them to front end.
Everything will be served from the local server.

= Where can I find a working demo? =

Just head to http://prismjs.com for demos and instructions.

= Who is the original developer of Prism Library? =

* This JS library is developed by : [Lea Verou](http://lea.verou.me/)
* With the many other Contributors : [Listed here](https://github.com/LeaVerou/prism/contributors)
* Hosted at : [Prismjs.com](http://www.prismjs.com)

= Changes do not reflect after saving settings ? =

Are you using some Cache/Performance plugin (eg:WP Super Cache/W3 Total Cache/BWP Minify) ?

Then flush your WP cache and refresh target page.

= Where does it store settings and options ? =

WP Database->wp-options->ank_prism_for_wp.
Uses a Single Row, stored in an array for faster access.

= What if I uninstall/remove this plugin? =

No worries! It will remove all traces from the database upon uninstall.


= This Plugin is unable to write js/css files . =

Each time update the settings, the plugin will create new js and CSS files.
There may be some chance that the plugin is unable to create or write these files. These files are essential for the plugin to work.

Possible reasons are ->

* Not enough permission to write a file.
* Plugin malfunction (my fault).
* You hosting provider has disabled File Handling Function via php.ini (rare).

How to resolve ->

* Login to your website via your FTP client software. (eg: FileZilla)
  and change file permission of this plugin folder.


= Did you test it older versions of WordPress ? =

It works with v4.6.0+ onwards. Most recent update allows it to work with 4.7.3.


= Have you changed anything in Prism source files =

No, each and every file is in its original state.



== Upgrade Notice ==

Please install v3.0.0

== Screenshots ==
1. Plugin Option Page Screen
2. Tiny MCE Pop-up box
3. Final output on front-end

== Changelog ==

= 3.0.0 =
* Added additional languages: 
* Ruby, SQL, C, ABAP, ActionScript, Ada, Apache Configuration, APL, Applescript, AsciiDoc, ASP.NET (C#), AutoIt, AutoHotkey, Bash, BASIC, Batch, Bison, Brainfuck, Bro, C#, C++, CoffeeScript, Crystal, D, Dart, Diff, Django/Jinja2, Docker, Eiffel, Elixir, Erlang, F#, Fortran, Gherkin, Git, GLSL, Go, GraphQL, Groovy, Haml, Handlebars, Haskell, Haxe, HTTP, Icon, Inform 7, Ini, J, Jade, Java, Jolie, JSON, Julia, Keyman, Kotlin, LaTex, Less, LiveScript, LOLCODE, Lua, Makefile, Markdown, MATLAB, MEL, Mizar, Monkey, NASM, nginx, Nim, Nix, Objective-C, OCaml, Oz, PARI/GP, Parser, Pascal, Perl, PowerShell, Processing, Prolog, .properties, Protocol Buffers, Puppet, Pure, Python, Q, Qore, R, React JSX, Reason, reST (reStructuredText), Rip, Roboconf, Rust, SAS, Sass (Sass), Sass (Scss), Scala, Scheme, Smalltalk, Smarty, Stylus, Swift, Tcl, Textile, Twig, TypeScript, Verilog, VHDL, vim, Wiki markup, Xojo (REALbasic), YAML
* Added additional plugins:
* Autoloader , Command Line, Copy to Clipboard, Preview: Base, Preview: Angle, Preview: Color, Preview: Easing, Preview: Gradient, Preview: Time
* Temporarily removed WebPlatform Docs

= 2.0.0 =
* Refactor code a lot
* Write dynamic files in out folder, so give write permission on out folder from now		

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
