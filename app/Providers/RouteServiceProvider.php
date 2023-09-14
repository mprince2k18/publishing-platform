<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;
use File;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to your application's "home" route.
     *
     * Typically, users are redirected here after authentication.
     *
     * @var string
     */
    public const HOME = '/home';

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     */
    public function boot(): void
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });


        /* The code block you provided is defining the routes for your application. */
        $this->routes(function () {
            Route::prefix('api')
                ->middleware('api')
                ->namespace($this->namespace)
                ->group(base_path('routes/api.php'));

            /* The code ` = base_path('routes/');` is setting the variable `` to the absolute
            path of the "routes" folder in your application. */
            $path = base_path('routes/');
            $filesInFolder = File::allFiles($path);

            /* The code block you provided is iterating over the files in the "routes" folder of your
            application. It checks each file's basename (the filename without the directory path)
            and excludes certain files ('channels.php', 'api.php', and 'console.php') from being
            included in the routes. */
            foreach($filesInFolder as $key => $path){
                $files = pathinfo($path);
                if($files['basename'] != 'channels.php' && 
                $files['basename'] != 'api.php' && 
                $files['basename'] != 'console.php'){
                    Route::middleware('web')
                        ->namespace($this->namespace)
                        ->group(base_path('routes/' . $files['basename']));
                }
            }
            
        });
    }
}
