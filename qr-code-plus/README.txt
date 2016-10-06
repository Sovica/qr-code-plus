=== Plugin Name ===
Contributors: Sovica
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=66TTWDMFHWYPU
Tags: qr code, qr code generator, qr code widget, qr code shortcode, qr code plus
Requires at least: 3.8
Tested up to: 4.5
Stable tag: 1.0.0
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Easily add Qr codes to your site via shortcodes or widgets.

== Description ==

This is a lightweight and fast plugin that uses JavaScript to create dynamic QR codes. It doesn't depend
on any third party services like Google and is free to use.

**Main Features**

*   Easy shortcode support for posts and pages
*   QR Code widget support is included
*   A single small JavaScript file is included only on pages that you use QR codes
*   Configurable colors for your QR codes
*   Easy straightforward settings page
*   Automatically prepopulates QR codes with your permalinks structure

The plugin will automatically detect your content length and use the appropriate QR code version.
This improves your QR codes and uses less dense graphics instead of more complicated ones if not needed.
For example, if you provide 55 alphanumeric characters, you will get a Version 3 QR code.
The plugin currently has support for a MAX of 396 alphanumeric characters.

The plugin is currently designed to take URL's as input or any other text but you can create vcards or anything
else as long as you know how to format your text.

Thanks to Lars Jung and his awesome [jQuery plugin](https://larsjung.de/jquery-qrcode/) that made this plugin possible.

== Installation ==

1. Download the zip plugin file from wordpress.org
1. Upload it through your plugins menu in your WordPress dahsboard
1. Activate the plugin
1. (Optional) Go to the settings menu of the plugin to setup default values for your QR codes

== Frequently Asked Questions ==

= Can I style my QR codes? =

Yes!
All QR codes share the *qrplus_container* CSS class. You can use it as a selector and use custom CSS in your 
main or child theme styles.css file to style, center or do whatever you wish.

= How do I use Qr Code Plus shortcodes? =

The plugin provides a tinyMCE button on your visual editor to easily insert shortcodes.

= What shortcode parameters are supported? =

The following parameters are supported:

*   size - [qrplus_code size="200"] Will set the size of your QR code to 200x200px
*   text - [qrplus_code text="http://www.google.com"] Will point to google.com when scanned
*   render - [qrplus_code render="canvas"] Will render the QR code in canvas mode
*   fill - [qrplus_code fill="#000000"] Will color your QR code in black
*   radius - [qrplus_code radius="5"] Will round the corners of your QR code

= What shortcode parameters are required? =

None! By default when you add a QR shortcode via your visual editor it will add [qrplus_code].
This is all that the plugin needs to render your QR code. It will grab all settings that you 
saved previously in the admin section of the plugin and use it.
If you wish to override any setting, use the above mentioned params to do so.

= Can I add other content then URL's into my QR codes? =

Indeed you can!
Here's an example text that when scanned will prompt a contact card request:

BEGIN:VCARD
VERSION:3.0
N:Lastname;Surname
FN:Displayname
ORG:EVenX
URL:http://www.evenx.com/
EMAIL:info@evenx.com
TEL;TYPE=voice,work,pref:+49 1234 56788
ADR;TYPE=intl,work,postal,parcel:;;Wallstr. 1;Berlin;;12345;Germany
END:VCARD

== Screenshots ==

1. This screen shot description corresponds to screenshot-1.(png|jpg|jpeg|gif). Note that the screenshot is taken from
the /assets directory or the directory that contains the stable readme.txt (tags or trunk). Screenshots in the /assets
directory take precedence. For example, `/assets/screenshot-1.png` would win over `/tags/4.3/screenshot-1.png`
(or jpg, jpeg, gif).
2. This is the second screen shot

== Changelog ==

= 1.0.0 =
* Initial release of the plugin.

== Upgrade Notice ==

= 1.0.0 =
Upgrade to 1.0 because it's the only version that exists currently.

== Arbitrary section ==

QR Code is registered trademark of DENSO WAVE INCORPORATED.