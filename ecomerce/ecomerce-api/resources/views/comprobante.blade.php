<!doctype html>
<!--Quite a few clients strip your Doctype out, and some even apply their own. Many clients do honor your doctype and it can make things much easier if you can validate constantly against a Doctype.-->
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Email template By Adobe Dreamweaver CC</title>

<!-- Please use an inliner tool to convert all CSS to inline as inpage or external CSS is removed by email clients -->
<!-- important in CSS is used to prevent the styles of currently inline CSS from overriding the ones mentioned in media queries when corresponding screen sizes are encountered -->

<style type="text/css">
body {
	margin: 0;
}
body, table, td, p, a, li, blockquote {
	-webkit-text-size-adjust: none!important;
	font-family: sans-serif;
	font-style: normal;
	font-weight: 400;
}
button {
	width: 90%;
}

@media screen and (max-width:600px) {
/*styling for objects with screen size less than 600px; */
body, table, td, p, a, li, blockquote {
	-webkit-text-size-adjust: none!important;
	font-family: sans-serif;
}
table {
	/* All tables are 100% width */
	width: 100%;
}
.footer {
	/* Footer has 2 columns each of 48% width */
	height: auto !important;
	max-width: 48% !important;
	width: 48% !important;
}
table.responsiveImage {
	/* Container for images in catalog */
	height: auto !important;
	max-width: 30% !important;
	width: 30% !important;
}
table.responsiveContent {
	/* Content that accompanies the content in the catalog */
	height: auto !important;
	max-width: 66% !important;
	width: 66% !important;
}
.top {
	/* Each Columnar table in the header */
	height: auto !important;
	max-width: 48% !important;
	width: 48% !important;
}
.catalog {
	margin-left: 0%!important;
}
}

@media screen and (max-width:480px) {
/*styling for objects with screen size less than 480px; */
body, table, td, p, a, li, blockquote {
	-webkit-text-size-adjust: none!important;
	font-family: sans-serif;
}
table {
	/* All tables are 100% width */
	width: 100% !important;
	border-style: none !important;
}
.footer {
	/* Each footer column in this case should occupy 96% width  and 4% is allowed for email client padding*/
	height: auto !important;
	max-width: 96% !important;
	width: 96% !important;
}
.table.responsiveImage {
	/* Container for each image now specifying full width */
	height: auto !important;
	max-width: 96% !important;
	width: 96% !important;
}
.table.responsiveContent {
	/* Content in catalog  occupying full width of cell */
	height: auto !important;
	max-width: 96% !important;
	width: 96% !important;
}
.top {
	/* Header columns occupying full width */
	height: auto !important;
	max-width: 100% !important;
	width: 100% !important;
}
.catalog {
	margin-left: 0%!important;
}
button {
	width: 90%!important;
}
}
	.punteado{
  border-style: dotted;
   border-width: 1px;
   border-color: 660033;
   background-color: cc3366;
   font-family: verdana, arial;
   font-size: 10pt;
}
</style>
</head>
<body yahoo="yahoo">
<table width="100%"  >
  <tbody>
    <tr>
      <td><table width="600"  align="center" >
          <!-- Main Wrapper Table with initial width set to 60opx -->
          <tbody>
            <tr>
              <td style="padding-top: 5%"><table bgcolor="#2D2E82" class="top" width="48%"  align="center"  style="padding:10px 10px 10px 10px;">
                  <!-- First header column with Logo -->
                  <tbody >
                    <tr>
                      <td style="font-size: 18
								 px; color:#FFFFFF; text-align:center; font-family: sans-serif; ">EP TECHNOLOGIES</td>
                    </tr>
                  </tbody>
                </table>
</td>
            </tr>
            <tr>
              <!-- HTML Spacer row -->
              <td style="font-size: 0; line-height: 0;" height="20"><table width="96%" align="left">
                  <tr>
                    <td style="font-size: 0; line-height: 0;" height="20">&nbsp;</td>
                  </tr>
                </table></td>
            </tr>
            <tr>
              <!-- HTML IMAGE SPACER -->
              <td style="font-size: 0; line-height: 0;" height="20"><table align="center" >
                  <tr>
                    <td ><img src="https://storeep.000webhostapp.com/assets/images/logo1.png"  alt="" height="" width="90%" class=""></td>
                  </tr>
                </table></td>
            </tr>
            <tr>
              <!-- HTML Spacer row -->
              <td style="font-size: 0; line-height: 0;" height="20"><table width="96%" align="left">
                  <tr>
                    <td style="font-size: 0; line-height: 0;" height="20">&nbsp;</td>
                  </tr>
                </table></td>
            </tr>
            <tr>
              <!-- Introduction area -->
              <td><table width="96%"  align="left">
                  <tr>
                    <!-- row container for TITLE/EMAIL THEME -->
                    <td align="center"bgcolor="#2D2E82" style="font-size: 32px; font-weight: 300; line-height: 2.5em; color: #FFFFFF; font-family: sans-serif;"style="padding:10px 10px 10px 10px;">DATOS DE PAGO</td>
                  </tr>
                  <tr>
                    <td style="font-size: 0; line-height: 0;" height="20"><table width="96%" align="left">
                        <tr>
                          <!-- HTML Spacer row -->
                          <td style="font-size: 0; line-height: 0;" height="20">&nbsp;</td>
                        </tr>
                      </table></td>
                  </tr>
                  <tr>
                    <!-- Row container for Intro/ Description -->
                    <td align="left" style="font-size: 14px; font-style: normal; font-weight: 100; color: #929292; line-height: 1.8; text-align:justify; padding:10px 20px 0px 20px; font-family: sans-serif;">

							<p>Fecha: {{$fecha}}</p>
							<p>Cliente: {{$cliente->nombre_persona.' '.$cliente->apellido_persona}}</p>
							<p>Cedula Cliente: {{$cliente->dni}}</p>
							<p>Pedido Nro: {{$num_comprobante}}</p>
                            <p>Fecha de Emision: {{$fecha}}</p>
                            <p>Total a Pagar: {{$precio}}</p>
						<table class="punteado">
		</table>
						</td>
                  </tr>
                </table></td>
            </tr>
          </tbody>
        </table></td>
    </tr>
  </tbody>
</table>
</body>
</html>
