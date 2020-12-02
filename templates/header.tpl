<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{$BASE_URL}css/css.css"  type="text/css">
    <link rel="stylesheet" href="{$BASE_URL}css/normalize.css"  type="text/css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>
    <script src="jquery-1.3.2.min.js" type="text/javascript"></script>   
    <link rel="icon" type="image/x-icon" href="uploads/logo.png" class="rounded-circle">
    <base href="{$BASE_URL}">
    <title>TodoRopa</title>
</head>
<body class="bg-body-blue">
    <div class="container-fluid m-0 p-0 position-sticky sticky-top">
        <div class="row">
            <div class="col-12">
                <nav class="navbar navbar-expand-lg navbar-light d-flex justify-content-around bg-main border-ligth">
                    <img src="uploads/logo.png" class="rounded-circle bg-light p-1" width="40px"><a class="navbar-brand" href="home"><h1 class=" display-5 text-white">TodoRopa</h1> <a>
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
                                <a class="nav-link display-5 text-white" href="products?page=1">Productos</a>
                            </li>
                            {if $userData.user.rol.admin eq true}
                            <li class="nav-item active">
                                <a class="nav-link display-5 text-white" href="users">Usuarios</a>
                            </li>
                            {/if}
                        </ul>
                    </div>
                    {if $userData.user.rol.colab eq false}
                    <a class="btn display-5 text-white" href="register">Registro</a>
                    <a class="btn display-5 text-white" href="login">Login</a>
                    {else}
                    <div class="dropdown text-center">
                        <a class="btn btn-secondary bg-sm d-flex text-center aling-items-center" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span>{$userData.user.name}</span><i class="fas fa-user-circle icon-user pl-2 pb-1"></i>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                            <a class="dropdown-item" href="login">Login</a>
                            <a class="dropdown-item" href="logout">Logout</a>
                        </div>
                    </div>
                    {/if}                
                </nav>
            </div>
        </div>
    </div>


