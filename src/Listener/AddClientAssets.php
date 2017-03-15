<?php 
namespace zhikuang\discuss\Listener;

use DirectoryIterator;
use Flarum\Event\ConfigureClientView;
use Flarum\Event\ConfigureLocales;
use Illuminate\Contracts\Events\Dispatcher;

class AddClientAssets
{
    /**
     * @param Dispatcher $events
     */
    public function subscribe(Dispatcher $events)
    {
        $events->listen(ConfigureClientView::class, [$this, 'addAssets']);
    }

    /**
     * @param ConfigureClientView $event
     */
    public function addAssets(ConfigureClientView $event)
    {

        //replace google fonts call
        foreach ($event->view->head as $k => $v) {
            if ($v == '<link rel="stylesheet" href="//fonts.googleapis.com/css?family=Open+Sans:400italic,700italic,400,700,600">') {
                $this->view->head[$k] = '<link rel="stylesheet" href="/gfonts/gfonts.css">'; // change to local cache

                error_log("k => " . $k . "v=> ". $v);
            }
        }

        if($event->isForum()) {
        }

        if($event->isAdmin()) {
        }
    }

}
