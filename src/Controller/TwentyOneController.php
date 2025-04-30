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

    #[Route("/game/twentyone", name: "twentyone")]
    public function twentyOne()
    {   
        $rules = "<p>Spelets idé är att med två eller flera kort försöka uppnå det sammanlagda värdet 21, eller komma så nära som möjligt utan att överskrida 21.</p>
            <ul>
                <li>Essen är värda valfritt 1 eller 14, kungarna 13, damerna 12, knektarna 11.</li>
                <li>Nummerkorten har samma värden som valören.</li>
                <li>En av deltagarna utses till bankir.</li>
                <li>Bankiren i tjugoett spelar mot en spelare i taget. Eftersom oddsen väger över till bankens fördel, är det brukligt att deltagarna turas om med att vara bankir.</li>
            </ul>
            <ul>
                <li>Två, eller tre, ess utan andra kort får räknas som 21</li>
                <li>En spelare som fått fem kort utan att spricka anses ha uppnått 21</li>
            </ul>";
        $imgPath = "";
        $textArticle = "I have a textarticle to use...";

        $data = [
            "article" => $textArticle,
            "imgPath" => $imgPath,
            "rules" => $rules,
            "game" => $game
        ];

        $deck = null;
        $game = null;

        $deck = new DeckOfCards('Trad52');
        $card = $deck->dealCard();
        $game = new TwentyOne($deck, 2, 'nightmare');

        return $this->render('cardgame/cardgame.html.twig', $data);
    }
}
