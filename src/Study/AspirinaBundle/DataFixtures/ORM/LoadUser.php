<?php

namespace Study\AspirinaBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Study\AspirinaBundle\Entity\User;
use Study\AspirinaBundle\Entity\Role;
use Study\AspirinaBundle\Entity\RoleRepository;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class LoadUserData implements FixtureInterface, ContainerAwareInterface, OrderedFixtureInterface
{
    private $container;
    
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $roleRepository = $this->container->get("doctrine")->getRepository('AspirinaBundle:Role');
        
        $roleAdmin = $roleRepository->findOneByRole('ROLE_ADMIN');
        
        $userAdmin = new User();
        $userAdmin->setUsername('Admin');
        $userAdmin->setPassword($this->encodePassword($userAdmin, 'senha12@'));
        $userAdmin->setEmail('admin@admin.local');
        $userAdmin->setActive(true);
        $userAdmin->setRole($roleAdmin);
        $manager->persist($userAdmin);
        
        $roleTypist = $roleRepository->findOneByRole('ROLE_TYPIST');
        
        $userTypist = new User();
        $userTypist->setUsername('Lilian.Ayres');
        $userTypist->setPassword($this->encodePassword($userTypist, 'senha12@'));
        $userTypist->setEmail('lilian.ayres@pgs.com.br');
        $userTypist->setActive(true);
        $userTypist->setRole($roleTypist);
        $manager->persist($userTypist);
        
        $userTypist = new User();
        $userTypist->setUsername('Zilda.Malagutti');
        $userTypist->setPassword($this->encodePassword($userTypist, 'senha12@'));
        $userTypist->setEmail('zilda.makino@pgs.com.br');
        $userTypist->setActive(true);
        $userTypist->setRole($roleTypist);
        $manager->persist($userTypist);
        
        $roleCoordinator = $roleRepository->findOneByRole('ROLE_COORDINATOR');
        
        $userCoordinator = new User();
        $userCoordinator->setUsername('Danielle.Borim');
        $userCoordinator->setPassword($this->encodePassword($userCoordinator, 'senha12@'));
        $userCoordinator->setEmail('danielle.borim@pgs.com.br');
        $userCoordinator->setActive(true);
        $userCoordinator->setRole($roleCoordinator);
        $manager->persist($userCoordinator);
        
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

    public function getOrder()
    {
        return 2;
    }
    
}