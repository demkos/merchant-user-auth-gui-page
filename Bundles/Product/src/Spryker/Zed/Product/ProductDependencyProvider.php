<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\Product;

use Spryker\Zed\Kernel\AbstractBundleDependencyProvider;
use Spryker\Zed\Kernel\Container;
use Spryker\Zed\Product\Dependency\Facade\ProductToLocaleBridge;
use Spryker\Zed\Product\Dependency\Facade\ProductToTouchBridge;
use Spryker\Zed\Product\Dependency\Facade\ProductToUrlBridge;
use Spryker\Zed\Product\Dependency\Facade\ProductToUtilTextBridge;

class ProductDependencyProvider extends AbstractBundleDependencyProvider
{

    const FACADE_LOCALE = 'FACADE_LOCALE';
    const FACADE_PRODUCT_CATEGORY = 'FACADE_PRODUCT_CATEGORY';
    const FACADE_PRODUCT_OPTION = 'FACADE_PRODUCT_OPTION';
    const FACADE_URL = 'FACADE_URL';
    const FACADE_TOUCH = 'FACADE_TOUCH';
    const FACADE_UTIL_TEXT = 'FACADE_UTIL_TEXT';

    const QUERY_CONTAINER_URL = 'QUERY_CONTAINER_URL';

    const PRODUCT_ABSTRACT_PLUGINS_BEFORE_CREATE = 'PRODUCT_ABSTRACT_PLUGINS_BEFORE_CREATE';
    const PRODUCT_ABSTRACT_PLUGINS_BEFORE_UPDATE = 'PRODUCT_ABSTRACT_PLUGINS_BEFORE_UPDATE';
    const PRODUCT_ABSTRACT_PLUGINS_READ = 'PRODUCT_ABSTRACT_PLUGINS_READ';
    const PRODUCT_ABSTRACT_PLUGINS_AFTER_CREATE = 'PRODUCT_ABSTRACT_PLUGINS_AFTER_CREATE';
    const PRODUCT_ABSTRACT_PLUGINS_AFTER_UPDATE = 'PRODUCT_ABSTRACT_PLUGINS_AFTER_UPDATE';

    const PRODUCT_CONCRETE_PLUGINS_BEFORE_CREATE = 'PRODUCT_CONCRETE_PLUGINS_BEFORE_CREATE';
    const PRODUCT_CONCRETE_PLUGINS_BEFORE_UPDATE = 'PRODUCT_CONCRETE_PLUGINS_BEFORE_UPDATE';
    const PRODUCT_CONCRETE_PLUGINS_READ = 'PRODUCT_CONCRETE_PLUGINS_BEFORE_READ';
    const PRODUCT_CONCRETE_PLUGINS_AFTER_CREATE = 'PRODUCT_CONCRETE_PLUGINS_AFTER_CREATE';
    const PRODUCT_CONCRETE_PLUGINS_AFTER_UPDATE = 'PRODUCT_CONCRETE_PLUGINS_AFTER_UPDATE';

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function provideBusinessLayerDependencies(Container $container)
    {
        $container[self::FACADE_LOCALE] = function (Container $container) {
            return new ProductToLocaleBridge($container->getLocator()->locale()->facade());
        };

        $container[self::FACADE_URL] = function (Container $container) {
            return new ProductToUrlBridge($container->getLocator()->url()->facade());
        };

        $container[self::FACADE_TOUCH] = function (Container $container) {
            return new ProductToTouchBridge($container->getLocator()->touch()->facade());
        };

        $container[self::FACADE_UTIL_TEXT] = function (Container $container) {
            return new ProductToUtilTextBridge($container->getLocator()->utilText()->facade());
        };

        $container[self::PRODUCT_ABSTRACT_PLUGINS_BEFORE_CREATE] = function (Container $container) {
            return $this->getProductAbstractBeforeCreatePlugins($container);
        };

        $container[self::PRODUCT_ABSTRACT_PLUGINS_AFTER_CREATE] = function (Container $container) {
            return $this->getProductAbstractAfterCreatePlugins($container);
        };

        $container[self::PRODUCT_ABSTRACT_PLUGINS_READ] = function (Container $container) {
            return $this->getProductAbstractReadPlugins($container);
        };

        $container[self::PRODUCT_ABSTRACT_PLUGINS_BEFORE_UPDATE] = function (Container $container) {
            return $this->getProductAbstractBeforeUpdatePlugins($container);
        };

        $container[self::PRODUCT_ABSTRACT_PLUGINS_AFTER_UPDATE] = function (Container $container) {
            return $this->getProductAbstractAfterUpdatePlugins($container);
        };

        $container[self::PRODUCT_CONCRETE_PLUGINS_BEFORE_CREATE] = function (Container $container) {
            return $this->getProductConcreteBeforeCreatePlugins($container);
        };

        $container[self::PRODUCT_CONCRETE_PLUGINS_AFTER_CREATE] = function (Container $container) {
            return $this->getProductConcreteAfterCreatePlugins($container);
        };

        $container[self::PRODUCT_CONCRETE_PLUGINS_READ] = function (Container $container) {
            return $this->getProductConcreteReadPlugins($container);
        };

        $container[self::PRODUCT_CONCRETE_PLUGINS_BEFORE_UPDATE] = function (Container $container) {
            return $this->getProductConcreteBeforeUpdatePlugins($container);
        };

        $container[self::PRODUCT_CONCRETE_PLUGINS_AFTER_UPDATE] = function (Container $container) {
            return $this->getProductConcreteAfterUpdatePlugins($container);
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function provideCommunicationLayerDependencies(Container $container)
    {
        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function providePersistenceLayerDependencies(Container $container)
    {
        $container[self::QUERY_CONTAINER_URL] = function (Container $container) {
            return $container->getLocator()->url()->queryContainer();
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Product\Dependency\Plugin\ProductAbstractPluginInterface[]
     */
    protected function getProductAbstractBeforeCreatePlugins(Container $container)
    {
        return [

        ];
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Product\Dependency\Plugin\ProductAbstractPluginInterface[]
     */
    protected function getProductAbstractAfterCreatePlugins(Container $container)
    {
        return [];
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Product\Dependency\Plugin\ProductAbstractPluginInterface[]
     */
    protected function getProductAbstractReadPlugins(Container $container)
    {
        return [];
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Product\Dependency\Plugin\ProductAbstractPluginInterface[]
     */
    protected function getProductAbstractBeforeUpdatePlugins(Container $container)
    {
        return [

        ];
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Product\Dependency\Plugin\ProductAbstractPluginInterface[]
     */
    protected function getProductAbstractAfterUpdatePlugins(Container $container)
    {
        return [];
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Product\Dependency\Plugin\ProductConcretePluginInterface[]
     */
    protected function getProductConcreteBeforeCreatePlugins(Container $container)
    {
        return [
        ];
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Product\Dependency\Plugin\ProductConcretePluginInterface[]
     */
    protected function getProductConcreteAfterCreatePlugins(Container $container)
    {
        return [];
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Product\Dependency\Plugin\ProductConcretePluginInterface[]
     */
    protected function getProductConcreteReadPlugins(Container $container)
    {
        return [];
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Product\Dependency\Plugin\ProductConcretePluginInterface[]
     */
    protected function getProductConcreteBeforeUpdatePlugins(Container $container)
    {
        return [
        ];
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Product\Dependency\Plugin\ProductConcretePluginInterface[]
     */
    protected function getProductConcreteAfterUpdatePlugins(Container $container)
    {
        return [];
    }

}
