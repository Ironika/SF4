<?php

namespace App\Controller\API;

use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\File\File;
use App\Application\Sonata\MediaBundle\Entity\Media;

use App\Entity\Blog;

class BlogApiController extends FOSRestController
{
	/**
     * @Rest\Get("/api/blogs")
     */
    public function getBlogsAction(Request $request)
    {
        $blogs = $this->getDoctrine()->getManager()->getRepository(Blog::class)->findAll();
        
        $serializer = $this->get('jms_serializer');
		$blogsJson = $serializer->serialize($blogs, 'json');

        return new Response($blogsJson);
    }

    /**
     * @Rest\Get("/api/blog/{slug}")
     */
    public function getBlogAction(Request $request)
    {
        $blog = $this->getDoctrine()->getManager()->getRepository(Blog::class)->findOneBy(array('slug' => $request->get('slug')));

        $serializer = $this->get('jms_serializer');
		$blogJson = $serializer->serialize($blog, 'json');

        return new Response($blogJson);
    }

    /**
     * @Rest\Post("/api/blog/add")
     */
    public function postBlogAction(Request $request)
    {
        $blog = new Blog();
        $blog->setTitle($request->request->get('title'));
        $blog->setContent($request->request->get('content'));

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
     * @Rest\Put("/api/blog/{slug}")
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
     * @Rest\Delete("/api/blog/{slug}")
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
