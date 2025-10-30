<?php
  /**
  * Requires the "PHP Email Form" library
  * The "PHP Email Form" library is available only in the pro version of the template
  * The library should be uploaded to: vendor/php-email-form/php-email-form.php
  * For more info and help: https://bootstrapmade.com/php-email-form/
  */

 


    // Ambil data form
    $name    = $_POST['name'];
    $email   = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    // Nomor WA tujuan
    $target = "081524499660";

    // Token API kamu dari Fonnte (buat akun di https://fonnte.com)
    $token = "MASUKKAN_TOKEN_FONNTE_KAMU_DI_SINI";

    // Susun pesan
    $text = "Pesan baru dari Website:%0A".
            "Nama: $name%0A".
            "Email: $email%0A".
            "Subjek: $subject%0A".
            "Pesan:%0A$message";

    // Kirim ke API Fonnte
    $curl = curl_init();
    curl_setopt_array($curl, [
        CURLOPT_URL => "https://api.fonnte.com/send",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POST => true,
        CURLOPT_POSTFIELDS => [
            'target' => $target,
            'message' => $text,
        ],
        CURLOPT_HTTPHEADER => [
            "Authorization: $token"
        ],
    ]);
    $response = curl_exec($curl);
    curl_close($curl);

    // Beri respon ke user
    if ($response) {
      echo "<script>alert('Pesan berhasil dikirim ke WhatsApp!'); window.history.back();</script>";
    } else {
      echo "<script>alert('Gagal mengirim pesan.'); window.history.back();</script>";
    }




  // Replace contact@example.com with your real receiving email address
  $receiving_email_address = 'contact@example.com';

  if( file_exists($php_email_form = '../assets/vendor/php-email-form/php-email-form.php' )) {
    include( $php_email_form );
  } else {
    die( 'Unable to load the "PHP Email Form" Library!');
  }

  $contact = new PHP_Email_Form;
  $contact->ajax = true;
  
  $contact->to = $receiving_email_address;
  $contact->from_name = $_POST['name'];
  $contact->from_email = $_POST['email'];
  $contact->subject = $_POST['subject'];

  // Uncomment below code if you want to use SMTP to send emails. You need to enter your correct SMTP credentials
  /*
  $contact->smtp = array(
    'host' => 'example.com',
    'username' => 'example',
    'password' => 'pass',
    'port' => '587'
  );
  */

  $contact->add_message( $_POST['name'], 'From');
  $contact->add_message( $_POST['email'], 'Email');
  $contact->add_message( $_POST['message'], 'Message', 10);

  echo $contact->send();
?>
