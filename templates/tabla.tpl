{include file="header.tpl" }
                <div></div>
                <div class="container mt-1 mb-1 bg-secondary">
                    <div class="row">
                        <div class="d-inline-flex justify-content-start align-items-center">
                            <figure class="figure text-center">
                                    <img src="https://images.pexels.com/photos/1777321/pexels-photo-1777321.jpeg?auto=compress&cs=tinysrgb&h=750&w=1260" class="rounded-circle" alt="colleciones"  width="250" height="250">
                            </figure>
                            <div class="text-center display-1">
                                <h1>Categoria: {$categoria->coleccion}</h1>
                            </div>
                        </div>
                        <table class="table bg-light">
                            <thead>
                                <tr>
                                    <th scope="col">Prenda</th>
                                    <th scope="col">Color</th>
                                    <th scope="col">Talle</th>
                                </tr>
                            </thead>
                            <tbody>
                            {foreach from=$producto item=prenda}
                                <tr>
                                    <td>{$prenda->tipo}</td>
                                    <td>{$prenda->color}</td>
                                    <td>{$prenda->talle}</td>
                                </tr>
                            {/foreach}
                            </tbody>
                        </table>
                    </div>
                </div>
{include file="footer.tpl"}