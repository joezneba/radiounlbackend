/* global baseurl */
$(function () {
//    notificacion();
    setInterval(notificacion, 1000);//ejecuta una funcion cada 3s
});
function notificacion() {
    $.ajax({
        url: "http://localhost/sius/Servicios_SW/disponibilidad",
        type: 'GET',
        success: function (data) {
            var datos = eval(data.response);
            html = '<a href="#" noclick="notificacion()"class="dropdown-toggle" data-toggle="dropdown" title="Notificacones de Servicios">';
            html += '<i class="glyphicon glyphicon-globe"></i><b class="_3z_5 _51lp" >' + datos.length + '</b></a>';
            html += '<ul class="dropdown-menu alert-dropdown">';
            if (datos.length > 0) {
                for (var i = 0; i < datos.length; i++) {
                    console.log(datos[i].DESCRIPCION);
                    var id = datos[i].contribuidorIDCONTRIBUIDOR;
                    html += '<li>';
                    html += '<a href="' + baseurl + 'servicios/inforServicio/' + id + '" ><i class="glyphicon glyphicon-info-sign"></i><span class="label label-danger"> ' + datos[i].DESCRIPCION + '</span></a>';
                    html += '</li>';
                    /*
                    <li>
                            <a href="#">Alert Name <span class="label label-danger">Alert Badge</span></a>
                        </li> 
                    */
                }
            } else {
                html += '<li>';
                html += '<a><i class="glyphicon glyphicon-info-sign"></i> Ninguna Notificación</a>';
                html += '</li>';
            }
            html += '</ul>';
            $('#notificacion').html(html);
        }
    });
}
