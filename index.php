<?php
/*
 *
 * LOGIN 3R: A secure PHP Login Script with Register, Remember, and Reset function
 *
 * Uses PHP SESSIONS, modern password-hashing and salting and gives the basic functions a proper login system needs.
 *
 * @author jotaroita
 * @link https://github.com/jotaroita/secure-login-php7-remember-register-resetpw
 * @license http://opensource.org/licenses/MIT MIT License
 *
 * INSTALL:
 * 1. upload all file in a folder in your server
 * 2. edit check.php and config variables
 * 3. execute query for set tables in your database see setup.sql file
 * 4. run the script www.yoursite.com/login3r/
 *
*/
session_start();
//check the cookie and set the session user 
include("admin/config/auth.php");
include("admin/config/connect.php");

//if session is set means that the user is already logged in, so doesnt show the login page to an user already logged


if (isset($_SESSION['user'])) {
//When user logged try to access to login page...
//header("location:content.php"); //decomment this line for redirect to content page 
$konf_login="Anda Telah Melakukan Login. Silahkan ke Halaman <a href=admin/index.php>Admin</a> ";//or stay in this page and show a message
}

// *********************************
// * CHECK IF USER/PW MATCH        *
// *********************************

//if login form is submitted 
if (isset($_POST["login"])) {

$_POST["email"]=trim($_POST["email"]);

do {
//if not valid email "end cicle" and show again the login form
if (filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)===false or !preg_match('/@.+\./', $_POST["email"])) {$message="Invalid Email";break;}

//******************** ADD A DELAY FOR AVOID BRUTAL FORCE ATTACKS 
//otherwise read from database how many login attemps in the last 10 minutes from the same IP address
$sql = $db->prepare("SELECT data FROM log_accessi WHERE ip='".$_SERVER['REMOTE_ADDR']."' and accesso=0 and data>date_sub(now(), interval 1 minute) ORDER BY data DESC");
$sql->execute();
$attempts=$sql->rowCount();
$last=$sql->fetchColumn();
  
$last=strtotime($last);
$delay=min(max(($attempts-4),0)*2,30); //after 3rd wrong try, add a delay of (# attempts * 2) as seconds (maximum 30 seconds each try)
  
//if there are many tries in few second, show a messagge and "end cicle" so doesnt check the email/pw this time
if ($attempts>3) {$message="Terlalu Banyak Percobaan, Silahkan Menunggu Beberapa Saat";break;}
//***************************************************************


$sql = $db->prepare("SELECT * FROM utenti WHERE email=?");
$sql->bindParam(1, $_POST["email"]);
$sql->execute();
$rows = $sql->fetch(PDO::FETCH_ASSOC);  

//check if password type is match with password in the database
//using php function password_hash in the register.php and password_verify here
//I add the constant PEPPER has salt (see check.php) the system already set a secure salt with the function password_hash
//(if u remove PEPPER or change it remember to do that in the register.php too)

$checked = password_verify($_POST['password'].PEPPER, $rows["password"]);
if ($checked) { //if email/pw are right:
    $message='password correct<br>enjoy content <a href=index.php>here</a>';
  $_SESSION['user'] = $rows["id"];
  $_SESSION['otorisasi'] = $rows["posisi"];
  $_SESSION['nama'] = $rows["nama"];
  
  //...and if remember me checked send the cookie
  if (isset($_POST["remember"])) {
    if ($_POST["remember"]=="true") {
    
    //create a random selector and auth code in the token database
      //function aZ is in the check.php file
     $selector = aZ();
     $authenticator = bin2hex(random_ver(33));
       $res=$db->prepare("INSERT INTO auth_tokens (selector,hashedvalidator,userid,expires,ip) VALUES (?,?,?,FROM_UNIXTIME(".(time() + 864000*7)."),?)");
       $res->execute(array($selector,password_hash($authenticator, PASSWORD_DEFAULT, ['cost' => 12]),$rows['id'],$_SERVER['REMOTE_ADDR']));     
  //set the cookie
      setcookie(
          'remember',
           $selector.':'.base64_encode($authenticator),
           time() + 864000*7 //the cookie will be valid for 7 days, or till log-out
      );
    }
  }

//redirect to page with content only for members
echo '<script language="javascript"> window.location.href = "admin/index.php" </script>';

//if email/pw are wrong 
} else {
    $message=($attempts>1)?"Banyak Percobaan ($attempts)":"Anda Salah Memasukkan Email/Password";
}


//save the access log
$sql = $db->prepare("INSERT INTO log_accessi (ip,mail_immessa,accesso) VALUES (? ,? ,?)");
$sql->bindParam(1, $_SERVER['REMOTE_ADDR']);
$sql->bindParam(2, $_POST["email"]);
$sql->bindParam(3, $checked);
$sql->execute();

}while(0);

}

// *********************************
// * HTML FOR LOGIN FORM           *
// *********************************

?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/css2?family=Varela+Round&family=Viga&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/font-awesome/all.css">
    <!--Import materialize.css-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/style.css">

    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Pencucian Mobil</title>
  </head>

  <body>

    <div class="container card-login">
      <div class="card">
        <div class="card-body">
          <div class="text-center">
            <img src="logo.png" class="img-thumbnail">
          </div>
          <div class="form">
            <form method="POST" action="">
              <div class="modal-body">
                <div class="input-group flex-nowrap">
                  <span class="input-group-text" id="addon-wrapping"><i class="fas fa-user-circle"></i></span>
                  <input type="email" class="form-control" placeholder="Masukkan Email..." aria-label="Masukkan Email..." aria-describedby="addon-wrapping" name="email" required>
                </div>
                <div class="input-group flex-nowrap mt-3">
                  <span class="input-group-text" id="addon-wrapping"><i class="fas fa-key"></i></span>
                  <input type="password" class="form-control" placeholder="Masukkan Password..." aria-label="Masukkan Password..." aria-describedby="addon-wrapping" name="password" required>
                </div>
                <div class="input-group flex-nowrap mt-3">
                  <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" role="switch" id="remember" name="remember" value="true">
                    <label class="form-check-label" for="remember">Remember Me</label>
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <input type="hidden" name="login" value="login">
                <button type="submit" class="btn btn-success">Login</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

    <!--JavaScript at end of body for optimized loading-->
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script type="text/javascript" src="js/script.js"></script>
  </body>
</html>