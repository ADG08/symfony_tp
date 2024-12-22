<?php

namespace App\Controller;

use App\Repository\PublicationRepository;
use App\Repository\TagRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Serializer\SerializerInterface;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(PublicationRepository $publicationRepository,TagRepository $tagRepository ,SerializerInterface $serializer): Response
    {
        $publications = $publicationRepository->findAll();
        $publicationsJson = $serializer->normalize($publications, null, ['groups' => 'publication.read']);

        $tags = $tagRepository->findAll();
        $tagsJson = $serializer->normalize($tags, null, ['groups' => 'tag.read']);

        return $this->render('home/index.html.twig', [
            'publications' => $publicationsJson,
            'tags' => $tagsJson
        ]);
    }
}
