<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class PaysController extends AbstractController
{

    private HttpClientInterface $httpClient;

    /**
     * @param HttpClientInterface $httpClient
     */
    public function __construct(HttpClientInterface $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    #[Route('/pays', name: 'app_pays')]
    public function index(): Response
    {
        // Lancer une requête vers l'api RestCountries
        $response = $this->httpClient->request(
            'GET',
            'https://restcountries.com/v3.1/subregion/europe?fields=name,population,capital,flags'
        );
        // Traiter la réponse
        $contenu = $response->toArray();

        return $this->render('pays/index.html.twig', [
            'data' => $contenu,
        ]);
    }

    #[Route('/pays/{name}', name: 'app_pays_detail')]
    public function getPays($name): Response
    {
        // Lancer une requête vers l'api RestCountries
        $response = $this->httpClient->request(
            'GET',
            'https://restcountries.com/v3.1/name/'.$name.'?fields=name,region,population,capital,currencies,languages,flags'
        );

        // Traiter la réponse
        $contenu = $response->toArray();

        return $this->render('pays/detail.html.twig', [
            'data' => $contenu,
        ]);
    }
}
