const formulario = document.querySelector('#form1');
const guardar = document.querySelector('#guardar_B');
const lista = document.querySelector('#lista');
const labo = document.querySelector('#lab');
const horaas = document.querySelector('#horarios');

var liss = [];
var ides;
var cont = 0;
window.onmouseover=function(e) {
        ides = (e.target.value);
};

formulario.addEventListener('submit',leeFormulario);
guardar.addEventListener('submit',guardarB);
lista.addEventListener('submit',listas);
labo.addEventListener('submit',laboratorio);
horaas.addEventListener('submit',hararios);

function laboratorio(e){
  e.preventDefault();	//Previene que el boton se comporte con naturaleza

	const nombre = ides;
  window.glob = ides;

	const xhr = new XMLHttpRequest();

	//xhr.open('GET',`servidorLAB.php?nomEstado=${nombre}`,true);
  xhr.open('GET',`servidorIF.php?nomEstado=${nombre}`,true);

	xhr.onload = function(){
		if(this.status===200){
			//const respuesta = JSON.parse(xhr.responseText);
      if(xhr.responseText.length>2){//-------------------------------------------------EN CASO DE SER LABORATORIO
        const xhrI = new XMLHttpRequest();

        xhrI.open('GET',`servidorLAB.php?nomEstado=${nombre}`,true);

        xhrI.onload = function(){
          if(this.status===200){
            const respuesta = JSON.parse(xhrI.responseText);
            //console.log(respuesta);
            var mpos="";
            for (var i=0;i<respuesta.length;i++) {
              var url = "http://eldelmomo.me/hospital/pages/laboratorioeimg/" + respuesta[i].resultados;
              mpos += '<a class="btb" href="' + url + '" target="_blank">Resultados</a>';
              mpos += '<br><br><b>Observaciones</b>';
              mpos += '<textarea rows="3" cols="72" disabled>' + respuesta[i].observaciones + '</textarea>';
            }
            const div = document.querySelector('#labor');
            div.innerHTML = mpos;/**/
          }
        };
        xhrI.send();/**/
      }else{//------------------------------------------------------------------------------EN CASO DE SER IMAGENOLOGIA
        const xhrI = new XMLHttpRequest();

        xhrI.open('GET',`servidorIMG.php?nomEstado=${nombre}`,true);

        xhrI.onload = function(){
          if(this.status===200){
            const respuesta = JSON.parse(xhrI.responseText);
            //console.log(respuesta);
            var mpos="";
            for (var i=0;i<respuesta.length;i++) {
              var url = "http://eldelmomo.me/hospital/pages/laboratorioeimg/" + respuesta[i].imagen;
              mpos+= "<b>Radiografía</b>";
              mpos += '<br><br><img width="100%" src="http://eldelmomo.me/hospital/pages/laboratorioeimg/' + respuesta[i].imagen + '">';
              mpos += '<a class="btb" href="' + url + '" target="_blank">Tamaño completo</a><br><br>';
            }
            const div = document.querySelector('#labor');
            div.innerHTML = mpos;/**/
          }
        };
        xhrI.send();/**/
      }
		}
	};
	xhr.send();
}

