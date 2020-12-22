<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEcoTest\Zed\OauthAzure\Business\Facade;

use Codeception\Test\Unit;
use Exception;
use Generated\Shared\Transfer\ResourceOwnerRequestTransfer;
use League\OAuth2\Client\Provider\GenericResourceOwner;
use League\OAuth2\Client\Token\AccessToken;
use Spryker\Shared\Kernel\Transfer\Exception\RequiredTransferPropertyException;
use SprykerEco\Zed\OauthAzure\Dependency\Client\OauthAzureToSessionClientInterface;
use SprykerEco\Zed\OauthAzure\Dependency\External\OauthAzureToOauthAdapterInterface;

/**
 * Auto-generated group annotations
 *
 * @group SprykerEcoTest
 * @group Zed
 * @group OauthAzure
 * @group Business
 * @group Facade
 * @group GetResourceOwnerTest
 * Add your own group annotations below this line
 */
class GetResourceOwnerTest extends Unit
{
    protected const SOME_CODE = 'SOME_CODE';
    protected const SOME_STATE = 'SOME_STATE';
    protected const SOME_ACCESS_TOKEN = 'SOME_ACCESS_TOKEN';
    protected const SOME_RESOURCE_OWNER_ID = 'SOME_RESOURCE_OWNER_ID';
    protected const SOME_INVALID_STATE = 'SOME_INVALID_STATE';

    /**
     * @var \SprykerEcoTest\Zed\OauthAzure\OauthAzureBusinessTester
     */
    protected $tester;

    /**
     * @return void
     */
    public function testGetResourceOwnerMustReturnResourceOwner(): void
    {
        //Arrange
        $this->tester->setOauthAzureToSessionClientBridge(
            $this->createOauthAzureToSessionClientBridgeMock(static::SOME_STATE)
        );

        $this->tester->setOauthAzureToLeagueOauthAzureProviderAdapter(
            $this->createOauthAzureToLeagueOauthAzureProviderAdapterMock()
        );

        $resourceOwnerRequestTransfer = (new ResourceOwnerRequestTransfer())
            ->setCode(static::SOME_CODE)
            ->setState(static::SOME_STATE);

        // Act
        $resourceOwnerResponseTransfer = $this->tester
            ->getFacade()
            ->getResourceOwner($resourceOwnerRequestTransfer);

        //Assert
        $this->assertTrue(
            $resourceOwnerResponseTransfer->getIsSuccessful(),
            'Expected that `IsSuccessful` flag equals to true.'
        );
        $this->assertNotEmpty(
            $resourceOwnerResponseTransfer->getResourceOwner(),
            'Expected that resource owner is provided.'
        );
    }

    /**
     * @dataProvider getResourceOwnerMustFailWhenNoRequireDataProvidedDataProvider
     *
     * @param \Generated\Shared\Transfer\ResourceOwnerRequestTransfer $resourceOwnerRequestTransfer
     *
     * @return void
     */
    public function testGetResourceOwnerMustFailWhenNoRequireDataProvided(
        ResourceOwnerRequestTransfer $resourceOwnerRequestTransfer
    ): void {
        // Assert
        $this->expectException(RequiredTransferPropertyException::class);

        // Act
        $this->tester->getFacade()->getResourceOwner($resourceOwnerRequestTransfer);
    }

    /**
     * @return \Generated\Shared\Transfer\ResourceOwnerRequestTransfer[][]
     */
    public function getResourceOwnerMustFailWhenNoRequireDataProvidedDataProvider(): array
    {
        return [
            [(new ResourceOwnerRequestTransfer())],
            [(new ResourceOwnerRequestTransfer())->setCode(static::SOME_CODE)],
            [(new ResourceOwnerRequestTransfer())->setState(static::SOME_STATE)],
        ];
    }

    /**
     * @return void
     */
    public function testGetResourceOwnerMustFailWhenStateIsNotValid(): void
    {
        //Arrange
        $this->tester->setOauthAzureToSessionClientBridge(
            $this->createOauthAzureToSessionClientBridgeMock(static::SOME_STATE, false)
        );

        $this->tester->setOauthAzureToLeagueOauthAzureProviderAdapter(
            $this->createOauthAzureToLeagueOauthAzureProviderAdapterMock()
        );

        $resourceOwnerRequestTransfer = (new ResourceOwnerRequestTransfer())
            ->setCode(static::SOME_CODE)
            ->setState(static::SOME_STATE);

        // Act
        $resourceOwnerResponseTransfer = $this->tester
            ->getFacade()
            ->getResourceOwner($resourceOwnerRequestTransfer);

        //Assert
        $this->assertFalse(
            $resourceOwnerResponseTransfer->getIsSuccessful(),
            'Expected that `IsSuccessful` flag equals to false.'
        );
        $this->assertEmpty(
            $resourceOwnerResponseTransfer->getResourceOwner(),
            'No resource owner is expected to be provided.'
        );
    }

