=== WC Password Strength Settings ===
Contributors: danielsantoro
Tags: WooCommerce, Users, Accounts, Passwords, Security
Requires at least: 4.5.0
Tested up to: 5.4.2
Stable tag: trunk
License: GPL
License URI: http://www.gnu.org/licenses/gpl.html

Give additional control to WooCommerce site owners regarding their site's password strength requirements.

== Description ==

##Description##

WooCommerce has an integrated Password Strength Meter which forces users to use strong passwords. Sometimes this isn't desirable - with this plugin, you can choose between five password levels ranging from "Anything Goes" to "Strong Passwords Only". In addition, you can modify the colors and appearance of these custom messages, as well as modify or remove the password hint. For details on how the password strength is determined, [please read the documentation here](https://github.com/DanielSantoro/wc-password-strength-settings/wiki/How-Password-Strength-is-Determined).

= What's New? =

2.2.0 adds automated translations for the following languages in addition to English:
 - Czech
 - German
 - Spanish
 - French
 - Italian
 - Japanese
 - Korean
 - Portuguese (Brazilian)
 - Russian
 - Chinese (Simplified)
 - Chinese (Traditional)

Note that these are automatic translations - I can't speak other languages, so any localization assistance is more than welcome. [If you can contribute to localization, head over to GitHub](https://github.com/DanielSantoro/wc-password-strength-settings).

= Notes =

While this does allow for user accounts to have weaker passwords, it's a good idea to still encourage strong password use - _especially_ for administrators!

= Planned Features =

* Option to hide - " - Please enter a stronger password." suffix for weak passwords to allow more admin control and message flexibility.
* Option to display a link to a password strength calculator to the user.
* Open to suggestions!

== Installation ==
1. Download the plugin & install it to your `wp-content/plugins` folder (or use the Plugins menu through the WordPress Administration section)
2. Activate the plugin
3. Navigate to **WooCommerce > Settings > Accounts** and edit the fields at the bottom. There, you can choose the strength of the required passwords as well as change the messaging that appears as a user enters their password, change colors, and change any password guidelines.
4. Save and enjoy!

== Frequently Asked Questions ==
= Q: What does each level do? =
A: The levels range from 0 (lowest) to 4 (highest). As passwords are typed, the strength meter will dynamically update - this will disable the "Sign Up" button until the requirements have been met. It should be noted that Level 0 accepts any password, so messaging isn't shown (and therefore doesn't have admin fields).

= Q: Where does this meter show up? =
A: This should appear wherever the Password Strength Meter appears - in the "My Account" page or during Checkout.

= Q: How is the password strength determined? =
A: The password strength is determined by code in WordPress core, more specifically using a library called "zxcvbn", created by Dropbox. There's a more in-depth description of how this works in the [plugin documentation](https://github.com/DanielSantoro/wc-password-strength-settings/wiki).

= Q: How can I require numbers, special characters, or a certain length? =
A: This plugin doesn't allow for that functionality, because it's not part of the built-in WordPress password strength algorithms. Those restrictions have also been proven to be ineffective and frustrating for users. See [How Password Strength is Determined](https://github.com/DanielSantoro/wc-password-strength-settings/wiki/How-Password-Strength-is-Determined).

= Q: Why is my password marked as weak? =
A: This is the most common question I get, and the short answer is I don't know, but you can likely figure it out with the guide on [How Password Strength is Determined](https://github.com/DanielSantoro/wc-password-strength-settings/wiki/How-Password-Strength-is-Determined).

= Q: This allows weak passwords during account creation in checkout - what gives? =
A: This is unfortunately unavoidable. As of writing, WooCommerce doesn't validate the password strength in the checkout page, so while the strength meter will show it _doesn't_ enforce it. This isn't something I'm able to work around, so share that you want validation on the password strength requirements in the official WooCommerce [Ideas Board](http://ideas.woocommerce.com/forums/133476-woocommerce) - once it's active in WooCommerce, it will automatically be active here. :)

= Q: My site was recently hacked. Is this plugin vulnerable, or does it cause vulnerabilities? =
A: No, this plugin does not create any vulnerabilities. It does create additional displays for the _client-side_ (in the user's browser), but not server-side where vulnerabilities are found. It is using the Password Strength Meter that is already in WordPress, and doesn't store or handle any information - WordPress or WooCommerce are the only ones that see and manage passwords, not this plugin. For security advice, please [check out this older but still valid security 101 guide I've written](https://danielsantoro.com/locking-down-wordpress-security-101/).

= Q: Where can I go if I find an issue or want to recommend a feature? =
A: If you experience any issues, please [let the developer know](https://danielsantoro.com/support/?utm_source=pw-strength-plugin&utm_medium=plugin-readme). If you have ideas for future features or improvements, head over to [GitHub to see if something is in development or to help contribute](https://github.com/DanielSantoro/wc-password-strength-settings).

= Q: Dang, this is pretty awesome. Where can I see some of your other stuff? =
A: You can check out the Danny's personal site at [DanielSantoro.com](https://danielsantoro.com?utm_source=pw-strength-plugin&utm_medium=plugin-readme). He doesn't keep up with it as much as he'd like, but it's there.

== Changelog ==

= 6/30/2020 - Version 2.2.0 =
 * Added localization for various languages
 * Confirmed compatibility with the latest WordPress and WooCommerce versions
 * FAQ update RE: Security

= 4/25/2019 - Version 2.1.0 =
 * Enabled localization for all text in the plugin's admin section.
 * Confirmed compatibility with WordPress 5.1.1 and WooCommerce 3.6.2.

= 2/9/2018 - Version 2.0.2 =
 * Cleaned up code in preparation for Localization
 * Getting ready for additional options like changing extra text
 * FAQ Update
 * Confirmed WooCommerce/WordPress compatibility

= 9/21/2017 - Version 2.0.1 =
 * Fixed a few spacing and semantic issues
 * Fixed broken link in readme.txt
 * Added version checking compatibility for WooCommerce 3.2 - tested working

= 8/25/2017 - Version 2.0.0 =
 * Total plugin rewrite from the ground up
 * Added quick links in Plugin Overview page to Documentation and Support
 * Created an Admin Screen class to better contain information
 * Added ability to change the messaging color per level (with built-in color picker or hex codes)
 * Added ability to change or disable the Password Hint messaging
 * Added ability to hide the emoji display
 * Removed "Level 1" fields, as they were not used in actual calculation or display
 * Tested through WordPress 4.8.1 and WooCommerce 3.1.2
 * Unfortunately, this broke multilingual support. If someone wants to jump in in the GitHub, that would be great!

= 8/1/2017 - Version 1.2.0 = 
 * Add multilingual support and zh_TW translated thanks to [AthenaTzeng](https://github.com/AthenaTzeng)

= 4/5/2017 - Version 1.1.0 =
 * Added fields to allow for custom messaging as a user is inputting passwords
 * Added rynald0s as a co-author, because he's a modern-day superhero

= 3/28/2017 - Version 1.0.2 =
 * Readme fixes, added setting to change password strength meter labels / password error message

= 9/28/2016 - Version 1.0.1 =
 * Readme fixes, version check to WordPress 4.6 compatibility

= 7/24/2016 - Version 1.0.0 =  
 * Initial Release
