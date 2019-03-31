const carrera = document.querySelector('#select2_carrera');
const grupo = document.querySelector('#select2_grupo');
const plan = document.querySelector('#select2_plan');
const materia = document.querySelector('#select2_materia');

carrera.addEventListener('change',getGrupos);
carrera.addEventListener('change',getPlanes);
carrera.addEventListener('change',getMaterias);

grupo.addEventListener('change',getMaterias);
plan.addEventListener('change',getMaterias);


$tabla = '';

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


