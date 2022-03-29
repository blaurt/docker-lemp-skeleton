<?php

namespace App\Classes\Dvd;

interface DvdRepository
{
    /**
     * @param Dvd $dvd
     * @return mixed
     */
    public function addDvd(Dvd $dvd);

    /**
     * @return mixed
     */
    public function getAllDvds();

    /**
     * @param int $id
     * @param array $params
     * @return mixed
     */
    public function updateDvd(int $id, array $params);

    /**
     * @param string $id
     * @return mixed
     */
    public function deleteDvd(string $id);

    /**
     * @param string $author
     * @return mixed
     */
    public function getDvdByAuthor(string $author);
}