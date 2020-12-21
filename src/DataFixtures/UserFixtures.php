<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
     {
         $this->passwordEncoder = $passwordEncoder;
     }
    public function load(ObjectManager $manager)
    {
        $contributor = new User();
        $contributor->setEmail('contributor@contributor.com');
        $contributor->setRoles(['ROLE_CONTRIBUTOR']);
        $contributor->setPassword($this->passwordEncoder->encodePassword(
            $contributor,
            'password'
        ));
        $manager->persist($contributor);
        $this->addReference('contributor', $contributor);

        $admin = new User();
        $admin->setEmail('admin@admin.com');
        $admin->setRoles(['ROLE_ADMIN']);
        $admin->setPassword($this->passwordEncoder->encodePassword(
            $admin,
            'password'
        ));
        $manager->persist($admin);
        $this->addReference('admin', $admin);

        $user = new User();
        $user->setEmail('user@user.com');
        $user->setPassword($this->passwordEncoder->encodePassword(
            $user,
            'password'
        ));
        $manager->persist($user);

        $manager->flush();
    }
}
