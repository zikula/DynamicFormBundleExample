<?php

namespace App\Controller;

use App\Entity\Survey;
use App\Entity\SurveyResponse;
use App\Form\SurveyResponseType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/survey/response')]
class SurveyResponseController extends AbstractController
{
    #[Route('/{id}/new', name: 'app_survey_response_new', methods: ['GET', 'POST'])]
    public function new(Request $request, Survey $survey, EntityManagerInterface $entityManager): Response
    {
        $surveyResponse = new SurveyResponse();
        $surveyResponse->setSurvey($survey);
        $form = $this->createForm(SurveyResponseType::class, $surveyResponse, [
            'specificationContainer' => $survey
        ]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($surveyResponse);
            $entityManager->flush();
            $this->addFlash('success', 'Thank you for completing the survey!');

            return $this->redirectToRoute('app_survey_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('survey_response/new.html.twig', [
            'survey' => $survey,
            'form' => $form,
        ]);
    }

    #[Route('/{id}/show', name: 'app_survey_response_show', methods: ['GET'])]
    public function show(SurveyResponse $surveyResponse): Response
    {
        return $this->render('survey_response/show.html.twig', [
            'survey_response' => $surveyResponse,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_survey_response_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, SurveyResponse $surveyResponse, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(SurveyResponseType::class, $surveyResponse, [
            'specificationContainer' => $surveyResponse->getSurvey()
        ]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();
            $this->addFlash('success', 'The survey response was edited!');

            return $this->redirectToRoute('app_survey_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('survey_response/edit.html.twig', [
            'survey_response' => $surveyResponse,
            'form' => $form,
        ]);
    }

    #[Route('/{id}/delete', name: 'app_survey_response_delete', methods: ['POST'])]
    public function delete(Request $request, SurveyResponse $surveyResponse, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$surveyResponse->getId(), $request->request->get('_token'))) {
            $entityManager->remove($surveyResponse);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_survey_index', [], Response::HTTP_SEE_OTHER);
    }
}
