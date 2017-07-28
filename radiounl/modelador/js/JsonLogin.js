//$(document).ready(function () {
//    // Al pulsar el botón submit del formulario
//    $('#loginform').submit(function () {
//        // Obtengo los valores de los input de mi formulario
//        var email =$('#email').val();
//        var password=$('#password').val();       
//        var datos = {
//            'email': email,
//            'password': password
//        }
//        // Hacemos la petición ajax
//        $.ajax({
//            type: 'POST',
//            url: 'servidorLogin.php',
//            data: datos,
//            dataType: 'json',
//            success: success,
//            error: error
//        });
//        function success(data) {
//            $("#" + data.campo + "").focus();
//            $("#mensaje").append(data.error_msg);
//        }
//        function error() {
//            alert("error");
//            jQuery.error();
//        }
//        // detiene el submit por defecto
//        return false;
//    });
//
//});


////var contE = 0, contP = 0;
//$(document).ready(function () {
//    $("#email").focus();
//    $("form#loginform").submit(function ()
//    {
//        var Mail = $('input#validamail').val();
//        if (Mail == "1") {
//            $("#mensaje").html("<div class='alert alert-danger text-center' alert-dismissable> <button type='button' class='close' data-dismiss='alert'>&times;</button>El Correo es Incorrecto</div>");
//            $("#email").focus();
//            return false;
//        } else {
//            var Login = new Object();
//            Login.UserName = $('#email').val();
//            Login.Password = $('#password').val();
//            if (Login.UserName != "") {
//                if (Login.Password != "") {
//                    $("#mensaje").append("<div class='modal1'><div class='center1'> <center> <img src='" + baseurl + "/img/gif-load.gif'> Iniciando Sessión...</center></div></div>");
//                } else {
////                    if(contP === 0){
//                    $("#password").focus();
//                    $("#mensaje").append("<div class='alert alert-danger text-center' alert-dismissable> <button type='button' class='close' data-dismiss='alert'>&times;</button>El Password es Obligatorio</div>");
////                        contP=1;
////                    }
//                }
//            } else {
////                if(contE === 0){
//                $("#mensaje").append("<div class='alert alert-danger text-center' alert-dismissable> <button type='button' class='close' data-dismiss='alert'>&times;</button>El Correo es Obligatorio</div>");
//                $("#email").focus();
////                    contE=1;
////                }
//            }
//            var DatosJson = JSON.stringify(Login);
//            $.post(baseurl + 'login/validar', {LoginPost: DatosJson}, function (data, textStatus) {
//                $("#" + data.campo + "").focus();
//                $("#mensaje").append(data.error_msg);
//            }, "json");
//            return false;
//        }
//    });
//
//});