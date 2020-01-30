<?php

namespace App\Controller;

use App\Repository\BlogRepository;
use App\Repository\InfosRepository;
use App\Repository\ProjectRepository;
use App\Repository\SkillsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/home", name="home")
     * @param BlogRepository $blogRepository
     * @param InfosRepository $infosRepository
     * @param ProjectRepository $projectRepository
     * @param SkillsRepository $skillsRepository
     * @return Response
     */
    public function index(
        BlogRepository $blogRepository,
        InfosRepository $infosRepository,
        ProjectRepository $projectRepository,
        SkillsRepository $skillsRepository
    )
    {
        $allProjects = $projectRepository->findAll();
        $allSkills = $skillsRepository->findAll();
        $articles = $blogRepository->findAll();
        $infos = $infosRepository->findAll();

        return $this->render('home/index.html.twig', [
            'projects' => $allProjects,
            'skills' => $allSkills,
            'articles' => $articles,
            'infos' => $infos,
        ]);
    }
}
