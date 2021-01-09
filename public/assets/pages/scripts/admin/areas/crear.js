$(document).ready(function () {
    sipmw.validacionGeneral('form-general');

    $(function(){
        $("#max_id").maxLength(10, {showNumber: "#contador1"});
        $("#max_name").maxLength(190, {showNumber: "#contador2"});
        $("#max_description").maxLength(250, {showNumber: "#contador3"});
    });
});