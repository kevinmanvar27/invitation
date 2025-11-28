<?php

require_once 'vendor/autoload.php';

use Illuminate\Container\Container;
use Illuminate\Events\Dispatcher;
use Illuminate\Database\Capsule\Manager as Capsule;

// Set up Laravel database connection
$capsule = new Capsule;
$capsule->addConnection([
    'driver' => 'sqlite',
    'database' => __DIR__.'/database/database.sqlite',
]);
$capsule->setEventDispatcher(new Dispatcher(new Container));
$capsule->setAsGlobal();
$capsule->bootEloquent();

// Fetch templates
$templates = Capsule::table('templates')->select('id', 'name', 'is_premium', 'price')->get();

echo "Templates:\n";
foreach ($templates as $template) {
    echo "ID: {$template->id}, Name: {$template->name}, Premium: {$template->is_premium}, Price: {$template->price}\n";
}