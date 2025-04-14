<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MyControllerJson
{
    #[Route("/api")]
    public function jsonNumber(): Response
    {
        $number = random_int(0, 100);

        $data = [
            '/api' => 'This page',
            '/api/quote' => 'Libraries for quotes and pictures',
        ];

        // return new JsonResponse($data);

        $response = new JsonResponse($data);
        $response->setEncodingOptions(
            $response->getEncodingOptions() | JSON_PRETTY_PRINT
        );
        return $response;
    }

    #[Route('/api/quote')]
    public function quote(): Response
    {
        $quote = random_int(0, 4);
        $quoteslist = ['Håll ut kosack, en dag blir du hövding', 'Själv är bäste dräng', 'Rötterna blir starka när det blåser', 'Ingen rök utan eld', 'Tala är silver, tiga är guld'];
        $artlist = ['bwrepair', 'bwtakeoff', 'bwstruggle', 'bwtailgun', 'bwbrainscan'];
        $selected = $quoteslist[$quote];
        $picture = $artlist[$quote];
        $data = [
            'quote' => $selected,
            'library' => $quoteslist,
            'picture' => $picture,
            'gallery' => $artlist,
            'timestamp' => date('c'),
        ];

        return new JsonResponse($data);
    }
}
