# PHP 7.1 sample application

Sample PHP applications that uses:
* Dependency Injection
* Apache routing
* Composer (aka: Not reinventing the wheel)

## Requirements

* Unix-like operating systems
* Apache
* MariaDB/MySQL
* PHP >= 7.1
* Command line tools `make` & `wget`

## Setup

1. Run `make` from project root.
2. Create a 'sampleuser' MariaDB/MySQL account, by default, application is configured to use password 'samplepass'.
3. Create the 'sample' database and load [sql/db.sql](/sql/db.sql).
4. Configure Apache:
```apache
<VirtualHost *:80>
    ServerName %application.host.name%
    DocumentRoot /%path-to-repository%/web

    <Directory /%path-to-repository%>
        Require all granted
        AllowOverride all
    </Directory>

    php_admin_value include_path "/%path-to-repository%/"

    Include /%path-to-repository%/config/vhost.conf
</VirtualHost>
```

You are all set, point your browser to http://%application.host.name%/
