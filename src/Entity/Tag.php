<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Blog;

/**
 * @ORM\Entity
 * @ORM\Table(name="tag")
 */
class Tag {

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
     * 
     * @ORM\ManyToMany(targetEntity="Blog", mappedBy="tags")
     */
    private $blogs;


    public function __construct() { 
        $this->blogs = new ArrayCollection();
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

    public function getBlogs() {
        return $this->blogs;
    }

    public function setBlogs($blogs) {
        $this->blogs = $blogs;
        return $this;
    }

    public function addBlog(Blog $blog) {
        if(!$this->blogs->contains($blog)) {
            $this->blogs[] = $blog;
        }
        return $this;
    }

    public function removeBlog(Blog $blog) {
        if($this->blogs->contains($blog)) {
            $this->blogs->removeElement($blog);
        }
        return $this;
    }
}