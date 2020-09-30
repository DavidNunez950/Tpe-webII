{include "header.tpl" }
                <style>
                    .table .tbody tr {
                        cursor: pointer;
                    }

                    .hideTableRow{
                        position: absolute;
                    }
                </style>
                <div class="container mt-2 bg-white border border-secondaryp-3 mb-5 rounded shadow">
                    <div class="row">
                        <div class="w-100 p-3">
                            <div class="w-100 h-100 d-inline-flex justify-content-start align-items-center bg-light">
                                <figure class="figure text-center position-relative mt-0 mb-0 pt-0 pb-0 mr-n4">
                                    <img src="https://images.pexels.com/photos/1777321/pexels-photo-1777321.jpeg?auto=compress&cs=tinysrgb&h=750&w=1260" class="rounded-circle mr-n5" alt="colleciones"  width="250" height="250">
                                </figure>
                                <div class="h-100 w-100 ml-n5 pl-5 display-1 bg-light border-secondary shadow">
                                    <h1 class="ml-5 pl-5 pt-5 d-inline align-middle">Categoria: {$categoria->coleccion}</h1>
                                </div>
                            </div>
                        </div>
                        <div class="w-100 pr-5 pl-5">
                            <table class="table table-striped table-light table-responsive-sm shadow">
                                <thead class="thead-dark">
                                    <tr>
                                        <th scope="col">Prenda</th>
                                        <th scope="col">Color</th>
                                        <th scope="col">Talle</th>
                                        <th scope="col">Editar</th>
                                    </tr>
                                </thead>
                                <tbody>
                                {* {foreach from=$producto item=prenda}
                                    <tr>
                                        <td>{$prenda->tipo}</td>
                                        <td>{$prenda->color}</td>
                                        <td>{$prenda->talle}</td>
                                    </tr>
                                {/foreach} *}
                                {foreach from=$producto item=prenda}
                                    <tr>
                                        <td>{$prenda->tipo}</td>
                                        <td>{$prenda->color}</td>
                                        <td>{$prenda->talle}</td>
                                        <td>
                                            <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                                <a href="delete/{$prenda->id}" class="btn btn-danger  stretched-link text-white">Borrar</a>
                                                <button type="button"  class="btn btn-primary stretched-link text-white" data-toggle="collapse" data-target="#prenda{$prenda->id}" aria-expanded="false" aria-controls="collapseExample">Editar</a></button>
                                            </div>
                                        </td>
                                        <td calss="tr" colspan="4"> test a
                                        {* <tr class="collapse" id="prenda{$prenda->id}" style="display:table-row"> *}
                                                <div class="collapse" id="prenda{$prenda->id}">
                                                    <div class="card card-body">
                                                        <form class="form-inline" action="modificar/{$prenda->id}" method="POST">
                                                            <div class="form-group">
                                                                <label for="career">Career:</label>
                                                                <input type="text" class="form-control" name="career" required>
                                                            </div>
                                                            <button type="submit" class="btn btn-primary">Submit</button>
                                                        </form>
                                                    </div>
                                                </div> 
                                        </td>
                                    </tr>
                                {/foreach}
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <script src="js/hideRowTable.js"></script>
{* {include "foother.tpl" }             *}
