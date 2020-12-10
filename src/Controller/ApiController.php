<?php


namespace App\Controller;
use App\Service\ApiService;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/api", name="api_")
 */
class ApiController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index(): Response
    {

        $api = new ApiService();
        $content = $api->apiTest();

        return $this->render('/api_test.html.twig',[
            'api' => $api,
            'content' => $content,
        ]);
    }


    /**
     * @Route("/programs", name="programs")
     */
    public function programs(): Response
    {
        $api = new ApiService();
        $contents = $api->apiTest();

        return $this->render('/api_programs.html.twig',[
            'api' => $api,
            'content' => $contents,
        ]);
    }


    /**
     * @Route("/{num}", methods={"GET"}, name="show")
     * @param $num
     * @return Response
     */
    public function programShow($num): Response
    {
        $api = new ApiService();
        $content = $api->same($num);
        return $this->render('/api_program_show.html.twig',[
            'api' => $api,
            'content' => $content,
        ]);
    }


}