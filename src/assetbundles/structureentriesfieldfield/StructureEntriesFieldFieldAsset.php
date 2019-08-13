<?php
/**
 * Structure Entries plugin for Craft CMS 3.x
 *
 * Structure entries selection field
 *
 * @link      https://github.com/timkelty
 * @copyright Copyright (c) 2019 Tim Kelty
 */

namespace timkelty\structureentries\assetbundles\structureentriesfieldfield;

use Craft;
use craft\web\AssetBundle;
use craft\web\assets\cp\CpAsset;

/**
 * @author    Tim Kelty
 * @package   StructureEntries
 * @since     1.0.0
 */
class StructureEntriesFieldFieldAsset extends AssetBundle
{
    // Public Methods
    // =========================================================================

    /**
     * @inheritdoc
     */
    public function init()
    {
        $this->sourcePath = "@timkelty/structureentries/assetbundles/structureentriesfieldfield/dist";

        $this->depends = [
            CpAsset::class,
        ];

        $this->js = [
            'js/StructureEntriesField.js',
        ];

        $this->css = [
            'css/StructureEntriesField.css',
        ];

        parent::init();
    }
}
