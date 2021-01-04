<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\OauthAzure\Business\Mapper;

use Generated\Shared\Transfer\ResourceOwnerTransfer;
use League\OAuth2\Client\Provider\ResourceOwnerInterface;

interface ResourceOwnerMapperInterface
{
    /**
     * @param \League\OAuth2\Client\Provider\ResourceOwnerInterface $resourceOwner
     * @param \Generated\Shared\Transfer\ResourceOwnerTransfer $resourceOwnerTransfer
     *
     * @return \Generated\Shared\Transfer\ResourceOwnerTransfer
     */
    public function mapResourceOwnerToResourceOwnerTransfer(
        ResourceOwnerInterface $resourceOwner,
        ResourceOwnerTransfer $resourceOwnerTransfer
    ): ResourceOwnerTransfer;
}
