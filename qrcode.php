<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="style.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SwissLife QRCode</title>
    <meta property="og:image" content="assets/uploads/<?php echo $favicon; ?>">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>
    <style>
        /* Reset some default browser styles */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: 'Arial', sans-serif;
    background: linear-gradient(to right, #f0f4f8, #d9e2ec);
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    padding: 20px;
    overflow: hidden;
}

/* Container for Logo, Title, and QR Code */
.container {
    text-align: center;
    background: #ffffff;
    border-radius: 20px;
    padding: 30px;
    box-shadow: 0 15px 40px rgba(0, 0, 0, 0.2);
    max-width: 400px;
    width: 100%;
    position: relative;
    overflow: hidden;
    animation: fadeIn 1s ease-out;
    transition: transform 0.5s ease-in-out;
}

/* Hover Effect */
.container:hover {
    transform: scale(1.05);
}

/* Logo Style */
.container .logo {
    margin-bottom: 20px;
    width: 100px; /* Adjust based on your logo's aspect ratio */
    height: auto;
}

/* Title Style */
.container h1 {
    font-size: 1.75rem;
    color: #333333;
    margin-bottom: 20px;
    font-weight: bold;
    animation: slideIn 1s ease-out;
}

/* QR Code Container */
#qrcode {
    width: 150px;
    height: 150px;
    transition: transform 0.4s ease-in-out, box-shadow 0.4s ease-in-out, filter 0.4s ease-in-out;
    box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
    border-radius: 15px;
    background: #ffffff;
    display: flex;
    align-items: center;
    justify-content: center;
    border: 2px solid #e0e0e0;
    position: relative;
    overflow: hidden;
    margin: 0 auto; /* Center QR code horizontally */
}

/* QR Code Inner Animation */
#qrcode::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: radial-gradient(circle, rgba(0, 0, 0, 0.1) 0%, rgba(0, 0, 0, 0) 70%);
    transition: opacity 0.4s ease-in-out, transform 0.4s ease-in-out;
    opacity: 0;
    transform: scale(1);
}

#qrcode:hover::before {
    opacity: 1;
    transform: scale(1.2);
}

/* Hover Animation */
#qrcode:hover {
    transform: scale(1.1);
    box-shadow: 0 12px 30px rgba(0, 0, 0, 0.2);
    filter: brightness(1.1);
}

/* Overlay Effect on Hover */
#qrcode::after {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    border-radius: 15px;
    background: rgba(0, 0, 0, 0.1);
    transition: opacity 0.4s ease-in-out;
    opacity: 0;
}

#qrcode:hover::after {
    opacity: 1;
}

/* Animations */
@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes slideIn {
    from {
        opacity: 0;
        transform: translateX(-20px);
    }
    to {
        opacity: 1;
        transform: translateX(0);
    }
}

/* Responsive Design */
@media screen and (max-width: 768px) {
    /*#qrcode {
        width: 120px;
        height: 120px;
    }*/

    .container {
        padding: 20px;
    }

    .container h1 {
        font-size: 1.5rem;
    }

    .container .logo {
        width: 80px; /* Adjust for smaller screens */
    }
}

@media screen and (max-width: 480px) {
   /* #qrcode {
        width: 100px;
        height: 100px;
    }*/

    .container {
        padding: 15px;
    }

    .container h1 {
        font-size: 1.25rem;
    }

    .container .logo {
        width: 60px; /* Adjust for smaller screens */
    }
}

@media screen and (max-width: 280px) {
    #qrcode {
        width: 100px;
        height: 100px;
    }
}

    </style>
</head>
<body>
    <div class="container">
        <img src="assets/uploads/logo.png" alt="Your Logo" class="logo">
        <h1>SwissLife</h1>
        <div id="qrcode"></div>
        <br>
        <h5>Scan the QR Code</h5>
    </div>
    

    <script>
        var qrcode = new QRCode(document.getElementById("qrcode"), {
            text: "https://www.swisslifelb.com",
            width: 128,
            height: 128,
            colorDark : "#000000",
            colorLight : "#ffffff",
            correctLevel : QRCode.CorrectLevel.H
        });
    </script>

</body>
</html>