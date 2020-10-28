<p align="center">
    <h1 align="center">Flip Software Developer (Backend) Technical Test</h1>
    <br>
</p>

DIRECTORY STRUCTURE
-------------------

      assets/             contains assets definition
      commands/           contains console commands (controllers)
      config/             contains application configurations
      controllers/        contains Web controller classes
      mail/               co
      ntains view files for e-mails
      models/             contains model classes
      runtime/            contains files generated during runtime
      tests/              contains various tests for the basic application
      vendor/             contains dependent 3rd-party packages
      views/              contains view files for the Web application
      web/                contains the entry script and Web resources



REQUIREMENTS
------------

The minimum requirement by this project:
- Apache 2.x Web server 
- PHP 5.6.0 and up
- Mysql 5.5 and up


INSTALLATION
------------

### Install via emailed zip file

- extract zip

- goto extracted folder

- create mysql database / use existing

- adjust config

- php yii migrate

  or
  
  run flip_test.sql to your mysql database

- php yii serve

- open http://localhost:8080/

- login admin for process disbursement: username : admin / password: admin

- login seller for process withdraw: username : seller / password: seller


### Install via Composer

- clone this project

- composer update

- create mysql database / use existing

- adjust config

- php yii migrate

  or
  
  run flip_test.sql to your mysql database

- php yii serve

- open http://localhost:8080/

- login admin for process disbursement: username : admin / password: admin

- login seller for process withdraw: username : seller / password: seller



CONFIGURATION
-------------

### Database

Edit the file `config/db.php` with real data, for example:

```php
return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=localhost;dbname=your db name',
    'username' => 'your db user',
    'password' => 'your db pass',
    'charset' => 'utf8',
];
```

### Flip API

Edit the file `config/params.php` with real data, for example:

```php
return [
    'flipAPI' => [
        'baseURL' => 'https://nextar.flip.id/',
        'username' => 'HyzioY7LP6ZoO7nTYKbG8O4ISkyWnX1JvAEVAhtWKZumooCzqp41',
    ]
];
```

**NOTES:**
- Yii won't create the database for you, this has to be done manually before you can access it.
- Check and edit the other files in the `config/` directory to customize your application as required.


TESTING
-------

