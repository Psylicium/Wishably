# Ønskesedlen
A tool for coordinating presents.

We all know the drill: It's christmas really soon, and you have to figure out both your own wishes, and what to give to others. It can be a pain to coordinate properly with a lot of mailing/calling/texting back and forth to figure out who buys what to whom. With this easy-to-use tool, the participants can write their own wishes, see other people's, and reserve/unreserve gifts.

## Requirements

All you need is a webhost which supports PHP, and access to an MySQL database.

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

* Open `register.php` and enter your invite code and mail settings (where the registration mail with the password will be sent from):

```php
$invite_code = "<INVITATION_CODE>";
$mailfrom    = "From: Sender Name <sender@mail.address>";
```

This should be it! Simple, eh? A text field can be added below the wishlist on the front page (welcome message, instructions etc.), but this is disabled by default. To enable it, open `index.php` and edit the variables at the top:

```php
$display_text = 0;
$page_text    = 'This is displayed in the text field below the wishlist';
```

`$display_text` sets whether the text field is shown. `0` disables it, `1` enables it.
`$page_text` contains the text you want to show. You can use standard HTML formatting.

The application is multilingual, and can be displayed in whatever language it is translated into. You can set the display language in `header.php` by changing `include('lang/lang_XX.php')` where XX being the language. Check `/lang/languages.txt` for more info and current translations.

If you want to clear the database and start over next christmas, you can either:
* have each user login and delete their profile (email address, wishes and reservations)
* manually empty (truncate) the tables, or
* import `/mysql/onskeseddel_dbcreate.sql` again

I may add some admin functionality, so the user profiles and the database can be managed in frontend, but until now, this'll have to do :)

## Usage

All participants sign up and get their random 6-digit password, which they sign in with. The registration process should be spam-proof using a honeypot to fool bots trying to sign up.

Let's take a christmas present example:

1. Phoebe wish for a book, some earrings and four new winter tires, so she adds them to "My Wishlist". These wishes will be shown on the index page for all to see (and reserve).
2. Now Chandler comes by to enter some of his wishes as well. He sees that Phoebe wants some tires and a book, so he reserves those wishes. Since they are now taken, they won't be displayed on the index page anymore. Chandler can still see them under "My Reservations" - and of course Phoebe also still sees them under "My Wishlist".
3. Phoebe can edit or delete her wishes at any time, but she should use this WITH CAUTION! She can't see which of her presents have been reserved - or perhaps even bought. (That would also ruin the whole surprise, right?)...
4. If Chandler get second thoughts, or can't afford the tires, he can unreserve them. The wish now becomes available, and is yet again shown on the front page for others to reserve.

By doing it like this, everyone can see what other people wish for, and it's shown in a nice and clean way to avoid accidentally getting the same gift from different people.

## History

* `2017/01/19` Version 1.01:
	- Minor bugfixes
	- Added language support

* `2017/01/16` Version 1.0: Committed to GitHub. As I originally made this in danish, this is of course best suited for people understanding the language. I will add some easy-to-use translation functionality in the next version, which will (hopefully) be released very soon.

## Credits

This was created in January 2017 by Henrik Mortensen (http://psylicium.dk). Read more about it (in Danish) and try a live demo at http://psylicium.dk/oenskesedlen/.

## License

Copyright (C) 2017 Henrik Mortensen

This program is free software; you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation; either version 3 of the License, or (at your option) any later version. This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details. You should have received a copy of the GNU General Public License along with this program; if not, write to the Free Software Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
