/* 
ESTA ES UNA ESTRUCTURA PARA TRABAJAR JAVA SCRIPT LLAMADA PATRON MODULAR 
*/

var personas = (function (personas, undefined) {

    var _disabled = true;

 //----------------ENVIO POR AJAX POR METODO POST ------------------------////

 personas.llenarModalEditar = function () {

        $(".btn-editar").on("click", function (e) {   //SE ACTIVA CUANDO SE HACE CLIC EN EL BOTON CON CLASE (btn-editar)

            e.preventDefault();

            var idPersona=this.id;   // CON EL (this.id) PODEMOS SACAR EL CONTENIDO DE LA ID  DEL BOTON CON LA CLASE (btn-editar) 
                                     //AL CUAL DIMOS CLIC   

            //AJAX ES UNA ESTRUCTURA PROPIA DE JQUERY Q PERMITE EL ENVIAR Y RECIBIR DATOS POR POST Y GET 
            //TYPE: TIPO DE ENVIO   / URL: LA URL DONDE ENVIARAS O RECIBIRAS ALGUN DATO / DATA: PARA ENVIAR VARIABLES

            $.ajax({

                type: "POST",
                url: 'bodies/tabla.php',

                data: { idPer: idPersona },

                success: function (data) {  //EL JSON QUE ENVIAMOS DESDE BUSCAR_DATOS_ID SE ALMACENA EN DATA 

                    var oDato = JSON.parse(data);   // JSON.parse convierte ese JSON en un objeto 

                    $('#codPersona').val(oDato[0].nPerCodigo);
                    $('#nomPersona').val(oDato[0].cPerNombre);
                    $('#apePersona').val(oDato[0].cPerApellido);
                    $('#dniPersona').val(oDato[0].cPerDni);
                    $('#emaPersona').val(oDato[0].cPerEmail);
                    $('#telPersona').val(oDato[0].cPerTelefono);

                },

            });
        });

    },
personas.mostrar = function () {

        $(".btn-mostrar").on("click", function (e) {   //SE ACTIVA CUANDO SE HACE CLIC EN EL BOTON CON CLASE (btn-editar)

            e.preventDefault();

            var idPersona=this.id;   // CON EL (this.id) PODEMOS SACAR EL CONTENIDO DE LA ID  DEL BOTON CON LA CLASE (btn-editar) 
                                     //AL CUAL DIMOS CLIC   

            //AJAX ES UNA ESTRUCTURA PROPIA DE JQUERY Q PERMITE EL ENVIAR Y RECIBIR DATOS POR POST Y GET 
            //TYPE: TIPO DE ENVIO   / URL: LA URL DONDE ENVIARAS O RECIBIRAS ALGUN DATO / DATA: PARA ENVIAR VARIABLES

            $.ajax({

                type: "POST",
                url: 'bodies/tabla.php',

                data: { idPer: idPersona },

                success: function (data) {  //EL JSON QUE ENVIAMOS DESDE BUSCAR_DATOS_ID SE ALMACENA EN DATA 

                    var oDato = JSON.parse(data);   // JSON.parse convierte ese JSON en un objeto 

                    $('#codPersona').val(oDato[0].nPerCodigo);
                    $('#nomPersona').val(oDato[0].cPerNombre);
                    $('#apePersona').val(oDato[0].cPerApellido);
                    $('#dniPersona').val(oDato[0].cPerDni);
                    $('#emaPersona').val(oDato[0].cPerEmail);
                    $('#telPersona').val(oDato[0].cPerTelefono);

                },

            });
        });

    },

  //----------------ENVIO POR METODO GET SIN AJAX------------------------ /////

  personas.eliminarPersona = function () {

        $(".btn-eliminar").on("click", function (e) { //SE ACTIVA CUANDO SE HACE CLIC EN EL BOTON CON CLASE (btn-eliminar)

            e.preventDefault();

            var id=this.id; // CON EL (this.id) PODEMOS SACAR EL CONTENIDO DE LA ID  DEL BOTON CON LA CLASE (btn-eliminar) AL CUAL DIMOS CLIC  


            p = confirm("¿Estas seguro que desea eliminar?");

            if(p){ 

                 window.location="controlers/eliminar_persona.php?identificador="+id;    //ENVIAMOS POR GET EL ID PARA LUEGO RECIBIRLO EN eliminar_persona.php
             }
         });
    };


    return personas;

})(personas || {});

$(function () {

    personas.eliminarPersona();
    personas.llenarModalEditar();

});


