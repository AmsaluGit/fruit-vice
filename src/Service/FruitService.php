<?php

namespace App\Service;

use App\Entity\Fruit;
use App\Entity\Nutrition;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class FruitService
{
    private $entityManager;
    private $httpClient;

    public function __construct(EntityManagerInterface $entityManager,HttpClientInterface $httpClient)
    {
        $this->entityManager = $entityManager;
        $this->httpClient = $httpClient;
    }

    public function createFruit(): void
    {
        $fruit = new Fruit();
        // $httpClient = HttpClient::create();
        $response = $this->httpClient->request('GET', 'https://www.fruityvice.com/api/fruit/all', [
            'verify_peer' => false,
            'verify_host' => false,
        ]);
        $fruits = $response->toArray();
        
        foreach ($fruits as $fruitData) {
            $fruit = new Fruit();
            $fruit->setName($fruitData['name']);
            $fruit->setFamily($fruitData['family']);
     
            // $fruit->setOrder($fruitData['order']);
            $this->entityManager->persist($fruit);


            $nutrition = new Nutrition();
            $nutrition->setCarbohydrates($fruitData['nutritions']['carbohydrates']);
            $nutrition->setProtein($fruitData['nutritions']['protein']);
            $nutrition->setFat($fruitData['nutritions']['fat']);
            $nutrition->setCalories($fruitData['nutritions']['calories']);
            $nutrition->setSugar($fruitData['nutritions']['sugar']);
            $nutrition->setFruit($fruit);

            $this->entityManager->persist($nutrition);
        }
        
        $this->entityManager->flush();
     
    }
}
