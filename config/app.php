<?php 

return [


    /**
     * Locale Language
     * English is the initial & fallback locale
     */
     "locale" => "en",


     /**
     * Fallback locale
     */
    "fb_locale" => "en",


    /** Not done yet
     * Aliases classes to be available globally
     * All classes here is included in the layout & could be used in all views
     */
    'aliases' => [
        "Auth" => \app\core\Auth::class,
        "Config" => \app\core\Config::class,
    ],


    "test1" => [
        "test11" => "test result",
        "test12",
        "test13" => [
            "test131",
            "test132" => 132,
            [
                "test1331",
                "test1332" => [
                    "test",
                ],
            ]
        ]
    ],
    "test2" => 2,
    "test3",


];