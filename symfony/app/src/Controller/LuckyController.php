<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LuckyController
{
    #[Route("/")]
    public function start(): Response
    {
        return new Response(
            '<html><body>Start</body></html>'
        );
    }

    #[Route('/about')]
    public function about(): Response
    {
        return new Response(
            '<html><body>About</body></html>'
        );
    }

    #[Route('/me')]
    public function me(): Response
    {
        return new Response(
            '<html><body>Me</body></html>'
        );
    }

    #[Route('/report')]
    public function report(): Response
    {
        return new Response(
            '<html><body>Report</body></html>'
        );
    }

    #[Route('/lucky/number')]
    public function number(): Response
    {
        $number = random_int(0, 100);

        return new Response(
            '<html><body>Lucky number: '.$number.'</body></html>'
        );
    }
}
