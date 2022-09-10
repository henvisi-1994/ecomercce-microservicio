<!doctype html>
<html>
<head>

<meta charset="utf-8">
<title>comprobante_pdf</title>
	<style type="text/css">
	.factura {
  table-layout: fixed;
}

.fact-info > div > h5 {
  font-weight: bold;
}

.factura > thead {
  border-top: solid 3px #000;
  border-bottom: 3px solid #000;
}

.factura > thead > tr > th:nth-child(2), .factura > tbod > tr > td:nth-child(2) {
  width: 300px;
}

.factura > thead > tr > th:nth-child(n+3) {
  text-align: right;
}

.factura > tbody > tr > td:nth-child(n+3) {
  text-align: right;
}

.factura > tfoot > tr > th, .factura > tfoot > tr > th:nth-child(n+3) {
  font-size: 24px;
  text-align: right;
}

.cond {
  border-top: solid 2px #000;
}
	</style>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
	<div id="app" class="col-12">
            <h2>COMPROBANTE DE PAGO</h2>


<table class="default">
  <tr>
    <td>
        <img class="w-50"src="https://storeep.000webhostapp.com/assets/images/logo1.png" />

    </td>
        <td>
        <h1>EP TECHNOLOGIES</h1>
        <p>El Oro - El Guabo</p>
        <p>Av. Sucre y la Providencia</p>

    </td>
  </tr>
</table>


    <hr />

    <table class="default">
  <tr>
    <td>
        <h5>Datos de Cliente</h5>
        <p>
          {{$cliente->nombre_persona}}&nbsp;{{$cliente->apellido_persona}}
        </p>
    </td>
    <td>
        <h5>Enviar a</h5>
        <p>
            {{$cliente->direcion}}
            <br>
          {{$cliente->email}}
        </p>
    </td>
    <td>
        <h5>N° de Comprobante </h5>
        <h5>Fecha de Emision</h5>
    </td>
     <td>
         <h5>{{$num_comprobante}}</h5>
        <p>{{$fecha}}</p>
     </td>

  </tr>
</table>

    <div class="row my-3">
      <table class="table table-borderless factura">
        <thead>
          <tr>
            <th>Cant.</th>
            <th>Descripcion</th>
            <th>Precio Unitario</th>
            <th>Importe</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($detalle as $d_fact )
                <tr>
            <td>{{$d_fact->cantidad}}</td>
            <td>{{$d_fact->descripcion_prod}}</td>
            <td>{{$d_fact->precio_prod}}</td>
            <td>{{$d_fact->total_detalle}}</td>
          </tr>
            @endforeach
        </tbody>
        <tfoot>
          <tr>
            <th></th>
            <th></th>
            <th>Total</th>
            <th>${{$precio}}</th>
          </tr>
        </tfoot>
      </table>
    </div>

    <div class="cond row">
      <div class="col-12">
        <h4>Condiciones y formas de pago</h4>
        <p>{{$forma_pago}}</p>
      </div>
    </div>
</div>


</body>
</html>
