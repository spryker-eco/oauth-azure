<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\OauthAzure\Business\Creator;

use Generated\Shared\Transfer\OauthAuthenticationLinkTransfer;

interface AuthenticationLinkCreatorInterface
{
    /**
     * @return \Generated\Shared\Transfer\OauthAuthenticationLinkTransfer
     */
    public function createAuthenticationLink(): OauthAuthenticationLinkTransfer;
}
