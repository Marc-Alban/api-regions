<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class ApiController extends AbstractController
{

    /**
     * @param SerializerInterface $serializer
     * @return Response
     * @Route("/listeRegions", name="listeRegions")
     */
    public function listeRegions(SerializerInterface $serializer): Response
    {
        $mesRegions = file_get_contents("https://geo.api.gouv.fr/regions");
//        $mesRegionsTab = $serializer->decode($mesRegions, 'json') ;
//        $mesRegionsObj = $serializer->denormalize($mesRegionsTab, 'App\Entity\Regions[]');
        $mesRegionsObj = $serializer->deserialize($mesRegions, 'App\Entity\Regions[]','json');
        return $this->render('api/index.html.twig', ['mesRegions'=>$mesRegionsObj]);
    }
}
