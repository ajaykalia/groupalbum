<?php
/**
 * file: app/views/events/overlay.ctp
 *
 * Overlay test
 */
//echo('<pre>');
//print_r($event);
//print_r($this->data);
//echo('</pre>');

?>
<script type="text/javascript" src="/js/jquery-1.4.4.min.js"></script>  
<link rel="stylesheet" href="/css/prettyPhoto.css" type="text/css" media="screen" charset="utf-8" />
<style>

ul#thumbs a{
		display:block;
		float:left;
		width:100px;
		height:100px;
		line-height:100px;
		overflow:hidden;
		position:relative;
		z-index:1;		
	}
	ul#thumbs a img{
		float:left;
		position:absolute;
		top:0px;
		left:0px;	
	}
	
	ul#thumbs a:hover{
				overflow:visible;
				z-index:1000;
				border:none;		
			}

</style>



<body>
<div id="page_wrap">
<div id="text">Overlay test</div>
<div >
<div id="single_photo">
<ul id="thumbs">
<li><a href="/img/image-1.jpg" title="first" rel="prettyPhoto[pp_gal]"><img src="/img/image-1.jpg" alt="picture" ></a></li>
<li><a href="/img/private.png" title="second" rel="prettyPhoto[pp_gal]"><img src="/img/private.png" alt="picture"></a></li>
<li><a href="/img/image-1.jpg" title="third" rel="prettyPhoto[pp_gal]"><img src="/img/image-1.jpg" alt="picture"></a></li>
</ul>
</div>
</div>
</body>