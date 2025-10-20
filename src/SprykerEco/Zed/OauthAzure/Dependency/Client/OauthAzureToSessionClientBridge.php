<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\OauthAzure\Dependency\Client;

class OauthAzureToSessionClientBridge implements OauthAzureToSessionClientInterface
{
    /**
     * @var \Spryker\Client\Session\SessionClientInterface
     */
    protected $sessionClient;

    /**
     * @param \Spryker\Client\Session\SessionClientInterface $sessionClient
     */
    public function __construct($sessionClient)
    {
        $this->sessionClient = $sessionClient;
    }

    /**
     * @param string $name
     * @param mixed $value
     *
     * @return void
     */
    public function set(string $name, $value)
    {
        $this->sessionClient->set($name, $value);
    }

    /**
     * @param string $name The attribute name
     * @param mixed $default The default value if not found.
     *
     * @return mixed
     */
    public function get(string $name, $default = null)
    {
        return $this->sessionClient->get($name, $default);
    }
}
