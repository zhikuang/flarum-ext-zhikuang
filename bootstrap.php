<?php
namespace zhikuang\discuss;
use Illuminate\Contracts\Events\Dispatcher;

return function(Dispatcher $events) {
	$events->listen(Listener\AddClientAssets::class);
}