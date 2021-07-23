<?php

namespace App\Controller;

use App\Entity\Anim;
use App\Repository\AnimRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AnimController extends AbstractController
{
    /**
     * @var AnimRepository
     */
    private $repository;
    
    public function __construct(AnimRepository $repository, EntityManagerInterface $em)
    {
        $this->repository= $repository;
        $this->em= $em;
    }


    /**
     * @route("/anims", name="anim.index")
     * @return Response
     */
    public function index() :Response
    {
        // $anim= $this->repository->findall();
        // dump($anim);

        // $anim[0]->setYear('1986');
        // $this->em->flush();
        
        // $anim= new Anim;
        // $anim->setTitle('Le Château dans le ciel');
        // $anim->setKanjiTitle('天空の城ラピュタ');
        // $anim->setJapTitle('Tenkū no shiro Rapyuta');
        // $anim->setYear('1986');
        // $anim->setDirector('1');

        // $em= $this->getDoctrine()->getManager();
        // $em->persist($anim);
        // $em->flush();

        // $repository= $this->getDoctrine()->getRepository(Anim::class);
        // dump($repository);


        return $this->render('/anim/index.html.twig', [
            'current_menu' => 'anims'
         ]);
    }


    /**
     * @route("/anims/{slug}-{id}", name="anim.show", requirements={"slug": "[a-z0-9\-]*"})
     * @return Response
     */
    public function show(Anim $anim, string $slug): Response
    {
        if ($anim->getSlug() !== $slug)
        {
           return $this->redirectToRoute('anim.show', [
                'id' => $anim->getId(),
                'slug' => $anim->getSlug()
            ], 301);
        };
        return $this->render("anim/show.html.twig", [
            'anim' => $anim,
            'current_menu' => 'anims'
        ]);
    }




}