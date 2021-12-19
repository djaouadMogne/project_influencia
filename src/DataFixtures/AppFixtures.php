<?php

namespace App\DataFixtures;

use App\Entity\Article;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
   const DEFAULT_USER=['email'=>'djaouad@djaouad.open','password'=>'password'];
    private UserPasswordHasherInterface $encoder;
    public function __construct(UserPasswordHasherInterface $encoder)
    {
        $this->encoder=$encoder;
    }
    public function load(ObjectManager $manager): void
    {

        

        $fake= Factory::create();

        $defaultUser=new User();
        $passHash=$this->encoder->hashPassword($defaultUser ,self::DEFAULT_USER['password']);
        $defaultUser->setEmail (self::DEFAULT_USER['email']);
        $defaultUser ->setPassword($passHash);
        $defaultUser->setTheusername($fake->name);

        for($u = 0;$u<10;$u++)
        {
            $user=new User();
        $passHash=$this->encoder->hashPassword($user ,plainPassword: 'password');
        $user->setEmail ($fake->email);
        $user->setPassword($passHash);
        $user->setTheusername($fake->name);

        $manager->persist($user);
        for ($a=0;$a<random_int(5,20);$a++)
        {
            $article= (new Article())->setAuthor($user);
            $article->setContent($fake->text(maxNbChars:350));
            $article->setName($fake->text(maxNbChars:30));
            
            if($u % 3===0)
            {
                $user->setStatus(false);
                     
            }
            
            $manager->persist($article);
        }
        }
        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();
        

    }
}
