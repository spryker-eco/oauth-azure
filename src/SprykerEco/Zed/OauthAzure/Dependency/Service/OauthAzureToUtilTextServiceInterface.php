<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\OauthAzure\Dependency\Service;

interface OauthAzureToUtilTextServiceInterface
{
    /**
     * @param int $length
     *
     * @return string
     */
    public function generateRandomString($length);
}
