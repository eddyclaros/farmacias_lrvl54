<template>
<main class="main">
    <div class="breadcrumb titmodulo">RRHH > Configuración de Parámetros</div>
    <div class="container-fluid">
        <div class="row">
            <!-- niveles de formación  niveles de formación  niveles de formación  niveles de formación -->
            <!-- niveles de formación  niveles de formación  niveles de formación  niveles de formación -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header titcard">
                        <div class="row">
                            <div class="col-md-8 col-sm-8">
                                <div class="tablatit"><div class="tcelda">Niveles de Formación</div></div>
                            </div>
                            <div class="col-md-4 col-sm-4 text-right">
                                <button v-if="!formFormacion" class="btn btn-primary" style="margin-top:0" 
                                    @click="nuevaFormacion()">Nueva</button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body" style="height:280px; overflow-y:scroll">
                        <table v-if="!formFormacion" class="table table-sm table-striped">
                            <thead class="tcabecera">
                                <tr>
                                    <th><span class="badge badge-success" v-text="arrayFormaciones.length+' items'"></span></th>
                                    <th>Descripción</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="formacion in arrayFormaciones" :key="formacion.id" 
                                    :class="formacion.activo?'':'txtdesactivado'" align="center">
                                    <td v-if="formacion.activo" nowrap>
                                        <button class="btn btn-warning btn-sm icon-pencil" title="Editar Formación" 
                                            @click="editarFormacion(formacion)"></button>
                                        <button class="btn btn-danger btn-sm icon-trash" title="Desactivar Formación"
                                            @click="estadoFormacion(formacion)"></button>
                                    </td>
                                    <td v-else>
                                        <button class="btn btn-success btn-sm icon-action-redo" title="Restaurar Formación"
                                            @click="estadoFormacion(formacion)"></button>
                                    </td>
                                    <td v-text="formacion.nombre" align="left"></td>
                                </tr>
                            </tbody>
                        </table>
                        <div v-if="formFormacion"><br>
                            <h4 class="titazul"><span v-text="accion==1?'Nueva':'Modificar'"></span> Formación</h4>
                            <br>Nivel de Formación: <input type="text" class="form-control" autofocus v-model="nomformacion">
                            <p align="right"><br>
                            <button class="btn btn-secondary" @click="formFormacion=0">Cancelar</button>
                            <button :disabled="nomformacion==''"   class="btn btn-primary" @click="accion==1?registrarFormacion():actualizarFormacion()">
                                Guardar <span v-if="accion==2">Modificaciones</span></button>                            
                            </p>
                        </div>                        
                    </div>

                </div>
            </div>

            <!-- profesiones profesiones profesiones profesiones profesiones profesiones profesiones-->
            <!-- profesiones profesiones profesiones profesiones profesiones profesiones profesiones-->
            <div class="col-md-6"> 
                <div class="card">
                    <div class="card-header titcard">
                        <div class="row">
                            <div class="col-md-8 col-sm-8">
                                <div class="tablatit"><div class="tcelda">Profesiones</div></div>
                            </div>
                            <div class="col-md-4 col-sm-4 text-right">
                                <button v-if="!formProfesion" class="btn btn-primary" style="margin-top:0" 
                                    @click="nuevaProfesion()">Nueva</button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body" style="height:280px; overflow-y:scroll">
                        <table v-if="!formProfesion" class="table table-sm table-striped">
                            <thead class="tcabecera">
                                <tr>
                                    <th><span class="badge badge-success" v-text="arrayProfesiones.length+' items'"></span></th>
                                    <th>Descripción</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="profesion in arrayProfesiones" :key="profesion.id"
                                    :class="profesion.activo?'':'txtdesactivado'" align="center">
                                    <td v-if="profesion.activo" align="center" nowrap>
                                        <button class="btn btn-warning btn-sm icon-pencil" title="Editar Profesión"
                                            @click="editarProfesion(profesion)"></button>
                                        <button class="btn btn-danger btn-sm icon-trash" title="Desactivar Profesión"
                                            @click="estadoProfesion(profesion)"></button>
                                    </td>
                                    <td v-else>
                                        <button class="btn btn-success btn-sm icon-action-redo" title="Restaurar Profesión"
                                            @click="estadoProfesion(profesion)"></button>
                                    </td>
                                    <td v-text="profesion.nombre" align="left"></td>
                                </tr>
                            </tbody>
                        </table>
                        <div v-if="formProfesion"><br>
                            <h4 class="titazul"><span v-text="accion==1?'Nueva':'Modificar'"></span> Profesión</h4>
                            <br>Profesión: <input type="text" class="form-control" autofocus v-model="nomprofesion">
                            <p align="right"><br>
                            <button class="btn btn-secondary" @click="formProfesion=0">Cancelar</button>
                            <button :disabled="nomprofesion==''" class="btn btn-primary" @click="accion==1?registrarProfesion():actualizarProfesion()">
                                Guardar <span v-if="accion==2">Modificaciones</span></button>
                            </p>
                        </div>
                    </div>
                </div>
            </div>           
            
            <!-- motivos de permiso  motivos de permiso  motivos de permiso  motivos de permiso -->
            <!-- motivos de permiso  motivos de permiso  motivos de permiso  motivos de permiso -->
            

            <!-- seguro social  seguro social  seguro social  seguro social   seguro social -->
            <!-- seguro social  seguro social  seguro social  seguro social   seguro social -->
            


            <!-- tipo contratos  tipo contratos tipo contratos tipo contratos tipo contratos tipo contratos-->
            <!-- tipo contratos  tipo contratos tipo contratos tipo contratos tipo contratos tipo contratos-->
           

            <!-- cargos  cargos cargos cargos cargos cargos cargos -->
            <!-- cargos  cargos cargos cargos cargos cargos cargos -->
            <div class="col-md-12"> 
                <div class="card">
                    <div class="card-header titcard">
                        <div class="row">
                            <div class="col-md-8 col-sm-8">
                                <div class="tablatit"><div class="tcelda">Cargos</div></div>
                            </div>
                            <div class="col-md-4 col-sm-4 text-right">
                                <button v-if="!formCargo" class="btn btn-primary" style="margin-top:0" 
                                    @click="nuevoCargo()">Nuevo</button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body" style="height:280px; overflow-y:scroll">
                        <table v-if="!formCargo" class="table table-sm table-striped">
                            <thead class="tcabecera">
                                <tr>
                                    <th><span class="badge badge-success" v-text="arrayCargos.length+' items'"></span></th>
                                    <th>Descripción</th>
                                    <th>Nivel</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="cargo in arrayCargos" :key="cargo.id"
                                    :class="cargo.activo?'':'txtdesactivado'" align="center">
                                    <td v-if="cargo.activo" align="center" nowrap>
                                        <button class="btn btn-warning btn-sm icon-pencil" title="Editar Cargo"
                                            @click="editarCargo(cargo)"></button>
                                        <button class="btn btn-danger btn-sm icon-trash" title="Desactivar Cargo"
                                            @click="estadoCargo(cargo)"></button>
                                    </td>
                                    <td v-else>
                                        <button class="btn btn-success btn-sm icon-action-redo" title="Restaurar Cargo"
                                            @click="estadoCargo(cargo)"></button>
                                    </td>
                                    <td v-text="cargo.nombre" align="left"></td>
                                    <td v-text="cargo.nivel" align="left"></td>
                                </tr>
                            </tbody>
                        </table>
                        <div v-if="formCargo"><br>
                            <h4 class="titazul"><span v-text="accion==1?'Nuevo':'Modificar'"></span> cargo</h4>
                            <br>
                            <div class="form-group row">
                                <div class="col-md-8">
                                    Cargo: <input type="text" class="form-control" autofocus v-model="nomcargo">
                                </div>
                                <div class="col-md-4">
                                    Nivel:
                                    <select name="" id="" v-model="nivelselected" class="form-control">
                                        <option  v-for="niveles in arrayNiveles" :key="niveles" v-text="niveles" :value="niveles"></option>
                                    </select>    
                                </div>
                                
                                
                            </div>
                            
                            <p align="right"><br>
                            <button class="btn btn-secondary" @click="formCargo=0">Cancelar</button>
                            <button :disabled="nomcargo==''" class="btn btn-primary" @click="accion==1?registrarCargo():actualizarCargo()">
                                Guardar <span v-if="accion==2">Modificaciones</span></button>
                            </p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</main>
