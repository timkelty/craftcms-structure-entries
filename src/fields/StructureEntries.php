<?php

/**
 * Structure Entries plugin for Craft CMS 3.x
 *
 * Structure entries selection field
 *
 * @link      https://github.com/timkelty
 * @copyright Copyright (c) 2019 Tim Kelty
 */

namespace timkelty\structureentries\fields;

use timkelty\structureentries\StructureEntries;
use timkelty\structureentries\assetbundles\structureentriesfieldfield\StructureEntriesFieldFieldAsset;

use Craft;
use craft\base\ElementInterface;
use craft\base\Field;
use craft\helpers\Db;
use yii\db\Schema;
use craft\helpers\Json;

/**
 * @author    Tim Kelty
 * @package   StructureEntries
 * @since     1.0.0
 */
class StructureEntries extends \craft\fields\Entries
{

    /**
     * @inheritdoc
     */
    public $allowLimit = false;

    /**
     * @inheritdoc
     */
    public $allowMultipleSources = false;

    /**
     * @var int|null Branch limit
     */
    public $branchLimit;

    /**
     * @inheritdoc
     */
    protected $settingsTemplate = '_components/fieldtypes/Categories/settings';

    /**
     * @inheritdoc
     */
    protected $inputTemplate = '_components/fieldtypes/Categories/input';

    /**
     * @inheritdoc
     */
    protected $inputJsClass = 'Craft.CategorySelectInput';

    /**
     * @inheritdoc
     */
    protected $sortable = false;

    /**
     * @inheritdoc
     */
    public static function displayName(): string
    {
        return Craft::t('structure-entries', 'Structure Entries');
    }
}
