<?php

namespace App\Services\Ventas;

use App\Traits\ConsumesExternalService;

class TipoIdentificacionService
{
    use ConsumesExternalService;

    /**
     * The base uri to be used to consume the identificaciones service
     * @var string
     */
    public $baseUri;

    /**
     * The secret to be used to consume the identificaciones service
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
        return $this->performRequest('GET', '/identificaciones');
    }
    public function store($data)
    {
        return $this->performRequest('POST', '/identificaciones', $data);
    }
    public function update($data, $id)
    {
        return $this->performRequest('PUT', "/identificaciones/{$id}", $data);
    }
    public function delete($id)
    {
        return $this->performRequest('DELETE', "/identificaciones/{$id}");
    }
}
