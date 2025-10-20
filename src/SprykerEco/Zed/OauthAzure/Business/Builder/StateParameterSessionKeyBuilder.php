<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\OauthAzure\Business\Builder;

use SprykerEco\Zed\OauthAzure\OauthAzureConfig;

class StateParameterSessionKeyBuilder implements StateParameterSessionKeyBuilderInterface
{
    /**
     * @param string $state
     *
     * @return string
     */
    public function getStateParameterSessionKey(string $state): string
    {
        return sprintf('%s:%s', OauthAzureConfig::SESSION_KEY_STATE, $state);
    }
}
