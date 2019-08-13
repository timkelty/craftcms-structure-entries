<?php

namespace timkelty\craftcms\structureentries\web\assets\field;

use craft\web\assets\cp\CpAsset;

class FieldAssets extends \craft\web\AssetBundle
{
    public function init()
    {
        $this->sourcePath = "@timkelty/craftcms/structureentries/web/assets/field/dist";

        $this->depends = [
            CpAsset::class,
        ];

        $this->js = ['field.js'];
        $this->css = ['field.css'];

        parent::init();
    }
}
