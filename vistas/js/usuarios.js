/*
 * VALIDAR EL REGISTRO DE USUARIO
 */
function registroUsuario(){
    
    /*
     * VALIDAR EL NOMBRE
     */
    var nombre = $("#regUsuario").val();
    if(nombre != ""){
       var expresion = /^[a-zA-ZñÑáéíóúÁÉÍÓÚ ]*$/;
       if(!expresion.test(nombre)){
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
    if(email != ""){
       var expresion = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,4})+$/;
       if(!expresion.test(email)){
          $("#regEmail").parent().before('<div class="alert alert-warning"><strong>ATENCIÓN:</strong>Escriba correctamente el correio electrónico</div>');
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
    if(password != ""){
       var expresion = /^[a-zA-Z0-9]*$/;
       if(!expresion.test(password)){
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
    if(politicas != "on"){
        $("#regPoliticas").parent().before('<div class="alert alert-warning"><strong>ATENCIÓN:</strong>Debe aceptar nuestras condiciones de uso y políticas de privacidad</div>')
        return false;
    }
    return true;
}




/*
 * VALIDAR EMAIL REPETIDO
 */
var validarEmailRepetido = false;

$("#regEmail").change(function(){
    var email = $("regEmail").val();
    var datos = new FormData();
    datos.append("validarEmail", email);
    $.ajax({
        url:rutaOculta+"ajax/usuarios.ajax.php",
        method: "POST",
        data: datos, 
        cache: false,
        contentType: false,
        processData: false,
        success:function(respuesta){
           if(!respuesta){
               
        
           } else {
               var modo = JSON.parse(respuesta).modo;
               
               if(modo == "directo"){
                   modo = "está página";
               } 
                $("#regEmail").parent().before('<div class="alert alert-warning"><strong>ERROR:</strong>El correo electrónico ya existe en la base de datos, fue registrado atraves de '+modo+' por favor ingrese otro diferente </div>');
               
           }
        }
    })
})

