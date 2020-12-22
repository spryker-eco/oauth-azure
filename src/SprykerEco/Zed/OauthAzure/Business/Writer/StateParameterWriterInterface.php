<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\OauthAzure\Business\Writer;

interface StateParameterWriterInterface
{
    /**
     * @param string $stateParameter
     *
     * @return void
     */
    public function storeStateParameter(string $stateParameter): void;
}
