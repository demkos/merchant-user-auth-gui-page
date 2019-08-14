<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Glue\WishlistsRestApi\Processor\Wishlists;

use Generated\Shared\Transfer\RestWishlistsAttributesTransfer;
use Generated\Shared\Transfer\WishlistTransfer;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;
use Spryker\Glue\WishlistsRestApi\Dependency\Client\WishlistsRestApiToWishlistClientInterface;
use Spryker\Glue\WishlistsRestApi\Processor\Mapper\WishlistResourceMapperInterface;
use Spryker\Glue\WishlistsRestApi\Processor\RestResponseBuilder\WishlistRestResponseBuilderInterface;

class WishlistCreator implements WishlistCreatorInterface
{
    /**
     * @var \Spryker\Glue\WishlistsRestApi\Dependency\Client\WishlistsRestApiToWishlistClientInterface
     */
    protected $wishlistClient;

    /**
     * @var \Spryker\Glue\WishlistsRestApi\Processor\Mapper\WishlistResourceMapperInterface
     */
    protected $wishlistResourceMapper;

    /**
     * @var \Spryker\Glue\WishlistsRestApi\Processor\RestResponseBuilder\WishlistRestResponseBuilderInterface
     */
    protected $wishlistRestResponseBuilder;

    /**
     * @param \Spryker\Glue\WishlistsRestApi\Dependency\Client\WishlistsRestApiToWishlistClientInterface $wishlistClient
     * @param \Spryker\Glue\WishlistsRestApi\Processor\Mapper\WishlistResourceMapperInterface $wishlistResourceMapper
     * @param \Spryker\Glue\WishlistsRestApi\Processor\RestResponseBuilder\WishlistRestResponseBuilderInterface $wishlistRestResponseBuilder
     */
    public function __construct(
        WishlistsRestApiToWishlistClientInterface $wishlistClient,
        WishlistResourceMapperInterface $wishlistResourceMapper,
        WishlistRestResponseBuilderInterface $wishlistRestResponseBuilder
    ) {
        $this->wishlistClient = $wishlistClient;
        $this->wishlistResourceMapper = $wishlistResourceMapper;
        $this->wishlistRestResponseBuilder = $wishlistRestResponseBuilder;
    }

    /**
     * @param \Generated\Shared\Transfer\RestWishlistsAttributesTransfer $attributesTransfer
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function create(RestWishlistsAttributesTransfer $attributesTransfer, RestRequestInterface $restRequest): RestResponseInterface
    {
        $wishlistTransfer = $this->wishlistResourceMapper->mapWishlistAttributesToWishlistTransfer(new WishlistTransfer(), $attributesTransfer);
        $wishlistTransfer->setFkCustomer((int)$restRequest->getRestUser()->getSurrogateIdentifier());

        $wishlistResponseTransfer = $this->wishlistClient->validateAndCreateWishlist($wishlistTransfer);
        if (!$wishlistResponseTransfer->getIsSuccess()) {
            return $this->wishlistRestResponseBuilder->createErrorResponseFromErrorIdentifiers(
                $wishlistResponseTransfer->getErrors()
            );
        }

        return $this->wishlistRestResponseBuilder
            ->createWishlistsRestResponse($wishlistResponseTransfer->getWishlist());
    }
}
