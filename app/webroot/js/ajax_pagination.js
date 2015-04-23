$(function(){
	
	function getNextItem(url,parent,appendDiv) {

		$.ajax({
            url: url,
            type: 'GET',
            success: function(data) {
				var table = $(data).find(parent +' .table-responsive').first();
				$(parent+" "+appendDiv).html(table);
            }
        });


	}

	$('body').on('click','#item_category_pagination span > a',function(e) {
		e.preventDefault();

		$url = $(this).attr('href');

		getNextItem($url,'#categoryTables','.main-box-body');
		
		
	});

	$('body').on('click','#item_type_pagination span > a',function(e) {
		e.preventDefault();

		$url = $(this).attr('href');

		getNextItem($url,'#itemTypeTables','.main-box-body');
		
		
	});

});