<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Product;

/**
 * @ORM\Entity
 * @ORM\Table(name="category_product")
 */
class CategoryProduct {

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     */
    private $name;

    /**
     * @ORM\OneToOne(targetEntity="App\Application\Sonata\MediaBundle\Entity\Media")
     */
    private $media;

    // connexion one to many entre category et product
    /**
     * @ORM\OneToMany(targetEntity="Product", mappedBy="category", orphanRemoval=true, cascade={"persist", "remove"})
     */
    private $products;


    public function __construct() { // dès qu'on créé une catégorie, un tableau se créé
        $this->products = new ArrayCollection(); // tableau special de doctrine, collection, pas vraiment tableau
    }

    public function __toString() {
        $string = '';
        if($this->name)
            $string = $this->name;

        return $string;
    }

    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
        return $this;
    }

    public function getMedia() {
        return $this->media;
    }

    public function setMedia($media) {
        $this->media = $media;
        return $this;
    }

    public function getProducts() {
        return $this->products;
    }

    public function setProducts($products) {
        $this->products = $products;
        return $this;
    }

    public function addProduct(Product $product) { // on type $product, comme ça renvoie erreur si ce n'est pas un product (class)
        if(!$this->products->contains($product)) {
            $this->products[] = $product; // quand il y a des crochets puis un =, cela veut dire qu on ajoute
        }
        return $this;
    }

    public function removeProduct(Product $product) {
        if($this->products->contains($product)) {
            $this->products->removeElement($product);
        }
        return $this;
    }
}