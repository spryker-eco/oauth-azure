<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\OauthAzure\Business;

use Generated\Shared\Transfer\OauthAuthenticationLinkTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \SprykerEco\Zed\OauthAzure\Business\OauthAzureBusinessFactory getFactory()
 */
class OauthAzureFacade extends AbstractFacade implements OauthAzureFacadeInterface
{
    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @return \Generated\Shared\Transfer\OauthAuthenticationLinkTransfer
     */
    public function createAuthenticationLink(): OauthAuthenticationLinkTransfer
    {
        return $this->getFactory()
            ->createAuthenticationLinkCreator()
            ->createAuthenticationLink();
    }
}
