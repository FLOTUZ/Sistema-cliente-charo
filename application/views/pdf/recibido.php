<!DOCTYPE html>
<html>
<head>
	<title>Formato de Recibido</title>
<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">	
<style type="text/css">

   @page { margin: 100px 50px; }
    #header { position: fixed; left: 0px; top: -50px; right: 10px; height: 150px; text-align: center; }
    #footer { position: fixed; left: 10px; bottom: -10px; right: 0px; height: 150px; }
    #footer .page:after { content: counter(page, upper-roman); }

	body {
		width: 90%;
		margin: 0 auto;
	}
	h1 {
		font-family: "Helvetica";
		color:#000;
		font-size: 12px;
		text-align: center;
		font-weight: bold;
	}

	h2 {
		font-family: "Helvetica";
		color:#00569b;
		font-size: 16px;
		font-weight: 200px;
		line-height: 16px;
	}

	h3 {
		font-family: "Helvetica";
		color:#00569b;
		font-size: 12px;
		font-weight: 200px;
	}


	p, ul, li{
		font-family: "Helvetica";
		color:#000;
		font-size: 12px;
		font-weight: 200px;
		text-align: justify;
	}
	.fecha{
		text-align: right;
		font-family: "Helvetica";
		font-size: 14px;
		color:#00569b;
		width: 100%;				
	}

	.destinatario {
		font-weight: 100px;
		line-height: 5px;
		letter-spacing: 3px;
	}
	.tabla{
		width: 90%;
		text-align: left;
		font-family: "Helvetica";
		color: #00569b;
		font-size: 12px;
	}
	.step1{
		background: url("<?= FCPATH?>assets/img/step1.png") top center no-repeat;
		width: 161px;
		height: 158px;
    	padding-left: 22px;
	}
	.step2{
		background: url("<?= FCPATH?>assets/img/step2.png") top center no-repeat;
		width: 161px;
		height: 158px;
    	padding-left: 22px;		
	}
	.step3{
		background: url("<?= FCPATH?>assets/img/step3.png") top center no-repeat;
		width: 161px;
		height: 158px;
	}		
	.firma{
		background: url("<?= FCPATH?>assets/img/firma.png") -20px center no-repeat;
		font-family: "Helvetica";
		font-size: 16px;
	}
	.firmante {
		color:#00569b;
	}
	.firmante_titulo {
		color:#00569b;
		font-style: italic;
	}
	.mark{
		color:#00569b;
		font-size: 14px;
		padding: 7px;
	}

	.form_table{
		width: 100%;
	}
	.form_label{
		width: 100%;
		text-align: center;
		font-family: "Helvetica";
		font-size: 12px;		
	}
	.td_border{
		border: 1px solid #00569b;
		text-align: center;
		font-family:  "Helvetica";
		color: #00569b;
		font-size: 14px;
	}

	.table_100{
		width: 100%;
		font-family: "Helvetica";
		font-size: 14px;
	}
	.table_t{
		font-family: "Helvetica";
		font-size: 12px;	
	}
	.bold_t{
		font-weight: bold;
	}
	.justif_t{
		text-align: justify;
	}
	.top_t{
		vertical-align: top;
	}
	.pad_l_20{
		padding-left: 20px; 
	}
	.cent_t{
		text-align: center;
	}
</style>
</head>
<body>
	<div id="header"><img src="<?= FCPATH?>assets/img/logo.png" width="120px"></div>
	<div id="footer"><img src="<?= FCPATH?>assets/img/logo.png" width="300px"></div>
	<br/><br/>
	<h1>FORMATO DE RECIBIDO</h1>
	<p class="fecha">Charo, Michoacán. <?= $fecha?></p>
	<hr><br/><br/>
	<table class="table_100">
        <tr>
          <td colspan="4" class="cent_t">Nombre: <b id="nombre"><?=$solicitud->nombre?></b></td>
        </tr> 
        <tr>
          <td>Tenencia:</td>
          <td><b id="tenencia"><?=$solicitud->tenencia?></b></td>
          <td>Comunidad:</td>
          <td><b id="comunidad"><?=$solicitud->comunidad?></b></td>
        </tr>
        <tr>
          <td>Cantidad solicitada: </td>
          <td><b id="cantidad"><?=$solicitud->cantidad?> <?=$solicitud->unidad?></b></td>
          <td>Apoyo:</td>
          <td><b id="apoyo"><?=$solicitud->apoyo?></b></td>
        </tr>
        <tr>
          <td>Fecha de solicitud:</td>
          <td><b id="fecha"><?=$solicitud->fecha?></b></td>
          <td>Estatus:</td>
          <td><b id="estatusB"><?=$solicitud->estatus?></b></td>
        </tr>
        <tr>
          <td>Costo:</td>
          <td><b id="costo"><?=$solicitud->costo?></b></td>
          <td>Folio: </td>
          <td><b><?=$solicitud->folio?></b></td>
        </tr>
        <tr>
        	<td colspan="4">Descripción: <b><?=$solicitud->descripcion?></b></td>
        </tr>
    </table>
    <br/><br/>
	<table class="table_100"> 
	    <tr>
	      <td>Fecha de autorización: <br><b id="fechaAu"><?=$solicitud->fecha_autorizo?></b></td>
	      <td>Autorizo: <br><b id="autorizo"><?=$solicitud->autorizo?></b></td>
	      <td>Cantidad Autorizada: <br><b id="cautorizada"><?=$solicitud->cautorizada?></b></td>
	      <td>Entrego: <br><b id="entrego"><?=$solicitud->entrego?></b></td>
	    </tr>
	</table>
	<br/><br/><br/>
	<p class="cent_t">__________________</p>
    <p class="bold_t cent_t">FIRMA DE RECIBIDO<br/><?=$solicitud->nombre?></p>       
</body>
</html>