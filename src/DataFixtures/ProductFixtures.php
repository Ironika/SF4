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
        $product1->setPrice('35.00');
        $product1->setDescription("La bague \"Eclipse\" est composée d'un corps de bague en laiton plaqué argent, de rayons de soleil en acier et d'un croissant de lune en plexiglass noir mat. Il n'y a pas de tailles car la bague peut être ajusté de manière invisible.");
        $product1->setCategory($this->getReference('category6'));
        $product1->setCollection($this->getReference('collection1'));
        $product1->addMaterial($this->getReference('material1'));
        $product1->addMaterial($this->getReference('material2'));
        
        $gallery1 = $this->createGallery('eclipse');

        $media1File = new File(__DIR__ . '/../../public/images/eclipse1.jpg');
        $media1 = $this->createMedia($media1File, 'eclipse1.jpg');
        $galleryHasMedia1 = $this->createGalleryHasMedia($media1);

        $media2File = new File(__DIR__ . '/../../public/images/eclipse2.jpg');
        $media2 = $this->createMedia($media2File, 'eclipse2.jpg');
        $galleryHasMedia2 = $this->createGalleryHasMedia($media2);

        $media3File = new File(__DIR__ . '/../../public/images/eclipse3.jpg');
        $media3 = $this->createMedia($media3File, 'eclipse3.jpg');
        $galleryHasMedia3 = $this->createGalleryHasMedia($media3);
        
        $gallery1->addGalleryHasMedia($galleryHasMedia1);
        $gallery1->addGalleryHasMedia($galleryHasMedia2);
        $gallery1->addGalleryHasMedia($galleryHasMedia3);

        $product1->setGallery($gallery1);

        // -------------  PRODUCT 2

        $product2 = new Product();
        $product2->setName('Cresecent Nebula');
        $product2->setPrice('40.00');
        $product2->setDescription("Le collier \"Nebula\" est fabriqué en plexiglass avec un lien en faux suede (faux cuir Vegan). Ce lien est garanti de qualité japonaise. La pierre au centre est une Labradorite de 1cm de diamètre. Il n'y a pas de fermoir sur ce model afin que vous puissiez ajuster le collier à votre convenance. Il peut se porter long comme un sautoir ou court comme un ras-du-cou.");
        $product2->setCategory($this->getReference('category2'));
        $product2->setCollection($this->getReference('collection1'));

        $gallery2 = $this->createGallery('cresecent nebula');

        $media4File = new File(__DIR__ . '/../../public/images/cresecent-nebula.jpg');
        $media4 = $this->createMedia($media4File, 'cresecent-nebula.jpg');
        $galleryHasMedia4 = $this->createGalleryHasMedia($media4);
        
        $gallery2->addGalleryHasMedia($galleryHasMedia4);

        $product2->setGallery($gallery2);

        // -------------  PRODUCT 3

        $product3 = new Product();
        $product3->setName('Trinity');
        $product3->setPrice('30.00');
        $product3->setDescription("\"Trinity\" est un collier fabriqué en plexiglass pourvue d'une fine chaîne. Toutes les chaînes sont plaquées ruthénium. Le collier est réglable et se termine par une gourmette \"INELUCTABLE\".");
        $product3->setCategory($this->getReference('category5'));
        $product3->setCollection($this->getReference('collection1'));
        $product3->addColor($this->getReference('color1'));
        $product3->addColor($this->getReference('color2'));

        $gallery3 = $this->createGallery('trinity');

        $media7File = new File(__DIR__ . '/../../public/images/trinity1.jpg');
        $media7 = $this->createMedia($media7File, 'trinity1.jpg');
        $galleryHasMedia7 = $this->createGalleryHasMedia($media7);

        $media8File = new File(__DIR__ . '/../../public/images/trinity2.jpg');
        $media8 = $this->createMedia($media8File, 'trinity2.jpg');
        $galleryHasMedia8 = $this->createGalleryHasMedia($media8);
        
        $gallery3->addGalleryHasMedia($galleryHasMedia7);
        $gallery3->addGalleryHasMedia($galleryHasMedia8);

        $product3->setGallery($gallery3);

        // -------------  PRODUCT 4

        $product4 = new Product();
        $product4->setName('Moon Phase');
        $product4->setPrice('65.00');
        $product4->setDescription("Le ras-de-cou \"Moon Phase\" est en plexiglass, ruban en velours noir de qualité japonaise. Toutes les pierres que j'utilise sont NATURELLES. Leurs couleurs et motifs peuvent donc varier d'un model à l'autre. Toutes les chaînes sont plaquées ruthénium. Le collier est réglable et se termine par une gourmette \"INELUCTABLE\".");
        $product4->setCategory($this->getReference('category5'));
        $product4->setCollection($this->getReference('collection1'));
        $product4->addMaterial($this->getReference('material1'));
        $product4->addMaterial($this->getReference('material2'));

        $gallery4 = $this->createGallery('moon phase');

        $media10File = new File(__DIR__ . '/../../public/images/moon-phase1.jpg');
        $media10 = $this->createMedia($media10File, 'moon-phase1.jpg');
        $galleryHasMedia10 = $this->createGalleryHasMedia($media10);

        $media11File = new File(__DIR__ . '/../../public/images/moon-phase2.jpg');
        $media11 = $this->createMedia($media11File, 'moon-phase2.jpg');
        $galleryHasMedia11 = $this->createGalleryHasMedia($media11);

        $media12File = new File(__DIR__ . '/../../public/images/moon-phase3.jpg');
        $media12 = $this->createMedia($media12File, 'moon-phase3.jpg');
        $galleryHasMedia12 = $this->createGalleryHasMedia($media12);
        
        $gallery4->addGalleryHasMedia($galleryHasMedia10);
        $gallery4->addGalleryHasMedia($galleryHasMedia11);
        $gallery4->addGalleryHasMedia($galleryHasMedia12);

        $product4->setGallery($gallery4);

        // -------------  PRODUCT 5

        $product5 = new Product();
        $product5->setName('Crescent Moon');
        $product5->setPrice('35.00');
        $product5->setDescription("Les ras-de-cou \"Crescent Moon\" sont disponibles en plusieurs formes et couleurs de pierres. Toutes les pierres que j'utilise sont NATURELLES. Leurs couleurs et motifs peuvent donc varier d'un modèle à l'autre. Toutes les chaînes sont plaquées ruthénium. Le collier est réglable et se termine par une gourmette \"INELUCTABLE\".");
        $product5->setCategory($this->getReference('category5'));
        $product5->setCollection($this->getReference('collection1'));
        $product5->addShape($this->getReference('shape1'));
        $product5->addShape($this->getReference('shape2'));
        $product5->addShape($this->getReference('shape3'));
        $product5->addMaterial($this->getReference('material1'));
        $product5->addMaterial($this->getReference('material2'));

        $gallery5 = $this->createGallery('crescent-moon');

        $media13File = new File(__DIR__ . '/../../public/images/crescent-moon1.jpg');
        $media13 = $this->createMedia($media13File, 'crescent-moon1.jpg');
        $galleryHasMedia13 = $this->createGalleryHasMedia($media13);

        $media14File = new File(__DIR__ . '/../../public/images/crescent-moon2.jpg');
        $media14 = $this->createMedia($media14File, 'crescent-moon2.jpg');
        $galleryHasMedia14 = $this->createGalleryHasMedia($media14);

        $media15File = new File(__DIR__ . '/../../public/images/crescent-moon3.jpg');
        $media15 = $this->createMedia($media15File, 'crescent-moon3.jpg');
        $galleryHasMedia15 = $this->createGalleryHasMedia($media15);
        
        $gallery5->addGalleryHasMedia($galleryHasMedia13);
        $gallery5->addGalleryHasMedia($galleryHasMedia14);
        $gallery5->addGalleryHasMedia($galleryHasMedia15);

        $product5->setGallery($gallery5);

        // -------------  PRODUCT 6

        $product6 = new Product();
        $product6->setName('Pulsar');
        $product6->setPrice('90.00');
        $product6->setDescription("La broche \"Pulsar\" se décline en trois versions. Toutes les pierres que j'utilise sont NATURELLES. Leurs couleurs et motifs peuvent donc varier d'un modèle à l'autre.");
        $product6->setCategory($this->getReference('category4'));
        $product6->setCollection($this->getReference('collection1'));
        $product6->addMaterial($this->getReference('material1'));
        $product6->addMaterial($this->getReference('material2'));
        $product6->addMaterial($this->getReference('material5'));

        $gallery6 = $this->createGallery('pulsar');

        $media16File = new File(__DIR__ . '/../../public/images/pulsar1.jpg');
        $media16 = $this->createMedia($media16File, 'pulsar1.jpg');
        $galleryHasMedia16 = $this->createGalleryHasMedia($media16);

        $media17File = new File(__DIR__ . '/../../public/images/pulsar2.jpg');
        $media17 = $this->createMedia($media17File, 'pulsar2.jpg');
        $galleryHasMedia17 = $this->createGalleryHasMedia($media17);

        $media18File = new File(__DIR__ . '/../../public/images/pulsar3.jpg');
        $media18 = $this->createMedia($media18File, 'pulsar3.jpg');
        $galleryHasMedia18 = $this->createGalleryHasMedia($media18);
        
        $gallery6->addGalleryHasMedia($galleryHasMedia16);
        $gallery6->addGalleryHasMedia($galleryHasMedia17);
        $gallery6->addGalleryHasMedia($galleryHasMedia18);

        $product6->setGallery($gallery6);

        // -------------  PRODUCT 7

        $product7 = new Product();
        $product7->setName('Moon');
        $product7->setPrice('15.00');
        $product7->setDescription("Les broches \"Moon & Moone Crater\" sont disponibles en deux tailles. Toutes les broches sont fermées par un loquet de sécurité.");
        $product7->setCategory($this->getReference('category4'));
        $product7->setCollection($this->getReference('collection1'));
        $product7->addSize($this->getReference('size1'));
        $product7->addSize($this->getReference('size2'));
        $product7->addColor($this->getReference('color3'));
        $product7->addColor($this->getReference('color4'));

        $gallery7 = $this->createGallery('moon');

        $media19File = new File(__DIR__ . '/../../public/images/moon1.jpg');
        $media19 = $this->createMedia($media19File, 'moon1.jpg');
        $galleryHasMedia19 = $this->createGalleryHasMedia($media19);

        $media20File = new File(__DIR__ . '/../../public/images/moon2.jpg');
        $media20 = $this->createMedia($media20File, 'moon2.jpg');
        $galleryHasMedia20 = $this->createGalleryHasMedia($media20);

        $media21File = new File(__DIR__ . '/../../public/images/moon3.jpg');
        $media21 = $this->createMedia($media21File, 'moon3.jpg');
        $galleryHasMedia21 = $this->createGalleryHasMedia($media21);
        
        $gallery7->addGalleryHasMedia($galleryHasMedia19);
        $gallery7->addGalleryHasMedia($galleryHasMedia20);
        $gallery7->addGalleryHasMedia($galleryHasMedia21);

        $product7->setGallery($gallery7);

        // -------------  PRODUCT 8

        $product8 = new Product();
        $product8->setName('Crescent Earrings');
        $product8->setPrice('15.00');
        $product8->setDescription("Les boucles d'oreilles \"Crescent\" en plexiglass peuvent être commandées en trois variations. Toutes les pierres que j'utilise sont NATURELLES. Leur couleur et motif peuvent donc varier d'un model à l'autre.");
        $product8->setCategory($this->getReference('category3'));
        $product8->setCollection($this->getReference('collection1'));
        $product8->addMaterial($this->getReference('material1'));
        $product8->addMaterial($this->getReference('material2'));
        $product8->addMaterial($this->getReference('material4'));

        $gallery8 = $this->createGallery('crescent-earrings');

        $media22File = new File(__DIR__ . '/../../public/images/crescent-earrings1.jpg');
        $media22 = $this->createMedia($media22File, 'crescent-earrings1.jpg');
        $galleryHasMedia22 = $this->createGalleryHasMedia($media22);

        $media23File = new File(__DIR__ . '/../../public/images/crescent-earrings2.jpg');
        $media23 = $this->createMedia($media23File, 'crescent-earrings2.jpg');
        $galleryHasMedia23 = $this->createGalleryHasMedia($media23);

        $media24File = new File(__DIR__ . '/../../public/images/crescent-earrings3.jpg');
        $media24 = $this->createMedia($media24File, 'crescent-earrings3.jpg');
        $galleryHasMedia24 = $this->createGalleryHasMedia($media24);
        
        $gallery8->addGalleryHasMedia($galleryHasMedia22);
        $gallery8->addGalleryHasMedia($galleryHasMedia23);
        $gallery8->addGalleryHasMedia($galleryHasMedia24);

        $product8->setGallery($gallery8);

                // -------------  PRODUCT 9

        $product9 = new Product();
        $product9->setName('Moon Tears');
        $product9->setPrice('30.00');
        $product9->setDescription("\"Moon Tears\" est disponible en deux couleurs. Toutes les pierres que j'utilise sont NATURELLES. Leur couleur et motif peuvent donc varier d'un model à l'autre.");
        $product9->setCategory($this->getReference('category3'));
        $product9->setCollection($this->getReference('collection1'));
        $product9->addMaterial($this->getReference('material1'));
        $product9->addMaterial($this->getReference('material2'));

        $gallery9 = $this->createGallery('moon-tears');

        $media25File = new File(__DIR__ . '/../../public/images/moon-tears1.jpg');
        $media25 = $this->createMedia($media25File, 'moon-tears1.jpg');
        $galleryHasMedia25 = $this->createGalleryHasMedia($media25);

        $media26File = new File(__DIR__ . '/../../public/images/moon-tears2.jpg');
        $media26 = $this->createMedia($media26File, 'moon-tears2.jpg');
        $galleryHasMedia26 = $this->createGalleryHasMedia($media26);

        $media27File = new File(__DIR__ . '/../../public/images/moon-tears3.jpg');
        $media27 = $this->createMedia($media27File, 'moon-tears3.jpg');
        $galleryHasMedia27 = $this->createGalleryHasMedia($media27);
        
        $gallery9->addGalleryHasMedia($galleryHasMedia25);
        $gallery9->addGalleryHasMedia($galleryHasMedia26);
        $gallery9->addGalleryHasMedia($galleryHasMedia27);

        $product9->setGallery($gallery9);

                // -------------  PRODUCT 10

        $product10 = new Product();
        $product10->setName('Night Sky');
        $product10->setPrice('55.00');
        $product10->setDescription("\"Night Sky\" est une manchette en laiton plaqué argent. Cette manchette peut être ajustée d'une simple pression ou élargie en fonction de votre morphologie. ");
        $product10->setCategory($this->getReference('category1'));
        $product10->setCollection($this->getReference('collection1'));

        $gallery10 = $this->createGallery('night-sky');

        $media28File = new File(__DIR__ . '/../../public/images/night-sky1.jpg');
        $media28 = $this->createMedia($media28File, 'night-sky1.jpg');
        $galleryHasMedia28 = $this->createGalleryHasMedia($media28);
        
        $gallery10->addGalleryHasMedia($galleryHasMedia28);

        $product10->setGallery($gallery10);

                // -------------  PRODUCT 11

        $product11 = new Product();
        $product11->setName('Crescent Moon Bracelet');
        $product11->setPrice('35.00');
        $product11->setDescription("Les bracelets \"Crescent Moon\" sont disponibles en 3 finitions. Toutes les pierres que j'utilise sont NATURELLES. Leurs couleurs et motifs peuvent donc varier d'un model à l'autre.");
        $product11->setCategory($this->getReference('category1'));
        $product11->setCollection($this->getReference('collection1'));
        $product11->addMaterial($this->getReference('material1'));
        $product11->addMaterial($this->getReference('material2'));
        $product11->addMaterial($this->getReference('material3'));
        $product11->addShape($this->getReference('shape1'));
        $product11->addShape($this->getReference('shape2'));

        $gallery11 = $this->createGallery('crescent-moon-bracelet');

        $media29File = new File(__DIR__ . '/../../public/images/crescent-moon-bracelet1.jpg');
        $media29 = $this->createMedia($media29File, 'crescent-moon-bracelet1.jpg');
        $galleryHasMedia29 = $this->createGalleryHasMedia($media29);

        $media30File = new File(__DIR__ . '/../../public/images/crescent-moon-bracelet2.jpg');
        $media30 = $this->createMedia($media30File, 'crescent-moon-bracelet2.jpg');
        $galleryHasMedia30 = $this->createGalleryHasMedia($media30);

        $media31File = new File(__DIR__ . '/../../public/images/crescent-moon-bracelet3.jpg');
        $media31 = $this->createMedia($media31File, 'crescent-moon-bracelet3.jpg');
        $galleryHasMedia31 = $this->createGalleryHasMedia($media31);
        
        $gallery11->addGalleryHasMedia($galleryHasMedia29);
        $gallery11->addGalleryHasMedia($galleryHasMedia30);
        $gallery11->addGalleryHasMedia($galleryHasMedia31);

        $product11->setGallery($gallery11);
        
        $manager->persist($product1);
        $manager->persist($product2);
        $manager->persist($product3);
        $manager->persist($product4);
        $manager->persist($product5);
        $manager->persist($product6);
        $manager->persist($product7);
        $manager->persist($product8);
        $manager->persist($product9);
        $manager->persist($product10);
        $manager->persist($product11);

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
        $this->addReference('product9', $product9);
        $this->addReference('product10', $product10);
        $this->addReference('product11', $product11);
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
            ColorFixtures::class
        );
    }
}