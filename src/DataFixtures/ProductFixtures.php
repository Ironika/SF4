<?php

namespace App\DataFixtures;

use App\Entity\Product;
use Symfony\Component\HttpFoundation\File\File;
use App\Application\Sonata\MediaBundle\Entity\Media;
use App\Application\Sonata\MediaBundle\Entity\GalleryHasMedia;
use App\Application\Sonata\MediaBundle\Entity\Gallery;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class ProductFixtures extends Fixture implements DependentFixtureInterface, ContainerAwareInterface
{
    private $container;
 
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    public function load(ObjectManager $manager)
    {
        $product1 = new Product();
        $product1->setName('Eclipse');
        $product1->setPrice('49.99');
        $product1->setDescription("Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam ultrices neque at leo dictum blandit. Aenean vel odio sem. Curabitur lectus felis, pulvinar accumsan facilisis in, auctor vel est. Nunc bibendum lacus at lectus vulputate tempus. In gravida, lorem non sodales commodo, tortor velit varius sapien, eget consequat justo metus a massa. Duis et velit accumsan, porttitor elit ut, sollicitudin magna. Mauris varius, orci eget hendrerit dignissim, mauris arcu blandit tortor, at suscipit metus arcu quis dui");
        $product1->setCategory($this->getReference('category1'));
        $product1->setCollection($this->getReference('collection1'));
        $product1->addSize($this->getReference('size1'));
        $product1->addShape($this->getReference('shape1'));
        $product1->addMaterial($this->getReference('material1'));
        
        $gallery1 = $this->createGallery('eclipse');

        $media1File = new File(__DIR__ . '/../../public/images/product-01.jpg');
        $media1 = $this->createMedia($media1File, 'product1-1.jpg');
        $galleryHasMedia1 = $this->createGalleryHasMedia($media1);

        $media2File = new File(__DIR__ . '/../../public/images/product-02.jpg');
        $media2 = $this->createMedia($media2File, 'product1-2.jpg');
        $galleryHasMedia2 = $this->createGalleryHasMedia($media2);

        $media3File = new File(__DIR__ . '/../../public/images/product-03.jpg');
        $media3 = $this->createMedia($media3File, 'product1-3.jpg');
        $galleryHasMedia3 = $this->createGalleryHasMedia($media3);
        
        $gallery1->addGalleryHasMedia($galleryHasMedia1);
        $gallery1->addGalleryHasMedia($galleryHasMedia2);
        $gallery1->addGalleryHasMedia($galleryHasMedia3);

        $product1->setGallery($gallery1);

        // -------------  PRODUCT 2

        $product2 = new Product();
        $product2->setName('Crescent');
        $product2->setPrice('59.99');
        $product2->setDescription("Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam ultrices neque at leo dictum blandit. Aenean vel odio sem. Curabitur lectus felis, pulvinar accumsan facilisis in, auctor vel est. Nunc bibendum lacus at lectus vulputate tempus. In gravida, lorem non sodales commodo, tortor velit varius sapien, eget consequat justo metus a massa. Duis et velit accumsan, porttitor elit ut, sollicitudin magna. Mauris varius, orci eget hendrerit dignissim, mauris arcu blandit tortor, at suscipit metus arcu quis dui");
        $product2->setCategory($this->getReference('category2'));
        $product2->setCollection($this->getReference('collection1'));
        $product2->addSize($this->getReference('size2'));
        $product2->addShape($this->getReference('shape2'));
        $product2->addMaterial($this->getReference('material2'));

        $gallery2 = $this->createGallery('crescent');

        $media4File = new File(__DIR__ . '/../../public/images/product-04.jpg');
        $media4 = $this->createMedia($media4File, 'product2-1.jpg');
        $galleryHasMedia4 = $this->createGalleryHasMedia($media4);

        $media5File = new File(__DIR__ . '/../../public/images/product-05.jpg');
        $media5 = $this->createMedia($media5File, 'product2-2.jpg');
        $galleryHasMedia5 = $this->createGalleryHasMedia($media5);

        $media6File = new File(__DIR__ . '/../../public/images/product-06.jpg');
        $media6 = $this->createMedia($media6File, 'product2-3.jpg');
        $galleryHasMedia6 = $this->createGalleryHasMedia($media6);
        
        $gallery2->addGalleryHasMedia($galleryHasMedia4);
        $gallery2->addGalleryHasMedia($galleryHasMedia5);
        $gallery2->addGalleryHasMedia($galleryHasMedia6);

        $product2->setGallery($gallery2);

        // -------------  PRODUCT 3

        $product3 = new Product();
        $product3->setName('Trinity');
        $product3->setPrice('69.99');
        $product3->setDescription("Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam ultrices neque at leo dictum blandit. Aenean vel odio sem. Curabitur lectus felis, pulvinar accumsan facilisis in, auctor vel est. Nunc bibendum lacus at lectus vulputate tempus. In gravida, lorem non sodales commodo, tortor velit varius sapien, eget consequat justo metus a massa. Duis et velit accumsan, porttitor elit ut, sollicitudin magna. Mauris varius, orci eget hendrerit dignissim, mauris arcu blandit tortor, at suscipit metus arcu quis dui");
        $product3->setCategory($this->getReference('category3'));
        $product3->setCollection($this->getReference('collection1'));
        $product3->addSize($this->getReference('size3'));
        $product3->addShape($this->getReference('shape3'));
        $product3->addMaterial($this->getReference('material3'));

        $gallery3 = $this->createGallery('trinity');

        $media7File = new File(__DIR__ . '/../../public/images/product-07.jpg');
        $media7 = $this->createMedia($media7File, 'product3-1.jpg');
        $galleryHasMedia7 = $this->createGalleryHasMedia($media7);

        $media8File = new File(__DIR__ . '/../../public/images/product-08.jpg');
        $media8 = $this->createMedia($media8File, 'product3-2.jpg');
        $galleryHasMedia8 = $this->createGalleryHasMedia($media8);

        $media9File = new File(__DIR__ . '/../../public/images/product-09.jpg');
        $media9 = $this->createMedia($media9File, 'product3-3.jpg');
        $galleryHasMedia9 = $this->createGalleryHasMedia($media9);
        
        $gallery3->addGalleryHasMedia($galleryHasMedia7);
        $gallery3->addGalleryHasMedia($galleryHasMedia8);
        $gallery3->addGalleryHasMedia($galleryHasMedia9);

        $product3->setGallery($gallery3);

        // -------------  PRODUCT 4

        $product4 = new Product();
        $product4->setName('Pulsar');
        $product4->setPrice('79.99');
        $product4->setDescription("Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam ultrices neque at leo dictum blandit. Aenean vel odio sem. Curabitur lectus felis, pulvinar accumsan facilisis in, auctor vel est. Nunc bibendum lacus at lectus vulputate tempus. In gravida, lorem non sodales commodo, tortor velit varius sapien, eget consequat justo metus a massa. Duis et velit accumsan, porttitor elit ut, sollicitudin magna. Mauris varius, orci eget hendrerit dignissim, mauris arcu blandit tortor, at suscipit metus arcu quis dui");
        $product4->setCategory($this->getReference('category1'));
        $product4->setCollection($this->getReference('collection2'));
        $product4->addSize($this->getReference('size2'));
        $product4->addShape($this->getReference('shape1'));
        $product4->addMaterial($this->getReference('material1'));

        $gallery4 = $this->createGallery('pulsar');

        $media10File = new File(__DIR__ . '/../../public/images/product-10.jpg');
        $media10 = $this->createMedia($media10File, 'product4-1.jpg');
        $galleryHasMedia10 = $this->createGalleryHasMedia($media10);

        $media11File = new File(__DIR__ . '/../../public/images/product-11.jpg');
        $media11 = $this->createMedia($media11File, 'product4-2.jpg');
        $galleryHasMedia11 = $this->createGalleryHasMedia($media11);

        $media12File = new File(__DIR__ . '/../../public/images/product-12.jpg');
        $media12 = $this->createMedia($media12File, 'product4-3.jpg');
        $galleryHasMedia12 = $this->createGalleryHasMedia($media12);
        
        $gallery4->addGalleryHasMedia($galleryHasMedia10);
        $gallery4->addGalleryHasMedia($galleryHasMedia11);
        $gallery4->addGalleryHasMedia($galleryHasMedia12);

        $product4->setGallery($gallery4);

        // -------------  PRODUCT 5

        $product5 = new Product();
        $product5->setName('Moon');
        $product5->setPrice('89.99');
        $product5->setDescription("Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam ultrices neque at leo dictum blandit. Aenean vel odio sem. Curabitur lectus felis, pulvinar accumsan facilisis in, auctor vel est. Nunc bibendum lacus at lectus vulputate tempus. In gravida, lorem non sodales commodo, tortor velit varius sapien, eget consequat justo metus a massa. Duis et velit accumsan, porttitor elit ut, sollicitudin magna. Mauris varius, orci eget hendrerit dignissim, mauris arcu blandit tortor, at suscipit metus arcu quis dui");
        $product5->setCategory($this->getReference('category2'));
        $product5->setCollection($this->getReference('collection1'));
        $product5->addSize($this->getReference('size1'));
        $product5->addShape($this->getReference('shape2'));
        $product5->addMaterial($this->getReference('material3'));

        $gallery5 = $this->createGallery('moon');

        $media13File = new File(__DIR__ . '/../../public/images/product-13.jpg');
        $media13 = $this->createMedia($media13File, 'product5-1.jpg');
        $galleryHasMedia13 = $this->createGalleryHasMedia($media13);

        $media14File = new File(__DIR__ . '/../../public/images/product-14.jpg');
        $media14 = $this->createMedia($media14File, 'product5-2.jpg');
        $galleryHasMedia14 = $this->createGalleryHasMedia($media14);

        $media15File = new File(__DIR__ . '/../../public/images/product-15.jpg');
        $media15 = $this->createMedia($media15File, 'product5-3.jpg');
        $galleryHasMedia15 = $this->createGalleryHasMedia($media15);
        
        $gallery5->addGalleryHasMedia($galleryHasMedia13);
        $gallery5->addGalleryHasMedia($galleryHasMedia14);
        $gallery5->addGalleryHasMedia($galleryHasMedia15);

        $product5->setGallery($gallery5);

        // -------------  PRODUCT 6

        $product6 = new Product();
        $product6->setName('Luna');
        $product6->setPrice('39.99');
        $product6->setDescription("Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam ultrices neque at leo dictum blandit. Aenean vel odio sem. Curabitur lectus felis, pulvinar accumsan facilisis in, auctor vel est. Nunc bibendum lacus at lectus vulputate tempus. In gravida, lorem non sodales commodo, tortor velit varius sapien, eget consequat justo metus a massa. Duis et velit accumsan, porttitor elit ut, sollicitudin magna. Mauris varius, orci eget hendrerit dignissim, mauris arcu blandit tortor, at suscipit metus arcu quis dui");
        $product6->setCategory($this->getReference('category1'));
        $product6->setCollection($this->getReference('collection2'));
        $product6->addSize($this->getReference('size1'));
        $product6->addShape($this->getReference('shape1'));
        $product6->addMaterial($this->getReference('material3'));

        $gallery6 = $this->createGallery('luna');

        $media16File = new File(__DIR__ . '/../../public/images/product-16.jpg');
        $media16 = $this->createMedia($media16File, 'product6-1.jpg');
        $galleryHasMedia16 = $this->createGalleryHasMedia($media16);

        $media17File = new File(__DIR__ . '/../../public/images/product-15.jpg');
        $media17 = $this->createMedia($media17File, 'product6-2.jpg');
        $galleryHasMedia17 = $this->createGalleryHasMedia($media17);

        $media18File = new File(__DIR__ . '/../../public/images/product-14.jpg');
        $media18 = $this->createMedia($media18File, 'product6-3.jpg');
        $galleryHasMedia18 = $this->createGalleryHasMedia($media18);
        
        $gallery6->addGalleryHasMedia($galleryHasMedia16);
        $gallery6->addGalleryHasMedia($galleryHasMedia17);
        $gallery6->addGalleryHasMedia($galleryHasMedia18);

        $product6->setGallery($gallery6);

        // -------------  PRODUCT 7

        $product7 = new Product();
        $product7->setName('Curse');
        $product7->setPrice('79.99');
        $product7->setDescription("Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam ultrices neque at leo dictum blandit. Aenean vel odio sem. Curabitur lectus felis, pulvinar accumsan facilisis in, auctor vel est. Nunc bibendum lacus at lectus vulputate tempus. In gravida, lorem non sodales commodo, tortor velit varius sapien, eget consequat justo metus a massa. Duis et velit accumsan, porttitor elit ut, sollicitudin magna. Mauris varius, orci eget hendrerit dignissim, mauris arcu blandit tortor, at suscipit metus arcu quis dui");
        $product7->setCategory($this->getReference('category3'));
        $product7->setCollection($this->getReference('collection3'));
        $product7->addSize($this->getReference('size2'));
        $product7->addShape($this->getReference('shape2'));
        $product7->addMaterial($this->getReference('material1'));

        $gallery7 = $this->createGallery('curse');

        $media19File = new File(__DIR__ . '/../../public/images/product-13.jpg');
        $media19 = $this->createMedia($media19File, 'product7-1.jpg');
        $galleryHasMedia19 = $this->createGalleryHasMedia($media19);

        $media20File = new File(__DIR__ . '/../../public/images/product-12.jpg');
        $media20 = $this->createMedia($media20File, 'product7-2.jpg');
        $galleryHasMedia20 = $this->createGalleryHasMedia($media20);

        $media21File = new File(__DIR__ . '/../../public/images/product-11.jpg');
        $media21 = $this->createMedia($media21File, 'product7-3.jpg');
        $galleryHasMedia21 = $this->createGalleryHasMedia($media21);
        
        $gallery7->addGalleryHasMedia($galleryHasMedia19);
        $gallery7->addGalleryHasMedia($galleryHasMedia20);
        $gallery7->addGalleryHasMedia($galleryHasMedia21);

        $product7->setGallery($gallery7);

        // -------------  PRODUCT 8

        $product8 = new Product();
        $product8->setName('Night');
        $product8->setPrice('99.99');
        $product8->setDescription("Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam ultrices neque at leo dictum blandit. Aenean vel odio sem. Curabitur lectus felis, pulvinar accumsan facilisis in, auctor vel est. Nunc bibendum lacus at lectus vulputate tempus. In gravida, lorem non sodales commodo, tortor velit varius sapien, eget consequat justo metus a massa. Duis et velit accumsan, porttitor elit ut, sollicitudin magna. Mauris varius, orci eget hendrerit dignissim, mauris arcu blandit tortor, at suscipit metus arcu quis dui");
        $product8->setCategory($this->getReference('category1'));
        $product8->setCollection($this->getReference('collection2'));
        $product8->addSize($this->getReference('size1'));
        $product8->addShape($this->getReference('shape1'));
        $product8->addMaterial($this->getReference('material3'));

        $gallery8 = $this->createGallery('night');

        $media22File = new File(__DIR__ . '/../../public/images/product-10.jpg');
        $media22 = $this->createMedia($media22File, 'product8-1.jpg');
        $galleryHasMedia22 = $this->createGalleryHasMedia($media22);

        $media23File = new File(__DIR__ . '/../../public/images/product-09.jpg');
        $media23 = $this->createMedia($media23File, 'product8-2.jpg');
        $galleryHasMedia23 = $this->createGalleryHasMedia($media23);

        $media24File = new File(__DIR__ . '/../../public/images/product-08.jpg');
        $media24 = $this->createMedia($media24File, 'product8-3.jpg');
        $galleryHasMedia24 = $this->createGalleryHasMedia($media24);
        
        $gallery8->addGalleryHasMedia($galleryHasMedia22);
        $gallery8->addGalleryHasMedia($galleryHasMedia23);
        $gallery8->addGalleryHasMedia($galleryHasMedia24);

        $product8->setGallery($gallery8);
        
        $manager->persist($product1);
        $manager->persist($product2);
        $manager->persist($product3);
        $manager->persist($product4);
        $manager->persist($product5);
        $manager->persist($product6);
        $manager->persist($product7);
        $manager->persist($product8);

        $manager->flush();

        // other fixtures can get this object using the UserFixtures::ADMIN_USER_REFERENCE constant
        $this->addReference('product1', $product1);
        $this->addReference('product2', $product2);
        $this->addReference('product3', $product3);
        $this->addReference('product4', $product4);
        $this->addReference('product5', $product5);
        $this->addReference('product6', $product6);
        $this->addReference('product7', $product7);
        $this->addReference('product8', $product8);
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

    public function createGalleryHasMedia($media){
        $galleryHasMedia = new GalleryHasMedia();
        $galleryHasMedia->setMedia($media);
        $galleryHasMedia->setEnabled(true);

        return $galleryHasMedia;
    }

    protected function createGallery($name) {
        $gallery = new Gallery();
        $gallery->setName($name);
        $gallery->setEnabled(true);
        $gallery->setContext('default');
        $gallery->setDefaultFormat('big');

        return $gallery;
    }

    public function getDependencies()
    {
        return array(
            CategoryFixtures::class,
            CollectionFixtures::class,
            SizeFixtures::class,
            ShapeFixtures::class,
            MaterialFixtures::class,
        );
    }
}