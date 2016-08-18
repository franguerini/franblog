<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use AppBundle\Entity\Categoria;
use AppBundle\Form\CategoriaType;

/**
 * Category controller.
 *
 * @Route("/categoria")
 */
class CategoriaController extends Controller
{
    /**
     * Lists all Post entities.
     *
     * @Route("/", name="categoria_index")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $categorias = $em->getRepository('AppBundle:Post')->findAll();

        return array(
            'categorias' => $categorias,
        );
    }



    /**
     * Finds and displays a Post entity.
     *
     * @Route("/categoria/{category}", name="categoria_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction(Categoria $categoria)
    {
        return $this->render('post/show.html.twig', array(
            'post' => $categoria,
        ));
    }
}