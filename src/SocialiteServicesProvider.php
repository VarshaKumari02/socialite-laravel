<?php

namespace Varsha\Socialite;

use Illuminate\Support\ServiceProvider;

/**
 * SocialiteServicesProvider class
 *
 * @since 1.0.0
 * @version 1.0.0
 * @author Varsha Kumari <varsha.kumari@ahex.co.in>
 */
class SocialiteServicesProvider extends ServiceProvider
{
    /**
     * Register method
     *
     * @return void
     */
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/config.php', 'socialite');
    }

    //-------------------------------------------------------------------------

    /**
     * Boot method
     *
     * @return void
     */
    public function boot(): void
    {
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
        $this->loadRoutesFrom(__DIR__ . '/routes/web.php');
        $this->loadTranslationsFrom(__DIR__ . '/../lang', 'vk-socialite');
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'socialite');
    }
}
// end of class SocialiteServicesProvider
// end of file SocialiteServicesProvider.php