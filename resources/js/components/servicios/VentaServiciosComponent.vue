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
                    <i class="fa fa-align-justify"></i> Venta de Servicios
                    
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th style="width:450px">Prestacion</th>
                                <th>Precio</th>
                                <th>Descuento</th>
                                <th>Precio Final</th>
                                <th>Agregar</th>
                           </tr>
                        </thead>
                        <tr>
                            <td>
                                <Ajaxselect  v-if="clearSelected"
                                    ruta="/prestacion/selectprestaciones?buscar=" @found="prestaciones" @cleaning="cleanprestaciones"
                                    resp_ruta="prestaciones"
                                    labels="cod"
                                    placeholder="Ingrese Texto..." 
                                    idtabla="id"
                                    :id="idprestacionselected"
                                    :clearable='true'>
                                </Ajaxselect>
                            </td>
                            
                            <td v-if="idprestaciones.length>0">{{ idprestaciones[3] }} Bs.</td>
                            <td v-else>-</td>
                            <td><select v-model="descuentoSelected"  class="form-control" @change="listarVenta()">
                                        <option value="0">Seleccionar...</option>
                                        <option v-for="descuento in arrayDescuentos" v-bind:key="descuento.id" :value="descuento.id" v-text="descuento.nombre"></option>
                                    </select></td>
                            <td  style="text-align:right">{{preciofinal}} &nbsp;Bs.</td>
                            <td><button type="button" class="btn btn-info btn-sm" @click="agregarVenta()" :disabled="idprestaciones.length==0" >
                                        <i class="icon-check"></i>
                                </button>
                            </td>
                        </tr>

                    </table>
                    <!-- <div class="form-group row">
                        <div class="col-md-2" style="text-align:center">
                            <label for="" >Area:</label>
                        </div>
                        <div class="col-md-6">
                            <div class="input-group">
                                <select class="form-control" @change="listarPrestaciones(1,buscar)"
                                    v-model="areaselected">
                                    <option value="0" disabled>Seleccionar...</option>
                                    <option v-for="area in arrayAreas" :key="area.id" :value="area.id" v-text="area.area"></option>
                                </select>                              
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="input-group">
                                <input type="text" id="texto" name="texto" class="form-control" placeholder="Texto a buscar" v-model="buscar"  @keyup.enter="listarPrestaciones(1)">
                                <button type="submit" class="btn btn-primary" @click="listarPrestaciones(1)"><i class="fa fa-search" ></i> Buscar</button>
                            </div>
                        </div>
                    </div> -->
                    <table class="table table-bordered table-striped table-sm">
                        <thead>
                            <tr>
                                <th>Opciones</th>
                                <th>Codigo</th>
                                <th>Prestacion</th>
                                <th>Precio</th>
                                <th>Descuento</th>
                                <th style="width:150px">Sub Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="venta in arrayVentas" :key="venta.id">
                                <td>
                                    <button v-if="venta.estado==0" type="button" class="btn btn-danger btn-sm" @click="eliminarVenta(venta.id)" >
                                        <i class="icon-trash"></i>
                                    </button>
                                </td>
                                <td v-text="venta.cod"></td>
                                <td v-text="venta.nompres"></td>
                                <td v-text="venta.precio + ' Bs.'" style="text-align:right"></td>
                                <td v-text="venta.descuento"></td>
                                <td v-text="venta.monto_cancelado + ' Bs.'" style="text-align:right"></td>
                            </tr>
                            <tr>
                                <th colspan="5" style="text-align:right">Suma Total:</th>
                                <th v-text="sumatotal + ' Bs.'" style="text-align:right"></th>
                            </tr>
                            <tr>
                                <th colspan="5" style="text-align:right">Efectivo:</th>
                                <th><input type="number" v-model="efectivo" v-on:focus="selectAll" @keyup="restartotal()" style="text-align:right"></th>
                            </tr>
                            <tr>
                                <th colspan="5" style="text-align:right">Cambio:</th>
                                <th v-text="cambio + ' Bs.'" style="text-align:right"></th>
                            </tr>
                            <tr>
                                <th colspan="5" >Cliente:
                                    
                                    <Ajaxselect  v-if="clearSelected1"
                                        ruta="/clientes/selectclientes?buscar=" @found="clientes" @cleaning="cleanclientes"
                                        resp_ruta="clientes"
                                        labels="nombres"
                                        placeholder="Ingrese Texto..." 
                                        idtabla="id"
                                        :id="idclienteselected"
                                        :clearable='true'>
                                    </Ajaxselect></th>
                                <th style="text-align:center">
                                    <button type="submit" class="btn btn-success" @click="registrarVenta()" :disabled="arrayVentas.length==0 || idclientes.length==0 || !sicancelado">
                                        <i class="icon check" ></i> Registrar Venta
                                    </button>
                                </th>
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
                        <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="text-input">Nombre <span  v-if="!sicompleto" class="error">(*)</span></label>
                                <div class="col-md-9">
                                    <input type="text" id="nombre" name="nombre" class="form-control" placeholder="Nombre de la Prestacion" v-model="nombre" v-on:focus="selectAll">
                                    <span  v-if="!sicompleto" class="error">Debe Ingresar el Nombre de la Prestacion</span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="text-input">Precio <span  v-if="!sicompletoprecio" class="error">(*)</span></label>
                                <div class="col-md-9">
                                    <input type="number" id="precio" name="precio" class="form-control" placeholder="0.0" v-model="precio" style="text-align:right" v-on:focus="selectAll" >
                                    <span  v-if="!sicompletoprecio" class="error">Debe Ingresar el Precio de la prestacion</span>
                                </div>
                            </div>
                            
                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="text-input">Descripción</label>
                                <div class="col-md-9">
                                    <input type="text" id="descripcion" name="descripcion" class="form-control" placeholder="Ingrese una Descripción" v-model="descripcion" v-on:focus="selectAll">
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"  @click="cerrarModal('registrar')">Cerrar</button>
                        <button type="button" v-if="tipoAccion==1" class="btn btn-primary" @click="registrarPrestacion()" :disabled="!sicompleto || !sicompletoprecio">Guardar</button>
                        <button type="button" v-if="tipoAccion==2" class="btn btn-primary" @click="actualizarPrestacion()">Actualizar</button>
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
import vSelect from 'vue-select';
Vue.component('v-select',vSelect);
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
                nombre:'',
                descripcion:'',
                codigo:'',
                correlativo:0,
                arrayAreas:[],
                tituloModal:'',
                tipoAccion:1,
                idprestacion:'',
                buscar:'',

                arrayPrestacion:[],
                areaselected:0,
                precio:'',
                idprestacionselected:'',
                idprestaciones:[],
                clearSelected:1,
                clearSelected1:1,
                descuentoSelected:0,
                arrayDescuentos:[],
                preciofinal:0,
                arrayVentas:[],
                sumatotal:0,
                efectivo:0,
                cambio:0,

                idclientes:[],
                idclienteselected:''
                
            }

        },
        computed:{
            sicancelado(){
                let me=this;
                me.preciofinal=Number(me.sumatotal);
                me.efectivo=Number(me.efectivo);
                if(me.efectivo<me.sumatotal)
                    return true
                else
                    return false

            },
            
            presfinal(){
                let me=this;
                if(me.idprestaciones.length>0)
                {
                    if(me.descuentoSelected!=0)
                    {
                        let respuesta=me.arrayDescuentos.find(element=>element.id==me.descuentoSelected);
                        //console.log(respuesta)
                        let descuento = respuesta.monto;
                        let siporcentaje=respuesta.siporcentaje;
                        let precio=Number(me.idprestaciones[3]);

                        //console.log(precio,descuento);
                        if(siporcentaje)
                            me.preciofinal=Number(precio-(precio*(descuento/100)).toFixed(2));
                        else
                            me.preciofinal= precio-descuento;
                    }
                    else
                        me.preciofinal=me.idprestaciones[3];
                }
                else
                    me.preciofinal=0;

            },
            siarealesected(){
                let me=this;
                if (me.areaselected!=0)
                    return true;
                else
                    return false;
            },
            sicompletoprecio(){
                let me=this;
                if (me.preciofinal!=0)
                    return true;
                else
                    return false;
            },
            sicompleto(){
                let me=this;
                if (me.nombre!='')
                    return true;
                else
                    return false;
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
            restartotal(){
                let me=this;
                if(me.efectivo!=0)
                    me.cambio=Number(me.efectivo-me.sumatotal);
                else
                    me.cambio=0;
            },
            
            cambiaprestacion(){
                let me=this;
                me.clearSelected=0;
                setTimeout(me.tiempo, 200); 
                //me.directivo=valor;
                me.ideprestacion=[];
                
               
            },
            cambiacliente(){
                let me=this;
                me.clearSelected1=0;
                setTimeout(me.tiempo1, 200); 
                //me.directivo=valor;
                me.ideprestacion=[];
                
               
            },
            tiempo(){
            this.clearSelected=1;
            }, 
            tiempo1(){
            this.clearSelected1=1;
            }, 
            prestaciones(prestaciones){
                this.idprestaciones=[];
                for (const key in prestaciones) {
                    if (prestaciones.hasOwnProperty(key)) {
                        const element = prestaciones[key];
                        //console.log(element);
                        this.idprestaciones.push(element);
                    }
                }
                //console.log(this.idprestaciones);
            },
            clientes(clientes){
                this.idcientes=[];
                for (const key in clientes) {
                    if (clientes.hasOwnProperty(key)) {
                        const element = clientes[key];
                        //console.log(element);
                        this.idclientes.push(element);
                    }
                }
                //console.log(this.idprestaciones);
            },
            cleanprestaciones(){
                this.idprestaciones=[];
                this.descuentoSelected=0;
                //this.idempleadorespuesta=0;
            //console.log('clean')
            
            },
            cleanclientes(){
                this.idclientes=[];
            
            },
            listarVenta(){
                let me=this;
                var url='/ventas/listar';
                axios.get(url).then(function(response){
                    var respuesta=response.data;
                    //console.log(respuesta);
                    me.arrayVentas=respuesta.ventas;
                    me.sumatotal=respuesta.sumatotal[0].total;
                    me.restartotal();
                })
                .catch(function(error){
                    console.log(error);
                });

            },
            selectDescuentos(){
                let me=this;
                var url='/descuento/selectdescuento';
                axios.get(url).then(function(response){
                    var respuesta=response.data;
                    me.arrayDescuentos=respuesta;
                })
                .catch(function(error){
                    console.log(error);
                });
            },
            cambiarPagina(page){
                let me =this;
                me.pagination.current_page = page;
                me.listarPrestaciones(page);
            },
            agregarVenta(){
                let me = this;
                

                axios.post('/ventas/registrar',{
                    'idprestacion':me.idprestaciones[2],
                    'iddescuento':me.descuentoSelected,
                    'monto_cancelado':me.preciofinal,
                    
                }).then(function(response){
                    //me.cerrarModal('registrar');
                    me.cambiaprestacion();
                    me.idprestaciones=[];
                    me.descuentoSelected=0;
                    me.preciofinal=0;
                    me.listarVenta();
                }).catch(function(error){
                    console.log(error);
                });

            },
            registrarVenta(){
                let me=this;
                axios.put('/ventas/registrarventa',{
                        
                    }).then(function (response) {
                        
                        /* swalWithBootstrapButtons.fire(
                            'Desactivado!',
                            'El registro a sido desactivado Correctamente',
                            'success'
                        ) */
                        me.listarVenta();
                        
                    }).catch(function (error) {
                        console.log(error);
                    });

            },
            eliminarVenta(idventa){
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
                title: 'Esta Seguro?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Si, Desactivar',
                cancelButtonText: 'No, Cancelar',
                reverseButtons: true
                }).then((result) => {
                if (result.isConfirmed) {
                     axios.put('/ventas/desactivar',{
                        'id': idventa
                    }).then(function (response) {
                        
                        /* swalWithBootstrapButtons.fire(
                            'Desactivado!',
                            'El registro a sido desactivado Correctamente',
                            'success'
                        ) */
                        me.listarVenta();
                        
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
            
            
            
          
            selectAll: function (event) {
                setTimeout(function () {
                    event.target.select()
                }, 0)
            },  
            


        },
        mounted() {
            this.selectDescuentos();
            this.listarVenta();
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
</style>
