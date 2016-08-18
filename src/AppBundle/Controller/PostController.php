<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Categoria;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use AppBundle\Entity\Post;
use AppBundle\Form\PostType;

/**
 * Post controller.
 *
 * @Route("/post")
 */
class PostController extends Controller
{
    /**
     * Lists all Post entities.
     *
     * @Route("/", name="post_index")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $posts = $em->getRepository('AppBundle:Post')->findAll();
        $categorias = $em->getRepository('AppBundle:Categoria')->findAll();

        return array(
            'posts' => $posts, 'categorias' => $categorias,
        );
    }

    /**
     * Lists all Post from category.
     *
     * @Route("/category/{id}", name="category_search")
     * @Method("GET")
     * @Template()
     */
    public function indexCategoriaAction(Categoria $categoria)
    {
        $em = $this->getDoctrine()->getManager();

        $posts = $em->getRepository('AppBundle:Post')->findByCategoria($categoria);
        $categorias = $em->getRepository('AppBundle:Categoria')->findAll();

        return array(
            'posts' => $posts,  'categorias' => $categorias,
        );
    }



    /**
     * Finds and displays a Post entity.
     *
     * @Route("/{id}", name="post_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction(Post $post)
    {
        return array(
            'post' => $post,
        );
    }
}
