<?php

namespace App\Services;

use App\Traits\ConsumesExternalService;

class EnvioService
{
    use ConsumesExternalService;

    /**
     * The base uri to be used to consume the envio service
     * @var string
     */
    public $baseUri;

    /**
     * The secret to be used to consume the envio service
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
        return $this->performRequest('GET', '/envio');
    }
    public function store($data)
    {
        return $this->performRequest('POST', '/envio', $data);
    }
    public function update($data, $id)
    {
        return $this->performRequest('PUT', "/envio/{$id}", $data);
    }
    public function delete($id)
    {
        return $this->performRequest('DELETE', "/envio/{$id}");
    }
}
