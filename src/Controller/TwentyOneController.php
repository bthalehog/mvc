<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Cards\Card;
use App\Cards\CardHand;
use App\Cards\DeckOfCards;

class TwentyOneController extends AbstractController
{
    #[Route("/game/doc", name: "doc")]
    public function getDoc()
    {   
        $textArticle = "";
        $imgPath = "kmom03flowchart.svg";

        $data = [
            "article" => $textArticle,
            "imgPath" => $imgPath,
        ];

        return $this->render('cardgame/documentation.html.twig', $data);
    }
}
