<br>   
<form action="#" class="">
    <p>
        <div class="w3-row">
            <div class="w3-col">
                <div class="w3-row">
                    <div class="input-group">
                        <span class="input-group-addon" style="cursor:pointer" onclick="getLocation()" id="origen-span-addon">
                            <i class="glyphicon glyphicon-screenshot"></i>
                        </span>
                        <label for="destino-input" class="control-label sr-only">Desde:</label>
                        <input type="text" id="origen-input" class="w3-input input-lg form-control" placeholder="Desde" tabindex="1" 
                           aria-describedby="origen-span-addon"/>
                    </div>

                    <!---------------------------->
                    <input type="hidden" id="origen-street_number"/>
                    <input type="hidden" id="origen-route"/>
                    <input type="hidden" id="origen-locality"/>
                    <input type="hidden" id="origen-administrative_area_level_1"/>
                    <input type="hidden" id="origen-postal_code"/>
                    <input type="hidden" id="origen-country"/>
                    <input type="hidden" id="origen-latitud"/>
                    <input type="hidden" id="origen-longitud"/>
                </div>
                <div class="w3-row">
                    <div class="w3-center">
                        <a href="#" id="btn-address-invest" class="fa fa-refresh" style="color:#337ab7" onclick="investAdsress()"></a>
                    </div>
                </div>
                <div class="w3-row">
                    <div class="input-group">
                        <span class="input-group-addon" style="cursor:pointer" id="destino-span-addon">
                            <i class="glyphicon glyphicon-screenshot"></i>
                        </span>
                        <label for="destino-input" class="control-label sr-only">Hasta:</label>
                        <input type="text" id="destino-input" class="w3-input input-lg form-control" placeholder="Hasta" tabindex="2" 
                               aria-describedby="destino-span-addon"/>
                    </div>
                    <!---------------------------->
                    <input type="hidden" id="destino-street_number"/>
                    <input type="hidden" id="destino-route"/>
                    <input type="hidden" id="destino-locality"/>
                    <input type="hidden" id="destino-administrative_area_level_1"/>
                    <input type="hidden" id="destino-postal_code"/>
                    <input type="hidden" id="destino-country"/>
                    <input type="hidden" id="destino-latitud"/>
                    <input type="hidden" id="destino-longitud"/>
                </div>
            </div>
        </div>
    </p>
    <div class="w3-row">
        <div class="w3-col">
            <div class="input-group w3-margin-top"><p>
                <label for="distancia-input">Distancia maxima a caminar: </label><label id="lblDistancia"> 500 mts.</label>
                <input type="range" id="distancia-input" class="form-control" min="50" max="2000" value="500" 
                       step="10" oninput="$('#lblDistancia').text(' '+value+' mts.') " tabindex="3"/></p>
            </div>
        </div>
    </div>
    <br/>
    <div class="form-group text-right">
        <button class="btn btn-primary btn-lg" tabindex="4">Calcular</button>
    </div>
</form>
