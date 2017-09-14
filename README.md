# Ønskesedlen
A tool for coordinating presents.

We all know the drill: It's christmas really soon, and you have to figure out both your own wishes, and what to give to others. It can be a pain to coordinate properly with a lot of mailing/calling/texting back and forth to figure out who buys what to whom. With this easy-to-use tool, the participants can write their own wishes, see other people's, and reserve/unreserve gifts.

## Demo

You can try a demo at http://projects.psylicium.dk/onskedemo/

## Requirements

All you need is a webhost which supports PHP 7.0, and access to a MySQL database.

## Installation

* Create a new empty database, and import the included `/mysql/onskeseddel_dbcreate.sql`. This will create the required tables.

* Set the necessary variables for connecting to the database in `conxion.php`:

```php
// Database host
$dbhost     = "<YOUR_DATABASE_ADDRESS>";
 
// Database username
$dbusername = "<DATABASE_USERNAME>";
 
// Database password
$dbpassword = "<DATABASE_PASSWORD>";
 
// Database name
$dbname     = "<DATABASE_NAME>";
```

* Open `func.php` and enter som bacic settings for your site:

An invite code and mail settings (where the registration mail with the password will be sent from):

```php
$mailfrom    = "From: Sender Name <sender@mail.address>";
$invite_code = "<INVITE_CODE>";
```

The title of your site:

```php
define("SITENAME", "Wishably");
```

The language (refer to /lang/languages.txt for supported languages):

```php
include('lang/lang_en.php');
```

This should be it! Simple, eh?

A text field can be added below the wishlist on the front page (welcome message, instructions etc.), but this is disabled by default. To enable it, open `index.php` and edit the variables at the top:

```php
$display_text = 0;
$page_text    = 'This is displayed in the text field below the wishlist';
```

`$display_text` sets whether the text field is shown. `0` disables it, `1` enables it.
`$page_text` contains the text you want to show. You can use standard HTML formatting.

You can also display a list of the registered users at the bottom of the wish list:

```$display_users = 1;```

This is enabled by default, but you can disable it by setting `$display_users = 0;` in `index.php`:

The application is multilingual, and can be displayed in whatever language it is translated into. You can set the display language in `func.php` by changing `include('lang/lang_XX.php')` where XX being the language. Check `/lang/languages.txt` for more info and current translations.

For easy management, I have included an admin section where you can either delete all current wishes (but leaving user information) or wipe the entire database for easy reuse.

### First thing to do after setting up
After the above steps are completed, the first thing you'll need to do is create an administrator account. This is done by going to __/admin/createadmin.php__ and entering your desired login details. It will set the `admin` cell to 1 in the database. ___You have to delete or rename this file to some random gibberish upon completion___ - otherwise, anyone can gain admin rights.

## Usage

All participants sign up. The registration process should be spam-proof using a honeypot to fool bots trying to sign up. There's also the required invite code to make it extra secure, and that as well prevents strangers from joining.

Let's take a christmas present example:

1. Phoebe wish for a book, some earrings and four new winter tires, so she adds them to "My Wishlist". These wishes will be shown on the index page for all to see (and reserve).
2. Now Chandler comes by to enter some of his wishes as well. He sees that Phoebe wants some tires and a book, so he reserves those wishes. Since they are now taken, they won't be displayed on the index page anymore. Chandler can still see them under "My Reservations" - and of course Phoebe also still sees them under "My Wishlist".
3. Phoebe can edit or delete her wishes at any time, but she should use this WITH CAUTION! She can't see which of her presents have been reserved - or perhaps even bought. (That would also ruin the whole surprise, right?)...
4. If Chandler get second thoughts, or can't afford the tires, he can unreserve them. The wish now becomes available, and is yet again shown on the front page for others to reserve.

By doing it like this, everyone can see what other people wish for, and it's shown in a nice and clean way to avoid accidentally getting the same gift from different people.

## History

* 2017/09/14: _Version 2.0_
	- __Added:__ Frontend administration for basic database operations
	- __Added:__ The option for users to select their own password
	- __Added:__ The option for users to reset and set a new password
	- __Fixed:__ Inconsistency in error messages
	- __Changed:__ Rearranged some of the variables across files
	- __Changed:__ Made some minor cosmetic adjustments

* 2017/01/19: _Version 1.01_
	- Minor bugfixes
	- __Added:__ Language support

* 2017/01/16: _Version 1.0_
	- Committed to GitHub. As I originally made this in danish, this is of course best suited for people understanding the language. I will add some easy-to-use translation functionality in the next version, which will (hopefully) be released very soon.

## Credits

This was created in January 2017 by Henrik Mortensen (http://psylicium.dk). Background image by Rolf Schweizer Fotografie (https://www.flickr.com/photos/schweizerrolf/23543699950/).

## License

Copyright (C) 2017 Henrik Mortensen

This program is free software; you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation; either version 3 of the License, or (at your option) any later version. This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details. You should have received a copy of the GNU General Public License along with this program; if not, write to the Free Software Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
