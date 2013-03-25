<?php

namespace Study\AspirinaBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Study\AspirinaBundle\Entity\User;
use Study\AspirinaBundle\Entity\RoleRepository;

use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class LoadUserData implements FixtureInterface, ContainerAwareInterface
{
    private $container;
    
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $roleRepository = new RoleRepository();
        $role = $roleRepository->loadByRole('ROLE_ADMIN');
        
        $userAdmin = new User();
        $userAdmin->setUsername('admin');
        $userAdmin->setPassword($this->encodePassword($userAdmin, 'senha12@'));
        $userAdmin->setEmail('admin@admin.local');
        $userAdmin->setActive(true);
        $userAdmin->setRoles($role);

        $manager->persist($userAdmin);
        $manager->flush();
    }

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }
    
    private function encodePassword($user, $plainPassword)
    {
        $enconder = $this->container->get("security.encoder_factory")
                ->getEncoder($user);
        return $enconder->encodePassword($plainPassword, $user->getSalt());
    }
    
}