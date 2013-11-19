# PHP Backend Start

This is, more or less, my starting point for any application requiring a PHP backend.


## Backend Installation

Currently a [SlimPHP](http://www.slimframework.com) application that uses 
the [Laravel](http://laravel.com)'s [Eloquent ORM](http://laravel.com/docs/eloquent) 
Library. 

1. From project root directory, install dependencies using [Composer](http://getcomposer.org):  
`composer install`

2. Copy database config template:  
`cp api/config/db.php.dist api/config/db.php`

3. Currently, a GET request returning an entire table (by name) is all that is provided. Test an API endpoint: http://localhost/php-backend-start/api/index.php/v1/tableName and http://localhost/php-backend-start/api/index.php/v1/tableName?format=csv


## Frontend Installation

1. From project root directory, install dependencies using bower:  
`bower install`

2. Test that the app loads: http://localhost/php-backend-start/app
