# user-management

## Development

### Prerequisites

You need to have previously installed:

- php 7.1 or higher
- Composer
  - For [Linux or Mac](https://getcomposer.org/doc/00-intro.md#installation-linux-unix-macos "Download Composer on Linux / Mac")
  - For [Windows](https://getcomposer.org/doc/00-intro.md#installation-windows "Download Composer on Windows")
- MySQL 5.7 or higher
- To be able to upload file > 2 MB don't forget to update `post_max_size` and `upload_max_filesize` parameters in your server `php.ini file.

### Install dependencies

`composer install`

### To delete the database run

`php bin/console doctrine:database:drop --force`

### Create database

First configure your database credentials inside the .env doc

`php bin/console doctrine:database:create`

### Run migrations

`php bin/console doctrine:migrations:migrate`

### Load some fixtures

`php bin/console doctrine:fixtures:load`

### Start the server

`symfony server:start`

### Build assets

`npm run dev` or `npm run watch` if you want to live compile assets.
