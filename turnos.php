﻿<!doctype html>
<html>
	<head>
	
    	<meta charset="utf-8">
	
    	<title>Turnos</title>
    
        <link rel="stylesheet" type="text/css" href="css/generales.css">
        <link rel="stylesheet" type="text/css" href="css/turnos.css">
        <link rel="stylesheet" type="text/css" href="css/responsivo-turnos.css">
    
    </head>
	<body>
    	
        <div class="contenedor-principal">
        	

            <?php

                require_once('funciones/conexion.php');
                require_once('funciones/funciones.php');
                
                //datos de la empresa
                $sql = "select * from info_empresa";
                $error = "Error al cargar datos de la empresa ";
                $search = consulta($con, $sql, $error);
                    
                $info = mysqli_fetch_assoc($search); 


                //turno atendido
                $sqlTA = "select turno, idCaja from atencion order by turno desc";
                $errorTA = "Error al cargar el turno atendido";
                $searchTA = consulta($con, $sqlTA, $errorTA);

                if(mysqli_num_rows($searchTA) > 1){

                    $turno = mysqli_fetch_assoc($searchTA);
                    $numeroTurno = $turno['turno'];
                    $caja = $turno['idCaja'];

                }else{

                    $numeroTurno = '000';
                    $caja = '0';

                }
                
                
                //ultimos 5 turnos atendidos
                $sqlUT = "select id, turno, idCaja from atencion order by turno desc limit 5";
                $errorUT = "Error al cargar los ultimos 5 turnos atendidos";
                $searchUT = consulta($con, $sqlUT, $errorUT);

            ?>

            <header>

                <div class="marco-tablaTurnos">
        
                    <div class="contenedor-tablaTurnos">
                        <div class="columna-tablaTurnos">
                            <div class="columna-tablaTurnos c1">
                                <div class="cont-logo">
                                    <img src="<?php echo $info['logo'];?>">
                                </div>
                            </div>
                        </div>
                        <div class="columna-tablaTurnos">
                            <div class="columna-tablaTurnos c2">
                                <div class="tabla-turnosArriba">Turno</div>
                                <div class="tabla-turnosAbajo" id="verTurno"><?php echo $numeroTurno; ?></div>
                            </div>
                        </div>
                        <div class="columna-tablaTurnos">
                            <div class="columna-tablaTurnos c3">
                                <div class="tabla-turnosArriba">Ventanilla</div>  
                                <div class="tabla-turnosAbajo" id="verCaja"><?php echo $caja; ?></div>
                            </div>
                        </div>
                    </div>
        
                </div>
            
            </header>

            <section class="contenido">
                        
                <div class="contenido-izquierda">
                    <div class="contenedor-video">
                        <div class="contenedor-reproductor">
                            <video id="video-geoportal" autoplay loop>
                                <source src="img/VID_20240516_ACC.mp4" type="video/mp4">
                            </video>
                        </div>
                    </div>
                </div>
                <div class="contenido-derecha">

                    <div class="contenedor-turnos">
                    
                         <table class="tabla-turnos" id="tabla-turnos">
                            <tr><th>Turno</th><th colspan="2">Ventanilla</th></tr>
                            <?php  

                                if(mysqli_num_rows($searchUT) != 0){

                                    $c = 0;
                                    $data = '';

                                    while ($row = mysqli_fetch_assoc($searchUT)){
                                        
                                        //if($c > 0){

                                        $data .=  $row['turno'].'|'.$row['idCaja'].'|tr|';

                                        echo "<tr><td><span  class='primer-fila'>$row[turno]</span></td><td class='td-caja'><span class='caja primer-fila'></span></td><td class='no-caja'><span  class='primer-fila'>$row[idCaja]</span></td></tr>";

                                        $c++;    
                                        
                                    }

                                }

                            ?>
                            
                        </table>

                        <input type="hidden" name="turnos" id="turnos" value="<?php echo $data; ?>">
                    
                    </div><!--contenedor turnos-->

                </div>
        		
            </section><!--contenido-->
            
            <footer class="footer">
                
                <marquee class="noticias">La Agencia Catastral de Cundinamarca, está comprometida con brindar el mejor servicio para sus diferentes públicos de interés. En este espacio de atención podrá ser parte activa de la Agencia y acceder a servicios y trámites.</marquee>

            </footer>
			
            
        </div><!--contenedor principal-->
        
        <audio src="tonos/hangouts_message.ogg" id="tono"></audio>
		
        <script src="js/funcionesGenerales.js"></script>
		<script src="js/websocket.js"></script>
 
    </body>

</html>
