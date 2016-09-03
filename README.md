-- Under development --
==============

A PHP wrapper for use with the [SonarQube](http://docs.sonarqube.org/display/DEV/Web+Service+API).
==============
Based on [php-sonarqube-api](https://github.com/spirit-dev/php-sonarqube-api).

Installation
------------
Install Composer
```
$ curl -sS https://getcomposer.org/installer | php
$ sudo mv composer.phar /usr/local/bin/composer
```

Add the following to your require block in composer.json config. Note: be careful when using the `dev-master` tag as this may have unexpected results depending on your version of SonarQube.
```
"spirit-dev/php-sonarqube-api": "dev-master"
```

Include Composer's autoloader:
```php
require_once dirname(__DIR__).'/vendor/autoload.php';
```

General API Usage
-----------------

```php
$client = new \SonarQube\Client('http://sonar.domain.com/api/', 'username', 'password'); // change here
$authentication = $client->api('authentication')->validate();
$projects = $client->projects->search(['search'=>'XYZ']);
$measures = $client->measures->component(['componentKey'=>'ABC.XYZ','metricKeys'=>'ncloc_language_distribution,complexity,violations']);
```

Calls can be made either via `$client->api('apiSection')->endpoint()` or as a property: `$client->apiSection->endpoint()`. The two syntaxes work identically.

Contributing
------------
This project is currently under development. Many part of SonarQube official API are not parts of this project. Feel free to fork this project, apply modifications and sending me you pull requests.
