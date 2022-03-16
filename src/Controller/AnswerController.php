<?php

namespace App\Controller;
use App\Repository\AnswerRepository;
use App\Entity\Answer;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;


class AnswerController extends AbstractController
{
    /**
     * @Route("/answers/{id}/vote", methods="POST", name="answer_vote")
     */
    public function answerVote(Answer $answer, LoggerInterface $logger, Request $request,EntityManagerInterface $entityManager)
    {

        dump('sakshi');
        $data = json_decode($request->getContent(), true);
        $direction = $data['direction'] ?? 'up';

        // todo - use id to query the database

        // use real logic here to save this to the database
        if ($direction === 'up') {
            $logger->info('Voting up!');
            $answer->setVotes($answer->getVotes() + 1);
        } else {
            $logger->info('Voting down!');
            $answer->setVotes($answer->getVotes() - 1);
        }
        $entityManager->flush();
        return $this->json(['votes' => $answer->getVotes()]);
    }
     /**
     * @Route("/answers/popular", name="app_popular_answers")
     */
  public function popularAnswers(AnswerRepository $answerRepository)
  {
      $answers = $answerRepository->findMostPopular();
      return $this->render('answer/popularAnswers.html.twig', [
          'answers' => $answers
      ]);
  }
}
    