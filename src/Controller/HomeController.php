<?php

namespace App\Controller;

use App\Repository\PublicationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Serializer\SerializerInterface;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(PublicationRepository $publicationRepository,SerializerInterface $serializer): Response
    {
        $publications = $publicationRepository->findAll();
        $publicationsJson = $serializer->normalize($publications, null, ['groups' => 'publication.read']);

        return $this->render('home/index.html.twig', [
            'publications' => $publicationsJson
        ]);
    }
}
