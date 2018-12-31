<?php
namespace AppBundle\DataFixtures\ORM;
use AppBundle\Entity\livre;
use AppBundle\Entity\author;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadFixtures implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
//first 
        $livre = new livre();
        $livre->setTitre("harrypotter");
        $livre->setDescriptif("good book");
        $livre->setISBN(93387306);
        $livre->setDateEdition(new \DateTime());
        $manager->persist($livre);
        $manager->flush();
//second
$livre2 = new livre();
$livre2->setTitre("the lord of the rings");
$livre2->setDescriptif("when hell of a book");
$livre2->setISBN(93387306);
$livre2->setDateEdition(new \DateTime());
$manager->persist($livre2);
$manager->flush();
//third
$livre3 = new livre();
$livre3->setTitre("alice in wonder world ");
$livre3->setDescriptif("damnn book");
$livre3->setISBN(93387306);
$livre3->setDateEdition(new \DateTime());
$manager->persist($livre3);
$manager->flush();


$author = new author();
$author->setFullName("amine kacem");
$author->setEmail("amine@devrows.com");
$manager->persist($author);
$manager->flush();
//second
$author2 = new author();
$author2->setFullName("nabil kriden");
$author2->setEmail("contact@devrows.com");
$manager->persist($author2);
$manager->flush();
    }
}
