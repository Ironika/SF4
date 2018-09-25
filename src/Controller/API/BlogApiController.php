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
    	$tag = $this->getDoctrine()->getManager()->getRepository(Tag::class)->find($request->get('tag'));
        $blogs = $this->getDoctrine()->getManager()->getRepository(Blog::class)->findByTag($tag);
        
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

    /**
     * @Rest\Post("/api/blog/add", name="api_blog_add")
     */
    public function postBlogAction(Request $request)
    {
    	if (false === $this->get('security.context')->isGranted('IS_AUTHENTICATED_FULLY')) {
            throw new AccessDeniedException();
        }

        $blog = new Blog();
        $blog->setTitle($request->request->get('title'));
        $blog->setContent($request->request->get('content'));

        if($request->request->get('tag')) {
        	$tag = $this->getDoctrine()->getManager()->getRepository(Tag::class)->find($request->request->get('tag'));
        	$blog->addTag($tag);
        }

        $blogFile = new File($request->request->get('filepath'));
        $blog->setMedia($this->createMedia($blogFile, $request->request->get('title') . '.jpg'));

        $this->getDoctrine()->getManager()->persist($blog);
        $this->getDoctrine()->getManager()->flush();

        $response = array(
        	'status'=> "200",
        	'message' => "Blog Saved !"
        );

        $serializer = $this->get('jms_serializer');
		$response = $serializer->serialize($response, 'json');

        return new Response($response);
    }

    /**
     * @Rest\Put("/api/blog/{slug}", name="api_blog_update")
     */
    public function putBlogAction(Request $request)
    {
        $blog = $this->getDoctrine()->getManager()->getRepository(Blog::class)->findOneBy(array('slug' => $request->get('slug')));
        
        if($request->request->get('title'))
        	$blog->setTitle($request->request->get('title'));
        if($request->request->get('content'))
        	$blog->setContent($request->request->get('content'));

        $this->getDoctrine()->getManager()->persist($blog);
        $this->getDoctrine()->getManager()->flush();

        $response = array(
        	'status'=> "200",
        	'message' => "Blog updated !"
        );

        $serializer = $this->get('jms_serializer');
		$response = $serializer->serialize($response, 'json');

        return new Response($response);
    }

   	/**
     * @Rest\Delete("/api/blog/{slug}", name="api_blog_delete")
     */
    public function deleteBlogAction(Request $request)
    {
        $blog = $this->getDoctrine()->getManager()->getRepository(Blog::class)->findOneBy(array('slug' => $request->get('slug')));

        $this->getDoctrine()->getManager()->remove($blog);
        $this->getDoctrine()->getManager()->flush();

        $response = array(
        	'status'=> "200",
        	'message' => "Blog deleted !"
        );

        $serializer = $this->get('jms_serializer');
		$response = $serializer->serialize($response, 'json');

        return new Response($response);
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
