function getCorredorRamalAll(corredorName, ramalName)
{
    $.ajax(
    {
        url: "http://comollego_ws.app/api/buseslines/all/"+corredorName+"/"+ramalName,
        type: 'GET',
        async: false,
        dataType: "jsonp",
        beforeSend: function(algo) {
            $("#div-loading-corredor-"+corredorName+"-ramal-"+ramalName).toggleClass("w3-hide");
            $("#input-checkbox-corredor-"+corredorName+"-ramal-"+ramalName).toggleClass("w3-hide");
        },
        complete: function(response) {
            $("#div-loading-corredor-"+corredorName+"-ramal-"+ramalName).toggleClass("w3-hide");
            $("#input-checkbox-corredor-"+corredorName+"-ramal-"+ramalName).toggleClass("w3-hide");
        }
    });
}