function JSONPgetLinesCallback(JSONResult)
{
    cargarOpcionesMenuRecorridosXLinea(JSONResult);
}


function onCompleteGetCorredorRamalAllAjaxRequest(busInformation)
{
    //Validamos que el corredor obtenido no exista en nuestra lista de corredores
    for (var i = 0; i < arrCorredores.length; i++) {
        for (var j = 0; j < busInformation.length; j++) {
            if (arrCorredores[i].id === busInformation[j].id)
            {
                return null;
            }
        }
    }
    
    for (var j = 0; j < busInformation.length; j++) 
    {
        var arrPolylineMarkers = drawBusRoute(busInformation[j], getRandomColor());
        
        busInformation[j].mapRoute = arrPolylineMarkers[0];
        
        busInformation[j].mapMarkers = arrPolylineMarkers[1];
        arrCorredores.push(busInformation[j]);
    }
}