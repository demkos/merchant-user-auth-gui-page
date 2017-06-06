<?php

/**
 * Copyright © 2017-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Unit\Spryker\Zed\Kernel\Communication\Form\Fixtures;

use Spryker\Zed\Kernel\Communication\Form\AbstractType;

class FooType extends AbstractType
{

    /**
     * @return \Spryker\Zed\Kernel\Communication\AbstractCommunicationFactory
     */
    public function getFactory()
    {
        return parent::getFactory();
    }

    /**
     * @return \Spryker\Zed\Kernel\Business\AbstractFacade
     */
    public function getFacade()
    {
        return parent::getFacade();
    }

    /**
     * @return \Spryker\Zed\Kernel\Persistence\AbstractQueryContainer
     */
    public function getQueryContainer()
    {
        return parent::getQueryContainer();
    }

}
