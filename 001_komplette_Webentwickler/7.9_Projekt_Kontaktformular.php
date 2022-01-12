<?php
    // php ist backend. Ausführung serverseitig
    // javascript im body wird auf User-PC ausgeführt 
    // (schnellere Reaktion für den Nutzer, keine Fehlerausgabe, wenn Seite lahm ist)

// Absender-email-Adresse als sicheren Absender hinzufügen, damit mails nicht Spam sind
// email-Versand per php bei Strato aktivieren
    $error = "";
    $successMassage = "";
    

    if($_POST){
        
        if(!$_POST['email']){
            
            $error.= "Eine email-Adresse wird benötigt. <br>";
        }
        if(!$_POST['titel']){
            
            $error.= "Ein Titel wird benötigt. <br>";
        }
        if(!$_POST['content']){
            
            $error.= "Etwas Inhalt wird benötigt. <br>";
        }
        if(filter_var($_POST['email'],FILTER_VALIDATE_EMAIL) == false){
            $error .= "Die email-Adresse ist ungültig";
        }
        if($error!=""){
            $("#error").html('<div class="alert alert-danger" role="alert"> <p> <b>Es gab Fehler in deinem Formular: </b> </p>' . $error . '</div>');
        }else{
            //email verschicken
            $emailTo = "me@mydomain.com";
            $subject = $_POST["titel"];
            $content = $_POST['content'];
            $headers = "From: ".$_POST['email'];
            
            if(mail($emailTo, $subject, $content, $headers)){
                $successMassage = '<div class="alert alert-success" role="alert"> <p> Alles geklappt! </p> </div>';
            }else {
                $error = '<div class="alert alert-danger" role="alert"> <p> Formular konnte nicht abgeschickt werden. </p> </div>';
            }
                
        }
    } 

?>

<!DOCTYPE html>
<html lang="de">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Kontaktformular</title>
      
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

    <!-- Bootstrap -->
    <!-- Das neueste kompilierte und minimierte CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

    <!-- Optionales Theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">

    <!-- Das neueste kompilierte und minimierte JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

  </head>
    
  <body>
      <div class="container">
      
      <h1>Kontaktiere uns!</h1>
    
    <!-- php-inline-Code ins div einfügen -->
    <div id="error">  <? echo $error;
                         echo $successMassage; ?>  </div>
          
          
      <form method="post">
          <div class="form-group">
            <label for="beispielFeldEmail1">Email-Adresse</label>
            <input name="email" type="email" class="form-control" id="email" placeholder="Email-Adresse">
          </div>

          <div class="form-group">
            <label for="titel">Titel</label>
            <input name="titel" type="text" class="form-control" id="title">
          </div>

          <div class="form-group">
            <label for="anliegen">Deine Frage an uns</label>
            <textarea name="content" class="form-control" id="content" rows="3"></textarea>
          </div>

          <button type="submit" id="submit" class="btn btn-primary">Abschicken</button>
    </form>
      
      
    </div>
    
    <script type="text/javascript">
      
        $("form").submit(function(event){
            
            
            event.preventDefault();
            
            var error = "";
            
            if($("#email").val()==""){
                error += " <p> Die email ist leer. Bitte trage was ein </p>";
            }
            if($("#title").val()==""){
                error += " <p> Der Titel ist leer. Bitte trage was ein </p>";
            }
            if($("#content").val()==""){
                error += "<p> Das Inhaltfeld ist leer </p>";
            }
            if(error!=""){
                $("#error").html('<div class="alert alert-danger" role="alert"> <p> <b>Es gab Fehler in deinem Formular: </b> </p>' + error + '</div>');
            }else {
                // unbind('submit') verhindert preventDefault()-Funktion beim erneuten Aufruf der submit-Funktion;
                $("form").unbind('submit').submit();
            }
            
        });
      
      </script>

      
  </body>
</html>






















