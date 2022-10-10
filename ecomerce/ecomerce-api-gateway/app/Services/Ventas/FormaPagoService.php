<?php

namespace App\Services\Ventas;

use App\Traits\ConsumesExternalService;

class FormaPagoService
{
    use ConsumesExternalService;

    /**
     * The base uri to be used to consume the formaPago service
     * @var string
     */
    public $baseUri;

    /**
     * The secret to be used to consume the formaPago service
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
        return $this->performRequest('GET', '/formaPago');
    }
    public function store($data)
    {
        return $this->performRequest('POST', '/formaPago', $data);
    }
    public function update($data, $id)
    {
        return $this->performRequest('PUT', "/formaPago/{$id}", $data);
    }
    public function delete($id)
    {
        return $this->performRequest('DELETE', "/formaPago/{$id}");
    }
}
