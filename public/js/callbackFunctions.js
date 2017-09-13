function JSONPgetLinesCallback(JSONResult)
{
    cargarOpcionesMenuRecorridosXLinea(JSONResult);
}



function JSONPgetAllLinesByNumberAndLetterCallback (busInformation)
{
    for( var i = 0; i < busInformation.length; i++)
    {
        var arrCorredorStopsRoute = [
                            busInformation[i].number, 
                            busInformation[i].letter, 
                            busInformation[i].zone, 
                            busInformation[i].stops,
                            busInformation[i].route
                        ];
        arrCorredoresBusStopRoute.push(arrCorredorStopsRoute);
  

        var rutaBusCoordenadas = new Array(); 

        for (var j = 0; j < busInformation[i].route.length; j++) 
        {
            rutaBusCoordenadas[j] = {lat: busInformation[i].route[j].latitud, lng: busInformation[i].route[j].longitud};
        }
        
        var colorRoute = Math.floor(Math.random()*16777215).toString(16);
        var PolyLine = new google.maps.Polyline({
          path: rutaBusCoordenadas,
          map: map,
          geodesic: true,
          strokeColor: '#'+colorRoute,
          strokeOpacity: 1.0,
          strokeWeight: 2
        });


        var arrMark = [];
        for (var j = 0; j < busInformation[i].stops.length; j++) 
        {
            arrMark.push(new google.maps.Marker(
            {
                map: map,
                position: {lat: busInformation[i].stops[j].latitud, lng: busInformation[i].stops[j].longitud},
                icon: {
                    path: google.maps.SymbolPath.CIRCLE,
                    scale: 3, 
                    strokeColor:'#'+colorRoute
                }
                
            }));
        }

         arrMarksAndPathBusStopRoute.push(
                [
                    busInformation[i].number, 
                    busInformation[i].letter, 
                    busInformation[i].zone, 
                    arrMark, 
                    PolyLine
                ]);
    }

}