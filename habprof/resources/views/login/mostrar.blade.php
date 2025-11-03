<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HabilProf UCSC</title>
    <link rel="stylesheet" href="{{ asset('elogin/styles.css') }}">

</head>
<body>
    <div class="logo">
        <img src="{{ asset('elogin/logo.png') }}" alt="Logo UCSC">
    </div>
    <div class="formulario">
        <h1>Inicio de sesión</h1>

        @if (session('error'))
            <div style="color: red; text-align:center; margin-bottom:10px;">
                {{ session('error') }}
            </div>
        @endif
        <form method= "post" action="{{ route('login.validar') }}">
            @csrf
            <div class="usuario">
                <input type="text" name="usuario" required>
                <label> Rut usuario sin digito verificador </label>
            </div>
            <div class="usuario">
                <input type="password" name="contrasenha" required>
                <label> Contraseña </label>
            </div>
            <div class= "olvidar"> <a href="#"> ¿Olvidó su contraseña? </a> </div>
            <input type="submit" value="INGRESAR">
            
        </form>
    </div>

</body>
</html>