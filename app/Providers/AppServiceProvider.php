<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
       $ext = get_loaded_extensions();	

       if (!in_array('pdo_mysql',$ext)) 
	   {
		   
		   if(! ini_get('enable_dl'))
			   dd('first run enable_dl in php.ini');
		   
			dl('pdo_mysql');	
	   }
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
