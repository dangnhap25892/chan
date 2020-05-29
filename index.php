<?php

use BotMan\BotMan\BotMan;
use BotMan\BotMan\BotManFactory;
use BotMan\BotMan\Drivers\DriverManager;

$config = [
	'facebook' => [
  	'token' => 'EAANubfLJEDEBAHht1v8ooEKqSMnL2rFFHZAOTVjtv7oBEfzqUAUIIEjfmpTjdYRR5piPDSPNk5OIdybCJzytSEzWFpzLcfJoV1trA01nnwFdoiqlE2hxjrqTnJEKgUzVFGJyx2isvZA5X3VoQZAFV0VfLEZAZA3cXFNFftru7MgZDZD',
	'app_secret' => 'b30e56607d11f75f666d869d1398ccaa',
    'verification'=>'123',
]
    // Your driver-specific configuration
    // "telegram" => [
    //    "token" => "TOKEN"
    // ]
];

// Load the driver(s) you want to use
DriverManager::loadDriver(\BotMan\Drivers\facebook\FacebookDriver::class);

// Create an instance
$botman = BotManFactory::create($config);

// Give the bot something to listen for.
$botman->hears('hello', function (BotMan $bot) {
    $bot->reply('Hello yourself.');
});

// Start listening
$botman->listen();