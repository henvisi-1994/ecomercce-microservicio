<?php

namespace App\Services;

use App\Traits\ConsumesExternalService;

class EstadoPedidoService
{
    use ConsumesExternalService;

    /**
     * The base uri to be used to consume the pedido/estado service
     * @var string
     */
    public $baseUri;

    /**
     * The secret to be used to consume the pedido/estado service
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
        return $this->performRequest('GET', '/pedido/estado');
    }
    public function store($data)
    {
        return $this->performRequest('POST', '/pedido/estado', $data);
    }
    public function update($data, $id)
    {
        return $this->performRequest('PUT', "/pedido/estado/{$id}", $data);
    }
    public function delete($id)
    {
        return $this->performRequest('DELETE', "/pedido/estado/{$id}");
    }
}