function listas(e){
  e.preventDefault();	//Previene que el boton se comporte con naturaleza
  if(ides=="bandera"){
    
    const div = document.querySelector('#msg');
    div.innerHTML += '<div class="alert alert-warning alert-dismissable"><button type="button" class="close" data-dismiss="alert">&times;</button>Se ha <strong>Guardado</strong> la receta </div>';
    
    const xhr = new XMLHttpRequest();//Primero se guarda la receta para despues asignarle la lsita receta

    xhr.open('GET',`servidor_GRES.php?id_cita=${document.getElementById("dato").value}`,false);

    xhr.onload = function(){

    };
    xhr.send();/**/
    
    for(v=0;v<cont;v++){
      var ddta = [];
      ddta.push(document.getElementById("dato").value);
    for(w=0;w<6;w++){
      
      if(w==0 || w==1){
        ddta.push(document.getElementById("t2").rows[v+1].cells[w].innerHTML);
      }else{
        var txx = document.getElementById("t2").rows[v+1].cells[w].innerHTML;
        var min = (txx.indexOf("name")+6);
        var max = (txx.indexOf("><div")-1);
        if(document.getElementsByName(txx.substring(min,max))[0].value==0){
          console.log(document.getElementById("t2").rows[v+1].style.backgroundColor = "#FA5858");
        }
        ddta.push(document.getElementsByName(txx.substring(min,max))[0].value);
      }
    }
      const xhr = new XMLHttpRequest();

      xhr.open('GET',`servidorGMED.php?id_cita=${ddta[0]}&id_med=${ddta[1]}&can=${ddta[3]}&dos=${ddta[4]}&dia=${ddta[5]}&hor=${ddta[6]}`,false);

      xhr.onload = function(){
        
      };
      xhr.send();
    }
  /**/}else{
    cont++;
    liss.push(ides);
    var mpos='';

    mpos='<table id="t2" class="inff" class="col-xs-12">';
    mpos+='<tr><th class="col-xs-1" style="text-align:center">ID</th><th class="col-xs-1" style="text-align:center">Nombre</th><th class="col-xs-2" style="text-align:center">Cantidad</th><th class="col-xs-2" style="text-align:center">Dosis</th><th class="col-xs-2" style="text-align:center">Hora</th><th class="col-xs-2" style="text-align:center">Día</th></tr>';
    for(y=0;y<liss.length;y++){
    const xhr = new XMLHttpRequest();

    xhr.open('GET',`servidorLIS.php?nomEstado=${liss[y]}`,true);

    xhr.onload = function(){
      if(this.status===200){
        const respuesta = JSON.parse(xhr.responseText);
        //console.log(respuesta);

        for (var i=0;i<respuesta.length;i++) {
          mpos += '<tr><td style="text-align:center">' + respuesta[i].id + '</td>';
          mpos += '<td style="text-align:center">' + respuesta[i].nombre + '</td>';
          mpos += '<td><div class="col-xs-1"></div><input min="0" max="10" class="col-xs-4" size="20" type="number" value="1" name="' + respuesta[i].nombre + 'C' + '"><div class="col-xs-4">Pza.</div></td>';
          mpos += '<td><div class="col-xs-1"></div><input min="1" max="10" class="col-xs-4" type="number" value="1" name="' + respuesta[i].nombre + 'D' + '"><div class="col-xs-4">Pastilla/ml.</div></td>';
          mpos += '<td><div class="col-xs-3">Cada </div><input min="1" max="24" class="col-xs-4" type="number" value="1" name="' + respuesta[i].nombre + 'H' + '"><div class="col-xs-1">Hrs.</div></td>';
          mpos += '<td><div class="col-xs-3">Por </div><input min="1" max="31" class="col-xs-4" type="number" value="1" name="' + respuesta[i].nombre + 'I' + '"><div class="col-xs-1">Días</div></td></tr>';
        }
        const div = document.querySelector('#listota');
        div.innerHTML = mpos;
      }
    };
    xhr.send();/**/
    }
  }
}

function guardarB(e){
  e.preventDefault();	//Previene que el boton se comporte con naturaleza

  const info = document.getElementById('bitaT').value;
  const vit = document.getElementById('vitalT').value;
  const motT = document.getElementById('motivoT').value;
	const nombre = glob;

	const xhr = new XMLHttpRequest();

	xhr.open('GET',`servidorGB.php?nomEstado=${nombre}&info=${info}&vit=${vit}&motT=${motT}`,true);

	xhr.onload = function(){
		
	};
	xhr.send();/**/
  const div = document.querySelector('#msg2');
    div.innerHTML += '<div class="alert alert-warning alert-dismissable"><button type="button" class="close" data-dismiss="alert">&times;</button>Se ha <strong>Guardado</strong> la bitácora </div>';
}

function leeFormulario(e){
  var d = new Date();
  var n = d.getFullYear() + "-" + (d.getMonth()+1) + "-" + d.getDate();
  
	e.preventDefault();	//Previene que el boton se comporte con naturaleza

	const nombre = ides;
  window.glob = ides;

	const xhr = new XMLHttpRequest();

	xhr.open('GET',`servidor.php?nomEstado=${nombre}`,true);

	xhr.onload = function(){
		if(this.status===200){
      var mpos='';
			const respuesta = JSON.parse(xhr.responseText);
			//console.log(respuesta);
      if(respuesta[0].fecha == n){//------------------------------------------------EN CASO DE SER DEL DIA DE LA CONSULTA
        
        //mpos = '<table width="100%" border="1px"><tr>';
        //mpos += "<th>Fecha</th><th>Motivo de atención</th><th>Signos vitales</th></tr><tr>";
        for (var y=0;y<respuesta.length;y++) {
          mpos += "<b>Fecha: </b>" + respuesta[y].fecha + "<br>";
          mpos += '<table><tr>';
          mpos += '<th><b>Motivo de atención: </b> <textarea id="motivoT" rows="1" cols="25">' + respuesta[y].motivo + '</textarea><br><th>';
          mpos += '<th><b>Signos vitales: </b> <textarea id="vitalT" rows="1" cols="25">' + respuesta[y].vital + '</textarea><br><th>';
          mpos += "</tr></table>";
          mpos += "<h3>Bitacora de consulta</h3>"
          mpos += '<textarea id="bitaT" rows="10" cols="72">' + respuesta[y].bitacora + '</textarea>'
        }
        mpos += '<button type="submit" class="btn btn-primary" style="float: right;" name="guardar">Guardar</button>';
        const div = document.querySelector('#bitacora');
        div.innerHTML = mpos;
      }
      else{//----------------------------------------------------------------------------EN CASO DE SER DE OTRO DIA XD
        //var mpos='';
        //mpos = '<table width="100%" border="1px"><tr>';
        //mpos += "<th>Fecha</th><th>Motivo de atención</th><th>Signos vitales</th></tr><tr>";
        for (var i=0;i<respuesta.length;i++) {
          mpos += "<b>Fecha: </b>" + respuesta[i].fecha + "<br>";
          mpos += "<b>Motivo de atención: </b>" + respuesta[i].motivo + "<br>";
          mpos += "<b>Signos vitales: </b>" + respuesta[i].vital + "<br>";
          //mpos += "</tr></table>";
          mpos += "<h3>Bitacora de consulta</h3>"
          mpos += '<textarea disabled rows="10" cols="72">' + respuesta[i].bitacora + '</textarea>'
        }
        //mpos += '<button type="submit" class="btn btn-primary" style="float: right;" name="guardar">Guardar</button>';
        const div = document.querySelector('#bitacora');
        div.innerHTML = mpos;
      }
			
		}
	};
	xhr.send();
}

