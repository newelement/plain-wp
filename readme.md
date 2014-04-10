#Plain. Website - Wordpress Theme

Plain Wordpress Version 1.0

This theme is based on LESS compiled by CodeKit.

Upon theme activation this theme will create some sample blog entries, pages, page sections, primary nav and comes with a small site settings page.

The site settings can be used in code for things like address info and social media links.

```php
$site_settings (array)

// Just use global inside functions

function my_function(){
    
    global $site_settings;
    
    ...
    
}

// Available settings

array(17) {  
["business_name"]=>  
string(0) ""  
["address1"]=>  
string(0) ""  
["address2"]=>  
string(0) ""  
["city"]=>   
string(0) ""  
["state"]=>  
string(0) ""  
["zip"]=>  
string(0) ""  
["phone"]=>  
string(0) ""  
["mobile"]=>  
string(0) ""  
["fax"]=>  
string(0) ""  
["google_analytics"]=>  
string(0) ""  
["facebook_url"]=>  
string(0) ""  
["twitter_url"]=>  
string(0) ""  
["instagram_url"]=>  
string(0) ""  
["pinterest_url"]=>  
string(0) ""  
["youtube_url"]=>  
string(0) ""  
["gplus_url"]=>  
string(0) ""  
["gmaps_url"]=>  
string(0) ""  
}

```

![Plain screenshot](https://raw.github.com/newelement/plain/master/screenshot-full.png)

Big thanks/props/monster shoutout to HTML5 Boilerplate, Bootstrap, Roots.io and all web designers and developers.

License: [WTFPL](http://www.wtfpl.net/txt/copying/)