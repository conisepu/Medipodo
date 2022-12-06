<?php 
session_start();
include("db.php");

if(isset($_SESSION['ID_Usuario'])){
    switch($_SESSION['ID_Usuario']){
        case 1: //entro podologo
            header('location: podologo.php');
        break;

        default: 
        header('location: index.php');
        break;
    }
}

if (isset($_POST['login'])) {
    
	    $correo = strtolower(trim($_POST['correo']));
        $pass = trim($_POST['pass']);
	    $consulta = "SELECT password, id FROM atencionpodologica.doctor WHERE correo='$correo'";
        $hash = mysqli_query($con,$consulta);
        
        
        if( mysqli_num_rows($hash) != 0){
            while($hash2= $hash->fetch_assoc()){
                //echo $hash2['password'];
                if (password_verify($pass, $hash2['password'])) {
                    $contrass=$hash2['password'];
                    $ID_Usuario=$hash2['id'];
                    //echo '¡La contraseña es válida!';
                    $consulta = "SELECT * FROM atencionpodologica.doctor WHERE correo='$correo' and password='$contrass'";
                    $resultado = mysqli_query($con,$consulta);
                
                    $filas=mysqli_num_rows($resultado);
                    
                    if($filas>0){
                        $_SESSION['ID_Usuario'] = $ID_Usuario;
    
                        if(isset($_SESSION['ID_Usuario'])){
                            switch($_SESSION['ID_Usuario']){
                                case 1: //entro podologo
                                    //echo "entro al podologo";
                                    header('location: ../podologo.php');
                                break;
                        
                                // default: 
                                // header('location: index.php');
                                // break;
                            }
                        }
        
                    }
        
        
                }else {
                        //echo "contraseña incorrecta";
                        header('Location:../login.php?fallo=true');
                }
            }
        }else {
            //echo "contraseña incorrecta";
            header('Location:../login.php?fallo=true');
        }
        
        
        
        
    
}

?>

