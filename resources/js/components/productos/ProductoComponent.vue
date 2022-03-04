<template>
    <main class="main">
        <!-- Breadcrumb -->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">Home</li>
            <li class="breadcrumb-item"><a href="#">Admin</a></li>
            <li class="breadcrumb-item active">Dashboard</li>
        </ol>
        <div class="container-fluid">
            <!-- Ejemplo de tabla Listado -->
            <div class="card">
                <div class="card-header">
                    <i class="fa fa-align-justify"></i> Registro de Productos
                    <button type="button" class="btn btn-secondary" @click="abrirModal('registrar')">
                        <i class="icon-plus"></i>&nbsp;Nuevo
                    </button>
                </div>
                <div class="card-body">
                    <div class="form-group row">
                        <!--  si se agrega filtro
                        <div class="col-md-6">
                            <label class="col-md-3 form-control-label" for="text-input">Linea: <span  v-if="!sicompleto" class="error">(*)</span></label>
                            <div class="col-md-9">
                                <input type="text" id="nombre" name="nombre" class="form-control" placeholder="Nombre de la Prestacion" v-model="nombre" v-on:focus="selectAll">
                                <span  v-if="!sicompleto" class="error">Debe Ingresar el Nombre de la Prestacion</span>
                            </div>
                        </div> -->
                        <div class="col-md-6">
                            <div class="input-group">
                                <input type="text" id="texto" name="texto" class="form-control" placeholder="Texto a buscar" v-model="buscar"  @keyup.enter="listarProducto(1)">
                                <button type="submit" class="btn btn-primary" @click="listarProducto(1)"><i class="fa fa-search" ></i> Buscar</button>
                            </div>
                        </div>
                    </div>
                    <table class="table table-bordered table-striped table-sm table-responsive">
                        <thead>
                            <tr>
                                <th>Opciones</th>
                                <th>Linea</th>
                                <th>Codigo</th>
                                <th>Nombre</th>
                                <th>Cantidad</th>
                                <th>Tiempo Pedido</th>
                                <th>Precio Lista</th>
                                <th>Precio Venta</th>
                                <th>Dispenser</th>
                                <th>Forma Farmaceutica</th>
                                <th>Estado</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="producto in arrayProducto" :key="producto.id">
                                <td>
                                    <button type="button" class="btn btn-warning btn-sm" @click="abrirModal('actualizar',producto)">
                                        <i class="icon-pencil"></i>
                                    </button> &nbsp;
                                    <button v-if="producto.activo==1" type="button" class="btn btn-danger btn-sm" @click="eliminarProducto(producto.id)" >
                                        <i class="icon-trash"></i>
                                    </button>
                                    <button v-else type="button" class="btn btn-info btn-sm" @click="activarProducto(producto.id)" >
                                        <i class="icon-check"></i>
                                    </button>
                                </td>
                                <td v-text="producto.nombrelinea"></td>
                                <td v-text="producto.codproducto"></td>
                                <td v-text="producto.nombreproducto"></td>
                                <td v-text="producto.cantidad"></td>
                                <td v-text="producto.tiempo_pedido"></td>
                                <td v-text="producto.precio_lista"></td>
                                <td v-text="producto.precio_venta"></td>
                                <td v-text="producto.nombredispenser"></td>
                                <td v-text="producto.nombreformafarm"></td>
                                <td>
                                    <div v-if="producto.activo==1">
                                        <span class="badge badge-success">Activo</span>
                                    </div>
                                    <div v-else>
                                        <span class="badge badge-warning">Desactivado</span>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <nav>
                        <ul class="pagination">
                            <li class="page-item" v-if="pagination.current_page > 1">
                                <a class="page-link" href="#" @click.prevent="cambiarPagina(pagination.current_page - 1)">Ant</a>
                            </li>
                            <li class="page-item" v-for="page in pagesNumber" :key="page" :class="[page == isActived ? 'active':'']">
                                <a class="page-link" href="#" @click.prevent="cambiarPagina(page)" v-text="page"></a>
                            </li>
                            <li class="page-item" v-if="pagination.current_page< pagination.last_page">
                                <a class="page-link" href="#" @click.prevent="cambiarPagina(pagination.current_page + 1)">Sig</a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
            <!-- Fin ejemplo de tabla Listado -->
        </div>
        <!--Inicio del modal agregar/actualizar-->
        <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" id="registrar" aria-hidden="true" data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog modal-primary modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">{{ tituloModal }}</h4>
                        <button type="button" class="close"  aria-label="Close" @click="cerrarModal('registrar')">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="form-group col-sm-8">
                                <strong>Producto:</strong>
                                <input type="text" class="form-control" v-model="nombre" placeholder="Nombre del Producto">
                                <span class="error" v-if="nombre.length==0">Debe Ingresar Nombre del Producto</span>
                            </div>
                            <div class="form-group col-sm-4">
                                <strong>Cantidad:</strong>
                                <input type="text" class="form-control" v-model="cantidad" style="text-align:right" placeholder="0" v-on:focus="selectAll">
                                <span class="error" v-if="cantidad==''">Debe ingresar Cantidad</span>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-sm-4">
                                <strong>Linea:</strong>
                                <Ajaxselect  v-if="clearSelected"
                                    ruta="/linea/selectlinea?buscar=" @found="lineas" @cleaning="cleanlineas"
                                    resp_ruta="lineas"
                                    labels="cod"
                                    placeholder="Ingrese Texto..." 
                                    idtabla="id"
                                    :id="idlineaselected"
                                    :clearable='true'>
                                </Ajaxselect>
                                <span class="error" v-if="idlineas.length==0">Debe Seleccionar la Linea</span>
                            </div>
                            <div class="form-group col-sm-4">
                                <strong>Dispenser:</strong>
                                <Ajaxselect  v-if="clearSelected1"
                                    ruta="/dispenser/selectdispenser?buscar=" @found="dispensers" @cleaning="cleandispensers"
                                    resp_ruta="dispensers"
                                    labels="nombre"
                                    placeholder="Ingrese Texto..." 
                                    idtabla="id"
                                    :id="iddispenserselected"
                                    :clearable='true'>
                                </Ajaxselect>
                                <span class="error" v-if="iddispenser.length==0">Debe Seleccionar el dispenser</span>
                            </div>
                            <div class="form-group col-sm-4">
                                <strong>Forma Farmaceutica:</strong>
                                <Ajaxselect  v-if="clearSelected2"
                                    ruta="/formafarm/selectformafarm?buscar=" @found="formafarm" @cleaning="cleanformafarm"
                                    resp_ruta="formafarm"
                                    labels="nombre"
                                    placeholder="Ingrese Texto..." 
                                    idtabla="id"
                                    :id="idformafarmselected"
                                    :clearable='true'>
                                </Ajaxselect>
                                <span class="error" v-if="idformafarm.length==0">Debe Seleccionar la Forma Farmaceutica</span>
                            </div>

                            
                        </div>
                        <div class="row">
                            <div class="form-group col-sm-4">
                                <strong>Precio de Lista:</strong>
                                <vue-numeric  
                                    class="form-control"
                                    currency="Bs." 
                                    separator="," 
                                    v-model="preciolista"
                                    v-bind:precision="2"
                                    v-on:focus="selectAll"
                                    style="text-align:right">
                                </vue-numeric>
                                <span class="error" v-if="preciolista==0">Debe Ingresar el Precio de Lista</span>
                            </div>
                            <div class="form-group col-sm-4">
                                <strong>Precio de Venta:</strong>
                                <vue-numeric  
                                    class="form-control"
                                    currency="Bs." 
                                    separator="," 
                                    v-model="precioventa"
                                    v-bind:precision="2"
                                    v-on:focus="selectAll"
                                    style="text-align:right">
                                </vue-numeric>
                                <span class="error" v-if="precioventa==''">Debe Ingresar el Precio de Venta</span>
                            </div>
                            <div class="form-group col-sm-4">
                                <strong>Tiempo de Pedido:</strong>
                                <select v-model="tiempopedidoselected" class="form-control">
                                    <option value="0">Seleccionar</option>
                                    <option v-for="tiempo in tiempopedido" :key="tiempo.id" :value="tiempo.id" v-text="tiempo.dato"></option>
                                </select>
                                <span class="error" v-if="cantidad==''">Debe ingresar Cantidad</span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <strong class="col-md-3 " for="text-input">Indicaciones: </strong>
                            <div class="col-md-9">
                                <textarea class="form-control" maxlength="255" style="resize: none;" v-model="indicaciones" placeholder="Ninguno"></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <strong class="col-md-3 " for="text-input">Dosificacion: </strong>
                            <div class="col-md-9">
                                <textarea class="form-control" maxlength="255" style="resize: none;" v-model="dosificacion" placeholder="Ninguno"></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <strong class="col-md-3 " for="text-input">Principio Activo: </strong>
                            <div class="col-md-9">
                                <textarea class="form-control" maxlength="255" style="resize: none;" v-model="principio" placeholder="Ninguno"></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <strong class="col-md-3 " for="text-input">Accion Terapeutica: </strong>
                            <div class="col-md-9">
                                <textarea class="form-control" maxlength="255" style="resize: none;" v-model="accion" placeholder="Ninguno"></textarea>
                            </div>
                        </div>
                        <!--  -->

                        <div v-if="tipoAccion==1">
                            <h4>Seleccionar Imagen</h4>
                            <input type="file" @change="onFileChange" accept="image/x-png,image/jpeg">
                        </div>
                        <!-- <div v-else>
                            <img :src="'storage/producto/'+imagen"  width="200px"/>
                            <img src="storage/producto/wT4pdk3MYitkDQAzA0B1Yq8kVjXMyn0l.jpg" alt="">
                             <img  src="storage/producto/default.png" class="rounded-circle fotosociomini" alt="Cinque Terre" >
                            <button @click="removeImage">Cambiar Imagen</button>
                        </div> -->



                        

                    
                        
                            
                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"  @click="cerrarModal('registrar')">Cerrar</button>
                        <button type="button" v-if="tipoAccion==1" class="btn btn-primary" @click="registrarProducto()" :disabled="!sicompleto">Guardar</button>
                        <button type="button" v-if="tipoAccion==2" class="btn btn-primary" @click="actualizarProducto()">Actualizar</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!--Fin del modal-->
        
        
    </main>
