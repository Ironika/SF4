<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use App\Entity\CategoryProduct;
use App\Entity\Collection;
use App\Entity\Size;
use App\Entity\Shape;
use App\Entity\Material;

/**
 * @ORM\Entity
 * @ORM\Table(name="product")
 */
class Product {

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
     * @ORM\OneToOne(targetEntity="App\Application\Sonata\MediaBundle\Entity\Gallery")
    */
    private $gallery;

    /**
     * @ORM\ManyToMany(targetEntity="Size", inversedBy="products")
     * @ORM\JoinColumn(nullable=true)
     * @ORM\JoinTable(name="product_sizes")
     */
    private $sizes;

    /**
     * @ORM\ManyToMany(targetEntity="Material", inversedBy="products")
     * @ORM\JoinColumn(nullable=true)
     * @ORM\JoinTable(name="product_materials")
     */
    private $materials;

    /**
     * @ORM\ManyToOne(targetEntity="Shape", inversedBy="products")
     * @ORM\JoinColumn(nullable=true)
     */
    private $shape;

    /**
     * @ORM\Column(type="float")
     */
    private $price;

    /**
     * @ORM\Column(type="string")
     */
    private $description;

    /**
     * @ORM\Column(name="created_at", type="datetime")
     */
    private $createdAt;

    public function __construct() {
        $this->sizes = new ArrayCollection();
        $this->materials = new ArrayCollection();
        $this->createdAt = new \Datetime('now');
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

    public function getShape() {
        return $this->shape;
    }

    public function setShape(Shape $shape) {
        $this->shape = $shape;
        $shape->addProduct($this);
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

    public function getMaterials() {
        return $this->materials;
    }

    public function setMaterials(ArrayCollection $materials) {
        $this->materials = $materials;
        return $this;
    }

    public function addMaterial(Material $material) {
        if(!$this->materials->contains($material)) {
            $this->materials[] = $material;
        }
        return $this;
    }

    public function removeMaterial(Material $material) {
        if($this->materials->contains($material)) {
            $this->materials->removeElement($material);
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

    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    }
}
