<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\OauthAzure\Business;

use Generated\Shared\Transfer\OauthAuthenticationLinkTransfer;

/**
 * @method \SprykerEco\Zed\OauthAzure\Business\OauthAzureBusinessFactory getFactory()
 */
interface OauthAzureFacadeInterface
{
    /**
     * Specification:
     * - Prepares Oauth Azure authentication link.
     * - Generates query string `state` parameter.
     * - Saves generated query string `state` parameter to the session.
     * - Returns prepared authentication link.
     *
     * @api
     *
     * @return \Generated\Shared\Transfer\OauthAuthenticationLinkTransfer
     */
    public function createAuthenticationLink(): OauthAuthenticationLinkTransfer;
}
