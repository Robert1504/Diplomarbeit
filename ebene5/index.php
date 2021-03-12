<?php
$session = mt_rand(1,999);  //user_id
?>
<!DOCTYPE html>
<html>
<head>
	<title>SNHS</title>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://code.getmdl.io/1.3.0/material.teal-light_green.min.css">
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

    <header>
	    <span>Gateway Configuration</span>
    </header>

    <main>

        <section class="sim_details">
            <div class="title">Sim Card Details:</div>
            <span>ID: 42423</span>
            <div class="connection_check" id="connection">---------------------</div>	
            <!-- schaut ob eine Verbindung zum Internet möglich ist -->
        </section>
        <!-- Accent-colored raised button with ripple -->
        
        <div class="shellbuttons">

        <!--<button id="chat_input">hello</button>-->

        <button id="c_b1" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent">
        connect
        </button>
        <!--<script>
        function myFunction() {
            document.getElementById("demo").innerHTML = "Hello World";
        }
        </script>-->

        <button id="d_b2" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent">
        disconnect
        </button>

        <button id="t_b3" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent">
        test-connection
        </button>
        </div>

	    <div class="wrapper" id="message-wrapper"><!-- begrenzt das feld mit css -->
                <div class="input_command" id="input"></div><!-- cmd wird ausgegeben -->    
                
                <div class="output_command" id="output"></div>
	    </div>

        <!--<div class="chat_input">
            <textarea id="chat_input" placeholder="Write your cmd here!"></textarea>
        </div>-->

    </main>

</body>

<script defer src="https://code.getmdl.io/1.3.0/material.min.js"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="script.js"></script>

</html>