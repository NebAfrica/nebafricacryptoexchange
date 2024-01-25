<?php
/****************************
 * |-----------------------|
 *   Instruction
 * |-----------------------|
 * This config file is where theme specific colors and typography are stored.
 * This file is created automatically during theme creation, however, after
 * you have made any changes to your css, fonts, colors and typography, you 
 * must manualy update this file.
 * CASE: During theme creation, you entered '#f6f6f6' as your theme_bg_color,
 * during design, you changed your bg color to #f2f2f2 , you must also change 
 * theme_bg_color in this config file to  f2f2f2 without the hash sign [#]
 */ 
 

//prevent direct access;
$url = $_SERVER['HOST'];
header("Location: " . $url);
die();

$config = [
    /*
    |-----------------------|
       Theme Author Details
    |-----------------------|
    */

    "author_name" => "Ichie_ICT_Solutions",
    "author_email" => "support@credcrypto.net",
    "author_website" => "https://credcrypto.net",

    /*
    |-----------------------|
       Config Details
    |-----------------------|
    */

    "theme_name" => "Skeleton",
    "version" => "1.0",
    "last_updated" => "August 27, 2022",

    /*
    |-----------------------|
       Color Presets
    |-----------------------|
    */

    "background_color" => "060818",

    /*
    |-----------------------|
       Typography
    |-----------------------|
    */

    "font_family" => "none",
    
];
