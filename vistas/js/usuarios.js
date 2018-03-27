/*
 * CAPTURA DE RUTAS
 */

var rutaActual = location.href;

$(".btnIngreso, .facebook, .google").click(function(){
    localStorage.setItem("rutaActual", rutaActual);
})





/*
 * FORMATAR OS CAMPOS
 */
$("input").focus(function(){
    $(".alert").remove();
})








/*
 * VALIDAR EMAIL REPETIDO
 */
var validarEmailRepetido = false;

$("#regEmail").change(function () {
    var email = $("#regEmail").val();
    var datos = new FormData();
    datos.append("validarEmail", email);
    $.ajax({
        url:rutaOculta + "ajax/usuarios.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        success:function (respuesta) {
            console.log("respuesta...:", respuesta);
            // assim não funciona pq a resposta false vem como uma string e não como bollean if(!respuesta){
            
            if (respuesta == "false") {

                $(".alert").remove(); // olho: não é alert do js é classe css
                validarEmailRepetido = false;
            } else {
                var modo = JSON.parse(respuesta).modo;

                if (modo == "directo") {
                    modo = "está página";
                }
                $("#regEmail").parent().before('<div class="alert alert-warning"><strong>ERROR:</strong>El correo electrónico ya existe en la base de datos, fue registrado atraves de ' + modo + ' por favor ingrese otro diferente </div>');
                validarEmailRepetido = true;

            }
        }
    })
})







/*
 * VALIDAR EL REGISTRO DE USUARIO
 */
function registroUsuario() {

    /*
     * VALIDAR EL NOMBRE
     */
    var nombre = $("#regUsuario").val();
    if (nombre != "") {
        var expresion = /^[a-zA-ZñÑáéíóúÁÉÍÓÚ ]*$/;
        
        if (!expresion.test(nombre)) {
            $("#regUsuario").parent().before('<div class="alert alert-warning"><strong>ATENCIÓN:</strong>No se permite numeros ni caracteres especialies</div>');
            return false;
        }
    } else {
        $("#regUsuario").parent().before('<div class="alert alert-warning"><strong>ATENCIÓN:</strong>Este campo es obligatório</div>');
        return false;
    }




    /*
     * VALIDAR EL EMAIL
     */
    var email = $("#regEmail").val();
    
    if (email != "") {
        
        var expresion = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,4})+$/;
        
        if (!expresion.test(email)) {
            $("#regEmail").parent().before('<div class="alert alert-warning"><strong>ATENCIÓN:</strong>Escriba correctamente el correio electrónico</div>');
            return false;
        }
        
        if(validarEmailRepetido){
            $("#regEmail").parent().before('<div class="alert alert-danger"><strong>ERROR:</strong>El correo electrónico ya existe en la base de datos, por favor ingrese otro diferente </div>');
            return false;
        }
    } else {
        $("#regEmail").parent().before('<div class="alert alert-warning"><strong>ATENCIÓN:</strong>Este campo es obligatório</div>');
        return false;
    }




    /*
     * VALIDAR CONTRASEÑA
     */
    var password = $("#regPassword").val();
    if (password != "") {
        var expresion = /^[a-zA-Z0-9]*$/;
        if (!expresion.test(password)) {
            $("#regPassword").parent().before('<div class="alert alert-warning"><strong>ATENCIÓN:</strong>No se permite caracteres especialies</div>');
            return false;
        }
    } else {
        $("#regPassword").parent().before('<div class="alert alert-warning"><strong>ATENCIÓN:</strong>Este campo es obligatório</div>');
        return false;
    }




    /*
     * VALITAR POLITICAS DE PRIVACIDAD
     */
    var politicas = $("#regPoliticas:checked").val();
    if (politicas != "on") {
        $("#regPoliticas").parent().before('<div class="alert alert-warning"><strong>ATENCIÓN:</strong>Debe aceptar nuestras condiciones de uso y políticas de privacidad</div>')
        return false;
    }
    return true;
}





/*=======================================================
 * CAMBIAR FOTO
 * ====================================================*/
$("#btnCambiarFoto").click(function(){
    $("#imgPerfil").toggle();
    $("#subirImagen").toggle();
})

$("#datosImagen").change(function(){
    
    var imagen = this.files[0];
    
    if(imagen["type"] != "image/jpeg"){
        
        $("#datosImagen").val("");
        
        swal({
            title: "ERROR!",
            text: "La imagen debe estar en formato JPG!",
            type: "error",
            confirmButtonText: "Cerrar",
            closeOnConfirm: false},
                function (isConfirm) {
                    if (isConfirm) {
                        window.location = rutaOculta+"perfil";
                    }
                });
    }
    
    else if(Number(imagen["size"]) > 2000000){
        
        $("#datosImagen").val("");
        
        swal({
            title: "ERROR!",
            text: "La imagen no debe pesar más de 2 MB!",
            type: "error",
            confirmButtonText: "Cerrar",
            closeOnConfirm: false},
                function (isConfirm) {
                    if (isConfirm) {
                        window.location = rutaOculta+"perfil";
                    }
                });
    } else {
        
        var datosImagen = new FileReader;
        datosImagen.readAsDataURL(imagen);
        
        $(datosImagen).on("load", function(event){
            var rutaImagen = event.target.result;
            $(".previsualizar").attr("src", rutaImagen);
        })
        
//        swal({
//            title: "Correcto!",
//            text: "La imagen se subió correctamente!",
//            type: "success",
//            confirmButtonText: "Cerrar",
//            closeOnConfirm: false},
//                function (isConfirm) {
//                    if (isConfirm) {
//                        window.location = rutaOculta+"perfil";
//                    }
//                });
    }
    
    
})



