<?php

namespace App\Controller\Admin;

use App\Entity\Anim;
use App\Form\AnimType;
use App\Repository\AnimRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class AdminAnimController extends AbstractController
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
     * @Route("/admin", name="admin.anim.index")
     * @return Response
     */
    public function index()
    {
       $anims= $this->repository->findAll();
       return $this->render('admin/anim/index.html.twig', compact('anims'));
    }

    /**
     * @Route("/admin/anim/create", name="admin.anim.new")
     * @param Anim $anim
     * @param Request $request
     * @return Response
     */
    public function new(Request $request)
    {
        $anim= new Anim();
        $form= $this->createForm(AnimType::class, $anim);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $this->em->persist($anim);
            $this->em->flush();
            $this->addFlash('success', 'Animé ajouté avec succès');
            return $this->redirectToRoute('admin.anim.index');
        }


       return $this->render('admin/anim/new.html.twig', [
          'anim' => $anim,
          'form' => $form->createView()
       ]);
    }

    /**
     * @Route("/admin/anim/{id}/", name="admin.anim.edit", methods={"GET|POST"})
     * @param Anim $anim
     * @param Request $request
     * @return Response
     */
    public function edit(Anim $anim, Request $request)
    {
        $form= $this->createForm(AnimType::class, $anim);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $this->em->flush();
            $this->addFlash('success', 'Animé modifié avec succès');
            return $this->redirectToRoute('admin.anim.index');
        }


       return $this->render('admin/anim/edit.html.twig', [
          'anim' => $anim,
          'form' => $form->createView()
       ]);
    }


    /**
     * @Route("/admin/anim/{id}/", name="admin.anim.delete", methods={"DELETE"})
     * @param Anim $anim
     * @return Response
     */
    public function delete(Anim $anim, Request $request)
    {
        if ($this->isCsrfTokenValid('delete'.$anim->getId(), $request->get('_token')))
        {
        // $this->em->remove($anim);
        // $this->em->flush();
        $this->addFlash('success', 'Animé supprimé avec succès');
        return new Response('Suppression');
        } 
        // else {
        //     return new Response('Token non valide');
        // }
        return $this->redirectToRoute('admin.anim.index');
    }

}