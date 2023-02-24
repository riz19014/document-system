<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\DmSection;
use App\Models\ApprovalUser;
use App\Models\DmFileUpload;
use App\Models\ApprovalStatus;
use Illuminate\Support\Facades\Auth;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
     
         view()->composer(['layouts.layout','approval.notify'], function ($view) {
            $filecount = 0;
            $sidebars = DmSection::where('is_section',1)->where('section_id', Auth::user()->section_id)->get();
            $apps = ApprovalUser::all();
            foreach($apps as $app){

                if(Auth::user()->id == $app->user_id){
                  $filecount = ApprovalStatus::where('user_id',Auth::user()->id)->where('approval_status',1)
                  ->count();
                     
                }

            }      
            $view->with(compact('sidebars','filecount'));

        });       
    }
}
