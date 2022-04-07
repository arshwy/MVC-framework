<?php 


return [


    /**
     * ROOT DIRECTORY FOR THE APLLICATION
     */
    "ROOT" => dirname(__DIR__),


    /**
     * Locale Language, english is the initial & fallback locale
     */
     "locale" => "en",



    /** Not done yet
     * Aliases classes to be available globally
     * All classes here is included in the layout & could be used in all views
     */
    'aliases' => [
        "Auth" => \app\core\Auth::class,
    ],





];