{include file="header.tpl" }
    <div class="container mt-2 bg-color border border-secondaryp-3 mb-5 rounded shadow">
        <div class="row p-5 d-block">
            <div class="d-flex justify-content-start align-items-center">
                <div class="text-center display-1">
                    <h1>Categorias</h1>
                </div>
            </div>
            <div>
                <ul class="list-group">
                    {foreach from=$categorias item=categoria}                                           
                        <li class="list-group-item d-flex justify-content-between align-items-center"> 
                            <a href="categoria/{$categoria->id}"><img src="{$categoria->url_img}" class="rounded-circle" width="75px" height="75px"/></a>
                            <a href="categoria/{$categoria->id}">{$categoria->coleccion|upper}</a>
                            <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                <button type="button"  class="btn btn-danger  stretched-link text-whit" data-toggle="modal" data-target="#borrar{$categoria->id}" aria-expanded="false">Borrar</button>
                                <button type="button"  class="btn btn-primary stretched-link text-white" data-toggle="modal" data-target="#modificar{$categoria->id}" aria-expanded="false">Editar</button>
                            </div>
                        </li>
                        <div class="modal fade" id="borrar{$categoria->id}" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content ">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Estas seguro de que quieres borrar la {$categoria->coleccion}</h5>
                                        <button type="submit" class="close" data-dismiss="modal" aria-label="Close">
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
                                            <a href="deleteCategoria/{$categoria->id}" class="btn btn-danger stretched-link text-white">Confirmar</a>'.
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal fade" id="modificar{$categoria->id}" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content ">
                                    <form class="form-inline" action="editCategoria/{$categoria->id}" method="POST">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Esta seguro que quiere editar {$categoria->coleccion}</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label for="url_img">Imagen(URL): </label>
                                                <input type="text" class="form-control" name="url_img" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="coleccion">Colección: </label>
                                                <input type="text" class="form-control" name="coleccion" required>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-primary">Editar</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    {/foreach}
                </ul>
            </div>
            <div>
                <form class="form p-0 m-0 mt-2 col-4" action="insertCategoria" method="POST">
                    <div class="d-flex">
                        <div>
                            <div class="form-group m-0 p-0 pr-2">
                                <label for="url_img">Imagen(URL):</label>
                                <input type="text" class="form-control" name="input_url_img" required>
                            </div>
                        </div>
                        <div>
                            <div class="form-group m-0 p-0">
                                <label for="coleccion">Coleccion: </label>
                                <input type="text" class="form-control" name="input_coleccion" required>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="btn-group btn-group-lg m-0 mt-3" role="group">
                            <button type="submit" class="btn btn-success m-1 mt-3" >Agregar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
{include file="footer.tpl"}