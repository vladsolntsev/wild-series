<?php

namespace App\Controller;

use App\Entity\Actor;
use App\Entity\Program;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/actors", name="actor_")
 */
class ActorController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index(): Response
    {
        $actors = $this->getDoctrine()
            ->getRepository(Actor::class)
            ->findAll();
        return $this->render('actor/index.html.twig', [
            'actors' => $actors
        ]);
    }
    /**
     * @Route("/actors/{actorId}", methods={"GET"}, name="show")
     * @ParamConverter("actor", class="App\Entity\Actor", options={"mapping": {"actorId": "id"}})
     */
    public function show(Actor $actor):Response
    {
        $program = $this->getDoctrine()
            ->getRepository(Program::class)
            ->findBy(['id' => $actor]);
        return $this->render('actor/show.html.twig', [
            'program' => $program,
            'actor' => $actor
        ]);
    }



}
