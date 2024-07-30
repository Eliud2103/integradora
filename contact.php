<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'components/head_meta.php'; ?>
    <style>
        
        .bg-form{
            background-color: #d6e1f7;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #4a4a4a;
            margin-left: 20px;
        }

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
            margin-top: 40px;
            width: 290px;
            margin-left: 15px;

        }
       
        
    </style>
    
</head>
<body>
    <?php include 'components/navbar.php'; ?>
    <div class="container">
        <h4 class="mt-3 text-center">CONTACTO</h4>
        <div class="row bg-form p-3 mt-4">
            <div class="col-8 mt-4">
                <form>
                    <div class="form-group ">
                        <label for="nombre">Nombre</label>
                        <input type="name" class="form-control" id="nombre" name="nombre" value="ADO" disabled>
                    </div>
                    <div class="form-group">
                        <label for="email">Correo electrónico</label>
                        <input type="email" class="form-control" id="email" name="email" value="Halcones@gmail.com" disabled>
                    </div>
                    <div class="form-group">
                        <label for="address">Dirección</label>
                        <input type="text" class="form-control" id="address" name="address" value="San Pablo Huixtepec" disabled>
                    </div>
                </form>
            </div>
            <div class="imagen">
                <img class="img-fluid" src="assets/images/autobus.png" alt="">
            </div>
           

        </div>
    </div>
</body>
<?php include 'components/footer.php'; ?>
</html>