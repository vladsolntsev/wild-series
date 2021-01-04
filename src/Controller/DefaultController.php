<?php


namespace App\Controller;

use App\Entity\Program;
use App\Repository\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    /**
     * @Route("/", name="app_index")
     */
    public function index(): Response
    {
        $lastPrograms = $this->getDoctrine()
            ->getRepository(Program::class)
            ->findBy([],
                ['id' => 'DESC'],
                $limit = 3
            );
        return $this->render('index.html.twig', [
            'lastPrograms' => $lastPrograms,
        ]);
    }


}