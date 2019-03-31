const formulario = document.querySelector('#select2_carrera');
formulario.addEventListener('change',leeFormulario);

function leeFormulario(e){
    e.preventDefault();
    const id = document.querySelector('#select2_carrera').value;
    const datos = new FormData();
        datos.append('id',id);


        //llama a AJAX
        //crea objeto
        const xhr = new XMLHttpRequest();
        //abrir conexion
        xhr.open('GET',`servidor.php?id_carrera=${id}`,true);
        //recibe respuesta
        xhr.onload = function() {
            if(this.status===200){
                const respuesta = JSON.parse(xhr.responseText);
                //console.log(respuesta);
                var mpos='';
               /// mpos = '<select>';
                for(var i=0;i<respuesta.length;i++){
                   // mpos += respuesta[i].nombre + '<br/>';

                   mpos += '<option value="'+respuesta[i].id+'"> ' +
                   respuesta[i].nombre + '</option>';
                   console.log(respuesta[i].query);
                }
                console.log("paso");
              //  mpos += '</select>';
                const div = document.querySelector('#select2_plan');
                
                div.innerHTML = mpos;
            }
            console.log("pasnoo");
        };
/*
        xhr.onload = function() {
            if(this.status===200){
                const respuesta = JSON.parse(xhr.responseText);
                //console.log(respuesta);
                var mpos='';
                mpos += '<select type="text" name="municipios" id="municipios" placeholder="Municipios">';
                for(var i=0;i<respuesta.length;i++){
                    mpos += '<option> ' + respuesta[i].nombre + ' </option>';
                }
                mpos += '</select>';
                const div = document.querySelector('#municipios');
                div.innerHTML = mpos;
                console.log("si");
            }
        };
*/
        //enviamos peticion
        xhr.send();
    }