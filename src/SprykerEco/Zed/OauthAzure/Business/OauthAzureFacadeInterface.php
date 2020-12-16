<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\OauthAzure\Business;

use Generated\Shared\Transfer\OauthAuthenticationLinkTransfer;
use Generated\Shared\Transfer\ResourceOwnerRequestTransfer;
use Generated\Shared\Transfer\ResourceOwnerResponseTransfer;

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

    /**
     * Specification:
     * - Requests a resource owner using a specified option set.
     * - Requires code and state field to be set.
     * - Compares the `state` parameter with saved to the session, in case of inequality, the request is considered unsuccessful.
     * - Returns `ResourceOwnerResponseTransfer::isSuccessful = true` in case the resource owner was received.
     * - Returns `ResourceOwnerResponseTransfer::isSuccessful = false` in case of failure.
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\ResourceOwnerRequestTransfer $resourceOwnerRequestTransfer
     *
     * @return \Generated\Shared\Transfer\ResourceOwnerResponseTransfer
     */
    public function getResourceOwner(
        ResourceOwnerRequestTransfer $resourceOwnerRequestTransfer
    ): ResourceOwnerResponseTransfer;
}
