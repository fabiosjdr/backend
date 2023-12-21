<?php

namespace App\Providers;

use Carbon\Carbon;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\ServiceProvider;
use Laravel\Sanctum\Sanctum;
use Illuminate\Support\Facades\Validator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        Sanctum::ignoreMigrations();
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {   
        
        Validator::extend('string_or_integer', function ($attribute, $value, $parameters, $validator) {
            return is_string($value) || is_integer($value);
        });

        Validator::extend('switch_button', function ($attribute, $value, $parameters, $validator) {
            return is_string($value) || is_bool($value);
        });


        Validator::extend('decimal', function ($attribute, $value, $parameters, $validator) {
            return preg_match('/^-?(?=.+)(?:[1-9]\d*|0)?(?:\.\d+)?$/',$value);
        });

        // if (App::environment('local')) {
        //     DB::listen(function($query) {
        //         if (strpos($query->sql, 'insert ') !== false ||
        //             strpos($query->sql, 'update ') !== false ||
        //             strpos($query->sql, 'delete ') !== false
        //         ) {
        //             $match = $lastIndex = 0;

        //             while (($index = strpos($query->sql, '?', $lastIndex)) !== false) {
        //                 if (is_null($query->bindings[$match])) $param = 'NULL';
        //                 else if (is_numeric($query->bindings[$match])) $param = $query->bindings[$match];
        //                 else $param = "'" . $query->bindings[$match] . "'";

        //                 $query->sql = substr_replace($query->sql, $param, $index, strlen('?'));
        //                 $lastIndex = $lastIndex + strlen('?');
        //                 $match++;
        //             }

        //             Storage::disk('local')->append('sqls_' . Carbon::now()->format('Ymd') . '.sql', $query->sql);
        //             Log::channel('sqls')->info($query->sql);
        //         }
        //     });
        // }
    }
}
