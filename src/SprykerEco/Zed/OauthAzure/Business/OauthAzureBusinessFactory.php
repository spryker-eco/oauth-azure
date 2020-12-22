<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\OauthAzure\Business;

use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;
use SprykerEco\Zed\OauthAzure\Business\Builder\StateParameterSessionKeyBuilder;
use SprykerEco\Zed\OauthAzure\Business\Builder\StateParameterSessionKeyBuilderInterface;
use SprykerEco\Zed\OauthAzure\Business\Creator\AuthenticationLinkCreator;
use SprykerEco\Zed\OauthAzure\Business\Creator\AuthenticationLinkCreatorInterface;
use SprykerEco\Zed\OauthAzure\Business\Generator\StateParameterGenerator;
use SprykerEco\Zed\OauthAzure\Business\Generator\StateParameterGeneratorInterface;
use SprykerEco\Zed\OauthAzure\Business\Mapper\ResourceOwnerMapper;
use SprykerEco\Zed\OauthAzure\Business\Mapper\ResourceOwnerMapperInterface;
use SprykerEco\Zed\OauthAzure\Business\Reader\ResourceOwnerReader;
use SprykerEco\Zed\OauthAzure\Business\Reader\ResourceOwnerReaderInterface;
use SprykerEco\Zed\OauthAzure\Business\Validator\StateParameterValidator;
use SprykerEco\Zed\OauthAzure\Business\Validator\StateParameterValidatorInterface;
use SprykerEco\Zed\OauthAzure\Business\Writer\StateParameterWriter;
use SprykerEco\Zed\OauthAzure\Business\Writer\StateParameterWriterInterface;
use SprykerEco\Zed\OauthAzure\Dependency\Client\OauthAzureToSessionClientInterface;
use SprykerEco\Zed\OauthAzure\Dependency\External\OauthAzureToOauthAdapterInterface;
use SprykerEco\Zed\OauthAzure\Dependency\Service\OauthAzureToUtilTextServiceInterface;
use SprykerEco\Zed\OauthAzure\OauthAzureDependencyProvider;

/**
 * @method \SprykerEco\Zed\OauthAzure\OauthAzureConfig getConfig()
 */
class OauthAzureBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \SprykerEco\Zed\OauthAzure\Business\Builder\StateParameterSessionKeyBuilderInterface
     */
    public function createStateParameterSessionKeyBuilder(): StateParameterSessionKeyBuilderInterface
    {
        return new StateParameterSessionKeyBuilder();
    }

    /**
     * @return \SprykerEco\Zed\OauthAzure\Business\Generator\StateParameterGeneratorInterface
     */
    public function createStateParameterGenerator(): StateParameterGeneratorInterface
    {
        return new StateParameterGenerator(
            $this->getUtilTextService(),
            $this->createStateParameterSessionKeyBuilder()
        );
    }

    /**
     * @return \SprykerEco\Zed\OauthAzure\Business\Writer\StateParameterWriterInterface
     */
    public function createStateParameterWriter(): StateParameterWriterInterface
    {
        return new StateParameterWriter($this->getSessionClient());
    }

    /**
     * @return \SprykerEco\Zed\OauthAzure\Business\Creator\AuthenticationLinkCreatorInterface
     */
    public function createAuthenticationLinkCreator(): AuthenticationLinkCreatorInterface
    {
        return new AuthenticationLinkCreator(
            $this->getConfig(),
            $this->getOauthProvider(),
            $this->createStateParameterGenerator(),
            $this->createStateParameterWriter()
        );
    }

    /**
     * @return \SprykerEco\Zed\OauthAzure\Business\Validator\StateParameterValidatorInterface
     */
    public function createStateParameterValidator(): StateParameterValidatorInterface
    {
        return new StateParameterValidator($this->getSessionClient());
    }

    /**
     * @return \SprykerEco\Zed\OauthAzure\Business\Mapper\ResourceOwnerMapperInterface
     */
    public function createResourceOwnerMapper(): ResourceOwnerMapperInterface
    {
        return new ResourceOwnerMapper();
    }

    /**
     * @return \SprykerEco\Zed\OauthAzure\Business\Reader\ResourceOwnerReaderInterface
     */
    public function createResourceOwnerReader(): ResourceOwnerReaderInterface
    {
        return new ResourceOwnerReader(
            $this->getOauthProvider(),
            $this->createResourceOwnerMapper(),
            $this->createStateParameterValidator()
        );
    }

    /**
     * @return \SprykerEco\Zed\OauthAzure\Dependency\External\OauthAzureToOauthAdapterInterface
     */
    public function getOauthProvider(): OauthAzureToOauthAdapterInterface
    {
        return $this->getProvidedDependency(OauthAzureDependencyProvider::OAUTH_PROVIDER);
    }

    /**
     * @return \SprykerEco\Zed\OauthAzure\Dependency\Client\OauthAzureToSessionClientInterface
     */
    public function getSessionClient(): OauthAzureToSessionClientInterface
    {
        return $this->getProvidedDependency(OauthAzureDependencyProvider::CLIENT_SESSION);
    }

    /**
     * @return \SprykerEco\Zed\OauthAzure\Dependency\Service\OauthAzureToUtilTextServiceInterface
     */
    public function getUtilTextService(): OauthAzureToUtilTextServiceInterface
    {
        return $this->getProvidedDependency(OauthAzureDependencyProvider::SERVICE_UTIL_TEXT);
    }
}
