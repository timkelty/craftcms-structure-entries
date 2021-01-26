<?php

namespace timkelty\craftcms\structureentries\fields;

use Craft;
use craft\base\ElementInterface;
use craft\elements\db\EntryQuery;
use craft\elements\Entry;
use craft\helpers\ArrayHelper;

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
    // protected $settingsTemplate = '_components/fieldtypes/Categories/settings';

    /**
     * @inheritdoc
     */
    // protected $inputTemplate = '_components/fieldtypes/Categories/input';

    /**
     * @inheritdoc
     */
    // protected $inputJsClass = 'Craft.CategorySelectInput';

    /**
     * @inheritdoc
     */
    protected $sortable = false;

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
    public function normalizeValue($value, ElementInterface $element = null)
    {
        if (is_array($value)) {
            /** @var Entry[] $entries */
            $entries = Entry::find()
                ->siteId($this->targetSiteId($element))
                ->id(array_values(array_filter($value)))
                ->anyStatus()
                ->all();

            // Fill in any gaps
            $strucuresService = Craft::$app->getStructures();
            $strucuresService->fillGapsInElements($entries);

            // Enforce the branch limit
            if ($this->branchLimit) {
                $strucuresService->applyBranchLimitToElements($entries, $this->branchLimit);
            }

            $value = ArrayHelper::getColumn($entries, 'id');
        }

        return parent::normalizeValue($value, $element);
    }

    /**
     * @inheritdoc
     */
    // protected function inputTemplateVariables($value = null, ElementInterface $element = null): array
    // {
    //     $variables = parent::inputTemplateVariables($value, $element);
    //     $variables['branchLimit'] = $this->branchLimit;

    //     return $variables;
    // }

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
