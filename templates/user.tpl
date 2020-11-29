{include file="header.tpl" }
    <div class="container mt-2 bg-color border border-secondaryp-3 mb-5 rounded shadow">
        <div class="row p-5 d-flex justify-content-center align-items-center">
            <div class="d-flex justify-content-start align-items-center">
                <div class="text-center display-1">
                    <h1>Mira el perfil de uno de nuestros usuarios:</h1>
                </div>
            </div> 

            <div class="col-12 m-2 w-75 ">
                <div class="d-flex justify-content-center align-items-center card-header-bg ">
                    {if $user->admin == 1}
                    <i class="fas fa-user-circle icon-user-admin m-5 p-5"></i>
                    {else}
                    <i class="fas fa-user-circle icon-user m-5 p-5"></i>
                    {/if}
                </div>
                <ul class="list-group text-center">
                    <li class="list-group-item">{$user->name}</li>
                    <li class="list-group-item">{$user->email}</li>
                    <li class="list-group-item">
                        {if $user->admin == 1}
                        Administrador
                        {else}
                        Colaborador 
                        {/if}
                    </li>
                </ul>
            </div>
        </div>
    </div>
{include file="footer.tpl"}