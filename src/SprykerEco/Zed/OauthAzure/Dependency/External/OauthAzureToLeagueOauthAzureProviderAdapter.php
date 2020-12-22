<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\OauthAzure\Dependency\External;

use League\OAuth2\Client\Provider\AbstractProvider;
use League\OAuth2\Client\Token\AccessToken;

class OauthAzureToLeagueOauthAzureProviderAdapter implements OauthAzureToOauthAdapterInterface
{
    /**
     * @var \League\OAuth2\Client\Provider\AbstractProvider
     */
    protected $provider;

    /**
     * @param \League\OAuth2\Client\Provider\AbstractProvider $provider
     */
    public function __construct(AbstractProvider $provider)
    {
        $this->provider = $provider;
    }

    /**
     * @param array $options
     *
     * @return string
     */
    public function getAuthorizationUrl(array $options = []): string
    {
        return $this->provider->getAuthorizationUrl($options);
    }

    /**
     * @param mixed $grant
     * @param array $options
     *
     * @return \League\OAuth2\Client\Token\AccessTokenInterface
     */
    public function getAccessToken($grant, array $options = [])
    {
        return $this->provider->getAccessToken($grant, $options);
    }

    /**
     * @param \League\OAuth2\Client\Token\AccessToken $accessToken
     *
     * @return \League\OAuth2\Client\Provider\ResourceOwnerInterface
     */
    public function getResourceOwner(AccessToken $accessToken)
    {
        return $this->provider->getResourceOwner($accessToken);
    }
}
