<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>
<h1 align="center">Try Laravel SOLID </h1>

## About the Project

The idea is for you get an application built without worrying about the SOLID principles and apply them. The theory is really nice, but you will not really understand it until you code it.

The SOLID Principles exist to make code more readable and maintainable. All the content you need to make it happen can be found [here.](https://github.com/danielhe4rt/solid4noobs)

## Expectations

Fork the project and try to run it on your machine and your goal is to focus on the tasks below:

-   Apply the Open Closed Principle on Services (Github and Twitch) without breaking them.
-   Apply Single Responsibility Principle mostly on Controllers and Repositories (that do not exist yet, so you have to create them).
-   Apply Liskov Substitution Principle on the methods that return specific data and make it a pattern.
-   Apply Interface Segregation Principle on Services that don't use all interface methods.
-   Find a place to implement Dependency Inversion and then make all the major modifications in the code.

If you want to worry about Clean Code here are some tips:

-   Know the difference between single and double quotes.
-   Use "Early Return" on methods.
-   Look to type every function/method in the entire project.
-   Create a new config file to store credentials and NEVER use env() function directly in the code
-   Use this new config file to generate the Sign-In buttons and leave an active flag for each provider as a Feature Flip.

When you're done, open a pull request on <strong> your fork </strong> and tag me for a code review.

## Running the Project

1. Clone the repository using this command:

```terminal
$ git clone https://github.com/DanielHe4rt/try-laravel-solid.git
```

2. Access the project folder on your terminal:

```terminal
$ cd try-laravel-solid
```

3. Run the command to install all dependencies with Composer.

```terminal
$ composer install
```

4. Copy the .env.example config to a new file called .env

```terminal
$ cp .env.example .env
```

5. Change the database environment variables on .env:
    - **DB_DATABASE**: Database that you created for the project.
    - **DB_USERNAME**: MySQL username.
    - **DB_PASSWORD**: MySQL password.

```dotenv
DB_DATABASE=dev_solid
DB_USERNAME=root
DB_PASSWORD=root
```

5. Active the folder sync and let public the user avatars

```terminal
$ php artisan storage:link
```

6. Run the application

```terminal
$ php artisan serve
```

## Getting the Providers

For this application you will need two base providers, that will be [Github](https://github.com/settings/apps) and [Twitch](https://dev.twitch.tv/console).

Create a new application on both providers and fill the callback urls same as the .env variables:

```
Github => "http://localhost:8000/auth/oauth/github"
Twitch => "http://localhost:8000/auth/oauth/twitch"
```

After that, replace the ID and Secret on envs providers:

```dotenv
GITHUB_OAUTH_ID="Iv1.your-github-app-id"
GITHUB_OAUTH_SECRET="your-github-secret"

TWITCH_OAUTH_ID="your-twitch-app-id"
TWITCH_OAUTH_SECRET="your-twitch-secret"
```

After the replacement you should be able to authenticate on the platform.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
