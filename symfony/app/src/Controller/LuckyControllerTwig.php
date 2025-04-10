<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LuckyControllerTwig extends AbstractController
{
    #[Route("/twig", name: "home")]
    public function home(): Response
    {
        return $this->render('home.html.twig');
    }

    #[Route("/about/twig", name: "about")]
    public function about(): Response
    {
        return $this->render('about.html.twig');
    }

    #[Route("/report/twig", name: "report")]
    public function report(): Response
    {
        return $this->render('report.html.twig');
    }

    #[Route("/report/report-view/twig", name: "report-view")]
    public function viewReport(): Response
    {
        $reportdict = [
            "report1"=>"mvc_kmom01_report.txt",
            "report2"=>"mvc_kmom02_report.txt",
            "report3"=>"mvc_kmom03_report.txt",
            "report4"=>"mvc_kmom04_report.txt",
            "report5"=>"mvc_kmom05_report.txt"
        ];

        $selector = isset($_GET['reportId']) ? $_GET['reportId'] : null;
        $selected = $reportdict[$selector];
        $repPath = $this->getParameter('kernel.project_dir') . '/assets/reports/' . $selected;
        $report = file_get_contents($repPath);
        
        return $this->render('report-view.html.twig', [
            'report' => $report,
        ]);
    }
    
    #[Route("/lucky/twig", name: "lucky")]
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
}
