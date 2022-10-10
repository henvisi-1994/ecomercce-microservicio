<?php

namespace App\Services\Ventas;

use App\Traits\ConsumesExternalService;

class DetallePedidoService
{
    use ConsumesExternalService;

    /**
     * The base uri to be used to consume the pedido/detalle service
     * @var string
     */
    public $baseUri;

    /**
     * The secret to be used to consume the pedido/detalle service
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
        return $this->performRequest('GET', '/pedido/detalle');
    }
    public function store($data)
    {
        return $this->performRequest('POST', '/pedido/detalle', $data);
    }
    public function update($data, $id)
    {
        return $this->performRequest('PUT', "/pedido/detalle/{$id}", $data);
    }
    public function delete($id)
    {
        return $this->performRequest('DELETE', "/pedido/detalle/{$id}");
    }
    public function getPedido($id){
        return $this->performRequest('GET', "/pedido/detalle/admin/{$id}");
    }
    public function show($id){
        return $this->performRequest('GET', "/pedido/detalle/{$id}");
    }
}
