<?php


namespace App\Controller;


use App\Entity\Category;
use App\Entity\Program;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/categories", name="category_")
 */
class CategoryController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index(): Response
    {
        $categories = $this->getDoctrine()
            ->getRepository(Category::class)
            ->findAll();
        return $this->render('/category/index.html.twig', [
                'categories' => $categories,
            ]
        );
    }

    /**
     * @Route("/{categoryName}", name="show")
     * @param string $categoryName
     * @return Response
     */
    public function show(string $categoryName): Response
    {
        $category = $this->getDoctrine()
            ->getRepository(Category::class)
            ->findBy(['name' => $categoryName]);

        $lastPrograms = $this->getDoctrine()
            ->getRepository(Program::class)
            ->findBy(['category' => $category],
                ['id' => 'DESC'],
                $limit = 3
            );
        if (!$lastPrograms) {
            throw $this->createNotFoundException(
                'No category '.$categoryName.' found.'
            );
        }
        return $this->render('category/show.html.twig', [
            'programs' => $lastPrograms,
            'category' => $categoryName
        ]);
    }

}