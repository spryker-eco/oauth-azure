<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEcoTest\Zed\OauthAzure;

use Codeception\Actor;
use SprykerEco\Zed\OauthAzure\Business\OauthAzureFacadeInterface;
use SprykerEco\Zed\OauthAzure\Dependency\Client\OauthAzureToSessionClientInterface;
use SprykerEco\Zed\OauthAzure\Dependency\External\OauthAzureToOauthAdapterInterface;
use SprykerEco\Zed\OauthAzure\OauthAzureDependencyProvider;

/**
 * Inherited Methods
 *
 * @method void wantToTest($text)
 * @method void wantTo($text)
 * @method void execute($callable)
 * @method void expectTo($prediction)
 * @method void expect($prediction)
 * @method void amGoingTo($argumentation)
 * @method void am($role)
 * @method void lookForwardTo($achieveValue)
 * @method void comment($description)
 * @method void pause()
 *
 * @SuppressWarnings(PHPMD)
 */
class OauthAzureBusinessTester extends Actor
{
    use _generated\OauthAzureBusinessTesterActions;

    /**
     * @return \SprykerEco\Zed\OauthAzure\Business\OauthAzureFacadeInterface
     */
    public function getOauthAzureFacade(): OauthAzureFacadeInterface
    {
        return $this->getLocator()->oauthAzure()->facade();
    }

    /**
     * @param \SprykerEco\Zed\OauthAzure\Dependency\Client\OauthAzureToSessionClientInterface $sessionClient
     *
     * @return void
     */
    public function setOauthAzureToSessionClientBridge(OauthAzureToSessionClientInterface $sessionClient): void
    {
        $this->setDependency(OauthAzureDependencyProvider::CLIENT_SESSION, $sessionClient);
    }

    /**
     * @param \SprykerEco\Zed\OauthAzure\Dependency\External\OauthAzureToOauthAdapterInterface $oauthAdapter
     *
     * @return void
     */
    public function setOauthAzureToLeagueOauthAzureProviderAdapter(
        OauthAzureToOauthAdapterInterface $oauthAdapter
    ): void {
        $this->setDependency(OauthAzureDependencyProvider::OAUTH_PROVIDER, $oauthAdapter);
    }
}
