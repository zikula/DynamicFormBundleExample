<?php

namespace App\Controller;

use App\Entity\Survey;
use App\Entity\SurveyResponse;
use App\Form\SurveyResponseType;
use App\Form\SurveyType;
use App\Repository\SurveyRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/survey')]
class SurveyController extends AbstractController
{
    #[Route('/', name: 'app_survey_index', methods: ['GET'])]
    public function index(SurveyRepository $surveyRepository): Response
    {
        return $this->render('survey/index.html.twig', [
            'surveys' => $surveyRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_survey_new', methods: ['GET', 'POST'])]
    public function new(Request $request, ManagerRegistry $managerRegistry): Response
    {
        $survey = new Survey();
        $form = $this->createForm(SurveyType::class, $survey);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid() && $form->get('submit')->isClicked()) {
            $managerRegistry->getManager()->persist($survey);
            $managerRegistry->getManager()->flush();

            return $this->redirectToRoute('app_survey_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('survey/new.html.twig', [
            'survey' => $survey,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_survey_show', methods: ['GET', 'POST'])]
    public function show(Request $request, Survey $survey, ManagerRegistry $managerRegistry): Response
    {
        $surveyResponse = new SurveyResponse();
        $surveyResponse->setSurvey($survey);
        $form = $this->createForm(SurveyResponseType::class, $surveyResponse, [
            'survey' => $survey
        ]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $managerRegistry->getManager()->persist($surveyResponse);
            $managerRegistry->getManager()->flush();
            $this->addFlash('success', 'Thank you for completing the survey!');

            return $this->redirectToRoute('app_survey_index', [], Response::HTTP_SEE_OTHER);
        }
        return $this->render('survey/show.html.twig', [
            'survey' => $survey,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}/edit', name: 'app_survey_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Survey $survey, ManagerRegistry $managerRegistry): Response
    {
        $form = $this->createForm(SurveyType::class, $survey);
        $form->handleRequest($request);

        if (!$request->isXmlHttpRequest() && $form->isSubmitted() && $form->isValid()) {
            $managerRegistry->getManager()->flush();

            return $this->redirectToRoute('app_survey_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('survey/edit.html.twig', [
            'survey' => $survey,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_survey_delete', methods: ['POST'])]
    public function delete(Request $request, Survey $survey, ManagerRegistry $managerRegistry): Response
    {
        if ($this->isCsrfTokenValid('delete'.$survey->getId(), $request->request->get('_token'))) {
            $managerRegistry->getManager()->remove($survey);
            $managerRegistry->getManager()->flush();
        }

        return $this->redirectToRoute('app_survey_index', [], Response::HTTP_SEE_OTHER);
    }
}
