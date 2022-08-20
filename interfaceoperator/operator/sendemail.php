<!-- Source code untuk mengirim data ID dan Password pengguna ke Email Pengguna -->

<?php
session_start();
if (empty($_SESSION['usernameop'])) {
	echo "<script>alert('You must login first to access this page, thank you.');document.location='../index.php'</script>";
}
?>

<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Include Library PHPMailer
include('PHPMailer/src/Exception.php');
include('PHPMailer/src/PHPMailer.php');
include('PHPMailer/src/SMTP.php');

//jika benar mendapatkan GET id dari URL
if (isset($_GET['ID'])) {
	//membuat variabel $id yang menyimpan nilai dari $_GET['ID']
	$ID = $_GET['ID'];
	$Nama = $_GET['Nama'];
    $zname_clean = preg_replace('/\s*/', '', $Nama);
    // convert the string to all lowercase
    $zname_clean = strtolower($zname_clean);
    $Email = $_GET['Email']; // Email penerima

    // Identitas pengirim
    $email_pengirim = 'ta212201002@gmail.com'; // Email Pengirim
    $nama_pengirim = 'facePresence';
    $subjek = 'ID dan Password untuk Akun Pengguna facePresence';
    $pesan = 'Akun anda memiliki ID User <b>'.$ID.'</b> dengan Password <b>'.$zname_clean.'</b>. Silahkan mencoba Login pada website dan lakukan registrasi wajah. Apabila terjadi kesalahan, segera hubungi operator.';

    // $mail = new PHPMailer\PHPMailer\PHPMailer();
    $mail = new PHPMailer;
    $mail->isSMTP();

    $mail->Host = 'smtp.gmail.com';
    $mail->Username = $email_pengirim;
    $mail->Password = 'iffaemxlgktsckmc';
    $mail->Port = 465;
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = 'ssl';
    $mail->SMTPDebug = 2; // Untuk debugging

    $mail->setFrom($email_pengirim, $nama_pengirim);
    $mail->addAddress($Email);
    $mail->isHTML(true);
    $mail->Subject = $subjek;
    $mail->Body = $pesan;

    $send = $mail->send();

	//jika email berhasil dikirim
	if ($send) {
        echo '<script>alert("Berhasil mengirim email."); document.location="index.php?page=tampil_pengguna";</script>';
	} else {
		echo '<script>alert("Email gagal dikirimkan."); document.location="index.php?page=tampil_pengguna";</script>';
	}
} else {
	echo '<script>alert("ID tidak ditemukan di database."); document.location="index.php?page=tampil_pengguna";</script>';
}

?>