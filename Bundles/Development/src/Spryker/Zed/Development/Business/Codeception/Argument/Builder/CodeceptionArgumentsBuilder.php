<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\Development\Business\Codeception\Argument\Builder;

use Spryker\Zed\Development\Business\Codeception\Argument\CodeceptionArguments;
use SprykerTest\Shared\Testify\Helper\SuiteFilterHelper;

class CodeceptionArgumentsBuilder implements CodeceptionArgumentsBuilderInterface
{
    protected const ARGUMENT_TYPE = 'type';
    protected const OPTION_GROUP_INCLUDE = 'group';
    protected const OPTION_GROUP_EXCLUDE = 'exclude';
    protected const OPTION_VERBOSE = 'verbose';
    protected const OPTION_MODULE = 'module';

    /**
     * @var string[]
     */
    protected $codeceptionConfigurationFiles;

    /**
     * @var string[]
     */
    protected $defaultInclusiveTestGroups;

    /**
     * @param array $defaultInclusiveTestGroups
     * @param array $codeceptionConfigurationFiles
     */
    public function __construct(array $defaultInclusiveTestGroups, array $codeceptionConfigurationFiles)
    {
        $this->defaultInclusiveTestGroups = $defaultInclusiveTestGroups;
        $this->codeceptionConfigurationFiles = $codeceptionConfigurationFiles;
    }

    /**
     * @param array $options
     *
     * @return \Spryker\Zed\Development\Business\Codeception\Argument\CodeceptionArguments
     */
    public function build(array $options): CodeceptionArguments
    {
        $codeceptionArguments = new CodeceptionArguments();

        $codeceptionArguments = $this->buildConfigPath($codeceptionArguments, $options);
        $codeceptionArguments = $this->buildInclusiveGroups($codeceptionArguments, $options);
        $codeceptionArguments = $this->buildIncludeGroups($codeceptionArguments, $options);
        $codeceptionArguments = $this->buildExcludeGroups($codeceptionArguments, $options);
        $codeceptionArguments = $this->buildVerboseMode($codeceptionArguments, $options);

        return $codeceptionArguments;
    }

    /**
     * @param \Spryker\Zed\Development\Business\Codeception\Argument\CodeceptionArguments $codeceptionArguments
     * @param array $options
     *
     * @return \Spryker\Zed\Development\Business\Codeception\Argument\CodeceptionArguments
     */
    protected function buildConfigPath(CodeceptionArguments $codeceptionArguments, array $options): CodeceptionArguments
    {
        if (!array_key_exists(static::ARGUMENT_TYPE, $options)) {
            return $codeceptionArguments;
        }

        $testType = $options[static::ARGUMENT_TYPE];

        if (!array_key_exists($testType, $this->codeceptionConfigurationFiles)) {
            return $codeceptionArguments;
        }

        $filePath = $this->codeceptionConfigurationFiles[$testType];

        if ($filePath[0] !== DIRECTORY_SEPARATOR) {
            $filePath = APPLICATION_ROOT_DIR . DIRECTORY_SEPARATOR . $filePath;
        }

        return $codeceptionArguments->addArgument('-c', [$filePath]);
    }

    /**
     * @param \Spryker\Zed\Development\Business\Codeception\Argument\CodeceptionArguments $codeceptionArguments
     * @param array $options
     *
     * @return \Spryker\Zed\Development\Business\Codeception\Argument\CodeceptionArguments
     */
    protected function buildIncludeGroups(CodeceptionArguments $codeceptionArguments, array $options): CodeceptionArguments
    {
        if ($options[static::OPTION_GROUP_INCLUDE]) {
            $codeceptionArguments->addArgument(
                '-g',
                explode(',', $options[static::OPTION_GROUP_INCLUDE])
            );
        }

        return $codeceptionArguments;
    }

    /**
     * @param \Spryker\Zed\Development\Business\Codeception\Argument\CodeceptionArguments $codeceptionArguments
     * @param array $options
     *
     * @return \Spryker\Zed\Development\Business\Codeception\Argument\CodeceptionArguments
     */
    protected function buildExcludeGroups(CodeceptionArguments $codeceptionArguments, array $options): CodeceptionArguments
    {
        if ($options[static::OPTION_GROUP_EXCLUDE]) {
            $codeceptionArguments->addArgument(
                '-x',
                explode(',', $options[static::OPTION_GROUP_EXCLUDE])
            );
        }

        return $codeceptionArguments;
    }

    /**
     * @param \Spryker\Zed\Development\Business\Codeception\Argument\CodeceptionArguments $codeceptionArguments
     * @param array $options
     *
     * @return \Spryker\Zed\Development\Business\Codeception\Argument\CodeceptionArguments
     */
    protected function buildVerboseMode(CodeceptionArguments $codeceptionArguments, array $options): CodeceptionArguments
    {
        if (!(bool)$options[static::OPTION_VERBOSE]) {
            return $codeceptionArguments;
        }

        return $codeceptionArguments->addArgument('-v');
    }

    /**
     * @param \Spryker\Zed\Development\Business\Codeception\Argument\CodeceptionArguments $codeceptionArguments
     * @param array $options
     *
     * @return \Spryker\Zed\Development\Business\Codeception\Argument\CodeceptionArguments
     */
    protected function buildInclusiveGroups(CodeceptionArguments $codeceptionArguments, array $options): CodeceptionArguments
    {
        if (!$options[static::OPTION_MODULE]) {
            return $codeceptionArguments;
        }

        $codeceptionArguments = $this->enableSuiteFilterExtension($codeceptionArguments);
        $codeceptionArguments = $this->buildInlineExtensionConfig($codeceptionArguments, $options);

        return $codeceptionArguments;
    }

    /**
     * @param \Spryker\Zed\Development\Business\Codeception\Argument\CodeceptionArguments $codeceptionArguments
     *
     * @return \Spryker\Zed\Development\Business\Codeception\Argument\CodeceptionArguments
     */
    protected function enableSuiteFilterExtension(CodeceptionArguments $codeceptionArguments): CodeceptionArguments
    {
        return $codeceptionArguments->addArgument(
            '--ext',
            ['\\\\' . str_replace('\\', '\\\\', SuiteFilterHelper::class)]
        );
    }

    /**
     * @param \Spryker\Zed\Development\Business\Codeception\Argument\CodeceptionArguments $codeceptionArguments
     * @param array $options
     *
     * @return \Spryker\Zed\Development\Business\Codeception\Argument\CodeceptionArguments
     */
    protected function buildInlineExtensionConfig(CodeceptionArguments $codeceptionArguments, array $options): CodeceptionArguments
    {
        $extensionInlineConfigTemplate = '"extensions: config: %s: inclusive: [%s]"';

        $inclusiveGroups = $this->defaultInclusiveTestGroups;
        $inclusiveGroups[] = $options[static::OPTION_MODULE];

        $suiteFilterHelperClassName = '\\' . SuiteFilterHelper::class;
        $inclusiveGroupsAsString = implode(',', $inclusiveGroups);

        $extensionInlineConfig = sprintf(
            $extensionInlineConfigTemplate,
            $suiteFilterHelperClassName,
            $inclusiveGroupsAsString
        );

        return $codeceptionArguments->addArgument(
            '-o',
            [$extensionInlineConfig]
        );
    }
}
