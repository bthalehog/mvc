<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ReportsController extends AbstractController
{
    #[Route("/report", name: "report")]
    public function showSelected($filename): Response
    {
        $currPath = $this->getParameter('kernel.project_dir') . 'public/assets/reports/' . $filename;

        if (!file_exists($currPath)) {
            throw new NotFoundHttpException("No such report");
        };

        return new Response(
            file_get_contents($filePath),
            200,
            ['Content-Type' => 'text/html'] // Using html in text-doc
        );
    }
};
