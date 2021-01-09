$(document).ready(function () {
    sipmw.validacionGeneral('form-general');

    $(function(){
        $("#max_id_sist").maxLength(10, {showNumber: "#contador1_sist_id"});
        $("#max_name_sist").maxLength(190, {showNumber: "#contador2_sist_nomb"});
        $("#max_description_sist").maxLength(250, {showNumber: "#contador3_sist_descrp"});
        /* $("#max_observacion_sist").maxLength(250, {showNumber: "#contador4_sist_obsrv"});
        $("#max_nota_sist").maxLength(250, {showNumber: "#contador5_sist_nota"}); */
    });
});