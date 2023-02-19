<?php

namespace Tale;

use Cheeseo\Rules\SupportedMetaTag;
use Cheeseo\View\Components\Tags;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;

class TaleServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'cheeseo');
        $this->loadViewComponentsAs('cheeseo', [Tags::class]);
    }

    public function boot()
    {
        Validator::extend('cheeseoTag', SupportedMetaTag::class . '@passes');
    }
}
