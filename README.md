# PHP 7.1 sample application

## Requirements

* Unix-like operating systems
* Apache
* PHP >= 7.1
* Command line tools `make` & `wget`

## Setup

1. Configure Apache:
```apache
<VirtualHost *:80>
    ServerName %application.host.name%
    DocumentRoot /%path-to-repository%/web

    <Directory /%path-to-repository%>
        Require all granted
        AllowOverride all
    </Directory>

    Include /%path-to-repository%/config/vhost.conf
</VirtualHost>
```
2. Run `make` from project root.
