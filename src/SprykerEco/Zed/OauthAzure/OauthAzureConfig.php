<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\OauthAzure;

use Spryker\Zed\Kernel\AbstractBundleConfig;
use SprykerEco\Shared\OauthAzure\OauthAzureConstants;

class OauthAzureConfig extends AbstractBundleConfig
{
    public const SESSION_KEY_STATE = 'Azure';
    public const GRANT_TYPE_AUTHORIZATION_CODE = 'authorization_code';

    protected const AUTHENTICATION_LINK_TARGET = '_self';
    protected const AUTHENTICATION_LINK_TEXT = 'Azure';

    /**
     * @uses \TheNetworg\OAuth2\Client\Provider\Azure::ENDPOINT_VERSION_2_0
     */
    protected const DEFAULT_ENDPOINT_VERSION = '2.0';

    /**
     * @api
     *
     * @return string
     */
    public function getAuthenticationLinkTarget(): string
    {
        return static::AUTHENTICATION_LINK_TARGET;
    }

    /**
     * @api
     *
     * @return string
     */
    public function getAuthenticationLinkText(): string
    {
        return static::AUTHENTICATION_LINK_TEXT;
    }

    /**
     * @api
     *
     * @return string
     */
    public function getClientId(): string
    {
        return $this->get(OauthAzureConstants::CLIENT_ID);
    }

    /**
     * @api
     *
     * @return string
     */
    public function getClientSecret(): string
    {
        return $this->get(OauthAzureConstants::CLIENT_SECRET);
    }

    /**
     * @api
     *
     * @return string
     */
    public function getRedirectUri(): string
    {
        return $this->get(OauthAzureConstants::REDIRECT_URI);
    }

    /**
     * @api
     *
     * @return string
     */
    public function getDefaultEndpointVersion(): string
    {
        return $this->get(OauthAzureConstants::ENDPOINT_VERSION, static::DEFAULT_ENDPOINT_VERSION);
    }

    /**
     * @api
     *
     * @return string
     */
    public function getPathAuthorize(): string
    {
        return $this->get(OauthAzureConstants::PATH_AUTHORIZE);
    }

    /**
     * @api
     *
     * @return string
     */
    public function getPathToken(): string
    {
        return $this->get(OauthAzureConstants::PATH_TOKEN);
    }

    /**
     * @api
     *
     * @return string[]
     */
    public function getScope(): array
    {
        return ['openid profile'];
    }
}
