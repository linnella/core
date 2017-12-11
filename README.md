
Requirements
------------
 - PHP >= 7.0.0
 - Laravel >= 5.5.0
 - Fileinfo PHP Extension
 
Installation
------------

> This package requires PHP 7+ and Laravel 5.5

First, install laravel 5.5, and make sure that the database connection settings are correct.

```
composer require linnella/core:dev-master
```

Then run these commands to publish assets and config：

```
php artisan vendor:publish --provider="Core\Admin\AdminServiceProvider"
```
After run command you can find config file in `config/admin.php`, in this file you can change the install directory,db connection or table names.

At last run following command to finish install. 
```
php artisan admin:install
```

Open `http://localhost/admin/` in browser,use username `admin` and password `admin` to login.

Configurations
------------
The file `config/admin.php` contains an array of configurations, you can find the default configurations in there.



License
------------
 [The MIT License (MIT)](LICENSE).
