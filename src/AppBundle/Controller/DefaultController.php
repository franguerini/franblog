<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        var_dump($request->get('category'));
        $filter = $request->get('category');

        $em = $this->getDoctrine()->getManager();

        $posts = $em->getRepository('AppBundle:Post')->findAll();
        $categorias = $em->getRepository('AppBundle:Categoria')->findAll();
        $autores = $em->getRepository('AppBundle:Autor')->findAll();

        $filteredPost = array();

        foreach ($posts as $post){
            if (in_array($post->getCategoria(), $filter)){
                array_push($filteredPost, $post);
            }
        }

        return $this->render('default/index.html.twig', [
            'posts' => $filteredPost, 'categorias' => $categorias, 'autores' => $autores,
        ]);
    }


}
