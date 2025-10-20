<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\OauthAzure\Business\Reader;

use Generated\Shared\Transfer\ResourceOwnerRequestTransfer;
use Generated\Shared\Transfer\ResourceOwnerResponseTransfer;
use Generated\Shared\Transfer\ResourceOwnerTransfer;
use Spryker\Shared\Log\LoggerTrait;
use SprykerEco\Zed\OauthAzure\Business\Mapper\ResourceOwnerMapperInterface;
use SprykerEco\Zed\OauthAzure\Business\Validator\StateParameterValidatorInterface;
use SprykerEco\Zed\OauthAzure\Dependency\External\OauthAzureToOauthAdapterInterface;
use SprykerEco\Zed\OauthAzure\OauthAzureConfig;
use Throwable;

class ResourceOwnerReader implements ResourceOwnerReaderInterface
{
    use LoggerTrait;

    /**
     * @var \SprykerEco\Zed\OauthAzure\Dependency\External\OauthAzureToOauthAdapterInterface
     */
    protected $oauthAdapter;

    /**
     * @var \SprykerEco\Zed\OauthAzure\Business\Mapper\ResourceOwnerMapperInterface
     */
    protected $resourceOwnerMapper;

    /**
     * @var \SprykerEco\Zed\OauthAzure\Business\Validator\StateParameterValidatorInterface
     */
    protected $stateParameterValidator;

    /**
     * @param \SprykerEco\Zed\OauthAzure\Dependency\External\OauthAzureToOauthAdapterInterface $oauthAdapter
     * @param \SprykerEco\Zed\OauthAzure\Business\Mapper\ResourceOwnerMapperInterface $resourceOwnerMapper
     * @param \SprykerEco\Zed\OauthAzure\Business\Validator\StateParameterValidatorInterface $stateParameterValidator
     */
    public function __construct(
        OauthAzureToOauthAdapterInterface $oauthAdapter,
        ResourceOwnerMapperInterface $resourceOwnerMapper,
        StateParameterValidatorInterface $stateParameterValidator
    ) {
        $this->oauthAdapter = $oauthAdapter;
        $this->resourceOwnerMapper = $resourceOwnerMapper;
        $this->stateParameterValidator = $stateParameterValidator;
    }

    /**
     * @param \Generated\Shared\Transfer\ResourceOwnerRequestTransfer $resourceOwnerRequestTransfer
     *
     * @return \Generated\Shared\Transfer\ResourceOwnerResponseTransfer
     */
    public function getResourceOwner(
        ResourceOwnerRequestTransfer $resourceOwnerRequestTransfer
    ): ResourceOwnerResponseTransfer {
        $resourceOwnerRequestTransfer
            ->requireCode()
            ->requireState();

        $resourceOwnerResponseTransfer = (new ResourceOwnerResponseTransfer())
            ->setIsSuccessful(true);

        if (!$this->stateParameterValidator->isValidStateParameter($resourceOwnerRequestTransfer->getStateOrFail())) {
            return $resourceOwnerResponseTransfer->setIsSuccessful(false);
        }

        return $this->fetchResourceOwner($resourceOwnerRequestTransfer, $resourceOwnerResponseTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\ResourceOwnerRequestTransfer $resourceOwnerRequestTransfer
     * @param \Generated\Shared\Transfer\ResourceOwnerResponseTransfer $resourceOwnerResponseTransfer
     *
     * @return \Generated\Shared\Transfer\ResourceOwnerResponseTransfer
     */
    protected function fetchResourceOwner(
        ResourceOwnerRequestTransfer $resourceOwnerRequestTransfer,
        ResourceOwnerResponseTransfer $resourceOwnerResponseTransfer
    ): ResourceOwnerResponseTransfer {
        try {
            /** @var \League\OAuth2\Client\Token\AccessToken $accessToken */
            $accessToken = $this->oauthAdapter->getAccessToken(
                OauthAzureConfig::GRANT_TYPE_AUTHORIZATION_CODE,
                ['code' => $resourceOwnerRequestTransfer->getCode()]
            );

            $resourceOwner = $this->oauthAdapter->getResourceOwner($accessToken);

            $resourceOwnerTransfer = $this->resourceOwnerMapper->mapResourceOwnerToResourceOwnerTransfer(
                $resourceOwner,
                new ResourceOwnerTransfer()
            );

            return $resourceOwnerResponseTransfer->setResourceOwner($resourceOwnerTransfer);
        } catch (Throwable $exception) {
            $this->getLogger()->error($exception->getMessage(), ['exception' => $exception]);

            return $resourceOwnerResponseTransfer->setIsSuccessful(false);
        }
    }
}
