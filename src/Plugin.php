<?php

namespace timkelty\craftcms\structureentries;

use craft\events\RegisterComponentTypesEvent;
use craft\services\Fields;
use yii\base\Event;

class Plugin extends \craft\base\Plugin
{
    // /**
    //  * @inheritdoc
    //  */
    // public $allowLimit = false;

    // /**
    //  * @inheritdoc
    //  */
    // public $allowMultipleSources = false;

    // /**
    //  * @var int|null Branch limit
    //  */
    // public $branchLimit;

    // /**
    //  * @inheritdoc
    //  */
    // protected $settingsTemplate = '_components/fieldtypes/Categories/settings';

    // /**
    //  * @inheritdoc
    //  */
    // protected $inputTemplate = '_components/fieldtypes/Categories/input';

    // /**
    //  * @inheritdoc
    //  */
    // protected $inputJsClass = 'Craft.CategorySelectInput';

    // /**
    //  * @inheritdoc
    //  */
    // protected $sortable = false;

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        Event::on(
            Fields::class,
            Fields::EVENT_REGISTER_FIELD_TYPES,
            function (RegisterComponentTypesEvent $event) {
                $event->types[] = \timkelty\craftcms\structureentries\fields\StructureEntries::class;
            }
        );
    }
}
