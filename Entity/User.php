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
    Symfony\Component\Validator\Constraint as Assert,
    Doctrine\Common\Collections\Collection;

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
     * @Assert\NotBlank()
     *
     * @var string
     */
    protected $displayName;

    /**
     * @ORM\ManyToMany(targetEntity="User")
     * @ORM\JoinTable(name="epixa_user_credential",
     *      joinColumns={@ORM\JoinColumn(name="user_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="credential_id", referencedColumnName="id", unique=true)}
     * )
     *
     * @var \Doctrine\Common\Collections\Collection
     */
    protected $credentials;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->setCredentials(new \Doctrine\Common\Collections\ArrayCollection);
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
     */
    public function addCredential(Credential $credential)
    {
        if (!$this->getCredentials()->contains($credential)) {
            $this->getCredentials()->add($credential);
        }
    }

    /**
     * Remove a credential from the user.
     *
     * @param \Epixa\UserBundle\Entity\Credential $credential
     */
    public function removeCredential(Credential $credential)
    {
        if ($this->getCredentials()->contains($credential)) {
            $this->getCredentials()->removeElement($credential);
        }
    }

    /**
     * Set the credentials associated with the user.
     *
     * @param \Doctrine\Common\Collections\Collection $credentials
     */
    protected function setCredentials(Collection $credentials)
    {
        $this->credentials = $credentials;
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
     * @return void
     */
    public function setDisplayName($displayName)
    {
        $this->displayName = $displayName;
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

}