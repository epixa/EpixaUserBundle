<?php

/*
 * This file is part of the EpixaUserBundle package.
 *
 * (c) Epixa <http://epixa.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Epixa\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @author Dustin Sweigart <dustins@swigg.net>
 *
 * @ORM\Entity(repositoryClass="Epixa\UserBundle\Repository\CredentialRepository")
 * @ORM\Table(name="epixa_credential")
 * @ORM\ChangeTrackingPolicy("DEFERRED_EXPLICIT")
 */
class Credential
{
    /**
     * @ORM\Id
     * @ORM\Column(name="id", type="integer", unique=true)
     * @ORM\GeneratedValue(strategy="AUTO")
     *
     * @var int
     */
    protected $id;

    /**
     * Name of the provider for the credential.
     *
     * @ORM\Column(name="provider_name", type="string", length="255")
     *
     * @var string
     */
    protected $providerName;

    /**
     * A uniquely identifying string either provided by the authenticating provider.
     *
     * @ORM\Column(name="identifier", type="string", length="255", unique=true)
     *
     * @var string
     */
    protected $identifier;


    /**
     * Sets the provider name and provider identifier
     * 
     * @param string $providerName
     * @param string $identifier
     */
    public function __construct($providerName, $identifier)
    {
        $this->setProviderName($providerName);
        $this->setIdentifier($identifier);
    }

    /**
     * Get the credential identifier
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the identifier provided by the authentication provider.
     *
     * @param string $identifier
     */
    public function setIdentifier($identifier)
    {
        $this->identifier = $identifier;
    }

    /**
     * Get the identifier provided by the authentication provider.
     *
     * @return string
     */
    public function getIdentifier()
    {
        return $this->identifier;
    }

    /**
     * Set the authentication provider name.
     *
     * @param string $providerName
     */
    public function setProviderName($providerName)
    {
        $this->providerName = $providerName;
    }

    /**
     * Get the authentication provider name.
     *
     * @return string
     */
    public function getProviderName()
    {
        return $this->providerName;
    }
}