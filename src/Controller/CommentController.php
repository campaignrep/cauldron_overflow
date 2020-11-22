<?php

namespace App\Controller;

use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class CommentController extends AbstractController
{
    /**
     * @Route("/comments/{id<\d+>}/vote/{direction<up|down>}", methods="POST")
     */
    public function commentVote($id, $direction, LoggerInterface $logger)
    {
        // todo - use id to query the database

        // use real logic here to save this to the database

        if ($direction === 'up') {
            $logger->info('Voting Up');
            $currentVoteCount = rand(7, 100);
        }
        else {
            $logger->info('Voting Down');
            $currentVoteCount = rand(0, 5);
        }

        // return new JsonResponse(['votes', $currentVoteCount]);
        return $this->json([
            'votes' => $currentVoteCount
        ]);

    }
}
