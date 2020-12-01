{include "header.tpl" }
<div class="container mt-2 bg-color border border-secondaryp-3 mb-5 rounded shadow">
    <div class="row p-5">
        <div class="w-100">
            <div class="w-100 h-100 d-inline-flex justify-content-start align-items-center bg-transparent">
                <figure class="figure text-center position-relative mt-0 mb-0 pt-0 pb-0 mr-n4">
                    <img src="https://www.mdpya.com.ar/wp-content/uploads/2020/03/textiles-ropa-678x381.jpg" class="rounded-circle mr-n5" alt="colleciones" width="250" height="250">
                </figure>
                <div class="h-100 w-100 ml-n5 pl-5 display-1 border-secondary shadow  text-white bg-dark d-flex">
                    <h1 class="ml-5 pl-5 pt-5 d-inline align-middle">Productos por categoria</h1>
                </div>
            </div>
        </div>
        <div>
            <form action="products/{$pag}/" method="GET" class="mt-3 p-2 rounded bg-dark">
                <div class="form-row">
                    <div class="form-group col-md-1">
                        <label for="prenda">Prenda</label>
                        <input type="text" class="form-control" name="prenda" placeholder="prenda">
                    </div>
                    <div class="form-group col-md-1">
                        <label for="color">Color</label>
                        <input type="text" class="form-control" name="color" placeholder="Color">
                    </div>
                    <div class="form-group col-md-1">
                        <label for="talle">Talle</label>
                        <input type="text" class="form-control" name="talle" placeholder="Talle">
                    </div>
                    <div class="form-group col-md-2">
                        <label for="coleccion">Coleccion</label>
                        <input type="text" class="form-control" name="coleccion" placeholder="coleccion">
                    </div>
                    <div class="form-group col-md-1">
                        <div class="form-check">
                            <label>Imágen</label>
                            <label  class="switch">
                                <input type="checkbox" name="image">
                                <span class="slider round"></span>
                            </label>
                        </div>
                    </div>
                    <div class="form-group col-md-3">
                        <div class="form-check">
                            <label>Buscar producto específico</label>
                            <label  class="switch">
                                <input type="checkbox" name="conectorLogico">
                                <span class="slider round"></span>
                            </label>
                        </div>
                    </div>
                    <div class="form-group col-md-1 pt-4">
                        <button type="sumbit" class="btn btn-outline-success">Buscar</button>
                    </div>
                </div>
            </form>
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
                        <td>
                            <button type="button" class="btn{if $prenda->img eq ""} btn-secondary {else} btn-warning{/if} text-white mr-1 rounded-circle" data-toggle="modal" data-target="#img{$prenda->id}" aria-expanded="false"><i class="fas fa-images"></i></button>{$prenda->tipo}
                        </td>
                        <td>{$prenda->color}</td>
                        <td>{$prenda->talle}</td>
                        <td>{$prenda->coleccion}</td>
                        {if $userData.user.rol.colab eq true}
                        <td class="w-25">
                            <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                <button type="button" class="btn btn-danger  stretched-link text-whit" data-toggle="modal" data-target="#borrar{$prenda->id}" aria-expanded="false"><i class="fas fa-trash-alt"></i></button>
                                <a href="product/{$prenda->id}" class="btn btn-success stretched-link text-white"><i class="fas fa-search"></i></a>
                                <button type="button" class="btn btn-primary stretched-link text-white" data-toggle="modal" data-target="#modificar{$prenda->id}" aria-expanded="false"><i class="far fa-edit"></i></button>
                            </div>
                        </td>
                        <div class="modal fade" id="borrar{$prenda->id}" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content ">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Estas seguro de que quieres borrar la prenda {$prenda->tipo} de la {$prenda->coleccion}</h5>
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
                                    <form class="form-inline" action="editProduct/{$prenda->id}" method="POST" enctype="multipart/form-data">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Estas seguro de que quieres realizar cambios de la prenda: "{$prenda->tipo}", de la {$prenda->coleccion}</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label for="tipo" class="text-dark">Prenda:</label>
                                                <input type="text" class="form-control" name="tipo" value={$prenda->tipo} required>
                                            </div>
                                            <div class="form-group">
                                                <label for="color" class="text-dark">Color:</label>
                                                <input type="text" class="form-control" name="color" value={$prenda->color} required>
                                            </div>
                                            <div class="form-group" >
                                                <label for="talle" class="text-dark">Talle</label>
                                                <select class="form-control" name="talle">
                                                    <optgroup label="Selecione su tipo de talle preferido"> 
                                                        <option value="XS"  {if $prenda->talle eq "XS"}selected{/if}>XS</option>
                                                        <option value="S" {if $prenda->talle eq "S"}selected{/if}>S</option>
                                                        <option value="M" {if $prenda->talle eq "M"}selected{/if}>M</option>
                                                        <option value="L" {if $prenda->talle eq "L"}selected{/if}>L</option>
                                                        <option value="XL" {if $prenda->talle eq "XL"}selected{/if}>XL</option>
                                                        <option value="XXL" {if $prenda->talle eq "XXL"}selected{/if}>XXL</option>
                                                        <option value="XXXL" {if $prenda->talle eq "XXXL"} selected{/if}>XXXL</option>
                                                        <option value="Otro" {if $prenda->talle eq "Otro"}selected{/if}>Otro</option>
                                                    </optgroup>
                                                </select>
                                            </div>
                                        </div>
                                        {* <div class="form-group">
                                            <label for="img"></label>
                                            <input type="file" class="form-control" id="file_img" name="img">
                                        </div> *}
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
                        <div class="modal fade" id="img{$prenda->id}" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-sm">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">{$prenda->tipo}:</h5>
                                    </div>
                                    <div class="modal-body">
                                        {if $prenda->img eq ""}
                                        <p>No tenemos una imagen para este producto, usted puede agregar una</p>
                                        {/if}
                                        <div class="modal-img-product pl-2"> 
                                            {if $prenda->img neq ""}
                                            <img src="uploads/{$prenda->img}" alt="{$prenda->img}" class="img rounded" width="250px">
                                            {else}
                                            <img src="uploads/img_404.png" alt="img 404" class="img rounded" width="250px">
                                            {/if}
                                            <div  class="modal-img-buttons d-flex flex-row ">
                                                <a  href="deleteImg/{$prenda->id}" class="btn btn-danger text-whie {if $prenda->img eq ""}disabled{/if}"><i class="fas fa-times-circle"></i></a>
                                                <form class="form-inline inputWrapper" action="editImg/{$prenda->id}" method="POST" enctype="multipart/form-data">
                                                    <button type="submit" class="btnnnb btn-primary">Ok</button>
                                                    <div class="inputWrapper">
                                                        <label class="btn btn-primary text-whie m-0" for="img" class="p-0 m-0"><i class="fas fa-arrow-circle-up"></i></label>
                                                        <input type="file" class="fileInput" id="file_img" name="img">
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </tr>
                    {/foreach}
                    {if $userData.user.rol.colab eq true}
                    <tr>
                        <form class="form p-0 m-0" action="insertProductInCategory" method="POST" enctype="multipart/form-data">
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
                    <tr class="table table-striped table-light table-responsive-sm shadow text-center mt-3 mb-0">
                        <td scope="row" colspan="5" class="">
                            <ul class="pagination">
                                <li class="page-item {if $pagePointed eq 1} disabled{/if}">
                                    <a class="page-link" href="products/{$pagePointed - 1}/{$search}" tabindex="-1" aria-disabled="true">Prev</a>
                                </li>
                                {if $pagePointed lte 5}
                                {for $page=1 to $pagePointed}
                                <li class="page-item {if $pagePointed eq $page} active{/if}">
                                    <a class="page-link" href="products/{$page}/{$search} ">{$page}</a>
                                </li>
                                {/for}
                                {else}
                                {for $page=$pagePointed-5 to $pagePointed}
                                <li class="page-item {if $pagePointed eq $page} active{/if}">
                                    <a class="page-link" href="products/{$page}/{$search} ">{$page}</a>
                                </li>
                                {/for}
                                {/if}

                                {if $pagePointed gte $cantPaginas-5}
                                {for $page=1+$pagePointed to $cantPaginas}
                                <li class="page-item {if $pagePointed eq $page} active{/if}">
                                    <a class="page-link" href="products/{$page}/{$search} ">{$page}</a>
                                </li>
                                {/for}
                                {else}
                                {for $page=1+$pagePointed to $pagePointed+5}
                                <li class="page-item {if $pagePointed eq $page} active{/if}">
                                    <a class="page-link" href="products/{$page}/{$search} ">{$page}</a>
                                </li>
                                {/for}
                                {/if}

                                <li class="page-item  {if $pagePointed eq $cantPaginas} disabled{/if}">
                                    <a class="page-link" href="products/{$pagePointed + 1}/{$search}">Next</a>
                                </li>
                            </ul>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
{include file="footer.tpl"}