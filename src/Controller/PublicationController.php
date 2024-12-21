<?php

namespace App\Controller;

use App\Entity\Publication;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Serializer\SerializerInterface;

class PublicationController extends AbstractController
{
    #[Route('/publication/{id}', name: 'app_publication')]
    public function index(Publication $publication ,SerializerInterface $serializer): Response
    {
        $publicationsJson = $serializer->normalize($publication, null, ['groups' => ['publication.read', 'publication.details']]);

        return $this->render('publication/details.html.twig', [
            'publication' => $publicationsJson
        ]);
    }
}
