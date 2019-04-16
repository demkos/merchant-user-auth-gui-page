<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Client\OauthPermission;

use Generated\Shared\Transfer\PermissionCollectionTransfer;

interface OauthPermissionClientInterface
{
    /**
     * Specification:
     *  - Retrieves permission collection from authorization header.
     *
     * @api
     *
     * @return \Generated\Shared\Transfer\PermissionCollectionTransfer
     */
    public function getOauthCustomerPermissions(): PermissionCollectionTransfer;
}
