$(document).ready(function () {
    sipmw.validacionGeneral('form-general');

    $(function(){
        $("#max_user_id").maxLength(11, {showNumber: "#contador1_user_id"});
        $("#max_user_nombre").maxLength(190, {showNumber: "#contador2_user_nomb"});
        $("#max_user_apellido").maxLength(190, {showNumber: "#contador3_user_apellido"});
    });

    $(function () {
        $('.enteros').on('input', function () {
            this.value = this.value.replace(/[^0-9]/g, '');
        });
    });
    
});
