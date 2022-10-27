<?php
   /*
   primer parametro = direccion en donde se encuentra la BD.
   segundo parametro = usuario 
   tercer parametro = contrasena
   cuarto parametro = nombre de la base de datos
   quinto parametro(opcional) = puerto
   */

   session_start();
   
   $conn = mysqli_connect(
       'localhost',
       '',
       '',
       ''
   );

   if(isset($conn)){
       echo "<script>console.log('Conectado a BD')</script>";
   }else{
       echo "<script>console.log('Sin conexion a BD')</script>";
   }


?>