</template>

<script>
import Swal from 'sweetalert2'
export default {
    data(){ return { 
        accion:'', 
        formFormacion:0,
        arrayFormaciones:[], 
        idformacion:'', 
        nomformacion:'',
        formProfesion:0, 
        arrayProfesiones:[], 
        idprofesion:'', 
        nomprofesion:'',
        formTipocontrato:0,  
        arrayTipocontratos:[], 
        idtipocontrato:'', 
        nomtipocontrato:'',
        formMotivo:0, 
        arrayMotivos:[], 
        idmotivo:'', 
        nommotivo:'',
        formSeguro:0, 
        arraySeguros:[], 
        idseguro:'', 
        nomseguro:'', 
        tipo:'', 
        sigla:'',
        formCargo:0, 
        arrayCargos:[], 
        idcargo:'', 
        nomcargo:'',
        arrayNiveles:[1,2,3,4,5],
        nivelselected:1
    }},

    methods:{
        //formaciones formaciones formaciones  formaciones formaciones formaciones formaciones
        //formaciones formaciones formaciones  formaciones formaciones formaciones formaciones
        listaFormaciones(){
            let me=this;
            axios.get('/formacion').then(function(response){
                me.arrayFormaciones=response.data.formacion.data;
            });
        },

        nuevaFormacion(){
            this.formFormacion=1;
            this.accion=1;
            this.nomformacion='';
        },

        editarFormacion(formacion){
            this.formFormacion=1;
            this.accion=2;
            this.idformacion=formacion.id;
            this.nomformacion=formacion.nombre;
        },

        registrarFormacion(){
            let me=this;
            var url='/formacion/registrar';
            axios.post(url,{
                'nombre':this.nomformacion
            }).then(function(){
                Swal.fire('Nivel de formación creada correctamente','','success');
                me.formFormacion=0;
                me.listaFormaciones();
            });
        },

        actualizarFormacion(){
            let me=this;
            var url='/formacion/actualizar';
            axios.put(url,{
                'id':this.idformacion,
                'nombre':this.nomformacion
            }).then(function(){
                Swal.fire('Datos actualizados','','success');
                me.formFormacion=0;
                me.listaFormaciones();
            });
        },

        estadoFormacion(formacion){
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false
                })
            this.idformacion=formacion.id;
            if(formacion.activo){
                swalWithBootstrapButtons.fire({  title:'Desactivará<br>'+formacion.nombre, icon: 'warning', 
                    html:'No podrá acceder a la información dependiente', showCancelButton: true,
                    confirmButtonColor:'#f86c6b', confirmButtonText:'Desactivar Formacion',
                    cancelButtonText:'Cancelar', reverseButtons: true
                }).then(confirmar=>{
                    if(confirmar.value) this.switchFormacion(1);
                });
            }
            else this.switchFormacion(0);
        },

        switchFormacion(activo){
            if(activo) 
            {
                var titswal='Desactivado'; 
                var url='/formacion/desactivar?id='+this.idformacion;
            }
                
            else
            {
                var titswal='Activado';
                var url='/formacion/activar?id='+this.idformacion;
            } 
            let me=this;
            axios.put(url).then(function(){
                Swal.fire(titswal+' correctamente','','success');
                me.listaFormaciones();
            });
        },        

        //profesiones profesiones profesiones profesiones profesiones profesiones profesiones
        //profesiones profesiones profesiones profesiones profesiones profesiones profesiones
        listaProfesiones(){
            let me=this;
            axios.get('/profesion').then(function(response){
                me.arrayProfesiones=response.data.profesion.data;
            });
        },

        nuevaProfesion(){
            this.formProfesion=1;
            this.accion=1;
            this.nomprofesion='';
        },

        editarProfesion(profesion){
            console.log(profesion);
            this.formProfesion=1;
            this.accion=2;
            this.idprofesion=profesion.id;
            this.nomprofesion=profesion.nombre;
        },

        registrarProfesion(){
            let me=this;
            var url='/profesion/registrar';
            axios.post(url,{
                'nombre':this.nomprofesion
            }).then(function(){
                Swal.fire('Profesion creada correctamente','','success');
                me.formProfesion=0;
                me.listaProfesiones();
            });
        },

        actualizarProfesion(){
            let me=this;
            var url='/profesion/actualizar';
            axios.put(url,{
                'id':this.idprofesion,
                'nombre':this.nomprofesion
            }).then(function(){
                Swal.fire('Datos actualizados','','success');
                me.formProfesion=0;
                me.listaProfesiones();
            });
        },

        estadoProfesion(profesion){
             const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false
                })
            this.idprofesion=profesion.id;
            if(profesion.activo){
                swalWithBootstrapButtons.fire({  title:'Desactivará:<br>'+profesion.nombre, icon: 'warning', 
                    html:'No podrá acceder a la información dependiente', showCancelButton: true,
                    confirmButtonColor:'#f86c6b', confirmButtonText:'Desactivar Profesion',
                    cancelButtonText:'Cancelar', reverseButtons: true
                }).then(confirmar=>{
                    if(confirmar.value) this.switchProfesion(1);
                });
            }
            else this.switchProfesion(0);
        },

        switchProfesion(activo){
            console.log(this.idprofesion);
            if(activo) 
            {
                var titswal='Desactivado';
                var url='/profesion/desactivar?id='+this.idprofesion;
            }
            else
            {
                var titswal='Activado';
                var url='/profesion/activar?id='+this.idprofesion;
            } 
            let me=this;
            axios.put(url).then(function(){
                Swal.fire(titswal+' correctamente','','success');
                me.listaProfesiones();
            });
        },        

        // tipo contratos tipo contratos tipo contratos tipo contratos tipo contratos tipo contratos
        // tipo contratos tipo contratos tipo contratos tipo contratos tipo contratos tipo contratos
        


        //motivos motivos motivos motivos motivos motivos motivos motivos
        //motivos motivos motivos motivos motivos motivos motivos motivos
        
        // seguros  seguros  seguros  seguros  seguros  seguros  seguros  seguros 
        // seguros  seguros  seguros  seguros  seguros  seguros  seguros  seguros 
        
        //cargos cargos cargos cargos cargos cargos cargos cargos
        //cargos cargos cargos cargos cargos cargos cargos cargos
        listaCargos(){
            let me=this;
            var url='/cargo';
            axios.get(url).then(function(response){
                me.arrayCargos=response.data.cargo.data;
            });
        },

        nuevoCargo(){
            this.formCargo=1;
            this.accion=1;
            this.nomcargo='';
            this.nivelselected=1;
        },

        editarCargo(cargo){
            console.log(cargo)
            this.formCargo=1;
            this.accion=2;
            this.idcargo=cargo.id;
            this.nomcargo=cargo.nombre;
            this.nivelselected=cargo.nivel;
        },

        registrarCargo(){
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false
                });
            swalWithBootstrapButtons.fire({  title:'Registrará: <br>Cargo: '+this.nomcargo+ '<br>Nivel: '+this.nivelselected, icon: 'info', 
                    html:'Esta Seguro?',
                    showCancelButton: true,
                    confirmButtonColor:'#f86c6b', confirmButtonText:'Regisrar Cargo',
                    cancelButtonText:'Cancelar', reverseButtons: true
                }).then(confirmar=>{
                    if(confirmar.value)
                    {
                        let me=this;
                        var url='/cargo/registrar';
                        axios.post(url,{
                            'nombre':this.nomcargo,
                            'nivel':this.nivelselected
                        }).then(function(){
                            Swal.fire('Cargo creado correctamente','','success');
                            me.formCargo=0;
                            me.listaCargos();
                        });
                    }
                });
        },

        actualizarCargo(){
            let me=this;
            var url='/cargo/actualizar';
            axios.put(url,{
                'id':this.idcargo,
                'nombre':this.nomcargo,
                'nivel':this.nivelselected
            }).then(function(){
                Swal.fire('Datos actualizados','','success');
                me.formCargo=0;
                me.listaCargos();
            });
        },

        estadoCargo(cargo){
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false
                })
            this.idcargo=cargo.id;
            if(cargo.activo){
                swalWithBootstrapButtons.fire({  title:'Desactivará:<br>'+cargo.nombre, icon: 'warning', 
                    html:'No podrá acceder a la información dependiente', showCancelButton: true,
                    confirmButtonColor:'#f86c6b', confirmButtonText:'Desactivar Cargo',
                    cancelButtonText:'Cancelar', reverseButtons: true
                }).then(confirmar=>{
                    if(confirmar.value) this.switchCargo(1);
                });
            }
            else this.switchCargo(0);
        },

        switchCargo(activo){
            if(activo)
            {
                var titswal='Desactivado';
                var url='/cargo/desactivar?idcargo='+this.idcargo;
            }  
            else 
            {
                var titswal='Activado';
                var url='/cargo/activar?idcargo='+this.idcargo;
            }
            let me=this;
            axios.put(url).then(function(){
                Swal.fire(titswal+' correctamente','','success');
                me.listaCargos();
            });
        },        


    },

    mounted(){
        this.listaFormaciones();
        this.listaProfesiones();
        this.listaCargos();
    }
}
</script>