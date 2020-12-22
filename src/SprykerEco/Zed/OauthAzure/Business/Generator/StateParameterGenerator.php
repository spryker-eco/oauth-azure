<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\OauthAzure\Business\Generator;

use SprykerEco\Zed\OauthAzure\Business\Builder\StateParameterSessionKeyBuilderInterface;
use SprykerEco\Zed\OauthAzure\Dependency\Service\OauthAzureToUtilTextServiceInterface;

class StateParameterGenerator implements StateParameterGeneratorInterface
{
    protected const DEFAULT_STRING_LENGTH = 32;

    /**
     * @var \SprykerEco\Zed\OauthAzure\Dependency\Service\OauthAzureToUtilTextServiceInterface
     */
    protected $utilTextService;

    /**
     * @var \SprykerEco\Zed\OauthAzure\Business\Builder\StateParameterSessionKeyBuilderInterface
     */
    protected $stateParameterSessionKeyBuilder;

    /**
     * @param \SprykerEco\Zed\OauthAzure\Dependency\Service\OauthAzureToUtilTextServiceInterface $utilTextService
     * @param \SprykerEco\Zed\OauthAzure\Business\Builder\StateParameterSessionKeyBuilderInterface $stateParameterSessionKeyBuilder
     */
    public function __construct(
        OauthAzureToUtilTextServiceInterface $utilTextService,
        StateParameterSessionKeyBuilderInterface $stateParameterSessionKeyBuilder
    ) {
        $this->utilTextService = $utilTextService;
        $this->stateParameterSessionKeyBuilder = $stateParameterSessionKeyBuilder;
    }

    /**
     * @return string
     */
    public function generateStateParameter(): string
    {
        $randomString = $this->utilTextService->generateRandomString(static::DEFAULT_STRING_LENGTH);

        return $this->stateParameterSessionKeyBuilder->getStateParameterSessionKey($randomString);
    }
}
