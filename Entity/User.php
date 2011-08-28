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
     * Gets the user identifier
     * 
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }
}