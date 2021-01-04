<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\OauthAzure\Communication\Plugin\SecurityOauthUser;

use Generated\Shared\Transfer\ResourceOwnerRequestTransfer;
use Generated\Shared\Transfer\ResourceOwnerResponseTransfer;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;
use Spryker\Zed\SecurityOauthUserExtension\Dependency\Plugin\OauthUserClientStrategyPluginInterface;
use SprykerEco\Zed\OauthAzure\OauthAzureConfig;

/**
 * @method \SprykerEco\Zed\OauthAzure\OauthAzureConfig getConfig()
 * @method \SprykerEco\Zed\OauthAzure\Business\OauthAzureFacadeInterface getFacade()
 * @method \SprykerEco\Zed\OauthAzure\Business\OauthAzureFacade getFactory()
 */
class AzureOauthUserClientStrategyPlugin extends AbstractPlugin implements OauthUserClientStrategyPluginInterface
{
    /**
     * {@inheritDoc}
     * - Checks if the plugins is applicable.
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\ResourceOwnerRequestTransfer $resourceOwnerRequestTransfer
     *
     * @return bool
     */
    public function isApplicable(ResourceOwnerRequestTransfer $resourceOwnerRequestTransfer): bool
    {
        return mb_strpos($resourceOwnerRequestTransfer->getStateOrFail(), OauthAzureConfig::SESSION_KEY_STATE) !== false;
    }

    /**
     * {@inheritDoc}
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
    ): ResourceOwnerResponseTransfer {
        return $this->getFacade()->getResourceOwner($resourceOwnerRequestTransfer);
    }
}
