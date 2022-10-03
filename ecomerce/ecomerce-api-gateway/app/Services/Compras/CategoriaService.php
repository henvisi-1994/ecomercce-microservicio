<?php

namespace App\Services\Compras;

use App\Traits\ConsumesExternalService;

class CategoriaService
{
    use ConsumesExternalService;

    /**
     * The base uri to be used to consume the categorias service
     * @var string
     */
    public $baseUri;

    /**
     * The secret to be used to consume the categorias service
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
        return $this->performRequest('GET', '/categorias');
    }
    public function store($data)
    {
        return $this->performRequest('POST', '/categorias', $data);
    }
    public function update($data, $id)
    {
        return $this->performRequest('PUT', "/categorias/{$id}", $data);
    }
    public function delete($id)
    {
        return $this->performRequest('DELETE', "/categorias/{$id}");
    }
    public function getActivas()
    {
        return $this->performRequest('GET', '/categorias/activas');
    }
    public function top()
    {
        return $this->performRequest('GET', '/categorias/top');
    }


}
