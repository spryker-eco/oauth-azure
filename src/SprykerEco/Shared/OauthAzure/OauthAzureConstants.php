<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Shared\OauthAzure;

/**
 * Declares global environment configuration keys. Do not use it for other class constants.
 */
interface OauthAzureConstants
{
    /**
     * Specification:
     *  - The client id for OAuth client provider to use when requesting for access tokens.
     *
     * @api
     */
    public const CLIENT_ID = 'OAUTH_AZURE:CLIENT_ID';

    /**
     * Specification:
     *  - The secret of OAuth client provider to use when requesting for access tokens.
     *
     * @api
     */
    public const CLIENT_SECRET = 'OAUTH_AZURE:CLIENT_SECRET';

    /**
     * Specification:
     *  - The redirect URI.
     *  - After a user successfully authorizes an application, the authorization server will redirect the user back to the application with either an authorization code or access token to the URI.
     *
     * @api
     */
    public const REDIRECT_URI = 'OAUTH_AZURE:REDIRECT_URI';

    /**
     * Specification:
     *  - The endpoint version for the OAuth azure provider.
     *
     * @api
     */
    public const ENDPOINT_VERSION = 'OAUTH_AZURE:ENDPOINT_VERSION';

    /**
     * Specification:
     *  - The path to for the authorization.
     *
     * @api
     */
    public const PATH_AUTHORIZE = 'OAUTH_AZURE:PATH_AUTHORIZE';

    /**
     * Specification:
     *  - The path to for the access token retrieval.
     *
     * @api
     */
    public const PATH_TOKEN = 'OAUTH_AZURE:PATH_TOKEN';
}
