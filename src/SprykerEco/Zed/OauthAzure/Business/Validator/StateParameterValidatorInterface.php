<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\OauthAzure\Business\Validator;

interface StateParameterValidatorInterface
{
    /**
     * @param string $state
     *
     * @return bool
     */
    public function isValidStateParameter(string $state): bool;
}
