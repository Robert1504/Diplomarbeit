<?php
$session = mt_rand(1,999);  //user_id
?>
<!DOCTYPE html>
<html>
    <head>
        <title>SNHS</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link rel="stylesheet" href="mdl/material.min.css">
        <link rel="stylesheet" href="mdl/material_style.css">

        <!--<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">-->
        <!--<link rel="stylesheet" href="https://code.getmdl.io/1.3.0/material.deep_purple-indigo.min.css" />-->
        <link rel="stylesheet" type="text/css" href="style.css?ver=">
    </head>
    <body>
        <!-- Simple header with fixed tabs. -->
        <div class="mdl-layout mdl-js-layout mdl-layout--fixed-header mdl-layout--fixed-tabs">
            <header class="mdl-layout__header">
                <div class="mdl-layout__header-row">
                    <!-- Title -->
                    <span class="mdl-layout-title">Gateway Configuration</span>
                </div>
                    <!-- Tabs -->
                <div class="mdl-layout__tab-bar mdl-js-ripple-effect">
                    <a href="#fixed-tab-1" class="mdl-layout__tab is-active">Data</a>
                    <a href="#fixed-tab-2" class="mdl-layout__tab">Setup</a>
                </div>
            </header>
            <main class="mdl-layout__content">
                <section class="mdl-layout__tab-panel is-active" id="fixed-tab-1">
                    <div class="page-content-1"><!-- Your content goes here -->
                        <section class="sim_details">
                            <h5 class= "sd_1" id="title">Internet connection</h5>
                            <p class="sd_2">ID: 42423</p>
                            <p class="sd_3">SIM</p>
                            <div class="connection_check" id="connection">---------------------</div>	
                            <!-- schaut ob eine Verbindung zum Internet möglich ist -->
                        </section>
                    </div>
                </section>
                <section class="mdl-layout__tab-panel" id="fixed-tab-2">
                    <div class="page-content-2"><!-- Your content goes here -->
                        <!-- Accent-colored raised button with ripple -->
                        <div class="shellbuttons">
                            <!--<button id="chat_input">hello</button>-->
                            <button onclick="hide(); this.onclick=null;" id="c_b1" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent button_width">
                            connect
                            </button>

                            <button onclick="hide(); this.onclick=null;" id="d_b2" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent button_width">
                            disconnect
                            </button>

                            <button onclick="hide(); this.onclick=null;" id="t_b3" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent button_width">
                            test-connection
                            </button>
                        </div>
                    </div>

                    <div class="wrapper" id="message-wrapper"><!-- begrenzt das feld mit css -->
                        <div class="input_command" id="input"></div><!-- cmd wird ausgegeben -->    

                        <div class="output_command" id="output"></div>
                    </div>
                </section>
                <footer class="mdl-mini-footer">
                    <div class="mdl-mini-footer__left-section">
                        <div class="mdl-logo">Senioren-Notfall-Hilfe-System</div>
                        <ul class="mdl-mini-footer__link-list">
                            <li><a class="link_htl" target="_blank" href="https://www.htl-hl.ac.at/web/">HTL Hollabrunn</a></li>
                            <!--<li><a href="#">Privacy & Terms</a></li>-->
                        </ul>
                    </div>
                </footer>
            </main>
        </div>
    </body>
    <script defer src="mdl/material.min.js"></script>
    <script src="jquery.js"></script>
    <script src="script.js"></script>
</html>