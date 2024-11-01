=== WP BBCode ===
Contributors: eflyjason
Donate link: http://www.arefly.com/donate/
Tags: BBCode
Requires at least: 3.0
Tested up to: 3.8
Stable tag: trunk
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Use BBCode in posts or comments. 讓你可以在部落格中使用BBCode

== Description ==

Use [BBCode](http://en.wikipedia.org/wiki/BBCode) in posts or comments.

讓你可以在部落格中使用 [BBCode](http://en.wikipedia.org/wiki/BBCode)

Examples:

`Bold: [b]bold[/b]

Italics: [i]italics[/i]

Underline: [u]underline[/u]

Delete: [del]delete[/del]

Code: [code]some code...[/code]

Font Color: [color="red"]These words are red![/color]

Font Size: [size="20"]These words are font size 20px big![/size]

Center: [center]These words are in the center![/center]

URL: [url]http://wordpress.org/[/url] [url="http://wordpress.org/"]WordPress[/url]

Image: [img]http://s.wordpress.org/style/images/codeispoetry.png[/img] [img="CODE IS POETRY"]http://s.wordpress.org/style/images/codeispoetry.png[/img]

URL: [email="info@google.com"]Send Mail To Google[/email] [email]info@google.com[/email]

Quote:

[quote]Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi.[/quote]

Textarea: [textarea]This is something in a textarea![/textarea]

Table:
[table]
[tr]
[th]row 1, title 1[/th]
[th]row 1, title 2[/th]
[/tr]
[tr]
[td]row 2, cell 1[/td]
[td]row 2, cell 2[/td]
[/tr]
[tr]
[td]row 3, cell 1[/td]
[td]row 3, cell 2[/td]
[/tr]
[/table]

Note: (The content in note will not display)

[note]These words will not display on the screen.[/note]

Line: (It will just display a line, and you should not add anything into it.)

[line][/line]

Unordered List: 

[ul]
[li]First Item[/li]
[li]Second Item[/li]
[/ul]

Ordered List: 

[ol]
[li]First Item[/li]
[li]Second Item[/li]
[/ol]

Right Align Text: [rtl]These Text are on the right![/rtl]`

= Translators =

* Chinese, Simplified (zh_CN) - [Arefly](http://www.arefly.com/)
* Chinese, Traditional (zh_TW) - [Arefly](http://www.arefly.com)
* English (en_US) - [Arefly](http://www.arefly.com)

If you have created your own language pack, or have an update of an existing one, you can send [gettext PO and MO files](http://codex.wordpress.org/Translating_WordPress) to [Arefly](http://www.arefly.com/about/) so that I can bundle it into WP BBCode. You can download the latest [POT file](http://plugins.svn.wordpress.org/wp-bbcode/trunk/lang/wp-bbcode.pot).

== Installation ==

###Updgrading From A Previous Version###

To upgrade from a previous version of this plugin, delete the entire folder and files from the previous version of the plugin and then follow the installation instructions below.

###Installing The Plugin###

Extract all files from the ZIP file, making sure to keep the file structure intact, and then upload it to `/wp-content/plugins/`.

This should result in the following file structure:

`- wp-content
    - plugins
        - wp-bbcode
            - lang
                | readme.txt
                | wp-bbcode-zh_CN.mo
                | wp-bbcode-zh_CN.po
                | wp-bbcode-zh_TW.mo
                | wp-bbcode-zh_TW.po
                | wp-bbcode.pot
            | LICENSE
            | license.txt
            | options.php
            | readme.txt
            | wp-bbcode.php`

Then just visit your admin area and activate the plugin.

**See Also:** ["Installing Plugins" article on the WP Codex](http://codex.wordpress.org/Managing_Plugins#Installing_Plugins)

== Frequently Asked Questions ==

= I cannot active this plugin, what can i do? =

You may post on the [support forum of this plugin](http://wordpress.org/support/plugin/wp-bbcode/) to ask for help.

= I love this plugin! Can I donate to you? =

YES! I do this in my free time and I appreciate all donations that I get. It makes me want to continue to update this plugin. You can find more details on [About Me Page](http://www.arefly.com/about/).

== Changelog == 

**Version 1.8.1**

* Add Translation for Russian. (Thanks for [Rlector](http://www.wordpressplugins.ru/komments/bbcode-rabochaya-versiya.html))

**Version 1.8**

* Remove All Remote Load File.

**Version 1.7.9**

* Fix Bug of `define`. (Thanks to cmhello)

**Version 1.7.8**

* Add Plugin Language Text Domain Information.

**Version 1.7.7**

* Update Readme File.

**Version 1.7.5 to 1.7.6**

* Fix Bugs.

**Version 1.7.4**

* Add short code `rtl`. (Thanks for Haroirum)

**Version 1.7.1 to 1.7.3**

* Fix Bugs.

**Version 1.7**

* Add Localize Support. (en_US, zh_CN and zh_TW)

* Fix Bugs.

**Version 1.6.2**

* Fix Bugs.

**Version 1.6.1**

* Add "My Plugins List".

**Version 1.6**

* Fix bugs.

**Version 1.5.5**

* Add Support to Wordpress 3.8.

**Version 1.5.2**

* Fixed bugs.

**Version 1.5**

* Add Options Page!

* Add option of place you want to open short code. (For now, just have "Everywhere" and "Only in comments")

* Fixed bugs.

**Version 1.4.1**

* Fixed bugs.

**Version 1.4**

* Add short code `ol`, `ul` and `li`.

* Add short code `size` and `center`.

* Add short code `textarea`.

* Add short code `table`, `th`, `tr` and `td`.

* Add short code `note` (The content in `note` will not display).

* Add short code `line` (It will display one line).

* Fixed bugs.

**Version 1.3**

* Add short code `email`.

**Version 1.2**

* Add short code `color`.

**Version 1.1**

* Add short code for `del` and `code`.

**Version 1.0**

* Initial release.

== Upgrade Notice ==

See Changelog.