<section>
	<h2>Сортировка коллекций</h2>
	<p class="alert alert-info">Расположите элементы в нужном порядке и нажмите "Сохранить"</p>
	<div id="orderResult"></div>
	<input type="button" id="save" value="Сохранить" class="btn btn-primary" />
</section>

<script>
$(function() {
	$.post('<?php echo site_url('admin/color/order_ajax'); ?>', {}, function(data){
		$('#orderResult').html(data);
	});

	$('#save').click(function(){
		oSortable = $('.sortable').nestedSortable('toArray');

		$('#orderResult').slideUp(function(){
			$.post('<?php echo site_url('admin/color/order_ajax'); ?>', { sortable: oSortable }, function(data){
				$('#orderResult').html(data);
				$('#orderResult').slideDown();
			});
		});

	});
});
</script>