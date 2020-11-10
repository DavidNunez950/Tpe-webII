<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{$BASE_URL}css/css.css"  type="text/css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    
    <script src="jquery-1.3.2.min.js" type="text/javascript"></script>   
    <base href="{$BASE_URL}">
    <title>TodoRopa</title>
</head>
<body class="bg-body-blue">
    <div class="container-fluid m-0 p-0 position-sticky sticky-top">
        <div class="row">
            <div class="col-12">
                <nav class="navbar navbar-expand-lg navbar-light d-flex justify-content-around bg-main border-ligth">
                    <a class="navbar-brand" href="#"><h1 class=" display-5 text-white">TodoRopa</h1> <a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse">
                        <ul class="navbar-nav">
                            <li class="nav-item active">
                                <a class="nav-link display-5 text-white" href="home">Home</a>
                            </li>
                            <li class="nav-item active">
                                <a class="nav-link display-5 text-white" href="categories">Categorias</a>
                            </li>
                            <li class="nav-item active">
                                <a class="nav-link display-5 text-white" href="products">Productos</a>
                            </li>
                            {if $userData.user.rol.admin eq true}
                                <a class="nav-link display-5 text-white" href="users">Usuarios</a>
                            {/if}
                            <li class="nav-item active">
                            <a class="nav-link display-5 text-white" href="register">Registro</a>
                        </li>
                        </ul>
                    </div>
                    <div class="dropdown">
                        <a class="btn btn-secondary bg-sm dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            {if $userData.user.rol.colab eq false}
                                Ingresar?
                            {else}
                                {$userData.user.name}
                            {/if}
                        </a>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                            <a class="dropdown-item" href="login">Login</a>
                            {if $userData.user.rol.colab eq false}
                                <a class="dropdown-item disabled" href="logout">Logout</a>
                            {else}
                                <a class="dropdown-item" href="logout">Logout</a>
                            {/if}
                        </div>
                    </div>
                    <figure class="figure d-flex flex-column justify-content-center align-items-center pr-5 mr-5">
                        <img src="https://thumbs.dreamstime.com/b/icono-del-usuario-s%C3%ADmbolo-humano-de-la-persona-muestra-inicio-sesi%C3%B3n-avatar-ejemplo-vector-aislado-en-fondo-moderno-118096858.jpg" class="rounded-circle" width="75px" height="75px" >
                    </figure>                  
                </nav>
            </div>
        </div>
    </div>
