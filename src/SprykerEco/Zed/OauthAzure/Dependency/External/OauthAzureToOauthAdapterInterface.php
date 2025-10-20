<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

declare(strict_types = 1);

namespace SprykerEco\Zed\OauthAzure\Dependency\External;

use League\OAuth2\Client\Provider\ResourceOwnerInterface;
use League\OAuth2\Client\Token\AccessToken;
use League\OAuth2\Client\Token\AccessTokenInterface;

interface OauthAzureToOauthAdapterInterface
{
    /**
     * @param array $options
     *
     * @return string
     */
    public function getAuthorizationUrl(array $options = []): string;

    /**
     * @param mixed $grant
     * @param array $options
     *
     * @return \League\OAuth2\Client\Token\AccessTokenInterface
     */
    public function getAccessToken($grant, array $options = []): AccessTokenInterface;

    /**
     * @param \League\OAuth2\Client\Token\AccessToken $accessToken
     *
     * @return \League\OAuth2\Client\Provider\ResourceOwnerInterface
     */
    public function getResourceOwner(AccessToken $accessToken): ResourceOwnerInterface;
}
