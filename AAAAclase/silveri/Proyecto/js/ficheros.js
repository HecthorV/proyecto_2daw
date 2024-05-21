datos=[["cañ","Cañon de Proyección"],
       ["portW","Portatil Windows"],
       ["portL","Portatil Linux"],
       ["internet","Conexión a Internet"],
       ["pantT","Pantalla Táctil"]
      ];

datos2=[["portL","Portatil Linux"],
        ["internet","Conexión a Internet"]
       ]

window.addEventListener("load",function(){
  let fichero=document.getElementById("fichero");
  let fuente=document.getElementById("fuente");
  let seleccionados=document.getElementById("seleccionados");
  let pasarIzq=document.getElementById("pasarIzq");
  let pasarIzqTodos=document.getElementById("pasarIzqTodos");
  let pasarDer=document.getElementById("pasarDer");
  let pasarDerTodos=document.getElementById("pasarDerTodos");
  fichero.onchange=function(){
    let ficheroSubido=this.files[0];
    if ((/\.csv$/i).test(ficheroSubido.name)){
        let lector=new FileReader();
        lector.readAsText(ficheroSubido);
        lector.onload=function(){
            let profesores=obtenerInformacion(this.result,/^.+;.{7}\d{3};.{7}\d{3}@.+\r?$/,3);
            console.log(profesores);
        }

    } else {
        alert("El fichero subido no tiene el formato csv")
    }
  }
  let datosMostrar=[];
  for (let i=0; i<datos.length;i++){
    let encontrado=false;
    for (let j=0;j<datos2.length;j++){
      if (datos2[j][0]==datos[i][0]){
        encontrado=true;
        break;
      }
    }
    if (!encontrado){
      datosMostrar.push(datos[i]);
    }

  }
  cargarDatosSelect(datosMostrar,fuente);
  cargarDatosSelect(datos2,seleccionados);
  pasarIzq.onclick=function(){
    pasarSeleccionadosSelect(seleccionados,fuente);
  }
  pasarIzqTodos.onclick=function(){
    pasarTodosSelect(seleccionados,fuente);
  }
  pasarDer.onclick=function(){
    pasarSeleccionadosSelect(fuente,seleccionados);
  }
  pasarDerTodos.onclick=function(){
    pasarTodosSelect(fuente,seleccionados);
  }


  let tabla=document.getElementById("ponentes");
  function pulsadoBorrar(fila){
    return function(){
      let respuesta=confirm("¿Estas seguro que quieres borrar?")
      if (respuesta){
        fila.parentElement.removeChild(fila);
      }
    }
  }
  function pulsadoEditar(fila){
    return function(){
     fila.editar();
    }
  }
  function pulsadoGuardar(fila){
    return function(){
     fila.guardar();
    }
  }
  function pulsadoCancelar(fila){
    return function(){
     fila.cancelar();
    }
  }
  tabla.activarEdicion(pulsadoBorrar,pulsadoEditar,pulsadoGuardar,pulsadoCancelar);
})