    /**
     * @dataProvider getResourceOwnerMustFailWhenExceptionIsThrownDataProvider
     *
     * @param \PHPUnit\Framework\MockObject\MockObject|\SprykerEco\Zed\OauthAzure\Dependency\External\OauthAzureToOauthAdapterInterface $oauthAzureToLeagueOauthAzureProviderAdapterMock
     *
     * @return void
     */
    public function testGetResourceOwnerMustFailWhenExceptionIsThrown(
        $oauthAzureToLeagueOauthAzureProviderAdapterMock
    ): void {
        //Arrange
        $this->tester->setOauthAzureToSessionClientBridge(
            $this->createOauthAzureToSessionClientBridgeMock(static::SOME_STATE)
        );

        $this->tester->setOauthAzureToLeagueOauthAzureProviderAdapter(
            $oauthAzureToLeagueOauthAzureProviderAdapterMock
        );

        $resourceOwnerRequestTransfer = (new ResourceOwnerRequestTransfer())
            ->setCode(static::SOME_CODE)
            ->setState(static::SOME_STATE);

        // Act
        $resourceOwnerResponseTransfer = $this->tester
            ->getFacade()
            ->getResourceOwner($resourceOwnerRequestTransfer);

        //Assert
        $this->assertFalse(
            $resourceOwnerResponseTransfer->getIsSuccessful(),
            'Expected that `IsSuccessful` flag equals to false.'
        );
        $this->assertEmpty(
            $resourceOwnerResponseTransfer->getResourceOwner(),
            'No resource owner is expected to be provided.'
        );
    }

    /**
     * @return \PHPUnit\Framework\MockObject\MockObject[][]|\SprykerEco\Zed\OauthAzure\Dependency\External\OauthAzureToOauthAdapterInterface[][]
     */
    public function getResourceOwnerMustFailWhenExceptionIsThrownDataProvider(): array
    {
        return [
            [$this->createOauthAzureToLeagueOauthAzureProviderAdapterWithExceptionsMock(true)],
            [$this->createOauthAzureToLeagueOauthAzureProviderAdapterWithExceptionsMock(false, true)],
        ];
    }

    /**
     * @param string $state
     * @param bool $validState
     *
     * @return \PHPUnit\Framework\MockObject\MockObject|\SprykerEco\Zed\OauthAzure\Dependency\Client\OauthAzureToSessionClientInterface
     */
    protected function createOauthAzureToSessionClientBridgeMock(
        string $state,
        bool $validState = true
    ): OauthAzureToSessionClientInterface {
        $oauthAzureToSessionClientBridgeMock = $this
            ->getMockBuilder(OauthAzureToSessionClientInterface::class)
            ->getMock();

        $oauthAzureToSessionClientBridgeMock->method('get')
            ->willReturn($validState ? $state : static::SOME_INVALID_STATE);

        return $oauthAzureToSessionClientBridgeMock;
    }

    /**
     * @return \PHPUnit\Framework\MockObject\MockObject|\SprykerEco\Zed\OauthAzure\Dependency\External\OauthAzureToOauthAdapterInterface
     */
    protected function createOauthAzureToLeagueOauthAzureProviderAdapterMock(): OauthAzureToOauthAdapterInterface
    {
        $oauthAzureToLeagueOauthAzureProviderAdapterMock = $this
            ->getMockBuilder(OauthAzureToOauthAdapterInterface::class)
            ->getMock();

        $oauthAzureToLeagueOauthAzureProviderAdapterMock->method('getAccessToken')
            ->willReturn(new AccessToken(['access_token' => static::SOME_ACCESS_TOKEN]));

        $oauthAzureToLeagueOauthAzureProviderAdapterMock->method('getResourceOwner')
            ->willReturn(new GenericResourceOwner([], static::SOME_RESOURCE_OWNER_ID));

        return $oauthAzureToLeagueOauthAzureProviderAdapterMock;
    }

    /**
     * @param bool $getAccessTokenThrowsException
     * @param bool $getResourceOwnerThrowsException
     *
     * @return \PHPUnit\Framework\MockObject\MockObject|\SprykerEco\Zed\OauthAzure\Dependency\External\OauthAzureToOauthAdapterInterface
     */
    protected function createOauthAzureToLeagueOauthAzureProviderAdapterWithExceptionsMock(
        bool $getAccessTokenThrowsException = false,
        bool $getResourceOwnerThrowsException = false
    ): OauthAzureToOauthAdapterInterface {
        $oauthAzureToLeagueOauthAzureProviderAdapterMock = $this
            ->getMockBuilder(OauthAzureToOauthAdapterInterface::class)
            ->getMock();

        if ($getAccessTokenThrowsException) {
            $oauthAzureToLeagueOauthAzureProviderAdapterMock->method('getAccessToken')
                ->willThrowException(new Exception());
        }

        if ($getResourceOwnerThrowsException) {
            $oauthAzureToLeagueOauthAzureProviderAdapterMock->method('getResourceOwner')
                ->willThrowException(new Exception());
        }

        return $oauthAzureToLeagueOauthAzureProviderAdapterMock;
    }
}
