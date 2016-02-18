<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\Propel\Business\Model;

interface PropelSchemaWriterInterface
{

    /**
     * @param string $fileName
     * @param string $content
     */
    public function write($fileName, $content);

}
