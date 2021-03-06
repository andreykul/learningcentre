Learning Centre App
==============

##Description
Learning Centre Web Application for Faculty of Computer Science at Dalhousie

#####Feel free to modify it for your own faculty or needs.

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
* [Optional] Open _PhpMyAdmin_ create a new database called "learningcentre"
* Create a file `app/config/database.php` and copy [database.php](https://raw.github.com/laravel/laravel/master/app/config/database.php) into it
	* Modify the following in the MySQL section to match your database:
		* host
		* database
		* user
		* password
* [Optional] Modify `app/config/mail.php` to send actual emails
* run `php artisan migrate` to update your database
* run `php artisan db:seed` to populate the tables
* You should have now have two accounts:
  * Email: "admin@cs.dal.ca" , Password: "password"
  * Email: "ta@cs.dal.ca" , Password: "password"
  * Email: "ta2@cs.dal.ca" , Password: "password"
  * Email: "ta3@cs.dal.ca" , Password: "password"
* You should be able to access the project in your browset at:
	* `http://localhost/learningcentre/public` or
	* `http://localhost:8888/learningcentre/public` or
	* `http://localhost:[port]/learningcentre/public`
* Modifications to `public/.htaccess` might be needed to work correctly

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
* Manual reset (If migrations fail to work)
	* Open PhpMyAdmin and remove each table manually
	* run `php artisan migrate`
	
###Populate/Seed
* run `php artisan db:seed`

---

##Development
* New Issue Branch
	* `git checkout -b issue-#`
	* `git push -u origin issue-#`
* Working on somebody's branch (Will download their branches)
	* `git fetch`
* Merge problems
	* You will be given your code and the other code sepperated with special symbols.
	* Decided what part to remove and what to keep
	* Add and Commit
	* You are good to go, push
* Working with Emails
	* If you want to see the email that is sent in pretend mode
	* First change the mailer.php to display the body of the message as explained [here](http://stackoverflow.com/a/19734702/2394104).
	* You are able to view the pretend emails at _"app/storage/logs"_