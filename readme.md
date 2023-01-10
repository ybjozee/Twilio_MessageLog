# Twilio_MessageLog

Technical Requirements

For the Symfony application
* PHP 8.0
* PDO-SQLite PHP extension enabled;
* [Git][2]
* [Composer][3]
* [Symfony CLI][4]
* and the [usual Symfony application requirements][5].

For the Svelte application, you would need a Package manager - this application uses [Yarn][6].

Installation
------------
```bash
$ git clone https://github.com/ybjozee/Twilio_MessageLog.git
$ cd Twilio_MessageLog
$ composer install
$ yarn install
```

Usage
-----

Make a local version of the `.env` file

```bash
$ cp .env .env.local
```

Update the relevant Twilio keys in `.env.local`

``` ini
TWILIO_ACCOUNT_SID="INSERT_TWILIO_ACCOUNT_SID"
TWILIO_AUTH_TOKEN="INSERT_TWILIO_AUTH_TOKEN"
```

Bundle your Svelte application
```bash
$ yarn dev
# To watch for changes 
# yarn watch
```
Run your application
```bash
$ symfony serve
```

[2]: https://git-scm.com/
[3]: https://getcomposer.org/
[4]: https://symfony.com/download
[5]: https://symfony.com/doc/current/reference/requirements.html
[6]: https://yarnpkg.com/getting-started/install
