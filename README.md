Learning Centre App
==============

##Description
Learning Centre Web Application for Faculty of Computer Science at Dalhousie

##Installation
###Prerequisites

* Install Git
	* Windows:
		* [Git](http://git-scm.com/downloads)
	* Linux (Ubuntu):
		* `sudo apt-get install git`
	* Mac:
		* Installed by default
* Install WAMP,LAMP or MAMP (Apache, MySQL, PHP 5.4):
	* Windows:
		* [WAMP](http://www.wampserver.com/en) (Download WAMP with PHP 5.4)
	* Linux (Ubuntu):
		* `sudo apt-get install lamp-server^` (Do not remove the ^)
	* Mac:
		* [MAMP](http://www.mamp.info/en/index.html) (Download the free version of MAMP )
* Make sure you can run PHP in the Command Line 
	* How to modify the PATH variable: [Windwos](http://www.itechtalk.com/thread3595.html), [Linux/Mac](http://www.cyberciti.biz/faq/unix-linux-adding-path/)
* Enable the _openssl_ and _Mcrypt_ modules in PHP
* Enable the *rewrite_module* in Apache

###Instructions
* Open Terminal/Command Line/Git Bash
* Change to the folder where you store your PHP code (Usually _htdocs_ or _www_).
* run `git clone https://github.com/andreykul/learningcentre.git`.
* Enter the Folder created.
* run `php composer.phar install` to install dependencies. 
* Open _PhpMyAdmin_ create a new database called "learningcentre"
* Create a file `app/config/database.php` and copy [database.php](https://raw.github.com/laravel/laravel/master/app/config/database.php) into it
	* Modify the user,password and database in the MySQL section
* run `php artisan migrate` to update your database
* run `php artisan db:seed` to populate the tables
* You should have now have two accounts:
  * Username: "admin" , Password: "password"
  * Username: "ta" , Password: "password"
* You should be able to access the project in your browset at:
	* `http://localhost/learningcentre/public` or
	* `http://localhost:8888/learningcentre/public` or
	* `http://localhost:[port]/learningcentre/public`

---

##Database
###Migrations
* Update tables
	* run `php artisan migrate`
* Reset tables
	* run `php artisan migrate:refresh`
* Remvoe tables
	* run `php artisan migrate:reset`
* Undo last table change
	* run `php artisan migrate:rollback`
* Manual reset
	* Open PhpMyAdmin and remove each table manually
	* run `php artisan migrate`
	
###Populate/Seed
* run `php artisan db:seed`