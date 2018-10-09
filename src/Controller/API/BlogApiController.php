<?php

namespace App\Controller\API;

use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations as Rest;

use App\Entity\Blog;
use App\Entity\Tag;
use Symfony\Component\HttpFoundation\File\File;
use App\Application\Sonata\MediaBundle\Entity\Media;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;


class BlogApiController extends FOSRestController
{
	/**
     * @Rest\Get("/api/blogs", name="api_blog_list")
     */
    public function getBlogsAction(Request $request)
    {
        $blogs = $this->getDoctrine()->getManager()->getRepository(Blog::class)->findAll();
        
        $serializer = $this->get('jms_serializer');
		$blogsJson = $serializer->serialize($blogs, 'json');

        return new Response($blogsJson);
    }

    /**
     * @Rest\Get("/api/blogs/{tag}", name="api_blog_list_tag")
     */
    public function getBlogsTagAction(Request $request)
    {
    	$tag = $this->getDoctrine()->getManager()->getRepository(Tag::class)->findOneBy(array('slug' =>$request->get('tag')));
        $blogs = $this->getDoctrine()->getManager()->getRepository(Blog::class)->findByTag($tag->getSlug());
        
        $serializer = $this->get('jms_serializer');
		$blogsJson = $serializer->serialize($blogs, 'json');

        return new Response($blogsJson);
    }

    /**
     * @Rest\Get("/api/blog/{slug}", name="api_blog")
     */
    public function getBlogAction(Request $request)
    {
        $blog = $this->getDoctrine()->getManager()->getRepository(Blog::class)->findOneBy(array('slug' => $request->get('slug')));

        $serializer = $this->get('jms_serializer');
		$blogJson = $serializer->serialize($blog, 'json');

        return new Response($blogJson);
    }
}
