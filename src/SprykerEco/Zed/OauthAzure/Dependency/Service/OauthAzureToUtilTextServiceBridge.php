<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\OauthAzure\Dependency\Service;

class OauthAzureToUtilTextServiceBridge implements OauthAzureToUtilTextServiceInterface
{
    /**
     * @var \Spryker\Service\UtilText\UtilTextServiceInterface
     */
    protected $utilTextService;

    /**
     * @param \Spryker\Service\UtilText\UtilTextServiceInterface $utilTextService
     */
    public function __construct($utilTextService)
    {
        $this->utilTextService = $utilTextService;
    }

    /**
     * @param int $length
     *
     * @return string
     */
    public function generateRandomString($length)
    {
        return $this->utilTextService->generateRandomString($length);
    }
}
