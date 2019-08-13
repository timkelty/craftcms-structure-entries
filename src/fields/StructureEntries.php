<?php

namespace timkelty\craftcms\structureentries\fields;

use Craft;
use craft\elements\Entry;
use craft\elements\db\EntryQuery;

class StructureEntries extends BaseStructureRelationField
{
    // Static
    // =========================================================================

    /**
     * @inheritdoc
     */
    public static function displayName(): string
    {
        return Craft::t('app', 'Structure Entries');
    }

    /**
     * @inheritdoc
     */
    protected static function elementType(): string
    {
        return Entry::class;
    }

    /**
     * @inheritdoc
     */
    public static function defaultSelectionLabel(): string
    {
        return Craft::t('app', 'Add an entry');
    }

    /**
     * @inheritdoc
     */
    public static function valueType(): string
    {
        return EntryQuery::class;
    }

    /**
     * Returns the sources that should be available to choose from within the field's settings
     *
     * @return array
     */
    protected function availableSources(): array
    {
        return array_filter(parent::availableSources(), function ($source) {
            return $source['structureId'] ?? false;
        });
    }
}
