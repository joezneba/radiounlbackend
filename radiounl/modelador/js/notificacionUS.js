/* global baseurl */
$(function () {
//    notificacionUS();
    setInterval(notificacionUS, 1000);//ejecuta una funcion cada 3s
});
function notificacionUS() {
    $.ajax({
        url: "http://localhost/sius/UnidadSalud_SW/disponibilidad",
        type: 'GET',
        success: function (data) {
            var datos = eval(data.response);
            console.log(datos);
            html = '<a href="#" noclick="notificacion()"class="dropdown-toggle" data-toggle="dropdown" title="Papelera Unidades de Salud">';
            html += '<i class="glyphicon glyphicon-trash"></i><b class="_3z_5 _51lp" >' + datos.length + '</b></a>';
            html += '<ul class="dropdown-menu alert-dropdown">';
            if (datos.length > 0) {
                for (var i = 0; i < datos.length; i++) {
                    console.log(datos[i].DESCRIPCION);
                    var id = datos[i].IDUNIDADSALUD;
                    html += '<li>';
                    html += '<a href="' + baseurl + 'unidadSalud/papelera/' + id + '" ><i class="glyphicon glyphicon-info-sign"></i> ' + datos[i].NOMBRE_COMUN + '</a>';
                    html += '</li>';
                }
            } else {
                html += '<li>';
                html += '<a><i class="glyphicon glyphicon-info-sign"></i> Ninguna Notificación</a>';
                html += '</li>';
            }
            html += '</ul>';
            $('#notificacionUS').html(html);
        }
    });
}
