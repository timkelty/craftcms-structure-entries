<?php

namespace timkelty\craftcms\structureentries\fields;

use Craft;
use craft\elements\db\EntryQuery;
use craft\elements\Entry;

class StructureEntries extends \craft\fields\Entries
{
    /**
     * @inheritdoc
     */
    public static function displayName(): string
    {
        return Craft::t('app', 'Structure Entries');
    }

    /**
     * Returns the sources that should be available to choose from within the field's settings
     *
     * @return array
     */
    // protected function availableSources(): array
    // {
    //     return array_filter(parent::availableSources(), function ($source) {
    //         return $source['structureId'] ?? false;
    //     });
    // }
}
