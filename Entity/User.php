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
     */
    protected $id;

    /**
     * @ORM\ManyToMany(targetEntity="User")
     * @ORM\JoinTable(name="epixa_user_credential",
     *      joinColumns={@ORM\JoinColumn(name="user_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="credential_id", referencedColumnName="id", unique=true)}
     * )
     */
    protected $credentials;

    /**
     * Gets the user identifier
     * 
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }
    public function __construct()
    {
        $this->credentials = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Add credentials
     *
     * @param Epixa\UserBundle\Entity\User $credentials
     */
    public function addCredentials(\Epixa\UserBundle\Entity\User $credentials)
    {
        $this->credentials[] = $credentials;
    }

    /**
     * Get credentials
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getCredentials()
    {
        return $this->credentials;
    }
}