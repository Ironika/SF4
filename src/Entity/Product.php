<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use App\Entity\CategoryProduct;
use App\Entity\Collection;
use App\Entity\Size;

/**
 * @ORM\Entity
 * @ORM\Table(name="product")
 */
class Product {


    // afin que ça entre en BDD
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
     * @ORM\ManyToOne(targetEntity="CategoryProduct", inversedBy="products")
     * @ORM\JoinColumn(nullable=false)
     */
    private $category;

    /**
     * @ORM\ManyToOne(targetEntity="Collection", inversedBy="products")
     * @ORM\JoinColumn(nullable=false)
     */
    private $collection;

    /**
     * @ORM\OneToOne(targetEntity="App\Application\Sonata\MediaBundle\Entity\Gallery", mappedBy="product",cascade={"persist"})
     * @ORM\JoinColumn(name="gallery", referencedColumnName="id",nullable=true)
    */
    private $gallery;

    /**
     * @ORM\ManyToMany(targetEntity="Size", inversedBy="products")
     * @ORM\JoinColumn(nullable=true)
     * @ORM\JoinTable(name="product_sizes")
     */
    private $sizes;

    /**
     * @ORM\Column(type="float")
     */
    private $price;

    /**
     * @ORM\Column(type="string")
     */
    private $description;

    public function __construct() {
        $this->sizes = new ArrayCollection();
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

    public function getCategory() {
        return $this->category;
    }

    public function setCategory(CategoryProduct $category) {
        $this->category = $category;
        $category->addProduct($this);
        return $this;
    }

    public function getCollection() {
        return $this->collection;
    }

    public function setCollection(Collection $collection) {
        $this->collection = $collection;
        $collection->addProduct($this);
        return $this;
    }

    public function getSizes() {
        return $this->sizes;
    }

    public function setSizes(ArrayCollection $sizes) {
        $this->sizes = $sizes;
        return $this;
    }

    public function addSize(Size $size) {
        if(!$this->sizes->contains($size)) {
            $this->sizes[] = $size;
        }
        return $this;
    }

    public function removeSize(Size $size) {
        if($this->sizes->contains($size)) {
            $this->sizes->removeElement($size);
        }
        return $this;
    }

    public function getPrice() {
        return $this->price;
    }

    public function setPrice($price) {
        $this->price = $price;
        return $this;
    }

    public function getDescription() {
        return $this->description;
    }

    public function setDescription($description) {
        $this->description = $description;
        return $this;
    }

    public function getGallery() {
        return $this->gallery;
    }

    public function setGallery($gallery) {
        $this->gallery = $gallery;
        return $this;
    }
}
