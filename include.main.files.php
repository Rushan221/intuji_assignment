<?php

require './vendor/autoload.php';

session_start();


#[NoReturn] function dd($data): void
{
    print_r($data);
    die();
}

function dateTimeFormat($datetime): string
{
    $date = new DateTime($datetime);
    return $date->format('Y-m-d\TH:i:s');
}