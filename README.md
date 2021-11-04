# Laravel Deployment Actions

<p align="center">
    <a href="https://github.com/r-evans18/Deployment-actions"><img src="https://img.shields.io/badge/Release version-1.0.0-green.svg"></a>
</p>

### Setup
- `composer require revans/deployment-actions-laravel`
- `php artisan vendor:publish` Find deployment actions (config, views & migrations)
- Set up your commands within the `config/deployment.php`

If you want to add an extra line of security for production sites, add `DEPLOYMENT_PRODUCTION_PASSWORD` to your `.env` and add a password within there.


Any issues please report or create a merge request into `staging` :) Happy deploying
