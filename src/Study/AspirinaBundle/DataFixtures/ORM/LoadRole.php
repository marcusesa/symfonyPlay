<?php

namespace Study\AspirinaBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Study\AspirinaBundle\Entity\Role;

class LoadRoleData implements FixtureInterface
{    
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $role = new Role();
        $role->setName('Admin');
        $role->setRole('ROLE_ADMIN');
        
        $manager->persist($role);
        $manager->flush();
    }    
}