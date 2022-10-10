<?php

namespace App\Services\Ventas;

use App\Traits\ConsumesExternalService;

class PaisService
{
    use ConsumesExternalService;

    /**
     * The base uri to be used to consume the pais service
     * @var string
     */
    public $baseUri;

    /**
     * The secret to be used to consume the pais service
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
        return $this->performRequest('GET', '/pais');
    }
    public function store($data)
    {
        return $this->performRequest('POST', '/pais', $data);
    }
    public function update($data, $id)
    {
        return $this->performRequest('PUT', "/pais/{$id}", $data);
    }
    public function delete($id)
    {
        return $this->performRequest('DELETE', "/pais/{$id}");
    }
}
