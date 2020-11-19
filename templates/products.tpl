{include "header.tpl" }
    <div class="container mt-2 bg-color border border-secondaryp-3 mb-5 rounded shadow">
        <div class="row p-5">
            <div class="w-100">
                <div class="w-100 h-100 d-inline-flex justify-content-start align-items-center bg-transparent">
                    <figure class="figure text-center position-relative mt-0 mb-0 pt-0 pb-0 mr-n4">
                        <img src="https://www.mdpya.com.ar/wp-content/uploads/2020/03/textiles-ropa-678x381.jpg" class="rounded-circle mr-n5" alt="colleciones"  width="250" height="250">
                    </figure>
                    <div class="h-100 w-100 ml-n5 pl-5 display-1 border-secondary shadow  text-white bg-dark d-flex">
                        <h1 class="ml-5 pl-5 pt-5 d-inline align-middle">Productos por categoria</h1>
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
                            <th scope="col">Datos</th>
                        </tr>
                    </thead>
                    <tbody>
                    {foreach from=$producto item=prenda}
                        <tr>
                            <td>{$prenda->tipo}</td>
                            <td>{$prenda->color}</td>
                            <td>{$prenda->talle}</td>
                            <td>{$prenda->coleccion}</td>
                            {if $userData.user.rol.colab eq true}
                            <td class="w-25">
                                <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                    <button type="button"  class="btn btn-danger  stretched-link text-whit" data-toggle="modal" data-target="#borrar{$prenda->id}" aria-expanded="false">Borrar</button>
                                    <a href="product/{$prenda->id}" class="btn btn-success stretched-link text-white">Ver</a>
                                    <button type="button"  class="btn btn-primary stretched-link text-white" data-toggle="modal" data-target="#modificar{$prenda->id}" aria-expanded="false">Editar</button>
                                </div>
                            </td>
                            <div class="modal fade" id="borrar{$prenda->id}" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content ">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Estas seguro de que quieres borrar la  prenda {$prenda->tipo} de la {$prenda->coleccion}</h5>
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
                                                <a href="deleteProduct/{$prenda->id}" class="btn btn-danger stretched-link text-white">Confirmar</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal fade" id="modificar{$prenda->id}" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content ">
                                        <form class="form-inline" action="editProduct/{$prenda->id}" method="POST">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Estas seguro de que quieres realizar cambios de la prenda: "{$prenda->tipo}", de la {$prenda->coleccion}</h5>
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
                            {else}
                            <td class="w-25">
                                <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                    <a href="product/{$prenda->id}" class="btn btn-success stretched-link text-white">Ver</a>
                                </div>
                            </td>
                            {/if}
                        </tr>
                    {/foreach}
                        {if $userData.user.rol.colab eq true}
                        <tr>
                            <form class="form p-0 m-0" action="insertProductInCategory" method="POST">
                                <td>
                                    <div class="form-group m-0 p-0">
                                        <label for="tipo"></label>
                                        <input type="text" class="form-control" name="tipo" required>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group m-0 p-0">
                                        <label for="color"></label>
                                        <input type="text" class="form-control" name="color" required>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group m-0 p-0">
                                        <label for="talle"></label>
                                        <select class="form-control  m-0 p-0" name="talle">
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
                                </td>
                                <td>
                                    <div class="form-group">
                                        <label for="id_category"></label>
                                        <select class="form-control" name="id_category">
                                            <optgroup label="Selecione categoria">
                                                {foreach from=$categorias item=categoria}
                                                    <option value="{$categoria->id}">{$categoria->coleccion}</option>
                                                {/foreach}
                                            </optgroup>
                                        </select>
                                    </div>
                                </td>
                                <td>
                                    <div class="btn-group btn-group-lg m-0 mt-3" role="group">
                                        <button type="sumbit" class="btn btn-outline-success btn-sm">Agregar</button>
                                    </div>
                                </td>
                            </form>
                        </tr>
                        {/if}
                        <tr class="d-flex flex-end">
                        <ul class="pagination">
                        {foreach from=$cantPaginas item=a}
                            <li class="page-item"><a class="page-link" href="products/{$aux++*5} ">{$aux}</a></li>
                        {/foreach} 
                        {* </ul>
                            <ul class="pagination">
                            <li class="page-item">
                            <a class="page-link" href="#" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                                <span class="sr-only">Previous</span>
                            </a>
                            </li>
                            <li class="page-item"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item">
                            <a class="page-link" href="#" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                                <span class="sr-only">Next</span>
                            </a>
                            </li>
                        </ul> *}
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
{include file="footer.tpl"}