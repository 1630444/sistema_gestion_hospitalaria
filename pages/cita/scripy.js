const fecha = document.querySelector('#EXC');
 
fecha.addEventListener('change',getFechas);
//aulas.addEventListener('change',getAula); 
//carrera.addEventListener('change',getPlanes);
//carrera.addEventListener('change',getMaterias);
//carrera.addEventListener('change',getProfes); 
//grupo.addEventListener('change',getMaterias);
//plan.addEventListener('change',getMaterias);



$tabla = '';



function getFechas(e){
    e.preventDefault();    
    var fecha = document.querySelector('#EXC').value;//fecha
  console.log("AAAAAAAAA");
   console.log(fecha); 
    const tabla = 'citas';
    const tipo = '999';
   // const datos = new FormData();
       // datos.append('id',id);        
        
        //llama a AJAX
        //crea objeto
        const xhr = new XMLHttpRequest();
        //abrir conexion
        xhr.open('GET',`servidor.php?id_carrera=${fecha}&tabla=${tabla}&tipo=${tipo}`,true);
        //console.log(`servidor.php?id_carrera=${id}&tabla=${tabla}`);
        //recibe respuesta
   console.log("nihao");
        xhr.onload = function() {
            if(this.status===200){                
                var respuesta = '';
                var mpos='';
                const div = document.querySelector('#repampanos');
                try {
                    //console.log(xhr.responseText);
                    respuesta = JSON.parse(xhr.responseText);
                     
                     
                    div.innerHTML = respuesta;
                } catch(error) {                    
                    div.innerHTML = respuesta;
                  console.log("nihao12");
                }     
            }
        };        

        //enviamos peticion
        xhr.send();
    }


/////////////

function getClases(e){
    e.preventDefault();    
    const id = document.querySelector('#select2_grupo').value;
    const tabla = 'clases';
    const tipo = '4';
    const datos = new FormData();
        datos.append('id',id);        
        
        //llama a AJAX
        //crea objeto
        const xhr = new XMLHttpRequest();
        //abrir conexion
        xhr.open('GET',`servidor.php?id_carrera=${id}&tabla=${tabla}&tipo=${tipo}`,true);
        //console.log(`servidor.php?id_carrera=${id}&tabla=${tabla}`);
        //recibe respuesta
        xhr.onload = function() {
            if(this.status===200){                
                var respuesta = '';
                var mpos='';
                const div = document.querySelector('#select2_clases');
                try {
                    //console.log(xhr.responseText);
                    respuesta = JSON.parse(xhr.responseText);
                    
                    mpos = '<option value="default"> Selecciona1. </option>';
                    for(var i=0;i<respuesta.length;i++){
                        mpos += '<option value="' + respuesta[i].id + '"> ' + respuesta[i].clave + ' </option>';
                    } 
                    div.innerHTML = mpos;
                } catch(error) {                    
                    div.innerHTML = mpos;
                }     
            }
        };        

        //enviamos peticion
        xhr.send();
    }



function getGrupos(e){
    e.preventDefault();    
    const id = document.querySelector('#select2_carrera').value;
    const tabla = 'grupos';
    const tipo = '1';
    const datos = new FormData();
        datos.append('id',id);        
        
        //llama a AJAX
        //crea objeto
        const xhr = new XMLHttpRequest();
        //abrir conexion
        xhr.open('GET',`servidor.php?id_carrera=${id}&tabla=${tabla}&tipo=${tipo}`,true);
        //console.log(`servidor.php?id_carrera=${id}&tabla=${tabla}`);
        //recibe respuesta
        xhr.onload = function() {
            if(this.status===200){                
                var respuesta = '';
                var mpos='';
                const div = document.querySelector('#select2_grupo');
                try {
                    //console.log(xhr.responseText);
                    respuesta = JSON.parse(xhr.responseText);
                    
                    mpos = '<option value="default"> Selecciona. </option>';
                    for(var i=0;i<respuesta.length;i++){
                        mpos += '<option value="' + respuesta[i].id + '"> ' + respuesta[i].clave + ' </option>';
                    }

                    div.innerHTML = mpos;
                } catch(error) {                    
                    div.innerHTML = mpos;
                }     
            }
        };        

        //enviamos peticion
        xhr.send();
    }

