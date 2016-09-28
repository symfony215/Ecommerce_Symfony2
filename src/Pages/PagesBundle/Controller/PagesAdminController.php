<?php

namespace Pages\PagesBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Pages\PagesBundle\Entity\Pages;
use Pages\PagesBundle\Form\PagesType;

/**
 * Pages controller.
 *
 */
class PagesAdminController extends Controller
{
    /**
     * Lists all Pages entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $pages = $em->getRepository('PagesBundle:Pages')->findAll();

        return $this->render('PagesBundle:Default:Administration/pages/index.html.twig', array(
            'pages' => $pages,
        ));
    }

    /**
     * Creates a new Pages entity.
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function newAction(Request $request)
    {
        $page = new Pages();
        $form = $this->createForm('Pages\PagesBundle\Form\PagesType', $page);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($page);
            $em->flush();

            return $this->redirectToRoute('adminPages_show', array('id' => $page->getId()));
        }

        return $this->render('PagesBundle:Default:Administration/pages/new.html.twig', array(
            'page' => $page,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Pages entity.
     * @param Pages $page
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function showAction(Pages $page)
    {
        $deleteForm = $this->createDeleteForm($page);

        return $this->render('PagesBundle:Default:Administration/pages/show.html.twig', array(
            'page' => $page,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Pages entity.
     * @param Request $request
     * @param Pages $page
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function editAction(Request $request, Pages $page)
    {
        $deleteForm = $this->createDeleteForm($page);
        $editForm = $this->createForm('Pages\PagesBundle\Form\PagesType', $page);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($page);
            $em->flush();

            return $this->redirectToRoute('adminPages_show', array('id' => $page->getId()));
        }

        return $this->render('PagesBundle:Default:Administration/pages/edit.html.twig', array(
            'page' => $page,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Pages entity.
     *
     */
    public function deleteAction(Request $request, Pages $page)
    {
        $form = $this->createDeleteForm($page);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($page);
            $em->flush();
        }

        return $this->redirectToRoute('adminPages_index');
    }

    /**
     * Creates a form to delete a Pages entity.
     *
     * @param Pages $page The Pages entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Pages $page)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('adminPages_delete', array('id' => $page->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
