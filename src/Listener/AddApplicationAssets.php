<?php
namespace EricYChu\BBCodeEditor\Listener;

use Flarum\Event\ConfigureWebApp;
use Flarum\Event\ConfigureFormatter;
use Illuminate\Contracts\Events\Dispatcher;

class AddApplicationAssets{

    public function subscribe(Dispatcher $events)
    {
        $events->listen(ConfigureWebApp::class, [$this, 'addAssets']);
        $events->listen(ConfigureFormatter::class, [$this, 'addBBCodeFormatter']);
    }

    public function addAssets(ConfigureWebApp $event)
    {
        if ($event->isForum()) {
            $event->addAssets([
                __DIR__.'/../../js/forum/dist/extension.js',
                __DIR__.'/../../less/default.less',
            ]);
            $event->addBootstrapper('flarum/bbcode-editor/main');
        }
    }

    /**
     * @param ConfigureFormatter $event
     */
    public function addBBCodeFormatter(ConfigureFormatter $event)
    {
        $event->configurator->BBCodes->addFromRepository('B');
        $event->configurator->BBCodes->addFromRepository('I');
        $event->configurator->BBCodes->addFromRepository('U');
        $event->configurator->BBCodes->addFromRepository('S');
        $event->configurator->BBCodes->addFromRepository('DEL');
        $event->configurator->BBCodes->addFromRepository('SUB');
        $event->configurator->BBCodes->addFromRepository('SUP');
        $event->configurator->BBCodes->addFromRepository('URL');
        $event->configurator->BBCodes->addFromRepository('IMG');
        $event->configurator->BBCodes->addFromRepository('EMAIL');
        $event->configurator->BBCodes->addFromRepository('CODE');
        $event->configurator->BBCodes->addFromRepository('QUOTE');
        $event->configurator->BBCodes->addFromRepository('LIST');
        $event->configurator->BBCodes->addFromRepository('LEFT');
        $event->configurator->BBCodes->addFromRepository('CENTER');
        $event->configurator->BBCodes->addFromRepository('RIGHT');
        $event->configurator->BBCodes->addFromRepository('H1');
        $event->configurator->BBCodes->addFromRepository('H2');
        $event->configurator->BBCodes->addFromRepository('H3');
        $event->configurator->BBCodes->addFromRepository('H4');
        $event->configurator->BBCodes->addFromRepository('H5');
        $event->configurator->BBCodes->addFromRepository('H6');
        $event->configurator->BBCodes->addFromRepository('HR');
        $event->configurator->BBCodes->addFromRepository('TABLE');
        $event->configurator->BBCodes->addFromRepository('TR');
        $event->configurator->BBCodes->addFromRepository('TH');
        $event->configurator->BBCodes->addFromRepository('TD');
        $event->configurator->BBCodes->addFromRepository('*');
        $event->configurator->BBCodes->addFromRepository('UL');
        $event->configurator->BBCodes->addFromRepository('OL');
        $event->configurator->BBCodes->addCustom(
            '[font={FONTFAMILY}]{TEXT}[/font]',
            '<font face="{FONTFAMILY}">{TEXT}</font>'
        );
        $event->configurator->BBCodes->addCustom(
            '[color={COLOR}]{TEXT}[/color]',
            '<font color="{COLOR}">{TEXT}</font>'
        );
        $event->configurator->BBCodes->addCustom(
            '[size={RANGE=1,7}]{TEXT}[/size]',
            '<font size="{RANGE}">{TEXT}</font>'
        );
        $event->configurator->BBCodes->addCustom(
            '[LI]{TEXT}[/LI]',
            '<li>{TEXT}</li>'
        );
    }
}