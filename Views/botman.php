<?php
require_once 'vendor/autoload.php';
use BotMan\BotMan\BotMan;
use BotMan\BotMan\BotManFactory;
use BotMan\BotMan\Drivers\DriverManager;

$config = [
    // Your driver-specific configuration
    // "telegram" => [
    //    "token" => "TOKEN"
    // ]
];


DriverManager::loadDriver(\BotMan\Drivers\Web\WebDriver::class);

$botman = BotManFactory::create($config);


$botman->hears('Hello', function (BotMan $bot) {
    $bot->reply('Hello yourself');
});
$botman->hears("Tell me your name", function (BotMan $bot) {
    $bot->reply('I am the BotMan! <br> What is your name?');
});
$botman->hears('My name is {name}', function ($bot, $name) {
    $bot->reply('It is very nice to meet you '.$name . '!' . '<br> How are you doing?');
});

$botman->hears('sup', function (BotMan $bot) {
    $bot->reply('Sup Dawg');
});

$botman->fallback(function ($bot) {
    $bot->reply('Sorry, I didnt get that. Here is the list of commands I understand:
    <br><br>Tell me your name
    <br> My name is {your name}
    <br>3
    <br>4
    <br>5
    ');
});

// Start listening
$botman->listen();
