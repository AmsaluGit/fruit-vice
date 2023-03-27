<?php

namespace App\Controller;


use App\Entity\Fruit;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Nelmio\CorsBundle\Attribute as Cors;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(): Response
    {
        return $this->render(
            'home.html.twig',
           );
    }

    #[Route('/fruit', name: 'fruit')]
    public function fruit(EntityManagerInterface $entityManager): JsonResponse
    {
        // $fruit = $entityManager->getRepository(Fruit::class)->all();
        $fruits = $entityManager->getRepository(Fruit::class)->findAll();
        $data = [];
        foreach ($fruits as $fruit) {
            $data[] = [
                'id' => $fruit->getId(),
                'name' => $fruit->getName(),
                'family' => $fruit->getFamily(),
      
                'nutritions'=>
                [
                   'carbohydrates'=> $fruit->getNutrition()->getCarbohydrates(),
                   'protein'=> $fruit->getNutrition()->getProtein(),
                   'fat'=> $fruit->getNutrition()->getFat(),
                   'calories'=> $fruit->getNutrition()->getCalories(),
                   'sugar'=> $fruit->getNutrition()->getSugar(),
                ]
                
             
            ];
        }

        return new JsonResponse($data);
      
    }
}
