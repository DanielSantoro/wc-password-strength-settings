=== WC Password Strength Settings ===
Contributors: danielsantoro, rynald0s
Tags: WooCommerce, Users, Accounts, Passwords, Security
Requires at least: 4.5.0
Tested up to: 4.7.3
Stable tag: trunk
License: GPL
License URI: http://www.gnu.org/licenses/gpl.html

Allows administrators to set minimum password strength requirements for their WooCommerce user accounts.

== Description ==

##Description##

Introduced in recent versions of WooCommerce, there is an integrated Password Strength Meter which forces users to use strong passwords. Sometimes this isn't desirable - with this plugin, you can choose between five password levels ranging from "Anything Goes" to "Strong Passwords Only".

= What's New? =

As of plugin version 1.1.0, you can change the messaging that appears as a user is typing through custom fields. Special thanks to Rynaldo for making this possible!

= Notes =

If you experience any issues or have ideas for features, please [let the developer know](https://github.com/DanielSantoro/wc-password-strength-settings).

While this does allow for user accounts to have weaker passwords, it's a good idea to still encourage strong password use - _especially_ for administrators!

= Planned Features =

The below list is things that are on the eventual roadmap:

* Ability to remove smiley faces
* Ability to change color of messaging
* Ability to optionally remove the password guidelines

== Installation ==
1. Download the plugin & install it to your `wp-content/plugins` folder (or use the Plugins menu through the WordPress Administration section)
2. Activate the plugin
3. Navigate to **WooCommerce > Settings > Accounts** and edit the fields at the bottom. There, you can choose the strength of the required passwords as well as change the messaging that appears as a user enters their password.
4. Save and enjoy!

== Frequently Asked Questions ==
= Q: What does each level do? =
A: The five levels range from 1 (lowest) to 5 (highest). As passwords are typed, the strength meter will dynamically update - this will disable the "Sign Up" button until the requirements have been met.

= Q: Where does this show up? =
A: This should appear wherever the Password Strength Meter appears - in the "My Account" page or during Checkout.

= Q: Where can I go if I find an issue or want to recommend a feature? =
A: You can submit a new issue on the [Public GitHub Repository](https://github.com/DanielSantoro/wc-password-strength-settings).

= Q: Dang, this is pretty awesome. Where can I see some of your other stuff? =
A: Two places! You can check out the Danny's personal site at [DanielSantoro.com](https://danielsantoro.com), or follow Rynaldo on his [WordPress.org page](https://profiles.wordpress.org/rynald0s/).

== Changelog ==

= 4/5/2017 - Version 1.1.0 =
 * Added fields to allow for custom messaging as a user is inputting passwords.
 * Added rynald0s as a co-author, because he's a modern-day superhero.

= 3/28/2017 - Version 1.0.2 =
 * Readme fixes, added setting to change password strength meter labels / password error message

= 9/28/2016 - Version 1.0.1 =
 * Readme fixes, version check to WordPress 4.6 compatibility

= 7/24/2016 - Version 1.0.0 =  
 * Initial Release