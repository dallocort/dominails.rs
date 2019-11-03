<?php
//value global reset initialisation
$rez  = $hvala = $name = $message = $hvala_posetilac = $posetilac = $name_error = $message_error = $posetilac_error = '';
// Checks if form has been submitted
if (isset($_GET['ime_prezime']) and isset($_GET['email']) and isset($_GET['poruka'])) {
  //ov F-JA dole MORA BITI  PRE POZIVA F-JE DEFINISANA, ILI GLOBALNO GORE ILI OVDE
  function clear_input($data)
  {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }
  if (empty($_GET["ime_prezime"])) {
    $name_error = "polje za ime je obavezno";
  } else {
    $name = clear_input($_GET["ime_prezime"]);
  }
  if (empty($_GET["poruka"])) {
    $message_error = "polje za poruku je obavezno";
  } else {
    $message = clear_input($_GET['poruka']);
  }
  if (empty($_GET["email"])) {
    $posetilac_error = "polje za e-mail je obavezno";
  } else {
    $posetilac = clear_input($_GET['email']);
    if (!filter_var($posetilac, FILTER_VALIDATE_EMAIL)) {
      $posetilac_error = "nije ispravan email";
    }
  }
  if ($name_error == '' and $message_error == '' and $posetilac_error == '') {
    $subject = "Poruka sa sajta Dominails.rs";
    $mailTo = "dominails_sa_sajta@dacha.rs";
    /*na ovaj mail se realno šale a on psrosleđuje na gmail, 
                    to je mail bez sandučeta samo prosleđivanje*/
    $mailFrom = "website@dominails.rs";
    /*ovo je izmišljeni mail, ne postoji */
    $headers .= 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
    $headers .= "From: $mailFrom\r\nReply-to: $posetilac";
    //može i Cc da se doda:
    //$headers .= 'Cc: myboss@example.com' . "\r\n";
    //Može i ovako ispred sa reči ispred adrese od koga je mail:
    // $headers="From: Proba <$mailFrom>\r\nReply-to: $posetilac";
    /* Mora da ide između \r\n  takva je sintaksa ako 
                    pišeš spojeno From: i Reply-to:*/
    $text = '
                    <html>
                    <head>    
                    <title>Dominails.rs</title>
                    </head>
                    <body>
                    <p style="margin-top:20px;color:gray;">Poštovana Sanja,</p>
                    <p><span style="color:gray">Imaš e-mail sa tvog sajta: </span>     
                    <a href="https://www.dominails.rs" target"_blank" style="text-decoration:none;">www.dominails.rs</a>    
                    </p>
                    <table style="text-align:left;margin-top:20px;">
                        <tr>
                        <th style="color:#ff5722;font-weight:normal;"><span style="color:gray;">Ime posetioca:</span>  ' . $name . '</th>
                        </tr>
                        <tr>
                        <td></td>
                        </tr> 
                        <tr>
                        <td></td>
                        </tr> 
                        <tr>
                        <td></td>
                        </tr> 
                        <tr>
                        <td style="color:gray">Poruka glasi:</td>
                        </tr>   
                        <tr>
                        <td></td>
                        </tr> 
                        <tr>
                        <td></td>
                        </tr> 
                        <tr>
                        <td></td>
                        </tr> 
                        <tr>
                        <td style="color:#ff5722;max-width: 500px;">' . $message . '</td>
                        </tr>
                        </table>
                        </body>
                        </html>
                        ';
    if (mail($mailTo, $subject, $text, $headers)) {
      $hvala = 'hvala';
    }
  }
  $rez->nameError = $name_error;
  $rez->messageError = $message_error;
  $rez->posetilacError = $posetilac_error;
  $rez->posetilac = $posetilac;
  $rez->hvala = $hvala;
  echo json_encode($rez);


  //echo $_SERVER['REQUEST_METHOD'];
}
