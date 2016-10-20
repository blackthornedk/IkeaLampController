<?php
/*
 * IKEA Lamp Updater
 * Turns on a wemos relay, if the corresponding button is pressed on the webpage.
 */
/*
 * ----------------------------------------------------------------------------
 * "THE BEER-WARE LICENSE" (Revision 42):
 * <black@blackthorne.dk> wrote this file. As long as you retain this notice you
 * can do whatever you want with this stuff. If we meet some day, and you think
 * this stuff is worth it, you can buy me a beer in return Jacob V. Rasmussen
 * ----------------------------------------------------------------------------
 */
$state = unserialize(file_get_contents("state.txt"));

if ($_POST["setState"]) {

    if ($_POST["black"] == 1) {
	$state["black"] = true;
    } elseif ($_POST["black"] === "0") {
	$state["black"] = false;	
    }


    if ($_POST["white"] == 1) {
	$state["white"] = true; 
    } elseif ($_POST["white"] === "0") {
	$state["white"] = false;
    }

    file_put_contents("state.txt", serialize($state));
}
if ($_GET["json"]) {
    echo json_encode($state);
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>IKEA Lamp Control</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
<body>
    <div class="container">
	<div class="header clearfix">
	    <h3 class="text-muted">IKEA Lamp Control</h3>
	</div>

	<div class="jumbotron">
	    <h1>Kontroller lyset i lamperne</h1>
	    <p class="lead">Tryk på knapperne nedenfor, for at tænde og slukke lamperne på bordet.</p>

<?php if (@$state["white"]): ?>
	    <p><a class="btn btn-lg btn-danger" id="white" href="#" role="button">Sluk den hvide lampe</a></p>
<?php else: ?>
	    <p><a class="btn btn-lg btn-success" id="white" href="#" role="button">Tænd den hvide lampe</a></p>
<?php endif; ?>

<?php if (@$state["black"]): ?>
	    <p><a class="btn btn-lg btn-danger" id="black" href="#" role="button">Sluk den sorte lampe</a></p>
<?php else: ?>
	    <p><a class="btn btn-lg btn-success" id="black" href="#" role="button">Tænd den sorte lampe</a></p>
<?php endif; ?>
	</div>
	<div class="jumbotron">
	    <h1>ET ENKELT FORMÅL</h1>

<p>At skabe et åbent fysisk rum i Århus, hvor teknisk interesserede og kreative mennesker kan mødes om åben teknologi, udveksle erfaringer og idéer, og ikke mindst socialisere og skabe kontakter til andre ligesindede indenfor åben teknologi.</p>
<p><a href="http://www.osaa.dk/">OSAA.DK</a></p>
	</div>

    </div>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
    <!-- Include button postback code -->
    <script src="js/buttons.js"></script>
</body>
</html>

