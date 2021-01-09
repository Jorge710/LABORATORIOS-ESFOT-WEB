$(document).ready(function () {
    sipmw.validacionGeneral('form-general');

    $(function(){
        $("#max_loc_id").maxLength(10, {showNumber: "#contador1_loc_id"});
        $("#max_loc_name").maxLength(190, {showNumber: "#contador2_loc_nomb"});
        $("#max_loc_description").maxLength(300, {showNumber: "#contador3_loc_descrip"});
        $("#max_loc_telephone").maxLength(13, {showNumber: "#contador4_loc_tlf"});
        $("#max_loc_extencion").maxLength(5, {showNumber: "#contador5_loc_ext"});
    });

    $(function () {
        $('.enteros').on('input', function () {
            this.value = this.value.replace(/[^0-9]/g, '');
        });
    });

});