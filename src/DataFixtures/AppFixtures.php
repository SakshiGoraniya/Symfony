<?php

namespace App\DataFixtures;
use App\Factory\UserFactory;
use App\Factory\TagFactory;
use App\Entity\Tag;
use App\Entity\Answer;
use App\Factory\QuestionFactory;
use App\Factory\AnswerFactory;
use App\Entity\Question;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Factory\QuestionTagFactory;

class AppFixtures extends Fixture
{
   
    public function load(ObjectManager $manager)
    {
        TagFactory::createMany(100);
      $questions=  QuestionFactory::new()->createMany(20);


      QuestionTagFactory::createMany(100,function(){
            return[
                'tag' => TagFactory::random(),
                'question' => QuestionFactory::random(),
            ];
      });
        QuestionFactory::new()
        ->unpublished()
        ->createMany(5)
        ;
      
        AnswerFactory::createMany(100,function() use ($questions){
            return[
                'question'=>$questions[array_rand($questions)]
            ];
        });
        AnswerFactory::new(function() use ($questions) {
            return [
                'question' => $questions[array_rand($questions)]
            ];
        })->needsApproval()->many(20)->create();
       
        UserFactory::createOne(['email' => 'abraca_admin@example.com']);
        UserFactory::createMany(10);
       


        $manager->flush();

    }
}
