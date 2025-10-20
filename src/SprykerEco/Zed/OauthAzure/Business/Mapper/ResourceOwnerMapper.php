<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\OauthAzure\Business\Mapper;

use Generated\Shared\Transfer\ResourceOwnerTransfer;
use League\OAuth2\Client\Provider\ResourceOwnerInterface;

class ResourceOwnerMapper implements ResourceOwnerMapperInterface
{
    protected const FIELD_EMAIL = 'preferred_username';

    /**
     * @param \League\OAuth2\Client\Provider\ResourceOwnerInterface $resourceOwner
     * @param \Generated\Shared\Transfer\ResourceOwnerTransfer $resourceOwnerTransfer
     *
     * @return \Generated\Shared\Transfer\ResourceOwnerTransfer
     */
    public function mapResourceOwnerToResourceOwnerTransfer(
        ResourceOwnerInterface $resourceOwner,
        ResourceOwnerTransfer $resourceOwnerTransfer
    ): ResourceOwnerTransfer {
        $resourceOwnerData = $resourceOwner->toArray();

        return $resourceOwnerTransfer
            ->fromArray($resourceOwnerData, true)
            ->setEmail($resourceOwnerData[static::FIELD_EMAIL] ?? null);
    }
}
