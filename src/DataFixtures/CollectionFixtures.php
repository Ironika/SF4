<?php

namespace App\DataFixtures;

use App\Entity\Collection;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\File\File;
use App\Application\Sonata\MediaBundle\Entity\Media;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class CollectionFixtures extends Fixture implements ContainerAwareInterface
{
	private $container;
 
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    public function load(ObjectManager $manager)
    {
        $collection1 = new Collection();
        $collection1->setName('Collection1');
        $collection1->setCatchPhrase('Spring 2018');
        $collection1File = new File(__DIR__ . '/../../public/images/banner-01.jpg');
        $collection1->setMedia($this->createMedia($collection1File, 'collection1.jpg'));

        $collection2 = new Collection();
        $collection2->setName('Collection2');
        $collection2->setCatchPhrase('Summer 2018');
        $collection2File = new File(__DIR__ . '/../../public/images/banner-02.jpg');
        $collection2->setMedia($this->createMedia($collection2File, 'collection2.jpg'));

        $collection3 = new Collection();
        $collection3->setName("Collection3");
        $collection3->setCatchPhrase('Winter 2018');
        $collection3File = new File(__DIR__ . '/../../public/images/banner-03.jpg');
        $collection3->setMedia($this->createMedia($collection3File, 'collection3.jpg'));

        $manager->persist($collection1);
        $manager->persist($collection2);
        $manager->persist($collection3);

        $manager->flush();

        // other fixtures can get this object using the UserFixtures::ADMIN_USER_REFERENCE constant
        $this->addReference('collection1', $collection1);
        $this->addReference('collection2', $collection2);
        $this->addReference('collection3', $collection3);
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
}