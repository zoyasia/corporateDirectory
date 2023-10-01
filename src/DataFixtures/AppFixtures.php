<?php


namespace App\DataFixtures;


use App\Entity\ContractType;
use App\Entity\Department;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;


class AppFixtures extends Fixture
{
    private const CONTRACT_TYPES = [6,7,8];


    private const DEPARTMENTS = [5,6,7,8];
    private const NB_EMPLOYEES = 50;
    private const NB_ADMIN = 2;

    public function __construct(private UserPasswordHasherInterface $hasher)
  {
  }
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');


        $contractTypes = [];
   
        foreach (self::CONTRACT_TYPES as $contractTypeName) {
          $contractType = new ContractType();
          $contractType->setName($contractTypeName);
          $manager->persist($contractType);
          $contractTypes[] = $contractType;
        }

        $departments = [];
        foreach (self::DEPARTMENTS as $departmentName) {
            $department = new Department();
            $department->setName($departmentName);
            $manager->persist($department);
            $departments[] = $department;
        }        


        for ($i = 0; $i < self::NB_EMPLOYEES; $i++) {
            $regularUser = new User();
            $regularUser
            ->setFirstname($faker->firstName())
            ->setName($faker->lastName())
            ->setPicture($faker->imageUrl())
            ->setEmail($faker->email())
            ->setPassword($this->hasher->hashPassword($regularUser, 'test'))
            ->setRoles(['ROLE_USER'])
            ->setContractType($contractTypes[$faker->randomElement(self::CONTRACT_TYPES)])
            ->setDepartment($departments[$faker->randomElement(self::DEPARTMENTS)]);




            $manager->persist($regularUser);
        }


        $manager->flush();
    }
}
