<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\ProductCategoryFilterGui\Communication\Controller;

use Spryker\Zed\Kernel\Communication\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

/**
 * @method \Spryker\Zed\ProductCategoryFilterGui\Communication\ProductCategoryFilterGuiCommunicationFactory getFactory()
 * @method \Spryker\Zed\ProductCategoryFilterGui\Persistence\ProductCategoryFilterGuiQueryContainerInterface getQueryContainer()
 */
class FilterSuggestionController extends AbstractController
{
    const PARAM_TERM = 'term';
    const PARAM_CATEGORY = 'category';

    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function indexAction(Request $request)
    {
        $searchTerm = $request->query->get(self::PARAM_TERM);
        $idCategory = $request->query->get(self::PARAM_CATEGORY);

        $suggestions = $this
            ->getFactory()
            ->getProductSearchFacade()
            ->suggestProductSearchAttributeKeys($searchTerm);

        $suggestions = array_flip($suggestions);
        return $this->jsonResponse($this->getFactory()->createSuggestionsFormatter()->formatCategorySuggestions($suggestions, $idCategory));
    }
}
