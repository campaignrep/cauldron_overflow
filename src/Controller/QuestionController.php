<?php

// src/Controller/QuestionController.php

namespace App\Controller;

use Knp\Bundle\MarkdownBundle\MarkdownParserInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Cache\CacheInterface;

class QuestionController extends AbstractController
{

    /**
     * @Route("/", name="app_homepage")
     */
    public function homepage()
    {

        /*
        $html = $twigEnviroment->render('question/homepage.html.twig');
        return new Response($html);
        */


        // return new Response('What a bewithcing controller we have whipped up here!');
        return $this->render(
            'question/homepage.html.twig'
        );
    }

    /**
     * @Route("/questions/{slug}", name="app_question_show")
     */
    public function show($slug, MarkdownParserInterface $markdownParser, CacheInterface $cache)
    {
        // return new Response(sprintf(
        //     'This is the URL Title Maybe: %s', 
        //     ucwords(str_replace('-', ' ', $slug))
        // ));

        $questionText = 'I\'ve been turned into a cat, any *thoughts* on how to turn back? While I\'m **adorable**, I don\'t really care for cat food.';
        // $parsedQuestionText = $markdownParser->transformMarkdown($questionText);

        $parsedQuestionText = $cache->get('markdown_'.md5($questionText), function() use($markdownParser, $questionText) {
            return $markdownParser->transformMarkdown($questionText);
        });

        dd($markdownParser);


        $answers = [
            'Make sure your cat is sitting `purrrfectly` still 🤣',
            'Honestly, I like furry shoes better than MY cat',
            'Maybe... try saying the spell backwards?',
        ];

        // dump($slug, $this);

        return $this->render('question/show.html.twig', [
            'question' => ucwords(str_replace('-', ' ', $slug)),
            'questionText' => $parsedQuestionText,
            'answers' => $answers,
        ]);
    }
}
