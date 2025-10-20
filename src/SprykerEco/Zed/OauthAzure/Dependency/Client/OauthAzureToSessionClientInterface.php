<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\OauthAzure\Dependency\Client;

interface OauthAzureToSessionClientInterface
{
    /**
     * @param string $name
     * @param mixed $value
     *
     * @return void
     */
    public function set(string $name, $value);

    /**
     * @param string $name The attribute name
     * @param mixed $default The default value if not found.
     *
     * @return mixed
     */
    public function get(string $name, $default = null);
}
