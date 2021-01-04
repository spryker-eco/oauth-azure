<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\OauthAzure\Business;

use Generated\Shared\Transfer\OauthAuthenticationLinkTransfer;
use Generated\Shared\Transfer\ResourceOwnerRequestTransfer;
use Generated\Shared\Transfer\ResourceOwnerResponseTransfer;
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

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\ResourceOwnerRequestTransfer $resourceOwnerRequestTransfer
     *
     * @return \Generated\Shared\Transfer\ResourceOwnerResponseTransfer
     */
    public function getResourceOwner(
        ResourceOwnerRequestTransfer $resourceOwnerRequestTransfer
    ): ResourceOwnerResponseTransfer {
        return $this->getFactory()
            ->createResourceOwnerReader()
            ->getResourceOwner($resourceOwnerRequestTransfer);
    }
}
