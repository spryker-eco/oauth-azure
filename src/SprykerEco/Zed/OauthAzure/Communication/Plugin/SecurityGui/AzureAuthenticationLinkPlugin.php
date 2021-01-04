<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\OauthAzure\Communication\Plugin\SecurityGui;

use Generated\Shared\Transfer\OauthAuthenticationLinkTransfer;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;
use Spryker\Zed\SecurityGuiExtension\Dependency\Plugin\AuthenticationLinkPluginInterface;

/**
 * @method \SprykerEco\Zed\OauthAzure\OauthAzureConfig getConfig()
 * @method \SprykerEco\Zed\OauthAzure\Business\OauthAzureFacadeInterface getFacade()
 * @method \SprykerEco\Zed\OauthAzure\Business\OauthAzureFacade getFactory()
 */
class AzureAuthenticationLinkPlugin extends AbstractPlugin implements AuthenticationLinkPluginInterface
{
    /**
     * {@inheritDoc}
     * - Prepares Oauth Azure authentication link.
     * - Generates query string `state` parameter.
     * - Saves generated query string `state` parameter to the session.
     * - Returns prepared authentication link.
     *
     * @api
     *
     * @return \Generated\Shared\Transfer\OauthAuthenticationLinkTransfer
     */
    public function getAuthenticationLink(): OauthAuthenticationLinkTransfer
    {
        return $this->getFacade()->createAuthenticationLink();
    }
}
