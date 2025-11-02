<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HabilProf UCSC</title>
    <link rel="stylesheet" href="{{ asset('edashboard/styles.css') }}">
</head>
<body>
    <div class="encabezado">
        <h1> Menú principal HabilProf </h1>
        <a href="/" class="cerrar-sesion">
        <button> Cerrar sesión </button>
        </a>
    </div>

    
    <!-- Botones principales -->
    <a href="/ingreso" class="boton-ingreso">
    <button> Ingreso de habilitación profesional </button>
    </a>

    <!-- Menú 1 -->
    <div class="menu-contenedor">
        <button onclick="abrirMenu('menu')" class="menus">Eliminar o Actualizar habilitación profesional</button>
        <div class="menu" id="menu">
            <div id="submenu1" class="submenu"> 
                
                <a href="###" class="botones"> 
                <button> Eliminar habilitación profesional </button>
                </a>
                <a href="##" class="botones">
                <button> Actualizar habilitacion profesional </button>
                </a>

            </div>
        </div>
    </div>
    <!-- Menú 2 -->
    <div class="menu-contenedor">
        <button onclick="abrirMenu('menu2')" class="menus">Listado Varios</button>
        <div class="menu" id="menu2">
            
            <div id="submenu1" class="submenu"> 
                <a href="###" class="botones">
                <button> Listado Semestral </button>
                </a>
                <a href="##" class="botones">
                <button> Listado Historico </button>
                </a>
            </div>
        </div>
    </div>


    <script>
        function abrirMenu(idMenu) {
            const menus = document.querySelectorAll('.menu');
            const menuSeleccionado = document.getElementById(idMenu);

            // Cierra todos los menús excepto el seleccionado
            menus.forEach(m => {
                if (m !== menuSeleccionado) {
                    m.classList.remove('mostrar');
                }
            });

            // Abre o cierra el menú seleccionado
            menuSeleccionado.classList.toggle('mostrar');
        }
    </script>
</body>
</html>