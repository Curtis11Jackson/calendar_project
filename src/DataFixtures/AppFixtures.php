<?php

namespace App\DataFixtures;

use App\Entity\Client;
use App\Entity\SalesRep;
use App\Entity\Timetable;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\User;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Faker\Factory;

class AppFixtures extends Fixture
{

    private UserPasswordHasherInterface $hasher;

    public function __construct(UserPasswordHasherInterface $hasher)
    {
        $this->hasher = $hasher;
    }

    public function load(ObjectManager $manager): void
    {

        $generator = Factory::create("fr_FR");

        $user[1] = new User();
        $user[1]->setEmail('francois.pignon@dinner.con');
        $user[1]->setPassword($this->hasher->hashPassword($user[1], '5465rge'));
        $user[1]->setRoles(['ROLE_SALESREP']);
        $manager->persist($user[1]);

        $user[2] = new User();
        $user[2]->setEmail('juste.leblanc@dinner.con');
        $user[2]->setPassword($this->hasher->hashPassword($user[2], 'nyt5498e'));
        $user[2]->setRoles(['ROLE_SALESREP']);
        $manager->persist($user[2]);

        $user[3] = new User();
        $user[3]->setEmail('marlene.sassoeur@dinner.con');
        $user[3]->setPassword($this->hasher->hashPassword($user[3], 'jytr4986'));
        $user[3]->setRoles(['ROLE_SALESREP']);
        $manager->persist($user[3]);


        $salesRep[1] = new SalesRep();
        $salesRep[1]->setEmail('francois.pignon@dinner.con');
        $salesRep[1]->setFirstName('François');
        $salesRep[1]->setLastName('Pignon');
        $salesRep[1]->setPhone(1234567890);
        $salesRep[1]->setFkUser($user[1]);
        $manager->persist($salesRep[1]);

        $salesRep[2] = new SalesRep();
        $salesRep[2]->setEmail('juste.leblanc@dinner.con');
        $salesRep[2]->setFirstName('Juste');
        $salesRep[2]->setLastName('Leblanc');
        $salesRep[2]->setPhone(987654312);
        $salesRep[2]->setFkUser($user[2]);
        $manager->persist($salesRep[2]);

        $salesRep[3] = new SalesRep();
        $salesRep[3]->setEmail('marlene.sassoeur@dinner.con');
        $salesRep[3]->setFirstName('Marlene');
        $salesRep[3]->setLastName('Sasoeur');
        $salesRep[3]->setPhone(346789654);
        $salesRep[3]->setFkUser($user[3]);
        $manager->persist($salesRep[3]);

        $user[5] = new User();
        $user[5]->setEmail('arnaud@lemoine.fr');
        $user[5]->setPassword($this->hasher->hashPassword($user[5], 'f65jedbrtd'));
        $user[5]->setRoles(['ROLE_USER']);
        $manager->persist($user[5]);

        $client[1] = new Client();
        $client[1]->setFirstName('Arnaud');
        $client[1]->setLastName('Lemoine');
        $client[1]->setEmail('arnaud@lemoine.fr');
        $client[1]->setCreatedAt(new \DateTimeImmutable());
        $client[1]->setFkUser($user[5]);

        $manager->persist($client[1]);

        $manager->flush();

    }
}
