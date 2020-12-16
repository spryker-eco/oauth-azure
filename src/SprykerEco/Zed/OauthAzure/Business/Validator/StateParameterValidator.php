<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\OauthAzure\Business\Validator;

use SprykerEco\Zed\OauthAzure\Dependency\Client\OauthAzureToSessionClientInterface;

class StateParameterValidator implements StateParameterValidatorInterface
{
    /**
     * @var \SprykerEco\Zed\OauthAzure\Dependency\Client\OauthAzureToSessionClientInterface
     */
    protected $sessionClient;

    /**
     * @param \SprykerEco\Zed\OauthAzure\Dependency\Client\OauthAzureToSessionClientInterface $sessionClient
     */
    public function __construct(OauthAzureToSessionClientInterface $sessionClient)
    {
        $this->sessionClient = $sessionClient;
    }

    /**
     * @param string $state
     *
     * @return bool
     */
    public function isValidStateParameter(string $state): bool
    {
        return $this->sessionClient->get($state) === $state;
    }
}
