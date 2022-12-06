<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';
/* 1. Entrar a la cuenta gmail.
2. Gestionar tu cuenta
3. Poner en la barra "Acceso de aplicaciones poco seguras"
4. Permitir
*/

// TRUE O FALSE EN LA OPCIÓN QUE QUIERAS AÑADIR
// CONTRASEÑA DE REGISTRO.-------------------------------------------
include("../conexion/db.php");
//echo 'entra';
if (isset($_GET['correo'])) {


	$email = strtolower(trim($_GET['correo']));	
	$fecha = trim($_GET['fecha']);	
	$hora = trim($_GET['hora']);		
	$tipo_visita = strtolower(trim($_GET['tipo']));	
	if($tipo_visita == "presencial"){
		$tipo = "en la CLINICA, la dirección es LLano Subercaseaux 3003 departamento 111, San Miguel, metro El Llano.";
	}else if($tipo_visita == "domicilio"){
		$tipo = "en su DOMICILIO";
	}
	$longitud = 10;
	$opcLetra = TRUE;
	$opcNumero = TRUE;
	$opcMayus = TRUE;
	$opcEspecial = TRUE;
	$letras ="abcdefghijklmnopqrstuvwxyz";
	$numeros = "1234567890";
	$letrasMayus = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
	$especiales ="@#$%()=*+-_";
	$listado = "";
	$password = "";
	if ($opcLetra == TRUE) $listado .= $letras;
	if ($opcNumero == TRUE) $listado .= $numeros;
	if($opcMayus == TRUE) $listado .= $letrasMayus;
	if($opcEspecial == TRUE) $listado .= $especiales;

	for( $i=1; $i<=$longitud; $i++) {
		$caracter = $listado[rand(0,strlen($listado)-1)];
		$password.=$caracter;
		$listado = str_shuffle($listado);
	}
	// echo $password; //contraseña provisoria
	// echo $email;
	// echo $_GET['p'];
	$hash = password_hash($password, PASSWORD_BCRYPT);
	$consulta = "UPDATE atencionpodologica.doctor SET password = '$hash' WHERE correo ='$email'"; 
	$resultado = mysqli_query($con,$consulta);
	//--------------------------------------------------------------



	$mail = new PHPMailer(true);

	try {
		//Server settings
		$mail->SMTPDebug = 0;                      // Enable verbose debug output
		$mail->IsSMTP();                                            // Send using SMTP
		$mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
		$mail->SMTPAuth   = true;                                   // Enable SMTP authentication
		$mail->Username   = "conisepu09@gmail.com";                     // SMTP username
		$mail->Password   = 'coodclpijgyrvlfv';                               // SMTP password
		$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
		$mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

		//Recipients
		$mail->setFrom('conisepu09@gmail.com', 'MediPod');

		$mail->addAddress($email);               // Name is optional
		/*$mail->addReplyTo('info@example.com', 'Information');
		$mail->addCC('cc@example.com');
		$mail->addBCC('bcc@example.com');*/

		/* Attachments
		$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
		$mail->addAttachment('/tmp/image.jpg', 'new.jpg'); */   // Optional name

		// Content
		$mail->isHTML(true);                                  // Set email format to HTML

		if($_GET['p'] == "desagendar"){// es porque patricia esta tomando horas o vacaciones y va a desagendar pacientes.
			$mail->Subject = 'Desagendacion de Hora Podologica';
			$mail->Body    = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
			<html xmlns="http://www.w3.org/1999/xhtml" lang="en-GB">
			<head>
				<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
				<title>Demystifying Email Design</title>
				<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
				<style type="text/css">
					a[x-apple-data-detectors] {color: inherit !important;}
				</style>
			</head>
			<body style="margin: 0; padding: 0;">
				<table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%">
					<tr>
						<td style="padding: 20px 0 30px 0;">
						<table align="center" border="0" cellpadding="0" cellspacing="0" width="600" style="border-collapse: collapse; border: 1px solid #cccccc;">
							<tr>
						<td align="center" bgcolor="#FFFFFF" style="padding: 40px 0 30px 0;">
						
							<img src="https://i.imgur.com/FSDN6YZ.jpeg" alt="EagleCopters" width="500" height="200" style="display: block;" />
						</td>
				</tr>
				<tr>
					<td bgcolor="#1977cc" style="padding: 40px 30px 40px 30px;">
						<table border="0" cellpadding="0" cellspacing="0" width="100%" style="border-collapse: collapse;">
							<tr>
								<td style="color: #fff; font-family: Arial, sans-serif;">
									<h1 style="font-size: 24px; margin: 0;">Buenos Dias, se le envia este correo ya que la Podologa Patricia Irigoin no atenderá estos días, se le volverá a avisar cuando estará disponible nuevamente</h1>
								</td>
							</tr>
							<tr>
								<td style="color: #fff; font-family: Arial, sans-serif; font-size: 16px; line-height: 24px; padding: 20px 0 30px 0;">
									<p style="margin: 0;">Por lo tanto la Cita que tenia el dia '.$fecha.' a las '.$hora.' ya no se realizará, cuando la Podologa vuelva se le avisará para que vuelva a agendar.</p>
								</td>
							</tr>
							<tr>
								<td>
									<table border="0" cellpadding="0" cellspacing="0" width="100%" style="border-collapse: collapse;">
										<tr>
											<td width="260" valign="top">
												<table border="0" cellpadding="0" cellspacing="0" width="100%" style="border-collapse: collapse;">
													<tr>
														<td>
														</td>
													</tr>
													<tr>
														<td style="color: #fff; font-family: Arial, sans-serif; font-size: 16px; line-height: 24px; padding: 25px 0 0 0;">
															<p style="margin: 0;">Para cualquier consulta el contacto es:</p>
															<br>
															<p style="margin: 0; color: #fff; "> Correo <a style="text-decoration:none; color: #ffffff;">patyirigoin@yahoo.es</a></p>
															<p style="margin: 0;"> Celular +56 9 72125502</p>
														</td>
													</tr>
												</table>
											</td>
											<td style="font-size: 0; line-height: 0;" width="20">&nbsp;</td>
											<td width="260" valign="top">
												<table border="0" cellpadding="0" cellspacing="0" width="100%" style="border-collapse: collapse;">
													<tr>
														<td>
														</td>
													</tr>
													<tr>
														<td style="color: #fff; font-family: Arial, sans-serif; font-size: 16px; line-height: 24px; padding: 25px 0 0 0;">
															<p style="margin: 0;">Recuerde nunca entregar sus datos personales a terceros. Nunca le pediremos datos personales por correo.</p>
														</td>
													</tr>
												</table>
											</td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td bgcolor="#ffffff" style="padding: 30px 30px;">
						<table border="0" cellpadding="0" cellspacing="0" width="100%" style="border-collapse: collapse;">
							<tr>
								
								<td align="right">
									<table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse;">
									</table>
								</td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
						</td>
					</tr>
				</table>
			</body>
			</html>';
		}elseif($_GET['p'] == "desNormal" || $_GET['p'] == "desNormalP" || $_GET['p'] == "desNormalPadmin"){

			$mail->Subject = 'Cancelacion de cita';
			$mail->Body    = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
			<html xmlns="http://www.w3.org/1999/xhtml" lang="en-GB">
			<head>
				<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
				<title>Demystifying Email Design</title>
				<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
				<style type="text/css">
					a[x-apple-data-detectors] {color: inherit !important;}
				</style>
			</head>
			<body style="margin: 0; padding: 0;">
				<table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%">
					<tr>
						<td style="padding: 20px 0 30px 0;">
						<table align="center" border="0" cellpadding="0" cellspacing="0" width="600" style="border-collapse: collapse; border: 1px solid #cccccc;">
							<tr>
						<td align="center" bgcolor="#FFFFFF" style="padding: 40px 0 30px 0;">
						
							<img src="https://i.imgur.com/FSDN6YZ.jpeg" alt="EagleCopters" width="500" height="200" style="display: block;" />
						</td>
				</tr>
				<tr>
					<td bgcolor="#1977cc" style="padding: 40px 30px 40px 30px;">
						<table border="0" cellpadding="0" cellspacing="0" width="100%" style="border-collapse: collapse;">
							<tr>
								<td style="color: #fff; font-family: Arial, sans-serif;">
									<h1 style="font-size: 24px; margin: 0;">Cancelacion de cita hecha correctamente</h1>
								</td>
							</tr>
							<tr>
								<td style="color: #fff; font-family: Arial, sans-serif; font-size: 16px; line-height: 24px; padding: 20px 0 30px 0;">
									<p style="margin: 0;">Se cancela la cita del dia '.$fecha.' a las '.$hora.'</p>
								</td>
							</tr>
							<tr>
								<td>
									<table border="0" cellpadding="0" cellspacing="0" width="100%" style="border-collapse: collapse;">
										<tr>
											<td width="260" valign="top">
												<table border="0" cellpadding="0" cellspacing="0" width="100%" style="border-collapse: collapse;">
													<tr>
														<td>
														</td>
													</tr>
													<tr>
														<td style="color: #fff; font-family: Arial, sans-serif; font-size: 16px; line-height: 24px; padding: 25px 0 0 0;">
															<p style="margin: 0;">Puede volver a agendar para otro dia ingresado a la página web o contactandose con la podologa:</p>
															<br>
															<p style="margin: 0; color: #fff; "> Correo <a style="text-decoration:none; color: #ffffff;">patyirigoin@yahoo.es</a></p>
															<p style="margin: 0;"> Celular +56 9 72125502</p>
														</td>
													</tr>
												</table>
											</td>
											<td style="font-size: 0; line-height: 0;" width="20">&nbsp;</td>
											<td width="260" valign="top">
												<table border="0" cellpadding="0" cellspacing="0" width="100%" style="border-collapse: collapse;">
													<tr>
														<td>
														</td>
													</tr>
													<tr>
														<td style="color: #fff; font-family: Arial, sans-serif; font-size: 16px; line-height: 24px; padding: 25px 0 0 0;">
															<p style="margin: 0;">Recuerde nunca entregar sus datos personales a terceros. Nunca le pediremos datos personales por correo.</p>
														</td>
													</tr>
												</table>
											</td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td bgcolor="#ffffff" style="padding: 30px 30px;">
						<table border="0" cellpadding="0" cellspacing="0" width="100%" style="border-collapse: collapse;">
							<tr>
								
								<td align="right">
									<table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse;">
									</table>
								</td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
						</td>
					</tr>
				</table>
			</body>
			</html>';

		}elseif($_GET['p'] == "password"){
			$mail->Subject = 'Solicitud de cambio de clave de ingreso';
			$mail->Body    = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
			<html xmlns="http://www.w3.org/1999/xhtml" lang="en-GB">
			<head>
				<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
				<title>Demystifying Email Design</title>
				<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
				<style type="text/css">
					a[x-apple-data-detectors] {color: inherit !important;}
				</style>
			</head>
			<body style="margin: 0; padding: 0;">
				<table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%">
					<tr>
						<td style="padding: 20px 0 30px 0;">
						<table align="center" border="0" cellpadding="0" cellspacing="0" width="600" style="border-collapse: collapse; border: 1px solid #cccccc;">
							<tr>
						<td align="center" bgcolor="#FFFFFF" style="padding: 40px 0 30px 0;">
						
							<img src="https://i.imgur.com/FSDN6YZ.jpeg" alt="EagleCopters" width="500" height="200" style="display: block;" />
						</td>
				</tr>
				<tr>
					<td bgcolor="#1977cc" style="padding: 40px 30px 40px 30px;">
						<table border="0" cellpadding="0" cellspacing="0" width="100%" style="border-collapse: collapse;">
							<tr>
								<td style="color: #fff; font-family: Arial, sans-serif;">
									<h1 style="font-size: 24px; margin: 0;">Le confirmamos la hora solicitada para la sesion Podologica en nuestra clinica MediPod</h1>
								</td>
							</tr>
							<tr>
								<td style="color: #fff; font-family: Arial, sans-serif; font-size: 16px; line-height: 24px; padding: 20px 0 30px 0;">
									<p style="margin: 0;">Su contraseña provisoria es: '.$password.' una vez ingresado a su cuenta cambiela por una nueva para más seguridad</p>
								</td>
							</tr>
							<tr>
								<td>
									<table border="0" cellpadding="0" cellspacing="0" width="100%" style="border-collapse: collapse;">
										<tr>
											<td style="font-size: 0; line-height: 0;" width="20">&nbsp;</td>
											<td width="260" valign="top">
												<table border="0" cellpadding="0" cellspacing="0" width="100%" style="border-collapse: collapse;">
													<tr>
														<td style="color: #fff; font-family: Arial, sans-serif; font-size: 16px; line-height: 24px; padding: 25px 0 0 0;">
															<p style="margin: 0;">Recuerde nunca entregar sus datos personales a terceros. Nunca le pediremos datos personales por correo.</p>
														</td>
													</tr>
												</table>
											</td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td bgcolor="#ffffff" style="padding: 30px 30px;">
						<table border="0" cellpadding="0" cellspacing="0" width="100%" style="border-collapse: collapse;">
							<tr>
								
								<td align="right">
									<table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse;">
									</table>
								</td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
						</td>
					</tr>
				</table>
			</body>
			</html>';
		}else{
			$mail->Subject = 'Solicitud de Hora Podologica';
			$mail->Body    = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
			<html xmlns="http://www.w3.org/1999/xhtml" lang="en-GB">
			<head>
				<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
				<title>Demystifying Email Design</title>
				<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
				<style type="text/css">
					a[x-apple-data-detectors] {color: inherit !important;}
				</style>
			</head>
			<body style="margin: 0; padding: 0;">
				<table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%">
					<tr>
						<td style="padding: 20px 0 30px 0;">
						<table align="center" border="0" cellpadding="0" cellspacing="0" width="600" style="border-collapse: collapse; border: 1px solid #cccccc;">
							<tr>
						<td align="center" bgcolor="#FFFFFF" style="padding: 40px 0 30px 0;">
						
							<img src="https://i.imgur.com/FSDN6YZ.jpeg" alt="EagleCopters" width="500" height="200" style="display: block;" />
						</td>
				</tr>
				<tr>
					<td bgcolor="#1977cc" style="padding: 40px 30px 40px 30px;">
						<table border="0" cellpadding="0" cellspacing="0" width="100%" style="border-collapse: collapse;">
							<tr>
								<td style="color: #fff; font-family: Arial, sans-serif;">
									<h1 style="font-size: 24px; margin: 0;">Le confirmamos la hora solicitada para la sesion Podologica en nuestra clinica MediPod</h1>
								</td>
							</tr>
							<tr>
								<td style="color: #fff; font-family: Arial, sans-serif; font-size: 16px; line-height: 24px; padding: 20px 0 30px 0;">
									<p style="margin: 0;">El dia '.$fecha.' tiene cita a las '.$hora.' y su tipo de visita es '.$tipo.'  </p>
								</td>
							</tr>
							<tr>
								<td>
									<table border="0" cellpadding="0" cellspacing="0" width="100%" style="border-collapse: collapse;">
										<tr>
											<td width="260" valign="top">
												<table border="0" cellpadding="0" cellspacing="0" width="100%" style="border-collapse: collapse;">
													<tr>
														<td>
														</td>
													</tr>
													<tr>
														<td style="color: #fff; font-family: Arial, sans-serif; font-size: 16px; line-height: 24px; padding: 25px 0 0 0;">
															<p style="margin: 0;">Puede cambiar su cita con 24 hrs de anticipación, ingresado a la página web o contactandose con nosotros:</p>
															<br>
															<p style="margin: 0; color: #fff; "> Correo <a style="text-decoration:none; color: #ffffff;">patyirigoin@yahoo.es</a></p>
															<p style="margin: 0;"> Celular +56 9 72125502</p>
														</td>
													</tr>
												</table>
											</td>
											<td style="font-size: 0; line-height: 0;" width="20">&nbsp;</td>
											<td width="260" valign="top">
												<table border="0" cellpadding="0" cellspacing="0" width="100%" style="border-collapse: collapse;">
													<tr>
														<td>
														</td>
													</tr>
													<tr>
														<td style="color: #fff; font-family: Arial, sans-serif; font-size: 16px; line-height: 24px; padding: 25px 0 0 0;">
															<p style="margin: 0;">Recuerde nunca entregar sus datos personales a terceros. Nunca le pediremos datos personales por correo.</p>
														</td>
													</tr>
												</table>
											</td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td bgcolor="#ffffff" style="padding: 30px 30px;">
						<table border="0" cellpadding="0" cellspacing="0" width="100%" style="border-collapse: collapse;">
							<tr>
								
								<td align="right">
									<table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse;">
									</table>
								</td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
						</td>
					</tr>
				</table>
			</body>
			</html>';
		}
		/*$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';*/
		$mail->send();
		if($_GET['p'] == "publico" || $_GET['p'] == "desNormalP"){
			header('Location: ../index.php?noti=T#calendar_sec');
		}elseif($_GET['p'] == "desNormalPadmin" || $_GET['p'] == "publicoadmin"){
			header('Location: ../index.php?admin=admin&noti=T#calendar_sec');
		}else if($_GET['p'] == "desagendar"){
			return 0;
		}else if($_GET['p'] == "password"){
			header('Location: ../login.php?noti=T');
		}else{
			//echo "es administrador";
			header('Location: ../podologo.php?noti=T#calendar_secP');
		}
		
		//echo 'El mensaje se envió correctamente';
	} catch (Exception $e) {
		echo "El mensaje no se envió. Mailer Error: {$mail->ErrorInfo}";
	}
}
?>