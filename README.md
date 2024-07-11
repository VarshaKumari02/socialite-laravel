## Socialite-Laravel Package Implementation

## Introduction

The `socialite-laravel` package provides an easy way to integrate social media login functionality into your Laravel application using the Socialite library. This package simplifies the process of authenticating users via social media platforms like Google, GitHub, Facebook, LinkedIn, and Twitter.

### Features

- Easy integration of social media login.
- Seamless configuration with existing Laravel applications.
- Supports multiple social media platforms through the Socialite library.

### Social Media Login Endpoints

The socialite-laravel package provides routes and controllers to handle the authentication process for various social media platforms. Below are the available endpoints for each supported platform:

#### Google Login

- Redirect to Google: `/google`
- Google Callback: `/google/callback`

#### GitHub Login

- Redirect to GitHub: `/github`
- GitHub Callback: `/github/callback`

#### Facebook Login

- Redirect to Facebook: `/facebook`
- Facebook Callback: `/facebook/callback`

#### LinkedIn Login

- Redirect to LinkedIn: `/linkedin`
- LinkedIn Callback: `/linkedin/callback`

#### Twitter Login

- Redirect to Twitter: `/twitter`
- Twitter Callback: `/twitter/callback`

## Installation

- Follow these steps to install and configure the `socialite-laravel` package in your Laravel application:

#### Step 1: Clone the Repository

#### Clone the repository to your local machine:

        `git clone -b main https://github.com/VarshaKumari02/socialite-laravel.git`

#### Step 2: Update Composer

        Open your Laravel project's `composer.json` file and add the following within the `repositories` and `require` sections:
        "repositories": [
        {
        "type": "path",
        "url": "./socialite-laravel"
        }
        ],
        "require": {
        // ... other dependencies
        "varsha/socialite-laravel": "\*"
        },
        "minimum-stability": "dev",
        "prefer-stable": true,

#### Step 3: Update Composer
        Run the following command to update your composer dependencies:
            - composer update

#### Step 4: Run Migrations
        Run the migrations to create the necessary tables

#### Step 5: Add Service Provider
        Open the `config/app.php file` and add the service provider to the `providers` array:
        'providers' => [
            // ...
            Varsha\Socialite\SocialiteServicesProvider::class,
        ],

#### Step 6: Install Socialite Package
        Install the `Socialite` package in your main project

