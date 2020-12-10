<?php

namespace App\Controller;

use App\Entity\Actor;
use App\Entity\Program;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/actorss", name="actorsss_")
 */
class incaseActorController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index(): Response
    {
        $actors = $this->getDoctrine()
            ->getRepository(Actor::class)
            ->findAll();
        return $this->render('incaseactor/index.html.twig', [
            'actors' => $actors
        ]);
    }
    /**

     */
    public function show(Actor $actor):Response
    {
        $program = $this->getDoctrine()
            ->getRepository(Program::class)
            ->findBy(['id' => $actor]);
        return $this->render('incaseactor/show.html.twig', [
            'program' => $program,
            'incaseactor' => $actor
        ]);
    }


}
