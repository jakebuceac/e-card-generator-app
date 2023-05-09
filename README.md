## About The E-Card Generator App

This project consists of a web application that enables the user to generate personalised cards

The E-Card Generator App uses Laravel to server-side render React views

## Requirements

The following requirements are needed in order to run this project locally:

- [Docker](https://www.docker.com/get-started)
- [WSL](https://docs.microsoft.com/en-us/windows/wsl/install) (Extra requirement for Windows)

First time:

```shell
copy and paste .env.example and rename it to .env
```

Once the ```.env``` file has been created add the OpenAI credentials.

## Installation

To get started with local development, please follow the steps below:

Once you have met the requirements above and have cloned the repository, you will need to install the composer dependencies
by running the following command:

```shell
docker run --rm \
    -v $(pwd):/opt \
    -w /opt \
    laravelsail/php80-composer:latest \
    composer install
```

Now, run the following command to start the project:

```shell
./vendor/bin/sail up -d
./vendor/bin/sail artisan key:generate
./vendor/bin/sail artisan migrate
./vendor/bin/sail artisan db:seed
```

Finally to view the front-end locally you will need to run the following command:

```shell
npm run dev
```

You should now be able to access your project by visiting [http://localhost](http://localhost)

For more information on Laravel Sail, please visit the [official documentation](https://laravel.com/docs/8.x/sail)

For more information on React, please visit the [official documentation](https://legacy.reactjs.org/docs/getting-started.html)

## Authors

Written by Jake Buceac in April 2023.
