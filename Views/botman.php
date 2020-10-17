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

// Give the bot something to listen for.
$botman->hears('Hello', function (BotMan $bot) {
    $bot->reply('Hello too');
});
$botman->hears('sup', function (BotMan $bot) {
    $bot->reply('Sup dawg');
});
$botman->hears('What is your name?', function (BotMan $bot) {
    $bot->reply('I am ze BotMan!');
});

$botman->fallback(function ($bot) {
    $bot->reply('Sorry, I didnt get that because Niko made me stupid :("');
});

// Start listening
$botman->listen();
