<?php

namespace timkelty\craftcms\structureentries\controllers;

use Craft;
use craft\base\Element;
use craft\base\ElementInterface;
use craft\errors\InvalidTypeException;
use timkelty\craftcms\structureentries\Plugin;
use yii\web\BadRequestHttpException;
use yii\web\Response;

class ElementsController extends \craft\controllers\BaseElementsController
{

    /**
     * Returns the HTML for a Structure field input, based on a given list of selected element IDs.
     *
     * @return Response
     */
    public function actionGetStructureInputHtml(): Response
    {
        $request = Craft::$app->getRequest();
        $elementIds = $request->getParam('elementIds', []);
        $elementType = $request->getRequiredParam('elementType');

        // TODO: should probably move the code inside try{} to a helper method
        try {
            if (!is_subclass_of($elementType, ElementInterface::class)) {
                throw new InvalidTypeException($elementType, ElementInterface::class);
            }
        } catch (InvalidTypeException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        /** @var Element $elementType */
        $elements = [];
        if (!empty($elementIds)) {
            $elements = $elementType::find()
                ->id($elementIds)
                ->siteId($request->getParam('siteId'))
                ->anyStatus()
                ->all();

            // Fill in the gaps
            $structuresService = Plugin::getInstance()->structures;
            $structuresService->fillGapsInElements($elements);

            // Enforce the branch limit
            if ($branchLimit = $request->getParam('branchLimit')) {
                $structuresService->applyBranchLimitToElements($elements, $branchLimit);
            }
        }
        $html = $this->getView()->renderTemplate(
            'structure-entries/_includes/forms/elementSelect.html',
            [
                'elements' => $elements,
                'id' => $request->getParam('id'),
                'name' => $request->getParam('name'),
                'selectionLabel' => $request->getParam('selectionLabel'),
                'structure' => true,
                'elementType' => $elementType,
            ]
        );

        return $this->asJson([
            'html' => $html,
        ]);
    }
}
