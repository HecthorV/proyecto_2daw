HTMLTableElement.prototype.editada=false;
HTMLTableElement.prototype.noEditable=[];

HTMLTableElement.prototype.saluda=function(){
    alert("Hola");
}

HTMLTableElement.prototype.getData=function(){
    var tBody=this.tBodies[0];
    let datos=[];
    let filas=tBody.rows;
    let nFilas=filas.length;
    for (let i=0;i<nFilas;i++){
        let fila=[];
        let nColumnas=filas[i].cells.length;
        for (let j=0;j<nColumnas;j++){
            if (!filas[i].cells[j].classList.contains("editada"))
            fila.push(filas[i].cells[j].innerHTML);
        }
        datos.push(fila);
    }
    return datos;
}

HTMLTableElement.prototype.setData=function(datos){
    var tBody=this.tBodies[0];
    tBody.innerHTML="";
    let nFilas=datos.length;
    for (let i=0;i<nFilas;i++){
        let fila=document.createElement("tr");
        let nColumnas=datos[i].length;
        for (let j=0;j<nColumnas;j++){
            let celda=document.createElement("td");
            celda.innerHTML=datos[i][j];
            fila.appendChild(celda);
        }
        tBody.appendChild(fila);
    }
}

HTMLTableElement.prototype.activarEdicion=function(callBackBorrar,callBackEditar,callBackGuardar,callBackCancelar){
    if (!this.editada){
        this.editada=true;
        if (this.dataset.noeditable){
            this.noEditable=JSON.parse(this.dataset.noeditable);
        }
        let tBody=this.tBodies[0];
        let tFoot=this.tFoot;
        let filas=tBody.rows;
        let nfilas=filas.length;
        let columnas=this.tHead.rows[0].cells.length;
        let td=document.createElement("td");
        td.innerHTML="ACCIONES";
        this.noEditable.push(columnas);
        this.noEditable.sort(function(a,b){a-b});
        this.tHead.rows[0].appendChild(td);
        for (let i=0;i<nfilas;i++){
            let td=document.createElement("td");
            let span1=document.createElement("span");
            span1.innerHTML="X";
            span1.className="botonBorrar";
            span1.onclick=callBackBorrar(filas[i]);
            let span2=document.createElement("span");
            span2.innerHTML="E";
            span2.className="botonEditar";
            span2.onclick=callBackEditar(filas[i]);
            let span3=document.createElement("span");
            span3.innerHTML="G";
            span3.className="botonGuardar";
            span3.onclick=callBackGuardar(filas[i]);
            let span4=document.createElement("span");
            span4.innerHTML="C";
            span4.className="botonCancelar";
            span4.onclick=callBackCancelar(filas[i]);
            td.appendChild(span1);
            td.appendChild(span2);
            td.appendChild(span3);
            td.appendChild(span4);
            filas[i].appendChild(td);
            
        }
    }
}


HTMLTableRowElement.prototype.editar=function(){
    let celdas=this.cells;
    let nceldas=celdas.length;
    let noEditable=this.parentElement.parentElement.noEditable;
    this.classList.add("editada");
    for (let i=0;i<nceldas;i++){
        if(noEditable.indexOf(i)==-1){
          let valor=celdas[i].innerHTML;
          celdas[i].innerHTML="";
          let input=document.createElement("input");
          input.value=valor;
          input.original=valor;
          celdas[i].appendChild(input); 
        }
    }
}

HTMLTableRowElement.prototype.guardar=function(){
    let inputs=this.getElementsByTagName("input");
    //let nInputs=inputs.length;
    this.classList.remove("editada");
    /*for (let i=0;i<nInputs;i++){
          let valor=inputs[0].value;
          inputs[0].parentElement.innerHTML=valor;
    }*/
    while (inputs.length>0){
        let valor=inputs[0].value;
        inputs[0].parentElement.innerHTML=valor;
    }
}

HTMLTableRowElement.prototype.cancelar=function(){
    let inputs=this.getElementsByTagName("input");
    //let nInputs=inputs.length;
    this.classList.remove("editada");
    /*for (let i=0;i<nInputs;i++){
          let valor=inputs[0].value;
          inputs[0].parentElement.innerHTML=valor;
    }*/
    while (inputs.length>0){
        let valor=inputs[0].original;
        inputs[0].parentElement.innerHTML=valor;
    }
}