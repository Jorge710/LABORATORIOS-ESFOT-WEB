$(document).ready(function () {
    sipmw.validacionGeneral('form-general');

    $(function(){
        $("#max_equ_id").maxLength(10, {showNumber: "#contador1_equ_id"});
        $("#max_equ_name").maxLength(191, {showNumber: "#contador2_equ_name"});
        $("#max_equ_description").maxLength(250, {showNumber: "#contador3_equ_description"});
        $("#max_equ_function").maxLength(250, {showNumber: "#contador4_equ_function"});
        $("#max_equ_recommendation").maxLength(250, {showNumber: "#contador5_equ_recommendation"});
        $("#max_equ_maintenance").maxLength(250, {showNumber: "#contador6_equ_maintenance"});
    });

    /**función operaciones calculo "CRITICIDADES" */
    $(function() {
      /**para evitar que ingresen valores al Input*/
      $("#consecuencias").prop("readonly", true);
      $("#criticidadEquipo").prop("readonly", true);
      /**funcion calcular */
	  $('#calcular').click(function(e) {

	  	e.preventDefault();
	         
      var impactOper = $('#valor1').val();
      var flexibilidad = $('#valor2').val();
      var costoMito = $('#valor3').val();
      var costoSegMa = $('#valor4').val();
      var frecuencia = $('#valor5').val();

        /**https://codepen.io/luismasDEV/pen/VrvxGE */
	  	  //if(primerValor.match(/^[0-9]+$/) && segundoValor.match(/^[0-9]+$/)){

      var consecuencia = (parseFloat(impactOper) * parseFloat(flexibilidad)) + (parseFloat(costoMito) + parseFloat(costoSegMa));        
      var criticidadEquipo = parseFloat(frecuencia) * parseFloat(consecuencia);
	  	
      $('#consecuencias').val(consecuencia);
      $('#criticidadEquipo').val(criticidadEquipo);
      
	  });
    });
    
    /**Fin dela función operaciones calculo "CRITICIDADES" */
});