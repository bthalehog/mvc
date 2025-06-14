<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

use App\Repository\BookRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Doctrine\Persistence\ManagerRegistry;

class MyControllerTwig extends AbstractController
{
    #[Route("/", name: "home")]
    public function home(): Response
    {
        return $this->render('home.html.twig');
    }

    #[Route("/about", name: "about")]
    public function about(): Response
    {
        return $this->render('about.html.twig');
    }

    #[Route("/report", name: "report")]
    public function report(): Response
    {
        return $this->render('report.html.twig');
    }

    #[Route("/report/report-view", name: "report-view")]
    public function viewReport(): Response
    {
        $reportdict = [
            "report1" => "mvc_kmom01_report.txt",
            "report2" => "mvc_kmom02_report.txt",
            "report3" => "mvc_kmom03_report.txt",
            "report4" => "mvc_kmom04_report.txt",
            "report5" => "mvc_kmom05_report.txt"
        ];

        $selector = isset($_GET['reportId']) ? $_GET['reportId'] : null;
        $selected = $reportdict[$selector];
        $repPath = $this->getParameter('kernel.project_dir') . '/public/assets/reports/' . $selected;
        $report = file_get_contents($repPath);

        return $this->render('report-view.html.twig', [
            'report' => $report,
        ]);
    }

    #[Route("/lucky", name: "lucky")]
    public function number(): Response
    {
        $number = random_int(0, 100);
        $selector = random_int(0, 4);
        $artlist = ['bwrepair.png', 'bwtakeoff.png', 'bwstruggle.png', 'bwtailgun.png', 'bwbrainscan.png'];
        $picture = $artlist[$selector];

        $data = [
            'number' => $number,
            'picture' => $picture
        ];

        return $this->render('lucky_number.html.twig', $data);
    }

    // API ROUTES

    #[Route("/api", name: "api")]
    public function apiLanding(): Response
    {
        $data = [
            'welcome' => "Welcome to my API-inventory page. Here you can test functionality that I have built.",
            'headline' => "API-Inventory",
            'card' => "card here",
            'deck' => "deck here",
            'hand' => "cardHand here",
            'sorted' => "sorted here",
            'shuffled' => "shuffled here"
        ];

        return $this->render('api.html.twig', $data);
    }

    #[Route("/api/game", name: "game")]
    public function currentScore(SessionInterface $session): Response
    {
        $game = $session->get('game');
        $playerWallet = 0;
        $bankWallet = 0;

        // Get bank and current player wallet
        $bankWallet = $game->getBank()->getWallet();
        $playerWallet = $game->getCurrentPlayer()->getWallet();

        $data = [
            'bank' => $bankWallet,
            'player' => $playerWallet
        ];

        return $this->render('game.html.twig', $data);
    }

    #[Route("/api/library/books", name: "books", methods: ['GET'])]
    public function libraryBooks(BookRepository $bookRepository): JsonResponse
    {
        $library = $bookRepository->findAll();

        return $this->json($library);
    }

    #[Route("/api/library/books/{isbn}", name: "book_by_isbn", methods: ['GET'])]
    public function libraryBookByIsbn(BookRepository $bookRepository, ManagerRegistry $doctrine, string $isbn): JsonResponse
    {
        $entityManager = $doctrine->getManager();
        
        // $isbn = "ISBN 978-04-5119-115-1";

        if (!$isbn) {
            throw $this->createNotFoundException(
                'No ISBN provided'
            );
        }

        $selected = $bookRepository->findByIsbn(['isbn' => $isbn]);

        return $this->json($selected);
    }
}
