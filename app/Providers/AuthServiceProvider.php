<?php

namespace App\Providers;

use App\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AuthServiceProvider extends ServiceProvider {

    public function register() {

    }


    public function boot() {


        $this->app['auth']->viaRequest('api', function ($request) {
            return \App\Models\User::where('email', $request->input('email'))->first();
        });
    }
}
