<?php

namespace Epixa\UserBundle\Test;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase,
    Epixa\UserBundle\Entity\Credential;

class CredentialTest extends WebTestCase
{
    public function testCredentialCreation()
    {
        $providerName = 'someProviderName';
        $identifier = 'someIdentifier';
        $credential = new Credential($providerName, $identifier);

        $this->assertAttributeEquals($providerName, 'providerName', $credential);
        $this->assertEquals($providerName, $credential->getProviderName());

        $this->assertAttributeEquals($identifier, 'identifier', $credential);
        $this->assertEquals($identifier, $credential->getIdentifier());

        return $credential;
    }

    /**
     * @depends testCredentialCreation
     * @param \Epixa\UserBundle\Entity\Credential $credential
     */
    public function testCredentialMutators(Credential $credential)
    {
        $providerName = 'newProviderName';
        $identifier = 'newIdentifier';

        // providerName
        $credential->setProviderName($providerName);
        $this->assertAttributeEquals($providerName, 'providerName', $credential);
        $this->assertEquals($providerName, $credential->getProviderName());

        // identifier
        $credential->setIdentifier($identifier);
        $this->assertAttributeEquals($identifier, 'identifier', $credential);
        $this->assertEquals($identifier, $credential->getIdentifier());
    }
}