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

        //replace google fonts call , originally is <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Open+Sans:400italic,700italic,400,700,600">
        $event->view->addHeadString('<link rel="stylesheet" href="/gfonts/gfonts.css">', 'font');
        if($event->isForum()) {
            $event->addAssets([
                __DIR__ . '/../../less/forum/extension.less',
            ]);

            // 增加缩略图，为微信显示
            $SCRIPT_TO_INJECT = <<<JS
            <div style=" overflow:hidden; width:0px; height:0; margin:0 auto; position:absolute; top:-800px;"><img src="http://on7cnqe42.bkt.clouddn.com/zhikuang_share.jpg"></div>

JS;
            $event->view->addFootString($SCRIPT_TO_INJECT);   
        }
        if($event->isAdmin()) {
        }
    }

}
