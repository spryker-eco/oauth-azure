<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\OauthAzure;

use League\OAuth2\Client\Provider\AbstractProvider;
use Spryker\Zed\Kernel\AbstractBundleDependencyProvider;
use Spryker\Zed\Kernel\Container;
use SprykerEco\Zed\OauthAzure\Dependency\Client\OauthAzureToSessionClientBridge;
use SprykerEco\Zed\OauthAzure\Dependency\External\OauthAzureToLeagueOauthAzureProviderAdapter;
use SprykerEco\Zed\OauthAzure\Dependency\Service\OauthAzureToUtilTextServiceBridge;
use TheNetworg\OAuth2\Client\Provider\Azure;

/**
 * @method \SprykerEco\Zed\OauthAzure\OauthAzureConfig getConfig()
 */
class OauthAzureDependencyProvider extends AbstractBundleDependencyProvider
{
    public const CLIENT_SESSION = 'CLIENT_SESSION';

    public const SERVICE_UTIL_TEXT = 'SERVICE_UTIL_TEXT';
    public const OAUTH_PROVIDER = 'OAUTH_PROVIDER';

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function provideBusinessLayerDependencies(Container $container)
    {
        $container = parent::provideBusinessLayerDependencies($container);

        $container = $this->addSessionClient($container);
        $container = $this->addUtilTextService($container);
        $container = $this->addOauthProvider($container);

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addSessionClient(Container $container): Container
    {
        $container->set(static::CLIENT_SESSION, function (Container $container) {
            return new OauthAzureToSessionClientBridge($container->getLocator()->session()->client());
        });

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addUtilTextService(Container $container): Container
    {
        $container->set(static::SERVICE_UTIL_TEXT, function (Container $container) {
            return new OauthAzureToUtilTextServiceBridge($container->getLocator()->utilText()->service());
        });

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addOauthProvider(Container $container): Container
    {
        $container->set(static::OAUTH_PROVIDER, function () {
            return new OauthAzureToLeagueOauthAzureProviderAdapter($this->getOauthProvider());
        });

        return $container;
    }

    /**
     * @return \League\OAuth2\Client\Provider\AbstractProvider
     */
    protected function getOauthProvider(): AbstractProvider
    {
        return new Azure([
            'clientId' => $this->getConfig()->getClientId(),
            'clientSecret' => $this->getConfig()->getClientSecret(),
            'redirectUri' => $this->getConfig()->getRedirectUri(),
            'defaultEndPointVersion' => $this->getConfig()->getDefaultEndpointVersion(),
            'pathAuthorize' => $this->getConfig()->getPathAuthorize(),
            'pathToken' => $this->getConfig()->getPathToken(),
            'scope' => $this->getConfig()->getScope(),
        ]);
    }
}
