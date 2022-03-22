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
                    <i class="fa fa-align-justify"></i> Configuracion de Descuentos en Productos
                    <button type="button" class="btn btn-secondary" @click="abrirModal('registrar')">
                        <i class="icon-plus"></i>&nbsp;Nuevo
                    </button>
                </div>
                <div class="card-body">
                    <div class="form-group row">
                        <div class="col-md-6">
                            <div class="input-group">
                                <input type="text" id="texto" name="texto" class="form-control" placeholder="Texto a buscar" v-model="buscar"  @keyup.enter="listarDescuentos(1)">
                                <button type="submit" class="btn btn-primary" @click="listarDescuentos(1)"><i class="fa fa-search" ></i> Buscar</button>
                            </div>
                        </div>
                    </div>
                    <table class="table table-bordered table-striped table-sm table-responsive">
                        <thead>
                            <tr>
                                <th>Opciones</th>
                                <th>Nombre</th>
                                <th>Monto Descuento</th>
                                <th>Tipo Descuento</th>
                                <th>Regla</th>
                                <th>Aplica A</th>
                                <th>Estado</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="descuento in arrayDescuentos" :key="descuento.id">
                                <td>
                                    <button type="button" class="btn btn-warning btn-sm" @click="abrirModal('actualizar',descuento)">
                                        <i class="icon-pencil"></i>
                                    </button> &nbsp;
                                    <button v-if="descuento.activo==1" type="button" class="btn btn-danger btn-sm" @click="eliminarDescuento(descuento.id)" >
                                        <i class="icon-trash"></i>
                                    </button>
                                    <button v-else type="button" class="btn btn-info btn-sm" @click="activarDescuento(descuento.id)" >
                                        <i class="icon-check"></i>
                                    </button>
                                </td>
                                <td v-text="descuento.nombre"></td>
                                <td v-text="descuento.regla_descuento"></td>
                                <td v-text="descuento.tipodescuento"></td>
                                <td v-text="regla"></td>
                                <td v-text="aplica_a"></td>
                                <td>
                                    <div v-if="descuento.activo==1">
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
                        <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="text-input">Nombre Descuento: <span  v-if="nomdescuento==''" class="error">(*)</span></label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" placeholder="Nombre Descuento" v-model="nomdescuento" v-on:focus="selectAll" >
                                    <span  v-if="nomdescuento==''" class="error">Debe Ingresar el Monto del descuento</span>
                                </div>
                            </div>
                            <div class="from-group row">
                                <div class="col-md-6">
                                    <strong>Tipo de Descuento:</strong>
                                    <select class="form-control" @change="listarSubcategorias()" v-model="idtipodescuentoselected">
                                        <option disabled value="0">Seleccionar...</option>
                                        <option v-for="tipodescuento in arrayTipoDescuentos" :key="tipodescuento.cod" v-text="tipodescuento.aplica_a " :value="tipodescuento.cod"></option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <strong>Sub Categoria:</strong>
                                    <select class="form-control" v-model="subcategoriaselected" @change="listarDetalle()">
                                        <option disabled value="0">Seleccionar...</option>
                                        <option v-for="subcategoria in arraySubCategorias" :key="subcategoria" v-text="subcategoria" :value="subcategoria"></option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="from-group row col-md-12" v-if="valor==1 || valor==4 || valor==5 ">
                                    <div class="col-md-6" >
                                        <strong>Operador:</strong>
                                        <select class="form-control" v-model="detalleselected">
                                            <option disabled value="0">Seleccionar...</option>
                                            <option v-for="detalle in arrayDetalle" :key="detalle.id" v-text="detalle.valor" :value="detalle.valor"></option>
                                        </select>
                                    </div>
                                    <div class="col-md-6" v-if="valor==4 || valor==5">
                                        <strong>Valor:</strong>
                                        <input type="number" class="form-control" placeholder="0" v-model="limite" v-on:focus="selectAll" style="text-align:right">
                                        <span  v-if="limite==0" class="error">Debe Ingresar el valor</span>
                                    </div>
                                </div>
                                <div v-else-if="valor==2" class="col-md-6">

                                </div>
                                <div v-else-if="valor==3" class="col-md-6">
                                    <strong>Categoria:</strong>
                                    <Ajaxselect  v-if="clearSelected"
                                        ruta="/categoria/selectcategoria?buscar=" @found="categorias" @cleaning="cleancategorias"
                                        resp_ruta="categorias"
                                        labels="nombre"
                                        placeholder="Ingrese Texto..." 
                                        idtabla="id"
                                        :id="idcategoriaselected"
                                        :clearable='true'>
                                    </Ajaxselect>
                                </div>
                                <div v-else-if="valor==7" class="col-md-12">
                                    <div class="form-group row">
                                        <div class="col-md-6">
                                            <label class="form-control-label" for="date-input">Fecha Inicial:</label>
                                            <input class="form-control" 
                                                type="date" v-model="fechainicio"
                                                :min="fechahoy">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-control-label" for="date-input">Fecha Final:</label>
                                            <input class="form-control" 
                                                type="date" v-model="fechafin"
                                                :min="fechahoy">
                                        </div>
                                    </div>
                                </div>
                                <div v-else-if="valor==6" class="col-md-12">
                                    <div class="form-group row">
                                        <div class="col-md-2">

                                        </div>
                                        <div class="col-md-5">
                                            <div  class="form-check" v-for="diasemana in arrayDetalle" v-bind:key="diasemana.id">
                                                <input class="form-check-input" type="checkbox" v-model="diaselected" :id="diasemana.valor" :value="diasemana.valor">
                                                <label class="form-check-label" :for="diasemana.valor">{{diasemana.valor}}</label>
                                            </div>
                                        </div>
                                        <div class="col.md-5">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" v-model="repetir" id="cadasemana" value="1">
                                                <label class="form-check-label" for="cadasemana">Repetir Cada Semana</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" v-model="repetir" id="unavez" value="2">
                                                <label class="form-check-label" for="unavez">Repetir Una Vez</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div v-else-if="valor==8" class="col-md-6">
                                    <strong>Detalle:</strong>
                                    <input class="form-control" 
                                        type="date" v-model="fechax"
                                        :min="fechahoy">
                                </div>
                               <!--  <div v-else-if="valor==6" class="col-md-6" >
                                    <div  class="form-check " v-for="diasemana in arrayDetalle" v-bind:key="diasemana.id">
                                        <input class="form-check-input" type="checkbox" v-model="diaselected" :id="diasemana.valor" :value="diasemana.valor">
                                        <label class="form-check-label" :for="diasemana.valor">{{diasemana.valor}}</label>
                                    </div>
                                </div> -->
                            </div>
                            <hr>
                            <div class="from-group row">
                                <div class="col-md-3">
                                    <strong>% de Descuento:</strong>
                                    <input type="number" class="form-control" placeholder="0" v-model="descuento" v-on:focus="selectAll" style="text-align:right">
                                    <span  v-if="descuento==0" class="error">Debe Ingresar el % del descuento</span>
                                </div>
                                <div class="col-md-6" v-if="idtipodescuentoselected!=1">
                                    <strong>Aplica A:</strong>
                                    <select class="form-control" v-model="aplicaselected">
                                        <option disabled value="0">Seleccionar...</option>
                                        <option v-for="aplica in arrayAplica" :key="aplica.id" v-text="aplica.valor" :value="aplica.valor"></option>
                                    </select>
                                </div>
                                
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"  @click="cerrarModal('registrar')">Cerrar</button>
                        <button type="button" v-if="tipoAccion==1" class="btn btn-primary" @click="registrarDescuento()" :disabled="!sicompleto">Guardar</button>
                        <button type="button" v-if="tipoAccion==2" class="btn btn-primary" @click="actualizarDescuento()">Actualizar</button>
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
                regla_descuento:'',
                codigo:'',
                correlativo:0,
                tituloModal:'',
                tipoAccion:1,
                iddescuento:'',
                buscar:'',
                idtipodescuento:true,
                regla:'',
                caracter:'%',

                arrayDias:[],
                arrayDescuentos:[],
                arrayTipoDescuentos:[],
                idtipodescuentoselected:0,
                aplica_a:'',
                arrayAplica:[{'id':1,'valor':'Todos los Productos'},
                                {'id':2,'valor':'Producto individual'},
                                {'id':3,'valor':'Categoria'},
                                {'id':4,'valor':'Metodo ABC'}],
                montodescuento:0,
                arraySubCategorias:[],
                subcategoriaselected:0,
                monto:'',
                nomdescuento:'',
                arrayOperadores:[{'id':1,'valor':'='},
                                    {'id':2,'valor':'>'},
                                    {'id':3,'valor':'<'}
                                    ],
                arrayABC:[{'id':1,'valor':'A'},
                            {'id':2,'valor':'B'},
                            {'id':3,'valor':'C'}],
                arrayDias:[{'id':1,'valor':'Lunes'},
                            {'id':2,'valor':'Martes'},
                            {'id':3,'valor':'Miercoles'},
                            {'id':4,'valor':'Jueves'},
                            {'id':5,'valor':'Viernes'},
                            {'id':6,'valor':'Sabado'},
                            {'id':7,'valor':'Domingo'}],
                arrayDetalle: [],
                detalleselected:0,
                valor:0,

                idcategoria:[],
                idcategoriaselected:'',
                clearSelected:1,

                fechainicio:'',
                fechafin:'',
                fechamin:'',
                fechahoy:'',
                diaselected:[],
                repetir:1,
                fechax:'',
                descuento:0,
                aplicaselected:0,
                limite:0


                
            }

        },
        computed:{
            sicompletoregla(){
                let me=this;
                if (me.regla!=0)
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
            obtenerfecha(valor){
                let me = this;
                var url= '/obtenerfecha';
                axios.get(url).then(function (response) {
                    let respuesta= response.data; 
                    me.fechaactual=respuesta[0].fecha;
                    me.fechainicio=me.fechaactual;
                    me.fechafin=me.fechaactual;
                    me.fechahoy=me.fechaactual;
                    me.fechax=me.fechahoy;
                })
                .catch(function (error) {
                    console.log(error);
                });
                
                
                //me.fechafactura=me.fechaactual;
            },
            tiempo(){
                this.clearSelected=1;
            },
            cleancategorias(){
                this.idcategoria=[];
                this.idcategoriaelected='';
            
            },
            categorias(categorias){
                this.idcategoria=[];
                for (const key in categorias) {
                    if (categorias.hasOwnProperty(key)) {
                        const element = categorias[key];
                        //console.log(element);
                        this.idcategoria.push(element);
                    }
                }
            },
            listarSubcategorias(){
                let me =this;
                me.subcategoriaselected=0;
                me.valor=0;
                let resp=me.arrayTipoDescuentos.find(element=>element.id==me.idtipodescuentoselected);
                let subcategoria=resp.subcategorias;
                
                me.arraySubCategorias=subcategoria.split('|');
            },
            selectTipoDescuentos(){
                let me=this;
                var url='/tipodescuento/selecttipodescuento';
                axios.get(url).then(function(response){
                    var respuesta=response.data;
                    //me.arrayDias=respuesta.arraydias;
                    me.arrayTipoDescuentos=respuesta.tipodescuentos;
                })
                .catch(function(error){
                    console.log(error);
                });
            },
            listarDescuentos(page){
                let me=this;
                var url='/proddescuento?page='+page+'&buscar='+me.buscar;
                axios.get(url).then(function(response){
                    var respuesta=response.data;
                    me.pagination=respuesta.pagination;
                    me.arrayDescuentos=respuesta.descuentos.data;
                })
                .catch(function(error){
                    console.log(error);
                });
            },
            cambiarPagina(page){
                let me =this;
                me.pagination.current_page = page;
                me.listarDescuentos(page);
            },
            registrarDescuento(){
                let me = this;
                axios.post('/proddescuento/registrar',{
                    'nombre':me.nombre,
                    'regla_descuento':me.regla_descuento,
                    'idtipodescuento':me.idtipodescuento,
                    'regla':me.regla,
                    'aplica_a':me.aplica_a,
                }).then(function(response){
                    me.cerrarModal('registrar');
                    me.listarDescuentos();
                }).catch(function(error){
                    console.log(error);
                });

            },
            eliminarDescuento(iddescuento){
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
                     axios.put('/proddescuento/desactivar',{
                        'id': iddescuento
                    }).then(function (response) {
                        
                        swalWithBootstrapButtons.fire(
                            'Desactivado!',
                            'El registro a sido desactivado Correctamente',
                            'success'
                        )
                        me.listarDescuentos();
                        
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
            activarDescuento(iddescuento){
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
                     axios.put('/proddescuento/activar',{
                        'id': iddescuento
                    }).then(function (response) {
                        
                        swalWithBootstrapButtons.fire(
                            'Activado!',
                            'El registro a sido Activado Correctamente',
                            'success'
                        )
                        me.listarDescuentos();
                        
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
            actualizarDescuento(){
               // const Swal = require('sweetalert2')
                let me =this;
                axios.put('/proddescuento/actualizar',{
                    'id':me.iddescuento,
                    'nombre':me.nombre,
                    'regla_descuento':me.regla_descuento,
                    'idtipodescuento':me.idtipodescuento,
                    'regla':me.regla
                    
                }).then(function (response) {
                    if(response.data.length){
                    }
                    // console.log(response)
                    else{
                            Swal.fire('Actualizado Correctamente')

                        me.listarDescuentos();
                    } 
                }).catch(function (error) {
                   
                });
                me.cerrarModal('registrar');


            },
            listarDetalle(){
                let me=this;
                me.arrayDetalle=0;
                me.valor=0;
                switch (me.subcategoriaselected) {
                    case 'Metodo ABC':
                        {
                            me.valor=1;
                            me.arrayDetalle=me.arrayABC;
                            break;
                        }
                    case 'Producto Individual':
                    {
                        me.valor=2;
                        break;
                    }
                    case 'Categoria':
                    {
                        me.valor=3;
                        break;
                    }
                    case 'Monto mayor A':
                    {
                        me.valor=4;
                        me.arrayDetalle=me.arrayOperadores;
                        break;
                    }
                    case 'Cantidad de Compras':
                    {
                        me.valor=5;
                        me.arrayDetalle=me.arrayOperadores;
                        break;
                    }
                    case 'Semana':
                    {
                        me.valor=6;
                        me.arrayDetalle=me.arrayDias;
                        break;
                    }
                    case 'Rango de Fechas':
                    {
                        me.valor=7;
                        break;
                    }
                    case 'Fecha X':
                    {
                        me.valor=8;
                        break;
                    }
                    case 'Efectivo':
                    {
                        
                        me.valor=9;
                        break;
                    }
                    case 'Tarjeta':
                    {
                        me.valor=10;
                        break;
                    }
                    case 'Transferencia':
                    {
                        me.valor=11;
                        break;
                    }

                        
                        
                
                    default:
                        break;
                }

            },

            abrirModal(accion,data= []){
                let me=this;
                switch(accion){
                    case 'registrar':
                    {
                        //me.listarDescuentos();
                       
                       me.tituloModal='Registar Descuento'
                        me.tipoAccion=1;
                        me.nombre='';
                        me.regla_descuento='';
                        me.idtipodescuento=true;
                        me.regla='';
                        me.classModal.openModal('registrar');
                        break;
                    }
                    
                    case 'actualizar':
                    {
                        me.iddescuento=data.id;
                        me.tipoAccion=2;
                        me.tituloModal='Actualizar Descuento'
                        me.nombre=data.nombre;
                        me.regla_descuento=data.regla_descuento;
                        me.idtipodescuento=data.idtipodescuento;
                        me.regla=data.regla;
                        me.classModal.openModal('registrar');
                        break;
                    }

                }
                
            },
            cerrarModal(accion){
                let me = this;
                me.classModal.closeModal(accion);
                me.nombre='';
                me.regla_descuento='';
                me.idtipodescuento=true;
                me.regla=0;
                me.tipoAccion=1;
                
            },
            selectAll: function (event) {
                setTimeout(function () {
                    event.target.select()
                }, 0)
            },  


        },
        mounted() {
            this.obtenerfecha();
            this.selectTipoDescuentos();
            //this.listarDescuentos(1);
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
