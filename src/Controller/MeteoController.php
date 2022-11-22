<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class MeteoController extends AbstractController
{

    private HttpClientInterface $httpClient;

    /**
     * @param HttpClientInterface $httpClient
     */
    public function __construct(HttpClientInterface $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    #[Route('/meteo', name: 'app_meteo')]
    public function index(): Response
    {

        $response = $this->httpClient->request(
            'GET',
            'https://restcountries.com/v3.1/subregion/europe?fields=name,population,capital,flags'
        );

        return $this->render('meteo/index.html.twig', [
            'controller_name' => 'MeteoController',
        ]);
    }
}
