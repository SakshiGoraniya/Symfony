<?php

namespace App\DataFixtures;
use App\Entity\Answer;
use App\Factory\QuestionFactory;
use App\Factory\AnswerFactory;
use App\Entity\Question;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);
      $questions=  QuestionFactory::new()->createMany(20);
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
       



        $manager->flush();

    }
}