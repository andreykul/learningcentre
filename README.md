Learning Centre App
==============

##Description
Learning Centre Web Application for Faculty of Computer Science at Dalhousie

##Installation
###Prerequisites 
* WAMP, LAMP, MAMP (Apache, MySQL, PHP)
* PHP in the PATH environment variable ([Windwos](http://www.itechtalk.com/thread3595.html), [Linux/Mac](http://www.cyberciti.biz/faq/unix-linux-adding-path/))
* openssl module enabled in php.ini (i.e. C:\wamp\bin\php\php5.4.3\php.ini)
* [Composer](http://getcomposer.org/doc/00-intro.md#downloading-the-composer-executable)

###Instructions
* Enter the folder where you store your PHP code (Usually _htdocs_ or _www_).
* run `git clone https://github.com/andreykul/learningcentre.git`.
* Enter the Folder created.
* run `php composer.phar install` to install dependencies. (Make sure it was successful)
* Configure "app/config/database.php" to your local database.
* You should be able to access the project at _localhost/learningcentre/public_


