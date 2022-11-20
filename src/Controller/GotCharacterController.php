<?php

namespace App\Controller;

use App\Entity\GotCharacter;
use App\Form\GotCharacterType;
use App\Repository\GotCharacterRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GotCharacterController extends AbstractController
{

    #[Route('/gotcharacters', name: 'app_gotcharacters')]
    public function index(GotCharacterRepository $gotCharacterRepository): Response {
        return $this->render('got_character/index.html.twig', [
            'characters' => $gotCharacterRepository->findAll(),
        ]);
    }

    #[Route('/gotcharacters/new', name: 'app_gotcharacters_new')]
    public function new(Request $request, GotCharacterRepository $gotCharacterRepository): Response
    {

        // we create an empty entity instance to hydrate later
        $character = new GotCharacter();
        // we create the form based on our form type class and we pass it the entity to hydrate
        $form = $this->createForm(GotCharacterType::class, $character);
        // we tell Symfony that this form should process the user input
        $form->handleRequest($request);

        // handling submitted and valid form
        if ($form->isSubmitted() && $form->isValid()) {
            $gotCharacterRepository->save($character, true);
            return $this->redirectToRoute('app_gotcharacters');
        }

        return $this->renderForm('got_character/new.html.twig', [
            'character' => $character,
            'form' => $form
        ]);
    }
}
