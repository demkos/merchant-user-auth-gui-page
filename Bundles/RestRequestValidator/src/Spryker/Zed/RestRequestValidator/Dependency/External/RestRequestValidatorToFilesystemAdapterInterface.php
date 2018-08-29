<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\RestRequestValidator\Dependency\External;

interface RestRequestValidatorToFilesystemAdapterInterface
{
    /**
     * @param string $file
     *
     * @return bool
     */
    public function exists(string $file): bool;

    /**
     * @param string $filename
     * @param string $content
     *
     * @return void
     */
    public function dumpFile(string $filename, string $content): void;
}
