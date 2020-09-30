{include file="header.tpl" }

    <div class="container mt-1 mb-1 bg-secondary">
        <div class="row">
            <div class="text-center display-1">
                <h1>Categorias</h1>
            </div>
        
            <ul class="list-group">
            
                {foreach from=$categorias item=categoria}   
                    <li class="list-group-item">
                    <img src="{$categoria->url_img}" width="50" height="50"/>{$categoria->coleccion}<button type="button" class="btn btn-dark">Ver</button></li>
                {/foreach}
            </ul>
        </div>
    </div>

{include file="footer.tpl"}