</template>

<script>
import Swal from 'sweetalert2'
import Vue from 'vue'
import VueNumeric from 'vue-numeric'

Vue.use(VueNumeric)
//Vue.use(VeeValidate);
    export default {
        data(){
            return{
                pagination:{
                    'total' :0,
                    'current_page':0,
                    'per_page':0,
                    'last_page':0,
                    'from':0,
                    'to':0
                },
                offset:3,
                
                arrayProducto:[],
                tituloModal:'',
                tipoAccion:1,
                iddispenser:'',
                buscar:'',
                idlineas:[],
                idlineaselected:'',
                clearSelected:1,
                
                cantidad:0,
                nombre:'',
                clearSelected2:1,
                clearSelected1:1,
                iddispenserselected:'',
                iddispenser:[],
                idformafarmselected:'',
                idformafarm:[],
                preciolista:0,
                precioventa:0,
                tiempopedido:[{'id':1,'dato':'1 mes'},
                                {'id':3,'dato':'3 meses'},
                                {'id':6,'dato':'6 meses'},
                                {'id':12,'dato':'12 meses'}],
                tiempopedidoselected:0,
                indicaciones:'',
                dosificacion:'',
                principio:'',
                accion:'',
                idproducto:'',
                image:'',
                imagen:''


            }

        },
        computed:{
            sicompleto(){
                let me=this;
                if (me.nombre=='' || me.cantidad==0 || me.idlineas.length==0 || me.iddispenser.length==0 || me.idformafarm.length==0 || me.preciolista==0 || me.precioventa==0 || me.tiempopedidoselected==0)
                    return false;
                else
                    return true;
            },
            isActived:function(){
                return this.pagination.current_page;
            },
            pagesNumber:function(){
                if(!this.pagination.to){
                    return[];
                }
                var from = this.pagination.current_page - this.offset;
                if(from<1){
                    from=1;
                }
                var to = from +(this.offset * 2);
                if(to>= this.pagination.last_page){
                    to=this.pagination.last_page;
                }
                var pagesArray =[];
                while(from<=to){
                    pagesArray.push(from);
                    from++
                }
                return pagesArray;
            },


        },
        methods :{
            onFileChange(e) {
                var files = e.target.files || e.dataTransfer.files;
                if (!files.length)
                return;
                this.createImage(files[0]);
            },
            createImage(file) {
                var image = new Image();
                var reader = new FileReader();
                var vm = this;

                reader.onload = (e) => {
                    vm.image = e.target.result;
                };
                    reader.readAsDataURL(file);
            },
            removeImage: function (e) {
                this.image = '';
            },
            tiempo(){
            this.clearSelected=1;
            },
            tiempo1(){
            this.clearSelected1=1;
            },
            tiempo2(){
            this.clearSelected2=1;
            },
            lineas(lineas){
                this.idlineas=[];
                for (const key in lineas) {
                    if (lineas.hasOwnProperty(key)) {
                        const element = lineas[key];
                        //console.log(element);
                        this.idlineas.push(element);
                    }
                }
                //console.log(this.idprestaciones);
            },
            cleanlineas(){
                this.idlineas=[];
                this.idlineaselected='';
            
            },
            dispensers(dispensers){
                this.iddispenser=[];
                for (const key in dispensers) {
                    if (dispensers.hasOwnProperty(key)) {
                        const element = dispensers[key];
                        //console.log(element);
                        this.iddispenser.push(element);
                    }
                }
                //console.log(this.idprestaciones);
            },
            cleandispensers(){
                this.iddispenser=[];
                this.iddispenserselected='';
            
            },
            formafarm(formafarm){
                this.idformafarm=[];
                for (const key in formafarm) {
                    if (formafarm.hasOwnProperty(key)) {
                        const element = formafarm[key];
                        //console.log(element);
                        this.idformafarm.push(element);
                    }
                }
                //console.log(this.idprestaciones);
            },
            cleanformafarm(){
                this.idformafarm=[];
                this.idformafarmselected='';
            
            },
            listarProducto(page){
                let me=this;
                var url='/producto?page='+page+'&buscar='+me.buscar;
                axios.get(url).then(function(response){
                    var respuesta=response.data;
                    me.pagination=respuesta.pagination;
                    me.arrayProducto=respuesta.producto.data;
                    
                })
                .catch(function(error){
                    console.log(error);
                });
            },
            cambiarPagina(page){
                let me =this;
                me.pagination.current_page = page;
                me.listarProducto(page);
            },
            registrarProducto(){
                let me = this;
                axios.post('/producto/registrar',{
                    'nombre':me.nombre,
                    'cod':me.idlineas[3],
                    'cantidad':me.cantidad,
                    'idlinea':me.idlineas[1],
                    'iddispenser':me.iddispenser[0],
                    'idformafarm':me.idformafarm[0],
                    'precio_lista':me.preciolista,
                    'precio_venta':me.precioventa,
                    'tiempo_pedido':me.tiempopedidoselected,
                    'indicaciones':me.indicaciones,
                    'dosificacione':me.dosificacione,
                    'principio_activo':me.principio,
                    'accion_terapeutica':me.accion,
                    'imagen':me.image,


                }).then(function(response){
                    console.log(response);
                    if(response.data=='error')
                    {
                        Swal.fire('El registro ya existe','Debe introducir uno diferente');
                    }
                    else
                    {
                        
                        Swal.fire('Registrado Correctamente');
                        me.cerrarModal('registrar');
                        me.listarProducto(me.pagination.current_page);
                    }
                    
                }).catch(function(error){
                    console.log(error);
                });

            },
            eliminarProducto(idproducto){
                let me=this;
                //console.log("prueba");
                const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false
                })

                swalWithBootstrapButtons.fire({
                title: 'Esta Seguro de Desactivar?',
                text: "Es una eliminacion logica",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Si, Desactivar',
                cancelButtonText: 'No, Cancelar',
                reverseButtons: true
                }).then((result) => {
                if (result.isConfirmed) {
                     axios.put('/producto/desactivar',{
                        'id': idproducto
                    }).then(function (response) {
                        
                        swalWithBootstrapButtons.fire(
                            'Desactivado!',
                            'El registro a sido desactivado Correctamente',
                            'success'
                        )
                        me.listarProducto(me.pagination.current_page);
                        
                    }).catch(function (error) {
                        console.log(error);
                    });
                    
                    
                } else if (
                    /* Read more about handling dismissals below */
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    /* swalWithBootstrapButtons.fire(
                    'Cancelado!',
                    'El Registro no fue desactivado',
                    'error'
                    ) */
                }
                })
            },
            activarProducto(idproducto){
                let me=this;
                //console.log("prueba");
                const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false
                })

                swalWithBootstrapButtons.fire({
                title: 'Esta Seguro de Activar?',
                text: "Es una Activacion logica",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Si, Activar',
                cancelButtonText: 'No, Cancelar',
                reverseButtons: true
                }).then((result) => {
                if (result.isConfirmed) {
                     axios.put('/producto/activar',{
                        'id': idproducto
                    }).then(function (response) {
                        
                        swalWithBootstrapButtons.fire(
                            'Activado!',
                            'El registro a sido Activado Correctamente',
                            'success'
                        )
                        me.listarProducto(me.pagination.current_page);
                        
                    }).catch(function (error) {
                        console.log(error);
                    });
                    
                    
                } else if (
                    /* Read more about handling dismissals below */
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    /* swalWithBootstrapButtons.fire(
                    'Cancelado!',
                    'El Registro no fue Activado',
                    'error'
                    ) */
                }
                })
            },
            actualizarProducto(){
               // const Swal = require('sweetalert2')
                let me =this;
                axios.put('/producto/actualizar',{
                    'id':me.idproducto,
                    'nombre':me.nombre,
                    'cantidad':me.cantidad,
                    'idlinea':me.idlineas[1],
                    'iddispenser':me.iddispenser[0],
                    'idformafarm':me.idformafarm[0],
                    'precio_lista':me.preciolista,
                    'precio_venta':me.precioventa,
                    'tiempo_pedido':me.tiempopedidoselected,
                    'indicaciones':me.indicaciones,
                    'dosificacione':me.dosificacione,
                    'principio_activo':me.principio,
                    'accion_terapeutica':me.accion,
                    
                }).then(function (response) {
                    if(response.data.length){
                    }
                    // console.log(response)
                    else{
                            Swal.fire('Actualizado Correctamente')

                        me.listarProducto(me.pagination.current_page);
                    } 
                }).catch(function (error) {
                   
                });
                me.cerrarModal('registrar');


            },
            abrirModal(accion,data= []){
                let me=this;
                switch(accion){
                    case 'registrar':
                    {
                        me.removeImage;
                        me.tituloModal='Registar Producto'
                        me.nombre='';
                        me.cantidad='';
                        me.clearSelected=0;
                        setTimeout(me.tiempo, 200); 
                        me.clearSelected1=0;
                        setTimeout(me.tiempo1, 200); 
                        me.clearSelected2=0;
                        setTimeout(me.tiempo2, 200); 
                        me.preciolista=0;
                        me.precioventa=0;
                        me.tiempopedidoselected=0;
                        me.indicaciones='';
                        me.dosificacione='';
                        me.principio='';
                        me.accion='';
                        me.tipoAccion=1;
                        me.image='';
                        me.imagen='';

                        me.classModal.openModal('registrar');
                        break;
                    }
                    
                    case 'actualizar':
                    {
                        me.tipoAccion=2;
                        me.idproducto=data.idproducto;
                        me.tituloModal='Actualizar Producto: ' + data.codproducto
                        me.nombre=data.nombreproducto;
                        me.cantidad=data.cantidad;
                        
                        me.clearSelected=0;
                        setTimeout(me.tiempo, 200); 
                        me.idlineaselected=data.idlinea;
                        
                        me.clearSelected1=0;
                        setTimeout(me.tiempo1, 200);
                        me.iddispenserselected=data.iddispenser; 
                        
                        me.clearSelected2=0;
                        setTimeout(me.tiempo2, 200); 
                        me.idformafarmselected=data.idformafarm
                        me.idlineas=[0,data.idlinea];
                        me.iddispenser=[data.iddispenser];
                        me.idformafarm=[data.idformafarm];
                        me.preciolista=data.precio_lista;
                        me.precioventa=data.precio_venta;
                        me.tiempopedidoselected=data.tiempo_pedido;
                        me.indicaciones=data.indicaciones;
                        me.dosificacione=data.dosificacione;
                        me.principio=data.principio_activo;
                        me.accion=data.accion_terapeutica;
                        me.tipoAccion=2;
                        me.imagen=data.imagen;
                        me.removeImage;
                        me.image='';
                        me.classModal.openModal('registrar');
                        break;
                    }

                }
                
            },
            cerrarModal(accion){
                let me = this;
                me.classModal.closeModal(accion);
                me.nombre='';
                me.cantidad='';
                me.idlineas=[];
                me.idlineaselected='';
                me.clearSelected=0;
                setTimeout(me.tiempo, 200); 
                me.iddispenser=[];
                me.iddispenserselected='';
                me.clearSelected1=0;
                setTimeout(me.tiempo1, 200); 
                me.idformafarm=[];
                me.idformafarmselected='';
                me.clearSelected2=0;
                setTimeout(me.tiempo2, 200); 
                me.preciolista=0;
                me.precioventa=0;
                me.tiempopedidoselected=0;
                me.indicaciones='';
                me.dosificacione='';
                me.principio='';
                me.accion='';
                me.tipoAccion=1;
                me.image='';
                me.imagen='';
                
            },
            selectAll: function (event) {
                setTimeout(function () {
                    event.target.select()
                }, 0)
            },  


        },
        mounted() {
            this.listarProducto(1);
            this.classModal = new _pl.Modals();
            this.classModal.addModal('registrar');
            //console.log('Component mounted.')
        }
    }
</script>
<style scoped>
.error{
    color: red;
    font-size: 10px;
    
}
img {
  width: 30%;
  margin: auto;
  display: block;
  margin-bottom: 10px;
}
</style>
