$(document).ready(function () {
    sipmw.validacionGeneral('form-general');

    $(function(){
        $("#max_elem_nomb").maxLength(190, {showNumber: "#contador1_elem_nomb"});
        $("#max_elem_cantidad").maxLength(4, {showNumber: "#contador2_elem_cantidad"});
        $("#max_elem_descrp").maxLength(250, {showNumber: "#contador3_elem_descrp"});
        $("#max_elem_func").maxLength(250, {showNumber: "#contador4_elem_func"});
        $("#max_elem_descrpFallo").maxLength(250, {showNumber: "#contador5_elem_descrpFallo"});
        $("#max_elem_mdoFallo").maxLength(250, {showNumber: "#contador6_elem_mdoFallo"});
        $("#max_elem_actividad").maxLength(250, {showNumber: "#contador7_elem_actividad"});
        $("#max_elem_tarea").maxLength(190, {showNumber: "#contador8_elem_tarea"});
        $("#max_elem_mejoras").maxLength(250, {showNumber: "#contador9_elem_mejoras"});
        $("#max_elem_pcdt_produccion").maxLength(250, {showNumber: "#contador10_elem_pcdt_produccion"});
        $("#max_elem_pcdt_mantenimiento").maxLength(250, {showNumber: "#contador11_elem_pcdt_mantenimiento"});
    });

    $(function () {
        $('.enteros').on('input', function () {
            this.value = this.value.replace(/[^0-9]/g, '');
        });
    });
});