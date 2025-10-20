<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

declare(strict_types = 1);

namespace SprykerEco\Zed\OauthAzure\Business\Builder;

interface StateParameterSessionKeyBuilderInterface
{
    /**
     * @param string $state
     *
     * @return string
     */
    public function getStateParameterSessionKey(string $state): string;
}
