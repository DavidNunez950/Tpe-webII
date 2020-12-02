
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
                        {if $userData.user.rol gte 0}
                        <th scope="col">Editar</th>
                        {/if}
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <button type="button"  class="btn{if $producto->img eq ""} btn-secondary {else} btn-warning{/if} text-white mr-1 rounded-circle" data-toggle="modal" data-target="#img{$producto->id}" aria-expanded="false"><i class="fas fa-images"></i></button>{$producto->tipo}
                        </td>
                        <td>{$producto->color}</td>
                        <td>{$producto->talle}</td>
                        <td>{$producto->coleccion}</td>
                        {if $userData.user.rol.colab eq true}
                        <td class="w-25">
                            <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                <button type="button" class="btn btn-danger  stretched-link text-whit" data-toggle="modal" data-target="#borrar{$producto->id}" aria-expanded="false"><i class="fas fa-trash-alt"></i></button>
                                <button type="button" class="btn btn-primary stretched-link text-white" data-toggle="modal" data-target="#modificar{$producto->id}" aria-expanded="false"><i class="far fa-edit"></i></button>
                            </div>
                        </td>
                        <div class="modal fade" id="borrar{$producto->id}" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content ">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Estas seguro de que quieres borrar la prenda {$producto->tipo} de la {$producto->coleccion}</h5>
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
                                    <form class="form-inline" action="editProduct/{$producto->id}" method="POST" enctype="multipart/form-data">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Estas seguro de que quieres realizar cambios de la producto: "{$producto->tipo}", de la {$producto->coleccion}</h5>
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
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-primary">Comfirmar</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        {/if}
                        <div class="modal fade" id="img{$producto->id}" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-sm">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">{$producto->tipo}:</h5>
                                    </div>
                                    <div class="modal-body">
                                        {if $producto->img eq ""}
                                        <p>No tenemos una imagen para este producto, usted puede agregar una</p>
                                        {/if}
                                        <div class="modal-img-product pl-2"> 
                                            {if $producto->img neq ""}
                                            <img src="uploads/{$producto->img}" alt="{$producto->img}" class="img rounded" width="250px">
                                            {else}
                                            <img src="uploads/img_404.png" alt="img 404" class="img rounded" width="250px">
                                            {/if}
                                            <div  class="modal-img-buttons d-flex flex-row ">
                                                {if $producto->img neq ""}
                                                <a  href="deleteImg/{$producto->id}" class="btn btn-danger text-whie {if $producto->img eq ""}disabled{/if}"><i class="fas fa-times-circle"></i></a>
                                                {/if}
                                                <form class="form-inline" action="editImg/{$producto->id}" method="POST" enctype="multipart/form-data">
                                                    <div class="inputWrapper">
                                                        <input type="file" class="fileInput" id="file_img" name="img">
                                                        <label class="btn btn-primary text-whie m-0" for="img" class="p-0 m-0"><i class="fas fa-arrow-up"></i></label>
                                                        <button type="submit" class="btn btn-success"><i class="fas fa-arrow-circle-up"></i></button>
                                                    </div>
                                                </form> 
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="w-100">
            <div class="col-12 bg-light pt-4">
                <form class="form" data-id-product={$producto->id} id="form-commentary">
                    <div class="form-group d-flex flex-row flex-nowrap alling-items-center   p-0 m-0">
                        <label for="text" class="text-dark col-3">Comenta y puntua el producto:</label>
                        <div class="form-group clasificacion p-0 rounded-pill">
                            <input id="radio1" type="radio" name="estrellas" value="5">
                            <label for="radio1"><i class="fas fa-star"></i></label>
                            <input id="radio2" type="radio" name="estrellas" value="4">
                            <label for="radio2"><i class="fas fa-star"></i></label>
                            <input id="radio3" type="radio" name="estrellas" value="3">
                            <label for="radio3"><i class="fas fa-star"></i></label>
                            <input id="radio4" type="radio" name="estrellas" value="2">
                            <label for="radio4"><i class="fas fa-star"></i></label>
                            <input id="radio5" type="radio" name="estrellas" value="1">
                            <label for="radio5"><i class="fas fa-star"></i></label>
                        </div>
                    </div>
                    <div class="form-group row  p-0 m-0">
                        <div class="form-group col-11">
                            <input type="text" class="form-control" name="text" required>
                        </div>
                        {if $userData.user.rol.colab eq true}
                        <div class="form-group col-1">
                            <button type="submit" class="btn btn-primary  rounded-circle"><i class="fas fa-paper-plane"></i></button>
                        </div>
                        {/if}
                    </div>
                </form>
            </div>
            {include file="../component/commentaries.html"}
        </div>
    </div>
</div>
<script src="js/commentaries.js"></script>
<script src="js/uploadBtn.js"></script>
{include file="footer.tpl"}