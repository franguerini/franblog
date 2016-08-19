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

        $filteredPost = array();
        $filter = $request->get('category');
        $filterAuthor = $request->get('autores');

        $em = $this->getDoctrine()->getManager();


        $posts = $em->getRepository('AppBundle:Post')->findAll();
        $categorias = $em->getRepository('AppBundle:Categoria')->findAll();
        $autores = $em->getRepository('AppBundle:Autor')->findAll();

        var_dump($filter);

        var_dump($filterAuthor);


        foreach ($posts as $post){
            if($filter != null && $filterAuthor != null) {

                if (in_array($post->getCategoria()->getId(), $filter)  && in_array($post->getAutor()->getId(), $filterAuthor)){
                    array_push($filteredPost, $post);
                }
            }
            else {
                $filteredPost = $posts;
            }
        }

        return $this->render('default/index.html.twig', [
            'posts' => $filteredPost, 'categorias' => $categorias, 'autores' => $autores, 'filtroCategorias' => $filter, 'filtroAutor' => $filterAuthor
        ]);

    }


}
