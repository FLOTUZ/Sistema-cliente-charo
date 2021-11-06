<!DOCTYPE html>
<html>
<head>
  <title>Listado</title>
  <style type="text/css">
    table, td, th {
      border: 1px solid black;
    }
    table {
      width: 100%;
      border-collapse: collapse;
    }
    table th {
      font-size: 14px;
      font-weight: bold;
      background-color: #ff5ce3;
      color: #ffffff; 
    }
    table td {
      font-size: 12px; 
    }
  </style>
</head>
<body>
  <center>
    <h3>Listado de programa de sanitización.</h3>
  </center>
  <table>
    <thead>
      <tr>
        <th>#</th>
        <th>Responsable</th>
        <th>Dirección</th>
        <th>Teléfono</th>
        <th>Giro Comercial</th>
        <th>Fecha</th>
        <th>Estatus</th>
      </tr>
    </thead>
    <tbody id="listadoBody">
      <?php 
        if($listado->num_rows() > 0){
          $i = 1;
          foreach($listado->result() as $row){
            echo "<tr>";
            echo "<td>".$i."</td>";
            echo "<td>".$row->responsable."</td>";
            echo "<td>".$row->direccion."</td>";
            echo "<td>".$row->telefono."</td>";
            echo "<td>".$row->giro."</td>";
            echo "<td>".$row->fecha."</td>";
            switch($row->estatus){
              case 1:
               echo "<td style='color:#ffc107;'><b>PENDIENTE</b></td>";
              break;
              case 2:
                echo "<td style='color:#28a745;'><b>SANITIZADO</b></td>";
              break;
              default:
              
              break;
            }
            echo "</tr>";
            $i++;
          }
        } 
      ?>
    </tbody>
  </table>
  <br/>
  <?= date('Y-m-d H:i:s');?>
</body>
</html>