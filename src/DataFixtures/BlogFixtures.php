<?php

namespace App\DataFixtures;

use App\Entity\Blog;
use Symfony\Component\HttpFoundation\File\File;
use App\Application\Sonata\MediaBundle\Entity\Media;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class BlogFixtures extends Fixture implements DependentFixtureInterface, ContainerAwareInterface
{
    private $container;
 
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    public function load(ObjectManager $manager)
    {
        $blog1 = new Blog();
        $blog1->setTitle('Blog1');
        $blog1->addTag($this->getReference('tag1'));
        $blog1->addTag($this->getReference('tag2'));
        $blog1->setContent(
            'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam ultrices neque at leo dictum blandit. Aenean vel odio sem. Curabitur lectus felis, pulvinar accumsan facilisis in, auctor vel est. Nunc bibendum lacus at lectus vulputate tempus. In gravida, lorem non sodales commodo, tortor velit varius sapien, eget consequat justo metus a massa. Duis et velit accumsan, porttitor elit ut, sollicitudin magna. Mauris varius, orci eget hendrerit dignissim, mauris arcu blandit tortor, at suscipit metus arcu quis dui'
        );
        $blog1File = new File(__DIR__ . '/../../public/images/blog-01.jpg');
        $blog1->setMedia($this->createMedia($blog1File, 'blog1.jpg'));

        $blog2 = new Blog();
        $blog2->setTitle('Blog2');
        $blog2->addTag($this->getReference('tag2'));
        $blog2->setContent(
            'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam ultrices neque at leo dictum blandit. Aenean vel odio sem. Curabitur lectus felis, pulvinar accumsan facilisis in, auctor vel est. Nunc bibendum lacus at lectus vulputate tempus. In gravida, lorem non sodales commodo, tortor velit varius sapien, eget consequat justo metus a massa. Duis et velit accumsan, porttitor elit ut, sollicitudin magna. Mauris varius, orci eget hendrerit dignissim, mauris arcu blandit tortor, at suscipit metus arcu quis dui'
        );
        $blog2File = new File(__DIR__ . '/../../public/images/blog-02.jpg');
        $blog2->setMedia($this->createMedia($blog2File, 'blog2.jpg'));

        $blog3 = new Blog();
        $blog3->setTitle("Blog3");
        $blog3->addTag($this->getReference('tag3'));
        $blog3->setContent(
            'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam ultrices neque at leo dictum blandit. Aenean vel odio sem. Curabitur lectus felis, pulvinar accumsan facilisis in, auctor vel est. Nunc bibendum lacus at lectus vulputate tempus. In gravida, lorem non sodales commodo, tortor velit varius sapien, eget consequat justo metus a massa. Duis et velit accumsan, porttitor elit ut, sollicitudin magna. Mauris varius, orci eget hendrerit dignissim, mauris arcu blandit tortor, at suscipit metus arcu quis dui'
        );
        $blog3File = new File(__DIR__ . '/../../public/images/blog-03.jpg');
        $blog3->setMedia($this->createMedia($blog3File, 'blog3.jpg'));


        $manager->persist($blog1);
        $manager->persist($blog2);
        $manager->persist($blog3);

        $manager->flush();

        // other fixtures can get this object using the UserFixtures::ADMIN_USER_REFERENCE constant
        $this->addReference('blog1', $blog1);
        $this->addReference('blog2', $blog2);
        $this->addReference('blog3', $blog3);
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
            TagFixtures::class,
        );
    }
}