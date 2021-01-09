$(document).ready(function () {
    sipmw.validacionGeneral('form-general');

    $(function(){
        $("#max_equiPrest_nomb").maxLength(190, {showNumber: "#contador1_equiPrest_nomb"});
        $("#max_equiPrest_facultad").maxLength(190, {showNumber: "#contador2_equiPrest_facultad"});
        $("#max_equiPrest_carrera").maxLength(190, {showNumber: "#contador3_equiPrest_carrera"});
        $("#max_equiPrest_email").maxLength(190, {showNumber: "#contador4_equiPrest_email"});
        $("#max_equiPrest_observacion").maxLength(250, {showNumber: "#contador5_equiPrest_observacion"});
    });
});