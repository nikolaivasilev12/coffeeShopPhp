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

$botman->hears('sup', function (BotMan $bot) {
    $bot->reply('Sup Dawg');
});
$botman->hears('Hello', function (BotMan $bot) {
    $bot->reply('Hello yourself');
});
$botman->hears('Tell me your name', function (BotMan $bot) {
    $bot->reply('I am the BotMan! <br> What is your name?');
});
$botman->hears('My name is {name}', function ($bot, $name) {
    $bot->reply('It is very nice to meet you '.$name . '!' . '<br> How are you doing?');
});
$botman->hears('How is your coffee', function (BotMan $bot) {
    $bot->reply('We sell only the FRESHIEST coffee beans from the DANKEST coffee fields!');
});
$botman->hears('I love you botman', function (BotMan $bot) {
    $bot->reply('Im sorry, Im taken :(');
});
$botman->hears('Tell me a joke', function (BotMan $bot) {
    $bot->reply('What do robots wear in winter? <br> Ro-boots.');
});
$botman->hears('Tell me another joke', function (BotMan $bot) {
    $bot->reply('How do you make a robot angry? <br> Push its buttons.');
});
$botman->hears('You are funny botman', function (BotMan $bot) {
    $bot->reply('Not as funny as your face though');
});



$botman->fallback(function ($bot) {
    $bot->reply('Sorry, I didnt get that. Here is the list of commands I understand:
    <br>Tell me your name
    <br>My name is YourName
    <br>How is your coffee
    <br>I love you botman
    <br>Tell me a joke
    <br>Tell me another joke
    <br>You are funny botman
    ');
});

// Start listening
$botman->listen();
