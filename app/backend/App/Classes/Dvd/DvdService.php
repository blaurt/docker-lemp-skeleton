<?php

namespace App\Classes\Dvd;

use App\ProductService;
use Exception;

class DvdService extends ProductService
{
    /**
     * @var DvdRepository
     */
    private DvdRepository $dvdRepository;

    /**
     * @param DvdRepository $dvdRepository
     */
    public function __construct(DvdRepository $dvdRepository)
    {
        $this->dvdRepository = $dvdRepository;
    }

    /**
     * @throws Exception
     */
    public function addProduct($params)
    {
        $newDvd = new Dvd($params['sku'], $params['name'], $params['price'], $params['type'], $params['size']);
        $savedDvd = $this->dvdRepository->addDvd($newDvd);
        return $savedDvd;
    }

    /**
     * @return mixed
     */
    public function getAllProducts()
    {
        return [];
        $dvds = $this->dvdRepository->getAllDvds();
        return $dvds;
    }

    /**
     * @param $dvdId
     * @param $params
     * @return void
     */
    public function updateProduct($dvdId, $params)
    {
        $this->dvdRepository->updateDvd($dvdId, $params);
    }

    /**
     * @param $dvdId
     * @return void
     */
    public function deleteProduct($dvdId)
    {
        $this->dvdRepository->deleteDvd($dvdId);
    }
}