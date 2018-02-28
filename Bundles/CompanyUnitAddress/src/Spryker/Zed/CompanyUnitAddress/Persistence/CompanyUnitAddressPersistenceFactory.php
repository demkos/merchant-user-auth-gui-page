<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\CompanyUnitAddress\Persistence;

use Orm\Zed\CompanyUnitAddress\Persistence\SpyCompanyUnitAddressQuery;
use Spryker\Zed\CompanyUnitAddress\Persistence\Mapper\CompanyUnitAddressMapper;
use Spryker\Zed\CompanyUnitAddress\Persistence\Mapper\CompanyUnitAddressMapperInterface;
use Spryker\Zed\Kernel\Persistence\AbstractPersistenceFactory;

class CompanyUnitAddressPersistenceFactory extends AbstractPersistenceFactory
{
    /**
     * @return \Orm\Zed\CompanyUnitAddress\Persistence\SpyCompanyUnitAddressQuery
     */
    public function createCompanyUnitAddressQuery(): SpyCompanyUnitAddressQuery
    {
        return SpyCompanyUnitAddressQuery::create();
    }

    /**
     * @return \Spryker\Zed\CompanyUnitAddress\Persistence\Mapper\CompanyUnitAddressMapperInterface
     */
    public function createCompanyUniAddressMapper(): CompanyUnitAddressMapperInterface
    {
        return new CompanyUnitAddressMapper();
    }
}
