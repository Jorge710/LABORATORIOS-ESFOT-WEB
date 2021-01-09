$(document).ready(function () {
    sipmw.validacionGeneral('form-general');

    $(function(){
        $("#max_inicioPag_mision").maxLength(300, {showNumber: "#contador1_inicioPag_mision"});
        $("#max_inicioPag_vision").maxLength(300, {showNumber: "#contador2_inicioPag_vision"});
    });
});