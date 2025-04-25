<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('general.web_name_ar', 'موقعي');
        $this->migrator->add('general.web_name_en', 'My website');
        $this->migrator->add('general.decs_footer_ar', 'موقعي');
        $this->migrator->add('general.decs_footer_en', 'My website');
        $this->migrator->add('general.logo', 'This is my website');
        $this->migrator->add('general.footer_logo', 'This is my website');
        $this->migrator->add('general.favicon', '');
        $this->migrator->add('general.big_image', '');

        $this->migrator->add('general.phone', '');
        $this->migrator->add('general.email', '');
        $this->migrator->add('general.website', '');
        $this->migrator->add('general.whatsapp', '');
        $this->migrator->add('general.facebook', '');
        $this->migrator->add('general.twitter', '');
        $this->migrator->add('general.instagram', '');
        $this->migrator->add('general.linkedin', '');
        $this->migrator->add('general.address', '');
        $this->migrator->add('general.location', '');
        
        // End Login Page Settings


        // about us page settings//
        $this->migrator->add('general.about_desc_one_ar', '');
        $this->migrator->add('general.about_desc_one_en', '');
        $this->migrator->add('general.about_desc_two_ar', '');
        $this->migrator->add('general.about_desc_two_en', '');
        $this->migrator->add('general.vision_ar', '');
        $this->migrator->add('general.vision_en', '');
        $this->migrator->add('general.goal_ar', '');
        $this->migrator->add('general.goal_en', '');
        $this->migrator->add('general.message_ar', '');
        $this->migrator->add('general.message_en', '');
        $this->migrator->add('general.about_image_one', '');
        $this->migrator->add('general.about_image_two', '');
        $this->migrator->add('general.about_image_three', '');
        $this->migrator->add('general.about_image_four', '');

    }
};
