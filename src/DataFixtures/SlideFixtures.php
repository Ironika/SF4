<?php

namespace App\DataFixtures;

use App\Entity\Slide;
use Symfony\Component\HttpFoundation\File\File;
use App\Application\Sonata\MediaBundle\Entity\Media;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class SlideFixtures extends Fixture implements DependentFixtureInterface, ContainerAwareInterface
{
    private $container;
 
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    public function load(ObjectManager $manager)
    {
        $slide1 = new Slide();
        $slide1->setTitle('Slide1');
        $slide1->setProduct($this->getReference('product1'));
        $slide1File = new File(__DIR__ . '/../../public/images/slide-01.jpg');
        $slide1->setMedia($this->createMedia($slide1File, 'slide1.jpg'));

        $slide2 = new Slide();
        $slide2->setTitle('Slide2');
        $slide2->setProduct($this->getReference('product2'));
        $slide2File = new File(__DIR__ . '/../../public/images/slide-02.jpg');
        $slide2->setMedia($this->createMedia($slide2File, 'slide2.jpg'));

        $slide3 = new Slide();
        $slide3->setTitle('Slide3');
        $slide3->setProduct($this->getReference('product3'));
        $slide3File = new File(__DIR__ . '/../../public/images/slide-03.jpg');
        $slide3->setMedia($this->createMedia($slide3File, 'slide3.jpg'));


        $manager->persist($slide1);
        $manager->persist($slide2);
        $manager->persist($slide3);

        $manager->flush();

        // other fixtures can get this object using the UserFixtures::ADMIN_USER_REFERENCE constant
        $this->addReference('slide1', $slide1);
        $this->addReference('slide2', $slide2);
        $this->addReference('slide3', $slide3);
    }
    public function createMedia($file, $filename)
    {
        $mediaManager = $this->container->get('sonata.media.manager.media');

        $media = $mediaManager->create();
        $media->setEnabled(true);
        $media->setBinaryContent($file);
        $media->setName($filename);
        $media->setContext('default');
        $media->setProviderName('sonata.media.provider.image');
        $media->setProviderStatus(1);

        $mediaManager->save($media);

        return $media;
    }

    public function getDependencies()
    {
        return array(
            ProductFixtures::class,
        );
    }
}