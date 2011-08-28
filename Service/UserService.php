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

use Doctrine\ORM\NoResultException,
    Epixa\UserBundle\Entity\User;

/**
 * Service for managing users
 *
 * @author Court Ewing <court@epixa.com>
 */
class UserService extends AbstractDoctrineService
{
    /**
     * Gets a specific user by its unique identifier
     *
     * @throws \Doctrine\ORM\NoResultException
     * @param integer $id
     * @return \Epixa\UserBundle\Entity\User
     */
    public function get($id)
    {
        $repo = $this->getEntityManager()->getRepository('Epixa\UserBundle\Entity\User');
        $user = $repo->find($id);
        if (!$user) {
            throw new NoResultException('That user cannot be found');
        }

        return $user;
    }

    /**
     * Gets a page of users
     *
     * @param int $page
     * @return array
     */
    public function getAll($page = 1)
    {
        /* @var \Epixa\UserBundle\Repository\UserRepository $repo */
        $repo = $this->getEntityManager()->getRepository('Epixa\UserBundle\Entity\User');
        $qb = $repo->getSelectQueryBuilder();

        $repo->restrictToPage($qb, $page);

        return $qb->getQuery()->getResult();
    }

    /**
     * Adds the given new user to the database
     *
     * @param \Epixa\UserBundle\Entity\User $user
     * @return void
     */
    public function add(User $user)
    {
        $em = $this->getEntityManager();
        $em->persist($user);
        $em->flush();
    }

    /**
     * Updates the given user in the database
     *
     * @throws \InvalidArgumentException
     * @param \Epixa\UserBundle\Entity\User $user
     * @return void
     */
    public function update(User $user)
    {
        $em = $this->getEntityManager();
        if (!$em->contains($user)) {
            throw new \InvalidArgumentException('User is not managed');
        }

        $em->persist($user);
        $em->flush();
    }

    /**
     * Deletes the given user from the database
     *
     * @param \Epixa\UserBundle\Entity\User $user
     * @return void
     */
    public function delete(User $user)
    {
        $em = $this->getEntityManager();
        $em->remove($user);
        $em->flush();
    }
}