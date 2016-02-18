<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Client\Catalog\Model\Builder;

interface FacetAggregationBuilderInterface
{

    /**
     * @param string $fieldName
     *
     * @return \Elastica\Aggregation\AbstractAggregation
     */
    public function createNumberFacetAggregation($fieldName);

    /**
     * @param string $fieldName
     *
     * @return \Elastica\Aggregation\AbstractAggregation
     */
    public function createStringFacetAggregation($fieldName);

}
