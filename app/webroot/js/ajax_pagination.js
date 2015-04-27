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

	$('body').on('click','#general_items_pagination span > a',function(e) {
		e.preventDefault();

		$url = $(this).attr('href');

		getNextItem($url,'#general-item-table','.main-box-body');
		
		
	});


	$('body').on('click','#substrate_pagination span > a',function(e) {
		e.preventDefault();

		$url = $(this).attr('href');

		getNextItem($url,'#substrate-table','.main-box-body');
		
		
	});

	$('body').on('click','#compound_substrate_pagination span > a',function(e) {
		e.preventDefault();
		$url = $(this).attr('href');

		getNextItem($url,'#compound-substrate-table','.main-box-body');
		
		
	});

	$('body').on('click','#corrugated_paper_pagination span > a',function(e) {
		e.preventDefault();
		$url = $(this).attr('href');

		getNextItem($url,'#corrugated-paper-table','.main-box-body');
		
		
	});

	$('body').on('click','#process_pagination span > a',function(e) {
		e.preventDefault();
		$url = $(this).attr('href');

		getNextItem($url,'#process-table','.main-box-body');
		
		
	});

	$('body').on('click','#sub_process_pagination span > a',function(e) {
		e.preventDefault();
		$url = $(this).attr('href');

		getNextItem($url,'#sub-process-table','.main-box-body');
		
		
	});

});