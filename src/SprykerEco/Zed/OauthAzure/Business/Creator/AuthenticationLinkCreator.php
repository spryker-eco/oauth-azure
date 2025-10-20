<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\OauthAzure\Business\Creator;

use Generated\Shared\Transfer\OauthAuthenticationLinkTransfer;
use SprykerEco\Zed\OauthAzure\Business\Generator\StateParameterGeneratorInterface;
use SprykerEco\Zed\OauthAzure\Business\Writer\StateParameterWriterInterface;
use SprykerEco\Zed\OauthAzure\Dependency\External\OauthAzureToOauthAdapterInterface;
use SprykerEco\Zed\OauthAzure\OauthAzureConfig;

class AuthenticationLinkCreator implements AuthenticationLinkCreatorInterface
{
    protected const QUERY_PARAMETER_STATE = 'state';

    /**
     * @var \SprykerEco\Zed\OauthAzure\OauthAzureConfig
     */
    protected $oauthAzureConfig;

    /**
     * @var \SprykerEco\Zed\OauthAzure\Dependency\External\OauthAzureToOauthAdapterInterface
     */
    protected $oauthAdapter;

    /**
     * @var \SprykerEco\Zed\OauthAzure\Business\Generator\StateParameterGeneratorInterface
     */
    protected $stateParameterGenerator;

    /**
     * @var \SprykerEco\Zed\OauthAzure\Business\Writer\StateParameterWriterInterface
     */
    protected $stateParameterWriter;

    /**
     * @param \SprykerEco\Zed\OauthAzure\OauthAzureConfig $oauthAzureConfig
     * @param \SprykerEco\Zed\OauthAzure\Dependency\External\OauthAzureToOauthAdapterInterface $oauthAdapter
     * @param \SprykerEco\Zed\OauthAzure\Business\Generator\StateParameterGeneratorInterface $stateParameterGenerator
     * @param \SprykerEco\Zed\OauthAzure\Business\Writer\StateParameterWriterInterface $stateParameterWriter
     */
    public function __construct(
        OauthAzureConfig $oauthAzureConfig,
        OauthAzureToOauthAdapterInterface $oauthAdapter,
        StateParameterGeneratorInterface $stateParameterGenerator,
        StateParameterWriterInterface $stateParameterWriter
    ) {
        $this->oauthAzureConfig = $oauthAzureConfig;
        $this->oauthAdapter = $oauthAdapter;
        $this->stateParameterGenerator = $stateParameterGenerator;
        $this->stateParameterWriter = $stateParameterWriter;
    }

    /**
     * @return \Generated\Shared\Transfer\OauthAuthenticationLinkTransfer
     */
    public function createAuthenticationLink(): OauthAuthenticationLinkTransfer
    {
        $stateParameter = $this->stateParameterGenerator->generateStateParameter();

        $this->stateParameterWriter->storeStateParameter($stateParameter);

        $href = $this->oauthAdapter->getAuthorizationUrl([
            static::QUERY_PARAMETER_STATE => $stateParameter,
        ]);

        return $this->createAuthenticationLinkTransfer($href);
    }

    /**
     * @param string $href
     *
     * @return \Generated\Shared\Transfer\OauthAuthenticationLinkTransfer
     */
    protected function createAuthenticationLinkTransfer(
        string $href
    ): OauthAuthenticationLinkTransfer {
        return (new OauthAuthenticationLinkTransfer())
            ->setHref($href)
            ->setTarget($this->oauthAzureConfig->getAuthenticationLinkTarget())
            ->setText($this->oauthAzureConfig->getAuthenticationLinkText());
    }
}
