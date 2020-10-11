{include "header.tpl" }
    <div class="container mt-2 bg-color border border-secondaryp-3 mb-5 rounded shadow">
        <div class="row p-5">
            <div class="w-100">
                <div class="w-100 h-100 d-inline-flex justify-content-start align-items-center bg-transparent">
                    <div class="h-100 w-100 ml-n5 pl-5 display-1 border-secondary shadow  text-white bg-dark d-flex">
                        <h1 class="ml-5 pl-5 pt-5 d-inline align-middle">{$producto->tipo}</h1>
                    </div>
                </div>
            </div>
            <div class="w-100">
                <table class="table table-striped table-light table-responsive-sm shadow text-center mt-3 mb-0">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">Prenda</th>
                            <th scope="col">Color</th>
                            <th scope="col">Talle</th>
                            <th scope="col">Coleccion</th>
                            {if $loginIn eq true}
                            <th scope="col">Editar</th>
                            {/if}
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{$producto->tipo}</td>
                            <td>{$producto->color}</td>
                            <td>{$producto->talle}</td>
                            <td>{$producto->coleccion}</td>
                            {if $loginIn eq true}
                            <td class="w-25">
                                <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                    <button type="button"  class="btn btn-danger  stretched-link text-whit" data-toggle="modal" data-target="#borrar{$producto->id}" aria-expanded="false">Borrar</button>
                                    <button type="button"  class="btn btn-primary stretched-link text-white" data-toggle="modal" data-target="#modificar{$producto->id}" aria-expanded="false">Editar</button>
                                </div>
                            </td>
                            <div class="modal fade" id="borrar{$producto->id}" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content ">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Estas seguro de que quieres borrar la  prenda {$producto->tipo} de la {$producto->coleccion}</h5>
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
                                                <a href="deleteProduct/{$producto->id}" class="btn btn-danger stretched-link text-white">Confirmar</a>'.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal fade" id="modificar{$producto->id}" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content ">
                                        <form class="form-inline" action="editProduct/{$producto->id}" method="POST">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Estas seguro de que quieres realizar cambios de la producto: "{$producto->tipo}", de la {$producto->coleccion}</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label for="tipo">Prenda:</label>
                                                    <input type="text" class="form-control" name="tipo" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="color">Color:</label>
                                                    <input type="text" class="form-control" name="color" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="talle">Talle</label>
                                                    <select class="form-control" name="talle">
                                                        <optgroup label="Selecione su tipo de talle preferido">
                                                            <option value="XS">XS</option>
                                                            <option value="S">S</option>
                                                            <option value="M">M</option>
                                                            <option value="L">L</option>
                                                            <option value="XL">XL</option>
                                                            <option value="XXL">XXL</option>
                                                            <option value="XXXL">XXXL</option>
                                                            <option value="Otro">Otro</option>
                                                        </optgroup>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-primary">Comfirmar</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            {/if}
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
{include file="footer.tpl"}