function getPlanes(e){    
    e.preventDefault();    
    const id = document.querySelector('#select2_carrera').value;
    const tabla = 'planes_estudio';
    const tipo = '1';
    const datos = new FormData();
        datos.append('id',id);        
        
        //llama a AJAX
        //crea objeto
        const xhr = new XMLHttpRequest();
        //abrir conexion
        xhr.open('GET',`servidor.php?id_carrera=${id}&tabla=${tabla}&tipo=${tipo}`,true);
        //console.log(`servidor.php?id_carrera=${id}&tabla=${tabla}`);
        //recibe respuesta
        xhr.onload = function() {
            if(this.status===200){                
                var respuesta = '';
                var mpos='';
                const div = document.querySelector('#select2_plan');
                try {
                    //console.log(xhr.responseText);
                    respuesta = JSON.parse(xhr.responseText);
                    
                    mpos = '<option value="default"> Selecciona. </option>';
                    for(var i=0;i<respuesta.length;i++){
                        mpos += '<option value="' + respuesta[i].id + '"> ' + respuesta[i].clave + ' </option>';
                    }

                    div.innerHTML = mpos;
                } catch(error) {                    
                    div.innerHTML = mpos;
                }     
            }
        };        

        //enviamos peticion
        xhr.send();
    }
 


function getProfes(e){    
    e.preventDefault();    
    const id = document.querySelector('#select2_carrera').value;
    const tabla = 'maestros';
    const tipo = '3';
    //const plan = document.querySelector('#select2_plan').selected;    
    var plan = document.getElementById('select2_plan').value;
    console.log('Plan elegido ',plan);

    const datos = new FormData();
        datos.append('id',id);    
        //llama a AJAX
        //crea objeto
        const xhr = new XMLHttpRequest();
        //abrir conexion
        xhr.open('GET',`servidor.php?id_carrera=${id}&tabla=${tabla}&tipo=${tipo}&id_plan=${plan}`,true);
        //console.log(`servidor.php?id_carrera=${id}&tabla=${tabla}`);
        //recibe respuesta
        xhr.onload = function() {
            if(this.status===200){
                var respuesta = '';
                var mpos='';
                const div = document.querySelector('#select2_profesor');
                try {
                    console.log(xhr.responseText);
                    respuesta = JSON.parse(xhr.responseText); 
                    for(var i=0;i<respuesta.length;i++){
                        //mpos += '<option value="' + respuesta[i].id + '"> ' + respuesta[i].clave + ' </option>';
                        mpos += '<option value="' + respuesta[i].id + '"> ' + respuesta[i].nombre + ' </option>';
                    }

                    div.innerHTML = mpos;
                } catch(error) {                    
                    div.innerHTML = mpos;
                }     
            }
        };        

        //enviamos peticion
        xhr.send();
    }
    
function getMaterias(e){    
    e.preventDefault();    
    const id = document.querySelector('#select2_carrera').value;
    const tabla = 'planes_con_materias';
    const tipo = '2';
    //const plan = document.querySelector('#select2_plan').selected;    
    var plan = document.getElementById('select2_plan').value;
    console.log('Plan elegido ',plan);

    const datos = new FormData();
        datos.append('id',id);        
        
        //llama a AJAX
        //crea objeto
        const xhr = new XMLHttpRequest();
        //abrir conexion
        xhr.open('GET',`servidor.php?id_carrera=${id}&tabla=${tabla}&tipo=${tipo}&id_plan=${plan}`,true);
        //console.log(`servidor.php?id_carrera=${id}&tabla=${tabla}`);
        //recibe respuesta
        xhr.onload = function() {
            if(this.status===200){
                var respuesta = '';
                var mpos='';
                const div = document.querySelector('#select2_materia');
                try {
                    console.log(xhr.responseText);
                    respuesta = JSON.parse(xhr.responseText);
                    

                    for(var i=0;i<respuesta.length;i++){
                        //mpos += '<option value="' + respuesta[i].id + '"> ' + respuesta[i].clave + ' </option>';
                        mpos += '<option value="' + respuesta[i].id + '"> ' + respuesta[i].nombre + ' </option>';
                    }

                    div.innerHTML = mpos;
                } catch(error) {                    
                    div.innerHTML = mpos;
                }     
            }
        };        

        //enviamos peticion
        xhr.send();
    }

