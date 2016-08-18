<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\Autor;
use AppBundle\Form\AutorType;

/**
 * Autor controller.
 *
 * @Route("/admin/autor")
 */
class AdminAutorController extends Controller
{
    /**
     * Lists all Autor entities.
     *
     * @Route("/", name="admin_autor_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $autors = $em->getRepository('AppBundle:Autor')->findAll();

        return $this->render('autor/index.html.twig', array(
            'autors' => $autors,
        ));
    }

    /**
     * Creates a new Autor entity.
     *
     * @Route("/new", name="admin_autor_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $autor = new Autor();
        $form = $this->createForm('AppBundle\Form\AutorType', $autor);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($autor);
            $em->flush();

            return $this->redirectToRoute('admin_autor_show', array('id' => $autor->getId()));
        }

        return $this->render('autor/new.html.twig', array(
            'autor' => $autor,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Autor entity.
     *
     * @Route("/{id}", name="admin_autor_show")
     * @Method("GET")
     */
    public function showAction(Autor $autor)
    {
        $deleteForm = $this->createDeleteForm($autor);

        return $this->render('autor/show.html.twig', array(
            'autor' => $autor,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Autor entity.
     *
     * @Route("/{id}/edit", name="admin_autor_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Autor $autor)
    {
        $deleteForm = $this->createDeleteForm($autor);
        $editForm = $this->createForm('AppBundle\Form\AutorType', $autor);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($autor);
            $em->flush();

            return $this->redirectToRoute('admin_autor_edit', array('id' => $autor->getId()));
        }

        return $this->render('autor/edit.html.twig', array(
            'autor' => $autor,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Autor entity.
     *
     * @Route("/{id}", name="admin_autor_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Autor $autor)
    {
        $form = $this->createDeleteForm($autor);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($autor);
            $em->flush();
        }

        return $this->redirectToRoute('admin_autor_index');
    }

    /**
     * Creates a form to delete a Autor entity.
     *
     * @param Autor $autor The Autor entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Autor $autor)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_autor_delete', array('id' => $autor->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
