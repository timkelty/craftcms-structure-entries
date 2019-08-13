<?php

namespace timkelty\craftcms\structureentries\services;

use craft\base\Element;
use craft\elements\db\ElementQuery;
use yii\base\Component;

class Structures extends Component
{
    /**
     * Patches an array of structure elements, filling in any gaps in the tree.
     *
     * @param Element[] $elements
     */
    public function fillGapsInElements(array &$elements)
    {
        /** @var Element|null $prevElement */
        $prevElement = null;
        $patchedElements = [];

        foreach ($elements as $i => $element) {
            // Did we just skip any elements?
            if (
                $element->level != 1 && (
                    ($i == 0) || (!$element->isSiblingOf($prevElement) && !$element->isChildOf($prevElement)))
            ) {
                // Merge in any missing ancestors
                /** @var ElementQuery $ancestorQuery */
                $ancestorQuery = $element->getAncestors()
                    ->anyStatus();

                if ($prevElement) {
                    $ancestorQuery->andWhere(['>', 'structureelements.lft', $prevElement->lft]);
                }

                foreach ($ancestorQuery->all() as $ancestor) {
                    $patchedElements[] = $ancestor;
                }
            }

            $patchedElements[] = $element;
            $prevElement = $element;
        }

        $elements = $patchedElements;
    }

    /**
     * Filters an array of structure elements down to only <= X branches.
     *
     * @param Element[] $elements
     * @param int $branchLimit
     */
    public function applyBranchLimitToElements(array &$elements, int $branchLimit)
    {
        $branchCount = 0;
        $prevElement = null;

        foreach ($elements as $i => $element) {
            // Is this a new branch?
            if ($prevElement === null || !$element->isDescendantOf($prevElement)) {
                $branchCount++;

                // Have we gone over?
                if ($branchCount > $branchLimit) {
                    array_splice($elements, $i);
                    break;
                }
            }

            $prevElement = $element;
        }
    }
}
