<?php

namespace timkelty\craftcms\structureentries;

use craft\events\RegisterComponentTypesEvent;
use craft\services\Fields;
use yii\base\Event;

class Plugin extends \craft\base\Plugin
{
    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        $this->setComponents([
            'structures' => \timkelty\craftcms\structureentries\services\Structures::class,
        ]);

        Event::on(
            Fields::class,
            Fields::EVENT_REGISTER_FIELD_TYPES,
            function (RegisterComponentTypesEvent $event) {
                $event->types[] = \timkelty\craftcms\structureentries\fields\StructureEntries::class;
            }
        );
    }
}
