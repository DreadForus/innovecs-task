<?php

namespace AppBundle\Controller;

use AppBundle\Exception\CustomFileException;
use AppBundle\Service\Interfaces\Pagination\EntityListPaginationInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Filesystem\Exception\FileNotFoundException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Response;

class NeoController extends Controller
{
    public function hazardousAction(Request $request)
    {
        $paginationService = $this->get('near_earth_object_hazardous_list_pagination_service');

        return $this->getListResponse($request, $paginationService);
    }

    public function fastestAction(Request $request)
    {
        $paginationService = $this->get('near_earth_object_fastest_list_pagination_service');

        return $this->getListResponse($request, $paginationService);
    }

    public function getListResponse(Request $request, EntityListPaginationInterface $paginationService)
    {
        $jsonResponse = new JsonResponse();

        $response = $paginationService->getTableList($request);

        $jsonResponse->setData($response)->setStatusCode(200);

        return $jsonResponse;
    }

}
