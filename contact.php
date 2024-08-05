<!DOCTYPE html>
<html lang="en">
<head>
    
    <?php
    session_start(); 
     include 'components/head_meta.php'; 
     ?>
    <style>
         h4 {
            font-family: 'Inter', sans-serif;
            font-weight: 800;
        }
        
        .bg-form{
            background-color: #d6e1f7;
            border-radius: 15px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #4a4a4a;
            margin-left: 30px;
            font-family: 'Inter', sans-serif;
        font-weight: 200; /* 200 corresponde a Extra Light */        }

        input {
           /* width: calc(100% - 20px);*/
            width: 40%;
            padding: 10px;
            margin-bottom: 20px;
          /*  border: 1px solid #ccc;*/
            border-radius: 10px;
            background-color: #6DA0ED;
        }
       
        .imagen{
            width: 290px;
            margin-left:990px;
            position: relative;
            display: flex;

        }
        .logo{
            position: absolute;
            align-items: start;
            margin-top: -290px;
            margin-left: -40px;
        }
        .autobus{
            position:absolute;
            margin-top: -252px;
            margin-left: -45px;
        }
       
        .form-control{
            border-radius: 30px;
            width: 65%;
            background-color: #6DA0ED;
            
        }
        input.form-control:disabled {
            background-color: #BBD5FD;
            color: black; /* Asegura que el texto siga siendo legible */
            opacity: 1; /* Remueve la opacidad reducida que algunos navegadores aplican */
        } 
        @media (max-width: 768px) {
            .bg-form {
                height: 560px;
                padding: 0px;
                margin-top: 10px;
                max-width: 90%;
                border-radius: 20px;
                margin-left: 20px;
                overflow-x: hidden;
                overflow-y: hidden;
            }

            .user-icon-container {
                display: none;
            }

            input[type="text"], input[type="email"], .btn {
                width: 300px;
                margin: 10px 0;
                border-radius: 20px;
                
            }
            input[type="text"], input[type="email"] {
                border-radius: 20px;
                width: 350px;
                margin: 10px 0;
                background-color: #FFFFFF;
                padding: 16px;
                margin-left:-20px;
            }

            .btn-primary, .btn-danger {
                font-size: 16px;
                border-radius: 15px;
            }

            label {
                font-size: 20px;
                white-space: nowrap; /* Evita que las palabras se dividan en varias líneas */
                margin-top:-9px;
                text-align:center;
                margin-left:100px;
                
            }
            .imagen{
            width: 190px;
            margin-left:-160px;
            position: relative;
            display: flex;

        }
        .logo{
            position: absolute;
            align-items: start;
            margin-top: 365px;
            margin-left: 5px;
        }
        .autobus{
            position:absolute;
            margin-top: 390px;
            margin-left: 5px;
        }
        .nombre{
           margin-left: 70px;
        }
            
        }
    </style>
    
</head>
<body>
    <?php include 'components/navbar.php'; ?>
    <div class="container">
        <h4 class="mt-3 text-center">CONTACTO</h4>
        <div class="row bg-form p-3 mt-5">
            <div class="col-8 mt-4">
                <form>
                    <div class="form-group ">
                        <label  for="nombre">Nombre</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" value="Autobuses Halcón División México" disabled>
                    </div>
                    <div class="form-group">
                        <label class="nombre" for="email">Correo electrónico</label>
                        <input type="email" class="form-control" id="email" name="email" value="autobuseshalcon.dmo@gmail.com" disabled>
                    </div>
                    <div class="form-group">
                        <label for="address">Dirección</label>
                        <input type="text" class="form-control" id="address" name="address" value="C. Valdivieso S/N B. San Antonio, San Pablo Huixtepec" disabled>
                    </div>
                </form>
            </div>
            <div class="imagen">
                <img  class="logo img-fluid " src="assets/images/logoTicket.png" alt="">
                <img class="autobus img-fluid" src="assets/images/autobus.png" alt="">
            </div>
           

        </div>
    </div>
</body>
<?php include 'components/footer.php'; ?>
</html>