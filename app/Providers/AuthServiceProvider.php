<?php

namespace App\Providers;

use App\Models\CartItem;
use App\Models\MenuItem;
use App\Models\Order;
use App\Policies\MenuItemPolicy;
use App\Policies\CartItemPolicy;
use App\Policies\OrderPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        CartItem::class => CartItemPolicy::class,
        MenuItem::class => MenuItemPolicy::class,
        Order::class => OrderPolicy::class,
    ];

    public function boot()
    {
        $this->registerPolicies();
    }
}
