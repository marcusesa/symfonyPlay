<?php

namespace Study\AspirinaBundle\Entity;

use Doctrine\ORM\EntityRepository;

class RoleRepository extends EntityRepository
{
    public function loadByRole($role)
    {
        $q = $this
            ->createQueryBuilder('r')
            ->select('r')
            ->where('r.role = :role')
            ->setParameter('role', $role)
            ->getQuery();

        $role = $q->getSingleResult();
        
        return $role;
    }
}
