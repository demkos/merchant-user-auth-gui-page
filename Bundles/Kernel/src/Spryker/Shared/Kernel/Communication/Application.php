<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Shared\Kernel\Communication;

use Silex\Application\TranslationTrait;
use Silex\Application\TwigTrait;
use Silex\Application\UrlGeneratorTrait;
use Silex\Application as SilexApplication;
use Symfony\Cmf\Component\Routing\ChainRouter;
use Symfony\Component\Routing\RouterInterface;

class Application extends SilexApplication
{

    use TranslationTrait;
    use TwigTrait;
    use UrlGeneratorTrait;

    const REQUEST = 'request';
    const ROUTERS = 'routers';
    const REQUEST_STACK = 'request_stack';

    /**
     * Adds a router to the list of routers.
     *
     * @param \Symfony\Component\Routing\RouterInterface $router The router
     * @param int $priority The priority of the router
     *
     * @return void
     */
    public function addRouter(RouterInterface $router, $priority = 0)
    {
        /** @var \Pimple $this */
        $this[self::ROUTERS] = $this->share($this->extend(self::ROUTERS, function (ChainRouter $chainRouter) use ($router, $priority) {
            $chainRouter->add($router, $priority);

            return $chainRouter;
        }));
    }

}
