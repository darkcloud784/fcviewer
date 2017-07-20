# Free Company Viewer

As the previous FC-Fetcher by Noodlefu has been inactive and undeveloped, I've decided to continue my own version. Most of the concept and some of the code came from his creation.
It is built on Viion's lodestone-php API. https://github.com/viion/lodestone-php

## Requirements

* PHP 7.0+
* MySQL 5 with MySQLi
* Webserver (Apache)
* Curl extension

## Install

* Setup the database schema, you can use phpmyadmin or commandline if on a unix based system.
```
mysql -u username -p database_name < path_to_sql_file.sql
```

1. Fill out config.php information.
2. Setup cron for cron.php.
* Lodestone updates once a day so creating a 15 min cron probably isn't going to do much.
3. Profit

## Wordpress
 To get this to appear in Wordpress, I edit my own theme's functions.php (found in content/themes/xxx/functions.php - add one if it's not there if you like), and add the following code and then use [phpinclude]FreeCompany.php[/phpinclude]
 Make sure you place the enter fcviewer source in the root of your wordpress directory.

```php
function phpinclude_func( $atts , $content = null ) {
	if ( !is_null( $content ) && file_exists( ABSPATH . $content ) )
		include( ABSPATH . $content );
	else
		echo "File not found.";
}
add_shortcode( 'phpinclude', 'phpinclude_func' );
```