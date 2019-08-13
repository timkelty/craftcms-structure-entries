<?php
/**
 * Structure Entries plugin for Craft CMS 3.x
 *
 * Structure entries selection field
 *
 * @link      https://github.com/timkelty
 * @copyright Copyright (c) 2019 Tim Kelty
 */

namespace timkelty\structureentries;

use timkelty\structureentries\fields\StructureEntriesField as StructureEntriesFieldField;

use Craft;
use craft\base\Plugin;
use craft\services\Plugins;
use craft\events\PluginEvent;
use craft\services\Fields;
use craft\events\RegisterComponentTypesEvent;

use yii\base\Event;

/**
 * Class StructureEntries
 *
 * @author    Tim Kelty
 * @package   StructureEntries
 * @since     1.0.0
 *
 */
class StructureEntries extends Plugin
{
    // Static Properties
    // =========================================================================

    /**
     * @var StructureEntries
     */
    public static $plugin;

    // Public Properties
    // =========================================================================

    /**
     * @var string
     */
    public $schemaVersion = '1.0.0';

    // Public Methods
    // =========================================================================

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        self::$plugin = $this;

        Event::on(
            Fields::class,
            Fields::EVENT_REGISTER_FIELD_TYPES,
            function (RegisterComponentTypesEvent $event) {
                $event->types[] = StructureEntriesFieldField::class;
            }
        );

        Event::on(
            Plugins::class,
            Plugins::EVENT_AFTER_INSTALL_PLUGIN,
            function (PluginEvent $event) {
                if ($event->plugin === $this) {
                }
            }
        );

        Craft::info(
            Craft::t(
                'structure-entries',
                '{name} plugin loaded',
                ['name' => $this->name]
            ),
            __METHOD__
        );
    }

    // Protected Methods
    // =========================================================================

}
