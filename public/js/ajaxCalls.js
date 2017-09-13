function getCorredorRamalAll(corredorName, ramalName)
{
    $.ajax(
    {
        url: "http://comollego_ws.app/api/buseslines/all/"+corredorName+"/"+ramalName,
        type: 'GET',
        async: false,
        contentType: "application/json",
        dataType: 'jsonp'
    });
}