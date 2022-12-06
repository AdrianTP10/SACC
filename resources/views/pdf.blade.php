<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        table,th,td{
            border: black 1px solid;
            border-collapse: collapse;
            width: 100%;
            font-family:Helvetica;
            padding: 4px;
        }
        p{
            text-align: justify;
            font-family:Helvetica;
            font-size: 18px;
            width: 100%;
        }
        .div{
            box-sizing: border-box;
            width: 90%;
            align-content: center;
            align-self: center;
            margin-top:  2%;
            margin-left: 5%;
            margin-right: 5%;
            margin-bottom: 6%
        }
        .firma{
            width: 48%;
            box-sizing:border-box;
            margin: 5px;
            text-align: left;
            font-family:Helvetica;
            font-size: 18px;
        }
    </style>
</head>
<body>
    <div class="div">
        <table>
            <tr>
              <th rowspan="3"  style="width: 100px"><img height="63px" width="113px" src="C:\wamp64\www\proyectos\inertia-test\public\img\logotec.png"></th>
              <th style="width: 300px; height:20px;">FORMATO</th>
              <th style="width: 100px">Versión:</th>
              <th style="width: 100px">0</th>
            </tr>
            <tr>
              <td rowspan="2">CONSTANCIA DE CUMPLIMIENTO DE ACTIVIDAD COMPLEMENTARIA</td>
              <td>Fecha</td>
              <td>{{date('d-m-Y');}}</td>
            </tr>
            <tr>
                <td>Página:</td>
                <td>1 de 1</td>
              </tr>
          </table>

    </div>
   
    <div class="div">
        <p><b>ME. JUAN MANUEL BANDA MORENO <br>
            Jefe(a) de Departamento de Servicios Escolares <br>
            Presente</b>
        </p><br>
        <p> &nbsp;&nbsp;&nbsp;&nbsp;El que suscribe {{$jefe}}, por este medio se permite hacer de 
          su conocimiento que el (la) estudiante <b>{{mb_strtoupper($alumno["nombre"])}}</b> con número
          de control <b>{{$alumno["no_control"]}}</b> de la carrera de {{mb_strtoupper($alumno["carrera"])}} ha cumplido su 
          actividad complementaria <b>{{mb_strtoupper($actividad["descripcion"])}}</b>; con un nivel de desempeño BUENO y un valor numérico
          de {{$actividad["valor"]}}, durante el período escolar <b>{{strtoupper($actividad["periodo"])}}</b> con un valor
          curricular de <b>{{$actividad["valor"]}} créditos.</b></p>
          
        <p>Se extiende la presente en Ciudad Valles, San Luis Potosí.</p><br>
        
        <div class='div' style="align-items: center">
            {{-- <img style="margin-left: 185px" height="150px" height="150px" src="C:\wamp64\www\sacc_cb\public\vendor\crudbooster\assets\sello.png" alt="sello_tec"> --}}
        </div>

        <br><br><br><br><br><br><br><br><br><br><br><br>
        <div style="width: 100%; display:flex;">
            <div class="firma" style="float: left;">
                <u>{{$responsable}}</u><br>
                Nombre y firma del(de la) profesor(a) responsable 
            </div>
            <div class="firma" style="float: right;">
                <u>{{$jefe}}</u><br>
                Vo.Bo. Jefe de Departamento 
            </div>
        </div>
        
        <br><br><p style="margin-top: 10%">c.c.p. Jefe(a) de Departamento correspondiente</p>
    </div>
      

</body>
</html>