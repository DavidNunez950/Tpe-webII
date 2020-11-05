{include file="header.tpl" }
    <div class="container mt-2 bg-color border border-secondaryp-3 mb-5 rounded shadow">
        <div class="row p-5 d-block">
            <div class="d-flex justify-content-start align-items-center">
                <div class="text-center display-1">
                    <h1>Usuarios</h1>
                </div>
            </div>

            <div class="card d-flex justify-content-between align-items-center" style="width: 18rem;">
                <div class=" card-body d-flex justify-content-between align-items-center">
                        {if $user->admin == 1}
                            <i class="fas fa-user-circle icon-user-admin"></i>
                        {else}
                            <i class="fas fa-user-circle icon-user"></i>
                        {/if}
                </div>
                <div class="card-body">
                    <h5 class="card-title">{$user->name}</h5>
                    <p class="card-text">No estas logeado, Unete y conece a distintos usuarios!!!</p>
                </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">Nombre: {$user->name}</li>
                        <li class="list-group-item">Administrador: {$user->admin}</li>
                        <li class="list-group-item">Vestibulum at eros</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
{include file="footer.tpl"}