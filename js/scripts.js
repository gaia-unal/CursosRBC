var inicio=function () {
	$(".cantidad").keyup(function(e){
		if($(this).val()!=''){
			if(e.keyCode==13){
				var referencia=$(this).attr('data-referencia');
				var valor=$(this).attr('data-valor');
				var cantidad=$(this).val();
				$(this).parentsUntil('#lista-carrito').find('.subtotal').text('Subtotal: $'+(valor*cantidad));
				$.post('./js/modificarDatos.php',{
					Referencia:referencia,
					Valor:valor,
					Cantidad:cantidad
				},function(e){
						$("#total").text('Total: $'+e);
				});
			}
		}
	});
}
$(document).on('ready',inicio);