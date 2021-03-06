krustykookies
=============

Yummy krusty kookies!

Installation
------------

*   Set up git & clone the repo to e.g. /srv/web/
    <br /><https://help.github.com/articles/set-up-git>

*   Optional: If you want to incorporate the project directly to Eclipse then go to File-&gt;Import-&gt;Projects from Git-&gt;Uri. Enter the URI of the repository (https://github.com/marcuslindfeldt/krustykookies.git) and your user details. Click Next-&gt;Next-&gt;Next-&gt;Finish. The New Project wizard will show up. Select PHP Project. Choose a project name. Specify php version 5.4 and enable java support for better autocompletion. Click Finish and your done! <br /><br />
OBS! This assumes that you already have the Eclipse PDT & EGit plugins installed.

*   Install webserver & other important packages (ubuntu)<br />
    Run the following commands from the terminal:
```
sudo apt-get install php5 php5-cli mysql-client mysql-server curl
```

*   Get the php dependency management system, Composer 
```
cd [project-dir]
curl -s https://getcomposer.org/installer | php
```
*   Install project dependencies 
```
cd [project-dir]
php composer.phar install
```
*   Run php's built in webserver
```
cd [project-dir]/public
php -S localhost:8000
```
*   The site can now be accessed from <http://localhost:8000/>

Configuration
-------------
Add your local database credentials to the configuration file located at project-dir/config/config.php. If you want you can also add an entry to your hosts file so you can access the server from e.g. <http://krustykookies.local/>. The hosts file is located at /etc/hosts.

Add the following row to your ~/.bashrc file to be able to run phpunit from anywhere within the project structure.

```
alias phpunit='$(git rev-parse --show-cdup)vendor/bin/phpunit'
```

Important documentation
-----------------------

*   PHP Conventions: <http://www.phptherightway.com>
*   Slim PHP framework: <http://docs.slimframework.com/>
*   PHPUnit docs: <http://www.phpunit.de/manual/current/en/writing-tests-for-phpunit.html>
*   Mustache template engine: <https://github.com/bobthecow/mustache.php/wiki/Mustache-Tags>
*   Official PHP API: <http://www.php.net/manual/en/>