function cargar() {
  const xhr = new XMLHttpRequest();

	xhr.open('GET',`srvidorBIT.php?id_cita=${document.getElementById("dato").value}`,false);

	xhr.onload = function(){
	};
	xhr.send();/**/

}


function cant_ds(mes,ano){ 
  di=28 
  f = new Date(ano,mes-1,di); 
  while(f.getMonth()==mes-1){ 
  di++; 
  f = new Date(ano,mes-1,di); 
  } 
  return di-1; 
}

var numm;
function calendario(mes){
  var tablar;
  if(document.getElementById("tipo").value=='especialidad'){
    tablar="cita";
  }
  else if(document.getElementById("tipo").value=='interconsulta'){
    tablar="cita_estudio";
  }
  var cd=cant_ds(parseInt(mes,10),2019);
  var fechh = "2019-"+mes+"-";
  
  
  const div = document.querySelector('#tablaC');
  
  var contenn = '<table border="1px" style="width:400px"><tr>';
  var lim=0;
  
  for(var c=1;c<=cd;c++){
    var fee = fechh+c;
    
    if(tablar==null){
      
    }else{
      const xhr = new XMLHttpRequest();
      xhr.open('GET',`servidorFEC.php?fecha=${fee}&tabla=${tablar}`,false);
      xhr.onload = function(){
        if(this.status===200){
          const respuesta = JSON.parse(xhr.responseText);
          numm = respuesta[0].nums;
        }
      };
      xhr.send();/**/
    }
    
    if(numm>14){
      contenn+='<th style="text-align:center" bgcolor="#FA5858"><h2>' + c + '</h2></th>';
    }else if(numm>7){
      contenn+='<th style="text-align:center" bgcolor="#FFBF00"><h2>' + c + '</h2></th>';
    }else if(numm>=0){
      contenn+='<th style="text-align:center" bgcolor="#01DF3A"><h2><a onclick="xd('+c+')">' + c + '</a></h2></th>';
    }
    
    lim++;
    if(lim==6){
      contenn+='</tr><tr>'
      lim=0;
    }
  }
  contenn+='</tr></table>';
  div.innerHTML = contenn;
}

document.getElementById("mes").addEventListener('change', (event) => {
    calendario(document.getElementById("mes").value);
});


var horas = ['08:00',
            '08:30',
            '09:00',
            '09:30',
            '10:00',
            '10:30',
            '11:00',
            '11:30',
            '12:00',
            '12:30',
            '13:00',
            '13:30',
            '14:00',
            '14:30',
            '15:00',
            '15:30'];

