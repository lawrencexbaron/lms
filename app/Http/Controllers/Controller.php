<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\View;
use App\Models\Setting;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function __construct()
    {
        $this->setAppName(1);
        
    }

    // add function to override app_name
    public function setAppName($app_name, $page = null)
    {
        if($app_name == 1) {
            // $app_name = env('APP_NAME');
            $setting = Setting::first();
            // Split the title into words, then get the first letter of each word.
            $app_name_parts = explode(' ', $setting->system_title);
            $app_name_initials = '';

            foreach ($app_name_parts as $part) {
                // Add the first letter of each word to the initials string.
                $app_name_initials .= $part[0];
            }
            $app_name = $app_name_initials;
            
        }else{
            $app_name = $app_name;
        }
        $app_name = $this->replaceUnderscoreToWhiteSpaces($app_name);
        View::share('title', ($app_name . ($page ? ' - ' . $page : '')));
    }

    // set favicon
    public function setFavicon($favicon)
    {
        View::share('favicon', $favicon);
    }

    public function replaceWhiteSpacesToUnderscore($string)
    {
        return preg_replace('/\s+/', '_', $string);
    }
    public function replaceUnderscoreToWhiteSpaces($string)
    {
        return preg_replace('/_+/', ' ', $string);
    }
}
