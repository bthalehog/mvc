<?php

namespace App\Controller;

use App\Entity\Book;
use App\Repository\BookRepository;
use Doctrine\Persistence\ManagerRegistry;
// For file upload handling
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;

final class BookController extends AbstractController
{
    #[Route('/book', name: 'app_book')]
    public function index(): Response
    {
        return $this->render('book/index.html.twig', [
            'controller_name' => 'BookController',
        ]);
    }

    #[Route('/book/show', name: 'book_show_all', methods: ['GET'])]
    public function showAllBook(ManagerRegistry $doctrine, BookRepository $bookRepository): Response
    {
        $entityManager = $doctrine->getManager();
        $books = $entityManager->getRepository(Book::class)->findAll();

        return $this->render('book/view.html.twig', ['books' => $books]);
    }

    #[Route('/book/show/{id}', name: 'view_details', methods: ['GET'])]
    public function showBookById(BookRepository $bookRepository, int $id): Response
    {
        $book = $bookRepository->find($id);

        return $this->render('book/view_details.html.twig', ['book' => $book]);
    }

    /* NOT NEEDED - CAN USE THE ID AS IN EXC
    #[Route('/book/show/{isbn}', name: 'book_by_isbn')]
    public function showBookByISBN(
        BookRepository $bookRepository,
        string $isbn
    ): Response {
        $book = $bookRepository
            ->find($isbn);

        return $this->json($book);
    }
    */

    #[Route('/book/create', name: 'book_create', methods: ['GET', 'POST'])]
    public function createBook(Request $request, ManagerRegistry $doctrine): Response
    {
        if ($request->isMethod('POST')) {
            $entityManager = $doctrine->getManager();

            $book = new Book();
            $book->setTitle($request->request->get('title'));
            $book->setAuthor($request->request->get('author'));
            $book->setISBN($request->request->get('isbn'));
            // $book->setImage($request->request->get('image'));
            $uploadedImage = $request->files->get('image');

            // Result has to be written to variable for further handling.
            // $uploadedImage = $book->setImage($request->files->get('image'));

            if ($uploadedImage) {
                $fileConstraint = new File([
                    'maxSize' => '1024k',
                ]);

                // Generate file name
                $fileName = uniqid().'.'.$uploadedImage->guessExtension();

                // Move to target dir public/uploads/images as set i service.yaml
                $uploadedImage->move($this->getParameter('images_directory'), $fileName);
                $book->setImage($fileName);
            }

            // tell Doctrine you want to (eventually) save the Product
            $entityManager->persist($book);

            // actually executes the queries (i.e. the INSERT query)
            $entityManager->flush();

            return $this->redirectToRoute('book_show_all');
        }

        return $this->render('book/add.html.twig');
    }

    #[Route('/book/delete/{id}', name: 'book_delete_by_id', methods: ['GET', 'POST'])]
    public function deleteBookById(Request $request, ManagerRegistry $doctrine, int $id): Response
    {
        $entityManager = $doctrine->getManager();
        $book = $entityManager->getRepository(Book::class)->find($id);

        if (!$book) {
            throw $this->createNotFoundException(
                'No book found for id '.$id
            );
        }

        if ($request->isMethod('POST')) {
            $entityManager->remove($book);
            $entityManager->flush();

            return $this->redirectToRoute('book_show_all');
        }

        return $this->render('book/delete.html.twig', ['book' => $book]);
    }

    #[Route('/book/update/{id}', name: 'book_update_by_id', methods: ['GET', 'POST'])]
    public function updateBookById(Request $request, ManagerRegistry $doctrine, int $id): Response
    {
        $entityManager = $doctrine->getManager();
        $book = $entityManager->getRepository(Book::class)->find($id);

        if (!$book) {
            throw $this->createNotFoundException(
                'No book found for id '.$id
            );
        }

        if ($request->isMethod('POST')) {
            dump($request->request->all());

            $book->setISBN($request->request->get('isbn'));
            $book->setTitle($request->request->get('title'));
            $book->setAuthor($request->request->get('author'));
            $book->setImage($request->request->get('image'));

            $entityManager->flush();

            return $this->redirectToRoute('book_show_all');
        }

        return $this->render('book/update.html.twig', ['book' => $book]);
    }

    #[Route('/book/view/{id}', name: 'book_view_details', methods: ['GET'])]
    public function viewBookDetails(BookRepository $bookRepository, int $id): Response
    {
        $book = $bookRepository->findByID($id);

        return $this->render('book/view_details.html.twig', ['book' => $book]);
    }
}
