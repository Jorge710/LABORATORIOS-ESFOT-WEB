$(document).ready(function () {
    sipmw.validacionGeneral('form-general');

    /**función operaciones calculo "CRITICIDADES" */
    $(function() {
      /**para evitar que ingresen valores al Input*/
      $("#consecuencias").prop("readonly", true);
      $("#criticidadEquipo").prop("readonly", true);
      $("#criticidadIdCodigo").prop("readonly", true);
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