<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class GeneralSettings extends Settings
{
    public string $web_name_ar;
    public string $web_name_en;
    public string $decs_footer_ar;
    public string $decs_footer_en;
    public string $footer_logo = 'settings/logo.png';
    public string $logo = 'settings/logo.png';
    public string $favicon = 'settings/favicon.png';
    public string $big_image ;
    public string $email;
    public string $phone;

    public string $whatsapp;
    public string $website = 'website';
    public string $facebook;
    public string $twitter;
    public string $instagram;
    public string $linkedin;
    public string $address;
    public  string| array $location;


    //about us page settings

    public string $about_desc_one_ar;
    public string $about_desc_one_en;
    public string $about_desc_two_ar;
    public string $about_desc_two_en;
    public string $vision_ar;
    public string $vision_en;
    public string $message_ar;
    public string $message_en;
    public string $goal_ar;
    public string $goal_en;
    public string $about_image_one;
    public string $about_image_two;
    public string $about_image_three;
    public string $about_image_four;

    public static function group(): string
    {
        return 'general';
    }
}