var diaE;
function xd(c){
  diaE=c;
  if(document.getElementById("tipo").value=="especialidad"){
      const div = document.querySelector('#fechass');
      var conteE='<br><br><b>Día: </b>'+c+'<br><b>Hora de cita: </b><select id="seFechass">';
      for(var t=0;t<16;t++){


        const xhr = new XMLHttpRequest();
          var fechadE = "2019-" + document.getElementById("mes").value + "-" + diaE;
          xhr.open('GET',`servidorHRSE.php?hrs=${horas[t]}&fecha=${fechadE}`,false);
          xhr.onload = function(){
            if(this.status===200){
              const respuesta = JSON.parse(xhr.responseText);
              if(respuesta[0].nin==0){
                conteE+='<option>'+horas[t]+'</option>';
              }
              else{

              }
            }
          };
          xhr.send();/**/

      }

      conteE+='</select><br><br>'
      conteE+='<form id="horariosES" action="#"><button type="submit" class="btn btn-primary" style="float: right;" name="guardar">Citar</button></form>';
      div.innerHTML = conteE;
  }else if(document.getElementById("tipo").value=="interconsulta"){
  const div = document.querySelector('#fechass');
  var conteF='<br><br><b>Día: </b>'+c+'<br><b>Hora de cita: </b><select id="seFechass">';
  for(var g=0;g<16;g++){
    
    
    const xhr = new XMLHttpRequest();
      var fechad = "2019-" + document.getElementById("mes").value + "-" + diaE;
      xhr.open('GET',`servidorHRS.php?hrs=${horas[g]}&fecha=${fechad}`,false);
      xhr.onload = function(){
        if(this.status===200){
          const respuesta = JSON.parse(xhr.responseText);
          if(respuesta[0].nin==0){
            conteF+='<option>'+horas[g]+'</option>';
          }
          else{
            
          }
        }
      };
      xhr.send();/**/

  }
  
  conteF+='</select><br><br>'
  conteF+='<button type="submit" class="btn btn-primary" style="float: right;" name="guardar">Citar</button>';
  div.innerHTML = conteF;
  }
}

document.getElementById("tipo").addEventListener('change', (event) => {
    if(document.getElementById("tipo").value=="especialidad"){//---------------------------------------EN CASO DE ESPECIALIDAD
      const divt = document.querySelector('#fechass');
      divt.innerHTML = "";
      
      const div = document.querySelector('#tiposs');
      var contE='<b>Especialidad: </b><select id="tipoEEs">';
      
      const xhr = new XMLHttpRequest();
      xhr.open('GET',`servidorLES.php?fecha=$1`,false);
      xhr.onload = function(){
        if(this.status===200){
          const respuesta = JSON.parse(xhr.responseText);
          for(var b=0;b<respuesta.length;b++){
            contE += '<option value="' + respuesta[b].id + '">' + respuesta[b].nombre + "</option>";
          }
          
        }
      };
      xhr.send();/**/
      contE+='</select>'
      
      div.innerHTML = contE;
      
    }else if(document.getElementById("tipo").value=="interconsulta"){//---------------------------------------EN CASO DE INTERCONSULTA
      const divt = document.querySelector('#fechass');
      divt.innerHTML = "";
      
      const div = document.querySelector('#tiposs');
      var contI='<b>Tipo de estudio a realizar: </b><select id="tipoEE">';
      
      const xhr = new XMLHttpRequest();
      xhr.open('GET',`servidorTI.php?fecha=$1`,false);
      xhr.onload = function(){
        if(this.status===200){
          const respuesta = JSON.parse(xhr.responseText);
          for(var b=0;b<respuesta.length;b++){
            contI += '<option value="' + respuesta[b].id + '">' + respuesta[b].tipo + "</option>";
          }
          
        }
      };
      xhr.send();/**/
      contI+='</select>'
      
      
      div.innerHTML = contI;
    }
});


function hararios(e){
  const div = document.querySelector('#msg');
  div.innerHTML += '<div class="alert alert-warning alert-dismissable"><button type="button" class="close" data-dismiss="alert">&times;</button>Se ha <strong>Guardado</strong> la cita </div>';
  e.preventDefault();	//Previene que el boton se comporte con naturaleza
  
  if(document.getElementById("tipo").value=="especialidad"){
    
    var fechade = "2019-" + document.getElementById("mes").value + "-" + diaE;
    var horad = document.getElementById("seFechass").value + ":00";
    
    const xhr = new XMLHttpRequest();
    xhr.open('GET',`servidorGESP.php?id_cita=${document.getElementById("dato").value}&fecha=${fechade}&hora=${horad}&tipo=${document.getElementById("tipoEEs").value}`,false);
    //console.log(`servidorGINT.php?id_cita=${document.getElementById("dato").value}&fecha=${fechade}&hora=${horad}&tipo=${document.getElementById("tipoEEs").value}`);
    xhr.onload = function(){
    };
    xhr.send();/**/
  }else if(document.getElementById("tipo").value=="interconsulta"){
    
    //console.log(document.getElementById("tipoEE").value);
    var fechad = "2019-" + document.getElementById("mes").value + "-" + diaE + " " + document.getElementById("seFechass").value + ":00";
    //console.log(fechad);
    //document.getElementById("dato").value
    const xhr = new XMLHttpRequest();
    xhr.open('GET',`servidorGINT.php?id_cita=${document.getElementById("dato").value}&fecha=${fechad}&tipo=${document.getElementById("tipoEE").value}`,false);
    xhr.onload = function(){
    };
    xhr.send();/**/
  }
}

function cerrar(){
  const xhr = new XMLHttpRequest();
  xhr.open('GET',`servidorCerrar.php?id_cita=${document.getElementById("dato").value}`,true);
  xhr.onload = function(){
  };
  xhr.send();/**/
}






