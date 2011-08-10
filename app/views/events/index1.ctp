<html>

<body>



	<div id="content">

		<h1>Infinite Scroll Testing</h1>
		<ul>
		<li>OneOneOneOneOneOneOneOneOneOneOneOneOneOneOne OneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOne OneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOne OneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOne OneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOne OneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOne OneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOne OneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOne OneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOne OneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOne OneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOne OneOneOneOneOneOneOneOneOneOne </li>
		
				<li>OneOneOneOneOneOneOneOneOneOneOneOneOneOneOne OneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOne OneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOne OneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOne OneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOne OneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOne OneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOne OneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOne OneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOne OneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOne OneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOne OneOneOneOneOneOneOneOneOneOne </li>
				
						<li>OneOneOneOneOneOneOneOneOneOneOneOneOneOneOne OneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOne OneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOne OneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOne OneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOne OneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOne OneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOne OneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOne OneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOne OneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOne OneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOneOne OneOneOneOneOneOneOneOneOneOne </li>
						</ul>

		


	</div>

	<a id="next" href="/events/moshi/2">next page?</a>

	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script> 
	<script type ="text/javascript" src="/js/scroll.js"></script>

	<script>


	$('#content').infinitescroll({

		// callback		: function () { console.log('using opts.callback'); },
		navSelector  	: "a#next:last",
		nextSelector 	: "a#next:last",
		itemSelector 	: "#content ul",
		dataType	 	: 'html',
		// behavior		: 'twitter',
		// appendCallback	: false, // USE FOR PREPENDING
		// pathParse     	: function( pathStr, nextPage ){ return pathStr.replace('2', nextPage ); }
    }, function(newElements){
    
    	//USE FOR PREPENDING
    	// $(newElements).css('background-color','#ffef00');
    	// $(this).prepend(newElements);
    	//
    	//END OF PREPENDING
    	
    	window.console && console.log('context: ',this);
    	window.console && console.log('returned: ', newElements);
    	
    });
	</script>
</body>
</html>