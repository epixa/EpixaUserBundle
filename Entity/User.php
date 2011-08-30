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

use Doctrine\ORM\Mapping as ORM,
    Doctrine\Common\Collections\ArrayCollection;

/**
 * @author Court Ewing <court@epixa.com>
 *
 * @ORM\Entity(repositoryClass="Epixa\UserBundle\Repository\UserRepository")
 * @ORM\Table(name="epixa_user")
 * @ORM\ChangeTrackingPolicy("DEFERRED_EXPLICIT")
 */
class User
{
    /**
     * @ORM\Id
     * @ORM\Column(name="id", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     *
     * @var int
     */
    protected $id;

    /**
     * @ORM\Column(name="display_name", type="string", length=255, unique=true)
     *
     * @var string
     */
    protected $displayName;

    /**
     * @ORM\ManyToMany(targetEntity="Credential")
     * @ORM\JoinTable(
     *      joinColumns={@ORM\JoinColumn(name="user_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="credential_id", referencedColumnName="id", unique=true)}
     * )
     *
     * @var \Doctrine\Common\Collections\ArrayCollection
     */
    protected $credentials;

    /**
     * @ORM\Column(name="date_created", type="datetime")
     *
     * @var \DateTime
     */
    protected $dateCreated;

    /**
     * @ORM\Column(name="last_login", type="datetime", nullable=true)
     *
     * @var null|\DateTime
     */
    protected $lastLogin = null;

    
    /**
     * Sets up the collection for credentials and defaults the date created to now.
     */
    public function __construct()
    {
        $this->setCredentials(new ArrayCollection);
        $this->setDateCreated('now');
    }

    /**
     * Get the user identifier.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Add a credential to the user.
     *
     * @param \Epixa\UserBundle\Entity\Credential $credential
     * @return User *Fluent interface*
     */
    public function addCredential(Credential $credential)
    {
        if (!$this->getCredentials()->contains($credential)) {
            $this->getCredentials()->add($credential);
        }
        return $this;
    }

    /**
     * Remove a credential from the user.
     *
     * @param \Epixa\UserBundle\Entity\Credential $credential
     * @return User *Fluent interface*
     */
    public function removeCredential(Credential $credential)
    {
        if ($this->getCredentials()->contains($credential)) {
            $this->getCredentials()->removeElement($credential);
        }
        return $this;
    }

    /**
     * Set the credentials associated with the user.
     *
     * @param \Doctrine\Common\Collections\ArrayCollection $credentials
     * @return User *Fluent interface*
     */
    protected function setCredentials(ArrayCollection $credentials)
    {
        $this->credentials = $credentials;
        return $this;
    }

    /**
     * Get the user credentials.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCredentials()
    {
        return $this->credentials;
    }

    /**
     * Set the user display name.
     *
     * @param string $displayName
     * @return User *Fluent interface*
     */
    public function setDisplayName($displayName)
    {
        $this->displayName = $displayName;
        return $this;
    }

    /**
     * Get the user display name.
     *
     * @return string
     */
    public function getDisplayName()
    {
        return $this->displayName;
    }

    /**
     * Sets the date this entity was created
     *
     * @throws \InvalidArgumentException
     * @param \DateTime|string|integer $date
     * @return User *Fluent interface*
     */
    public function setDateCreated($date)
    {
        if (is_string($date)) {
            $date = new \DateTime($date);
        } else if (is_int($date)) {
            $date = new \DateTime(sprintf('@%d', $date));
        } else if (!$date instanceof \DateTime) {
            throw new \InvalidArgumentException(sprintf(
                'Expecting string, integer or DateTime, but got `%s`',
                is_object($date) ? get_class($date) : gettype($date)
            ));
        }

        $this->dateCreated = $date;
        return $this;
    }

    /**
     * Gets the date that this entity was created
     *
     * @return \DateTime
     */
    public function getDateCreated()
    {
        return $this->dateCreated;
    }

    /**
     * Sets the date of the last login
     * 
     * @throws \InvalidArgumentException
     * @param \DateTime|string|integer $date
     * @return User *Fluent interface*
     */
    public function setLastLogin($date)
    {
        if (is_string($date)) {
            $date = new \DateTime($date);
        } else if (is_int($date)) {
            $date = new \DateTime(sprintf('@%d', $date));
        } else if (!$date instanceof \DateTime) {
            throw new \InvalidArgumentException(sprintf(
                'Expecting string, integer or DateTime, but got `%s`',
                is_object($date) ? get_class($date) : gettype($date)
            ));
        }

        $this->lastLogin = $date;
        return $this;
    }

    /**
     * Gets the date of the last login
     * 
     * @return \DateTime|null
     */
    public function getLastLogin()
    {
        return $this->lastLogin;
    }
}