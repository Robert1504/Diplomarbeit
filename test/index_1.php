<?php
$session = mt_rand(1,999);  //user_id
?>
<!DOCTYPE html>
<html>
<head>
	<title>Chat</title>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <header>
	    <span>Spusu Config</span>
        <div class="connection_check" id="connection">Connection Check</div>	<!-- schaut ob eine Verbindung zum Internet möglich ist -->
    </header>
    <main>
        <section class="sim_details">
            <div class="title">Sim Card Details:</div>
            <span>ID: 42423</span>
        </section>
	    <div class="wrapper" id="message-wrapper"><!-- begrenzt das feld mit css -->
                
                <div class="input_command">
                    <span>Old Command</span>
                </div>
                <!-- cmd wird ausgegeben -->    
                <div class="output_command" id="chat_output">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas in mauris ultricies sem sodales dictum. Nunc lacinia ut risus lacinia imperdiet. Morbi gravida, lectus in ullamcorper venenatis, massa quam lacinia ipsum, nec auctor est felis quis ipsum. Duis quam nulla, finibus ac accumsan ut, maximus a augue.
            	</div>
	    </div>
        <div class="chat_input">
            <textarea id="chat_input" placeholder="Write your cmd here!"></textarea>
        </div>
    </main>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="script.js"></script> 
</html>