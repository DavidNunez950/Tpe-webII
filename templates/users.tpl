{include file="header.tpl" }
<div class="container mt-2 bg-color border border-secondaryp-3 mb-5 rounded shadow">
    <div class="row p-5 d-block">
        <div class="d-flex justify-content-start align-items-center">
            <div class="text-center display-1">
                <h1>Usuarios</h1>
            </div>
        </div>
        <div>
            <ul class="list-group">
                {foreach from=$users item=user}
                    <li class="list-group-item d-flex justify-content-start align-items-center">
                        {if $user->admin == 1}
                            <i class="fas fa-user-circle icon-user-admin pr-3"></i>
                        {else}
                            <i class="fas fa-user-circle icon-user pr-3"></i>
                        {/if}
                        <a href="users/{$user->id}">{$user->name}<span class="text-secondary"> - {$user->email}</span></a>
                        <div class="btn-group btn-group-toggle ml-3" data-toggle="buttons">
                            <button type="button" class="btn btn-danger  stretched-link text-whit" data-toggle="modal" data-target="#borrar{$user->id}" aria-expanded="false"><i class="fas fa-trash-alt"></i></button>
                            <a class="btn btn-success stretched-link text-white" href="users/{$user->id}"><i class="fas fa-search"></i></a>
                            <button type="button" class="btn btn-primary stretched-link text-white" data-toggle="modal" data-target="#modificar{$user->id}" aria-expanded="false">
                                {if $user->admin == 0}
                                    <i class="fas fa-toggle-off"></i>
                                {else}
                                    <i class="fas fa-toggle-on"></i>
                                {/if}
                            </button>
                        </div>
                        <div class="modal fade" id="borrar{$user->id}" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content ">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Estas seguro de que quieres borrar la cuenta del usuario: {$user->name}</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-footer">
                                        <div class="btn-group btn-group-lg m-0 mt-3" role="group">
                                            <button type="button" class="border-0 close">
                                                <button type="button" class="btn btn-info btn-sm" data-dismiss="modal">
                                                    Cancelar
                                                </button>
                                            </button>
                                            <a href="deleteUsers/{$user->id}" class="btn btn-danger stretched-link text-white">Confirmar</a>'.
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal fade" id="modificar{$user->id}" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content ">
                                    <div class="modal-header">
                                        <h5 class="modal-title">
                                            {if $user->admin == 1}
                                                Quitar permisos de administración
                                            {else}
                                                Dar permisos de administración
                                            {/if}
                                            del usuario: {$user->name}</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-footer">
                                        <div class="btn-group btn-group-lg m-0 mt-3" role="group">
                                            <button type="button" class="border-0 close">
                                                <button type="button" class="btn btn-info btn-sm" data-dismiss="modal">
                                                    Cancelar
                                                </button>
                                            </button>
                                            <a href="changeAdministrationPermissions/{$user->id}" class="btn btn-danger stretched-link text-white">Confirmar</a>'.
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                {/foreach}
            </ul>
        </div>
    </div>
</div>
{include file="footer.tpl"}