<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

declare(strict_types = 1);

namespace SprykerEco\Zed\OauthAzure\Business\Generator;

interface StateParameterGeneratorInterface
{
    /**
     * @return string
     */
    public function generateStateParameter(): string;
}
