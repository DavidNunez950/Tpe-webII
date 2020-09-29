{include file="header.tpl" }

    <div class="container mt-1 mb-1 bg-secondary">
        <div class="row">
            <div class="text-center display-1">
                <h1>Categorias</h1>
            </div>
        
            <ul class="list-group">
            
                {foreach from=$categorias item=categoria}   
                    <li class="list-group-item">{$categoria->}</li> //ver tabla en BBSS por img y botones 
                {/foreach}
            </ul>
        </div>
    </div>

{include file="footer.tpl"}