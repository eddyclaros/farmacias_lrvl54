@extends('principal')
@section('contenido')
<template v-if="menu==0">
<h1>Contenido menu 0</h1>
</template>
<template v-if="menu==10">
    <sucursal-component></sucursal-component>

</template>
<template v-if="menu==1">
    <area-component></area-component>

</template>
    
<template v-if="menu==2">
    <prestaciones-component></prestaciones-component>
</template>

<template v-if="menu==3">
    <descuentos-component></descuentos-component>
</template>
<template v-if="menu==31">
    <descproductos-component></descproductos-component>
</template>

<template v-if="menu==4">
    <ventas-component></ventas-component>
</template>

<template v-if="menu==5">
    <histventas-component></histventas-component>
</template>

<template v-if="menu==60">
    <linea-component></linea-component>
</template>

<template v-if="menu==61">
    <producto-component></producto-component>
</template>

<template v-if="menu==62">
    <dispenser-component></dispenser-component>
</template>

<template v-if="menu==63">
    <formafarm-component></formafarm-component>
</template>

<template v-if="menu==7">
    <h1>Contenido menu 7</h1>
</template>

<template v-if="menu==8">
    <h1>Contenido menu 8</h1>
</template>

<template v-if="menu==9">
    <h1>Contenido menu 9</h1>
</template>

<template v-if="menu==11">
    <h1>Contenido menu 11</h1>
</template>

<template v-if="menu==12">
    <h1>Contenido menu 12</h1>
</template>

@endsection