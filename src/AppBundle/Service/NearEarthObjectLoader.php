<?php

namespace AppBundle\Service;

use AppBundle\Entity\NearEarthObject;
use Doctrine\ORM\EntityManager;

class NearEarthObjectLoader
{
    private $em;
    private $apiKey;
    private $apiPath;

    public function __construct(EntityManager $em, string $apiKey, $apiPath)
    {
       $this->em = $em;
       $this->apiKey = $apiKey;
       $this->apiPath = $apiPath;
    }

    public function loadNearEarthObjects(){
        $urlQuery = [
            'start_date' => date("Y-m-d", strtotime("-2 day")),
            'end_date' => date("Y-m-d"),
            'api_key' => $this->apiKey,
        ];

        $client = new \GuzzleHttp\Client();
        $response = $client->request('GET', $this->apiPath, ['query' => $urlQuery]);

        $result = json_decode($response->getBody()->getContents(), true);

        $dates = array_keys($result['near_earth_objects']);

        foreach ($dates as $date){
            $objectsData = $result['near_earth_objects'][$date];

            foreach ($objectsData as $data){
                $newObject = new NearEarthObject();
                $newObject->setDate(new \DateTime($date));
                $newObject->setHazardous($data['is_potentially_hazardous_asteroid']);
                $newObject->setName($data['name']);
                $newObject->setReference($data['neo_reference_id']);
                $newObject->setSpeedPerSecond($data['close_approach_data'][0]['relative_velocity']['kilometers_per_second']);

                $existing = $this->em->getRepository("AppBundle:NearEarthObject")->findOneBy([
                    'reference' => $newObject->getReference()
                ]);

                if(!$existing){
                    $this->em->persist($newObject);
                }
            }
        }

        $this->em->flush();
    }
}