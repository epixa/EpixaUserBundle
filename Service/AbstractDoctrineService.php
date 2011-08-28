<?php

/*
 * This file is part of the EpixaUserBundle package.
 *
 * (c) Epixa <http://epixa.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Epixa\UserBundle\Service;

use Doctrine\ORM\EntityManager;

/**
 * @author Court Ewing <court@epixa.com>
 */
abstract class AbstractDoctrineService
{
    /**
     * @var \Doctrine\ORM\EntityManager
     */
    protected $em;


    /**
     * Sets the entity manager
     *
     * @param  \Doctrine\ORM\EntityManager $em
     * @return AbstractDoctrineService *Fluent interface*
     */
    public function setEntityManager(EntityManager $em)
    {
        $this->em = $em;
        return $this;
    }

    /**
     * Gets the doctrine entity manager
     *
     * @return \Doctrine\ORM\EntityManager
     */
    public function getEntityManager()
    {
        return $this->em;
    }
}