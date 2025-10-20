<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\OauthAzure\Business\Writer;

use SprykerEco\Zed\OauthAzure\Dependency\Client\OauthAzureToSessionClientInterface;

class StateParameterWriter implements StateParameterWriterInterface
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
     * @param string $stateParameter
     *
     * @return void
     */
    public function storeStateParameter(string $stateParameter): void
    {
        $this->sessionClient->set($stateParameter, $stateParameter);
    }
}
