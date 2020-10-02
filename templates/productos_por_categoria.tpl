{include file="header.tpl" }

<div class="conteiner">
    <div class="lista">
        <ul class="list-group"> 
              
             {foreach from= $productos item= producto}
             
                 
               

                <li class="list-group-item">{$producto->tipo} {$producto->color} {$producto->talle}</li>
                 
             {/foreach}

                  

        </ul>
    </div>
 </div>   



{include file="footer.tpl"}