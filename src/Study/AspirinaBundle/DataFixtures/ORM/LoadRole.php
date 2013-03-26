<?php

namespace Study\AspirinaBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Study\AspirinaBundle\Entity\Role;

class LoadRoleData implements FixtureInterface, OrderedFixtureInterface
{    
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $role = new Role();
        $role->setName('Administrator');
        $role->setRole('ROLE_ADMIN');
        $manager->persist($role);
        
        $role = new Role();
        $role->setName('Typist');
        $role->setRole('ROLE_TYPIST');
        $manager->persist($role);
        
        $role = new Role();
        $role->setName('Coordinator');
        $role->setRole('ROLE_COORDINATOR');
        $manager->persist($role);
        
        $role = new Role();
        $role->setName('Statistician');
        $role->setRole('ROLE_STATISTICIAN');
        $manager->persist($role);
        
        $manager->flush();
    }

    public function getOrder()
    {
        return 1;
    }
}