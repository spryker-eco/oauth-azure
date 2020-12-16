<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEcoTest\Zed\OauthAzure\Business\Facade;

use Codeception\Test\Unit;
use SprykerEco\Zed\OauthAzure\Dependency\Client\OauthAzureToSessionClientInterface;

/**
 * Auto-generated group annotations
 *
 * @group SprykerEcoTest
 * @group Zed
 * @group OauthAzure
 * @group Business
 * @group Facade
 * @group CreateAuthenticationLinkTest
 * Add your own group annotations below this line
 */
class CreateAuthenticationLinkTest extends Unit
{
    /**
     * @var \SprykerEcoTest\Zed\OauthAzure\OauthAzureBusinessTester
     */
    protected $tester;

    /**
     * @return void
     */
    public function testCreateAuthenticationLinkCreatesAuthenticationLink(): void
    {
        //Arrange
        $this->tester->setOauthAzureToSessionClientBridge($this->createOauthAzureToSessionClientBridgeMock());

        // Act
        $oauthAuthenticationLinkTransfer = $this->tester
            ->getOauthAzureFacade()
            ->createAuthenticationLink();

        //Assert
        $this->assertNotEmpty(
            $oauthAuthenticationLinkTransfer->getHref(),
            'Expected that `href` attribute is provided.'
        );
        $this->assertNotEmpty(
            $oauthAuthenticationLinkTransfer->getTarget(),
            'Expected that `target` attribute is provided.'
        );
        $this->assertNotEmpty(
            $oauthAuthenticationLinkTransfer->getText(),
            'Expected that `text` attribute is provided.'
        );
    }

    /**
     * @return \PHPUnit\Framework\MockObject\MockObject|\SprykerEco\Zed\OauthAzure\Dependency\Client\OauthAzureToSessionClientInterface
     */
    protected function createOauthAzureToSessionClientBridgeMock(): OauthAzureToSessionClientInterface
    {
        $oauthAzureToSessionClientBridgeMock = $this
            ->getMockBuilder(OauthAzureToSessionClientInterface::class)
            ->getMock();

        return $oauthAzureToSessionClientBridgeMock;
    }
}
