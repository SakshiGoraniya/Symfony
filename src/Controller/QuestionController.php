<?php
namespace App\Controller;
use Twig\Environment;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class QuestionController extends AbstractController
{
    /**
     * @Route("/",name="app_homepage")
     */
    public function homepage(Environment $twigEnvironment)
    {
        // $html = $twigEnvironment->render('question/homepage.html.twig');
        return $this->render('question/homepage.html.twig');
        // return new Response($html);
    }
     /**
     * @Route("/questions/{slug}",name="app_question_show")
     */
    public function show($slug)
    {

        $answers=['make sure your cat is sitting perfectly',
                'furry shoes better than cat',
                'try it backwards'    
    ];
    dump($slug,$this);
      
        return $this->render('question/show.html.twig',[
            'question'=> ucwords(str_replace('-', ' ', $slug)),
            'answers'=>$answers,
        ]);

        
    }

}



?>