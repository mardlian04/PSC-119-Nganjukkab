<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Menu;
use App\Models\Visitor;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        if (!app()->runningInConsole()) {

            $exists = Visitor::where('ip_address', request()->ip())
                ->where('visit_date', now()->toDateString())
                ->exists();

            if (!$exists) {
                Visitor::create([
                    'ip_address' => request()->ip(),
                    'user_agent' => request()->userAgent(),
                    'url' => request()->fullUrl(),
                    'visit_date' => now()->toDateString(),
                ]);
            }
        }

        View::composer('*', function ($view) {

            $menus = Menu::whereNull('parent_id')
                ->where('is_active', 1)
                ->with(['children' => function ($q) {
                    $q->where('is_active', 1)->orderBy('urutan');
                }])
                ->orderBy('urutan')
                ->get();

            $view->with('menus', $menus);
        });
    }
}