<?php

namespace AppBundle\Club\Controller;

use AppBundle\Entity\Club;
use AppBundle\Entity\Player;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Club controller.
 *
 * @Route("club")
 */
class ClubController extends Controller
{
    /**
     * Lists all club entities.
     *
     * @Route("/", name="club_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $clubs = $em->getRepository('AppBundle:Club')->findByDeleted(false);

        return $this->render('club/index.html.twig', array(
            'clubs' => $clubs,
        ));
    }

    /**
     * Creates a new club entity.
     *
     * @Route("/nuevo", name="club_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $club = new Club();
        $form = $this->createForm('AppBundle\Club\Form\ClubType', $club);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->get('club.manager')->create($club);

            return $this->redirectToRoute('club_show', array('id' => $club->getId()));
        }

        return $this->render('club/new.html.twig', array(
            'club' => $club,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a club entity.
     *
     * @Route("/{id}", name="club_show")
     * @Method("GET")
     */
    public function showAction(Club $club)
    {
        $deleteForm = $this->createDeleteForm($club);

        return $this->render('club/show.html.twig', array(
            'club' => $club,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing club entity.
     *
     * @Route("/{id}/editar", name="club_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Club $club)
    {
        $originalPlayers = new ArrayCollection();

        foreach ($club->getPlayers() as $player) {
            $originalPlayers->add($player);
        }

        $deleteForm = $this->createDeleteForm($club);
        $editForm = $this->createForm('AppBundle\Club\Form\ClubType', $club);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->get('club.manager')->edit($club, $originalPlayers);

            return $this->redirectToRoute('club_edit', array('id' => $club->getId()));
        }

        return $this->render('club/edit.html.twig', array(
            'club' => $club,
            'form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a club entity.
     *
     * @Route("/{id}", name="club_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Club $club)
    {
        $form = $this->createDeleteForm($club);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->get('club.manager')->remove($club);
        }

        return $this->redirectToRoute('club_index');
    }

    /**
     * Creates a form to delete a club entity.
     *
     * @param Club $club The club entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Club $club)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('club_delete', array('id' => $club->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
