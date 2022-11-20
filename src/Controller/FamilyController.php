<?php

namespace App\Controller;

use App\Entity\Family;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FamilyController extends AbstractController
{

    #[Route('/family/{id}', name: 'app_show_family')]
    public function show(Family $family): Response
    {
        // ParamConverter requires `sensio/framework-extra-bundle` dependency to be installed to function properly
        return $this->render('family/index.html.twig', [
            'family' => $family,
        ]);
    }
}
