<?php

namespace AppBundle\Controller\Party;

use AppBundle\Entity\Party;
use AppBundle\Form\Type\Party\Edition\EditPartyType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class EditionController extends Controller
{
    public function editPartyAction(Request $request, Party $party)
    {
        $form = $this->createForm(EditPartyType::class, $party);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($party);
            $em->flush();

            return $this->redirectToRoute('app_party_listing_list_party');
        }

        return $this->render('@Page/Party/Edition/edit_party.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}