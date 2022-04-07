<?php 


return [

    "required" => "This field is required.",
    "string" => "The data must be type string.",
    "int" => "The data must be type integer.",
    "email" => "Invalid email id.",
    "numeric" => "The data must be numeric.",

    'max' => [
        'numeric' => 'The :attribute must not be greater than :max.',
        'file' => 'The :attribute must not be greater than :max kilobytes.',
        'string' => 'The :attribute must not be greater than :max characters.',
    ],

    'min' => [
        'numeric' => 'The :attribute must be at least :min.',
        'file' => 'The :attribute must be at least :min kilobytes.',
        'string' => 'The :attribute must be at least :min characters.',
    ],

    'size' => [
        'numeric' => 'The :attribute must be :size.',
        'file' => 'The :attribute must be :size kilobytes.',
        'string' => 'The :attribute must be :size characters.',
    ],

    
];