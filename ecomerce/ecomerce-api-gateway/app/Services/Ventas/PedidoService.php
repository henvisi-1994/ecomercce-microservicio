<?php

namespace App\Services;

use App\Traits\ConsumesExternalService;

class PedidoService
{
    use ConsumesExternalService;

    /**
     * The base uri to be used to consume the pedido service
     * @var string
     */
    public $baseUri;

    /**
     * The secret to be used to consume the pedido service
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
        return $this->performRequest('GET', '/pedido');
    }
    public function store($data)
    {
        return $this->performRequest('POST', '/pedido', $data);
    }
    public function update($data, $id)
    {
        return $this->performRequest('PUT', "/pedido/{$id}", $data);
    }
    public function delete($id)
    {
        return $this->performRequest('DELETE', "/pedido/{$id}");
    }


    public function Pagar($id)
    {
        return $this->performRequest('GET', "/pedido/pagar/{$id}");
    }
    public function status($data)
    {
        return $this->performRequest('POST', '/pedido/estado_pedido', $data);
    }
    public function enviar($id)
    {
        return $this->performRequest('GET', "/pedido/enviar/{$id}");
    }

}
