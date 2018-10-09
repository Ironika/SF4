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
 * @ORM\Entity(repositoryClass="App\Repository\ProductRepository")
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
     * @ORM\Column(type="string")
     */
    private $slug;

    /**
     * @ORM\ManyToOne(targetEntity="CategoryProduct")
     * @ORM\JoinColumn(nullable=false)
     */
    private $category;

    /**
     * @ORM\ManyToOne(targetEntity="Collection")
     * @ORM\JoinColumn(nullable=false)
     */
    private $collection;

    /**
     * @ORM\OneToOne(targetEntity="App\Application\Sonata\MediaBundle\Entity\Gallery", cascade={"persist", "remove"})
    */
    private $gallery;

    /**
     * @ORM\ManyToMany(targetEntity="Size")
     * @ORM\JoinColumn(nullable=true)
     * @ORM\JoinTable(name="product_sizes")
     */
    private $sizes;

    /**
     * @ORM\ManyToMany(targetEntity="Material")
     * @ORM\JoinColumn(nullable=true)
     * @ORM\JoinTable(name="product_materials")
     */
    private $materials;

    /**
     * @ORM\ManyToMany(targetEntity="Shape")
     * @ORM\JoinColumn(nullable=true)
     * @ORM\JoinTable(name="product_shapes")
     */
    private $shapes;

    /**
     * @ORM\Column(type="float")
     */
    private $price;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\Column(name="created_at", type="datetime")
     */
    private $createdAt;

    private $medias = array();

    public function __construct() {
        $this->sizes = new ArrayCollection();
        $this->shapes = new ArrayCollection();
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
        $this->slug = strtolower( preg_replace( array( '/[^-a-zA-Z0-9\s]/', '/[\s]/' ), array( '', '-' ), $name ) );
        return $this;
    }

    public function getSlug() {
        return $this->slug;
    }

    public function getCategory() {
        return $this->category;
    }

    public function setCategory(CategoryProduct $category) {
        $this->category = $category;
        return $this;
    }

    public function getShapes() {
        return $this->shapes;
    }

    public function setShapes(Shape $shapes) {
        $this->shapes = $shapes;
        return $this;
    }

    public function addShape(Shape $shape) {
        if(!$this->shapes->contains($shape)) {
            $this->shapes[] = $shape;
        }
        return $this;
    }

    public function removeShape(Shape $shape) {
        if($this->shapes->contains($shape)) {
            $this->shapes->removeElement($shape);
        }
        return $this;
    }

    public function getCollection() {
        return $this->collection;
    }

    public function setCollection(Collection $collection) {
        $this->collection = $collection;
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

    public function getMedias()
    {
        return $this->medias;
    }

    public function setMedias($medias)
    {
        $this->medias = $medias;
    }

    public function addMedia($media) 
    {
    	$this->medias[] = $media;
    }
}
