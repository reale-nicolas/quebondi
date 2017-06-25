    <form action="#" class="">
        
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group has-feedback margin-bottom-5px">
                            <label for="origen-input" class="control-label sr-only">Desde:</label>
                            <input type="text" id="origen-input" class="form-control input-lg" placeholder="Desde" tabindex="1" aria-describedby="inputSuccess2Status"/>
                            <span class="glyphicon form-control-feedback hide" aria-hidden="true"></span>
                            <span id="inputSuccess2Status" class="sr-only">(success)</span>

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
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-2 col-md-offset-5 text-right">
                        <div class="form-group  has-feedback margin-bottom-5px">
                            <a href="#" id="btn-address-invest" class="glyphicon glyphicon-refresh" onclick="investAdsress()"></a>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group has-feedback">
                            <label for="destino-input" class="control-label sr-only">Hasta:</label>
                            <input type="text" id="destino-input" class="form-control input-lg" placeholder="Hasta" tabindex="2" aria-describedby="inputSuccess2Status"/>
                            <span class="glyphicon form-control-feedback hide" aria-hidden="true"></span>
                            <span id="inputSuccess2Status" class="sr-only">(success)</span>
                            
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
            </div>
        </div>
        
        <div class="form-group">
            <label for="distancia-input">Distancia maxima a caminar: </label><label id="lblDistancia"> 500 mts.</label>
            <input type="range" id="distancia-input" class="form-control" min="50" max="2000" value="500" 
                   step="10" oninput="$('#lblDistancia').text(' '+value+' mts.') " tabindex="3"/>
        </div>

        <div class="form-group text-right">
            <button class="btn btn-primary btn-lg" tabindex="4">Calcular</button>
        </div>
    </form>