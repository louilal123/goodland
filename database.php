<html lang="en"><head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <title>Hacked by 7h3N00bh4ck3r!</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=VT323&display=swap');

        body {
            margin: 0;
            overflow: hidden;
            color: #00ff00;
            font-family: 'VT323', monospace;
            text-align: center;
            position: relative;
            height: 100vh;
            background-color: #000;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .glitch {
            font-size: 4em;
            font-weight: bold;
            text-transform: uppercase;
            position: relative;
            text-shadow: 0.05em 0 0 #00fffc, -0.03em -0.04em 0 #fc00ff,
                0.025em 0.04em 0 #fffc00;
            animation: glitch 725ms infinite;
        }

        .glitch span {
            position: absolute;
            top: 0;
            left: 0;
        }

        .glitch span:first-child {
            animation: glitch 500ms infinite;
            clip-path: polygon(0 0, 100% 0, 100% 35%, 0 35%);
            transform: translate(-0.04em, -0.03em);
            opacity: 0.75;
        }

        .glitch span:last-child {
            animation: glitch 375ms infinite;
            clip-path: polygon(0 65%, 100% 65%, 100% 100%, 0 100%);
            transform: translate(0.04em, 0.03em);
            opacity: 0.75;
        }

        @keyframes glitch {
            0% {
                text-shadow: 0.05em 0 0 #00fffc, -0.03em -0.04em 0 #fc00ff,
                    0.025em 0.04em 0 #fffc00;
            }
            15% {
                text-shadow: 0.05em 0 0 #00fffc, -0.03em -0.04em 0 #fc00ff,
                    0.025em 0.04em 0 #fffc00;
            }
            16% {
                text-shadow: -0.05em -0.025em 0 #00fffc, 0.025em 0.035em 0 #fc00ff,
                    -0.05em -0.05em 0 #fffc00;
            }
            49% {
                text-shadow: -0.05em -0.025em 0 #00fffc, 0.025em 0.035em 0 #fc00ff,
                    -0.05em -0.05em 0 #fffc00;
            }
            50% {
                text-shadow: 0.05em 0.035em 0 #00fffc, 0.03em 0 0 #fc00ff,
                    0 -0.04em 0 #fffc00;
            }
            99% {
                text-shadow: 0.05em 0.035em 0 #00fffc, 0.03em 0 0 #fc00ff,
                    0 -0.04em 0 #fffc00;
            }
            100% {
                text-shadow: -0.05em 0 0 #00fffc, -0.025em -0.04em 0 #fc00ff,
                    -0.04em -0.025em 0 #fffc00;
            }
        }

        .warning {
            font-size: 2em;
            margin: 20px 0;
            text-shadow: 0 0 10px #00ff00;
        }

        .message {
            font-size: 1.5em;
            margin-top: 20px;
            overflow: hidden;
            white-space: nowrap;
            animation: typing 2s steps(500, end) infinite;
        }

        @keyframes typing {
            from { width: 0 }
            to { width: 100% }
        }

        canvas {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
        }

        .logo {
            width: 200px;
            height: 200px;
            margin: 20px 0;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.1); }
            100% { transform: scale(1); }
        }
    </style>
</head>
<body>   
    <audio id="backgroundMusic" loop="">
        <source src="play.mp3" type="audio/mpeg/mp3">
        Your browser does not support the audio element.
    </audio>
    
    
    
    <img src="https://miro.medium.com/v2/resize:fit:720/format:webp/0*CPEio-1l7xGqQ97V.jpg" alt="Hacker Logo" class="logo"><h1 class="glitch">
        Hacked By 7h3N00bh4ck3r
        <span aria-hidden="true">Hacked By 7h3N00bh4ck3r</span>
        <span aria-hidden="true">Hacked By 7h3N00bh4ck3r</span>
    </h1>
    
    <div class="warning">Warning: Security Breach Detected!</div>
    
    <div class="message">Your system has been compromised!</div>
           


</body></html>