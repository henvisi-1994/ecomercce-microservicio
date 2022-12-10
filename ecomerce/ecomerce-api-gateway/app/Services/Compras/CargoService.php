<?php

namespace App\Services\Compras;

use App\Traits\ConsumesExternalService;

class CargoService
{
    use ConsumesExternalService;

    /**
     * The base uri to be used to consume the authors service
     * @var string
     */
    public $baseUri;

    /**
     * The secret to be used to consume the authors service
     * @var string
     */
    public $secret;

    public function __construct()
    {
        $this->baseUri = config('services.compras.base_uri');
        $this->secret = config('services.compras.secret');
    }
    public function index()
    {
        return $this->performRequest('GET', '/cargo');
    }
    public function store($data)
    {
        return $this->performRequest('POST', '/cargo', $data);
    }
    public function update($data, $id)
    {
        return $this->performRequest('PUT', "/cargo/{$id}", $data);
    }
    public function delete($id)
    {
        return $this->performRequest('DELETE', "/cargo/{$id}");
    }

}
