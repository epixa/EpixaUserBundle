<?php

/*
 * This file is part of the EpixaUserBundle package.
 *
 * (c) Epixa <http://epixa.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Epixa\UserBundle\Repository;

use Doctrine\ORM\EntityRepository,
    Doctrine\ORM\QueryBuilder;

/**
 * Repository for data access logic related to user entities
 *
 * @author Court Ewing <court@epixa.com>
 */
class UserRepository extends EntityRepository
{
    /**
     * Gets the basic query builder for retrieving user entities
     *
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function getSelectQueryBuilder()
    {
        return $this->createQueryBuilder('epixa_user');
    }

    /**
     * Restricts the given query to only users that fall on the given page
     *
     * @param \Doctrine\ORM\QueryBuilder $qb
     * @param integer $page
     * @param integer $max
     * @return void
     */
    public function restrictToPage(QueryBuilder $qb, $page, $max = 25)
    {
        $qb->setMaxResults($max);
        $qb->setFirstResult($max * ($page - 1));
    }
}