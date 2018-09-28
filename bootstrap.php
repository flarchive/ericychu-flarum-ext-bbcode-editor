<?php
use Illuminate\Contracts\Events\Dispatcher;
use EricYChu\BBCodeEditor\Listener;

return function (Dispatcher $events) {
    $events->subscribe(Listener\AddApplicationAssets::class);
};
