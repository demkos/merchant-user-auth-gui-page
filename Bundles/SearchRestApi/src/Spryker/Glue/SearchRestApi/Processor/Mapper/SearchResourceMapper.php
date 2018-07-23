<?php
/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Glue\SearchRestApi\Processor\Mapper;

use Generated\Shared\Transfer\RestSearchAttributesTransfer;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceInterface;
use Spryker\Glue\SearchRestApi\SearchRestApiConfig;

class SearchResourceMapper implements SearchResourceMapperInterface
{
    /**
     * @var \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface
     */
    protected $restResourceBuilder;

    /**
     * @param \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface $restResourceBuilder
     */
    public function __construct(RestResourceBuilderInterface $restResourceBuilder)
    {
        $this->restResourceBuilder = $restResourceBuilder;
    }

    /**
     * @param array $restSearchResponse
     * @param string $currency
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceInterface
     */
    public function mapSearchResponseAttributesTransferToRestResponse(array $restSearchResponse, string $currency): RestResourceInterface
    {
        $restSearchAttributesTransfer = (new RestSearchAttributesTransfer())->fromArray($restSearchResponse, true);
        $restSearchAttributesTransfer->setCurrency($currency);

        return $this->restResourceBuilder->createRestResource(
            SearchRestApiConfig::RESOURCE_SEARCH,
            null,
            $restSearchAttributesTransfer
        );
    }
}
