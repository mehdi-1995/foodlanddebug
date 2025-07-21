<?php

namespace App\Providers;

use App\Models\CartItem;
use App\Models\MenuItem;
use App\Policies\MenuItemPolicy;
use App\Policies\CartItemPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        CartItem::class => CartItemPolicy::class,
        MenuItem::class => MenuItemPolicy::class,
    ];

    public function boot()
    {
        $this->registerPolicies();
    }
}
