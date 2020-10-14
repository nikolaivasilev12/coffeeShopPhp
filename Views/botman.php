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

$botman->fallback(function ($bot) {
    $bot->reply('Sorry, I did not understand these commands. Here is a list of commands I understand: ...');
});

// Start listening
$botman->listen();
