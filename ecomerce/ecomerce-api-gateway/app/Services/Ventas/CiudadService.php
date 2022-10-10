<?php

namespace App\Services\Ventas;

use App\Traits\ConsumesExternalService;

class CiudadService
{
    use ConsumesExternalService;

    /**
     * The base uri to be used to consume the ciudad service
     * @var string
     */
    public $baseUri;

    /**
     * The secret to be used to consume the ciudad service
     * @var string
     */
    public $secret;

    public function __construct()
    {
        $this->baseUri = config('services.ventas.base_uri');
        $this->secret = config('services.ventas.secret');
    }
    public function index()
    {
        return $this->performRequest('GET', '/ciudad');
    }

    public function store($data)
    {
        return $this->performRequest('POST', '/ciudad', $data);
    }
    public function update($data, $id)
    {
        return $this->performRequest('PUT', "/ciudad/{$id}", $data);
    }
    public function delete($id)
    {
        return $this->performRequest('DELETE', "/ciudad/{$id}");
    }
}
