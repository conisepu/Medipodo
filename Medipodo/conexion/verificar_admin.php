<?php 
 

include 'db.php';

if (isset($_POST['login'])) {
    
	    $correo = trim($_POST['correo']);
        $pass = trim($_POST['pass']);
	    $consulta = "SELECT PASS, ID_USUARIO FROM atencionpodologica.usuario WHERE CORREO='$correo'";
        $hash = mysqli_query($con,$consulta);
        
        
        
        while($hash2= $hash->fetch_assoc()){
            echo $hash2['PASS'];
            if (password_verify($pass, $hash2['PASS'])) {
                $contrass=$hash2['PASS'];
                $ID_Usuario=$hash2['ID_USUARIO'];
                echo '¡La contraseña es válida!';
                $consulta = "SELECT * FROM atencionpodologica.usuario WHERE CORREO='$correo' and PASS='$contrass'";
                $resultado = mysqli_query($con,$consulta);
            
                $filas=mysqli_num_rows($resultado);
            
                if($filas>0){

                    header('Location: ../podologo.php');
    
                }else {
                 echo 'La contraseña no es válida.';
                }
    
    
            }else {
                echo "Error en la verificacion";
            }
        }
        
        
        
    
}

?>

