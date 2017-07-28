function buscar() {
    $("#busqueda").keyup(function (e) {
        var datoABuscar = $('#inputbuscador').val();
        if (datoABuscar === "") {
            alert("El campo debe conterner informacion");
        } else {
            //Quitar acentos 
            var acentos = "ÃÀÁÄÂÈÉËÊÌÍÏÎÒÓÖÔÙÚÜÛãàáäâèéëêìíïîòóöôùúüûÑñÇç";
            var original = "AAAAAEEEEIIIIOOOOUUUUaaaaaeeeeiiiioooouuuunncc";
            for (var i = 0; i < acentos.length; i++) {
                if (acentos.charAt(i) === 'ñ') {
                    datoABuscar = datoABuscar.replace(acentos.charAt(i), original.charAt(i) + 'i');
                } else {
                    datoABuscar = datoABuscar.replace(acentos.charAt(i), original.charAt(i));
                }
            }
            $.ajax({
                type: 'POST',
                url: "../escribirBD.php",
                data: {"mensaje": mensaje, "usuario": usuario},
                success: function () {
                    leer();
                }
            });
        }
    });

}