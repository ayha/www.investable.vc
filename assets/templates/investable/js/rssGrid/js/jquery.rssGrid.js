/*!
 * rssGrid PACKAGED v0.1
 * Get RSS Feed and build a newsfeed grid with the help of Isotope for positioning
 * Dependency: JQuery Isotope http://isotope.metafizzy.co
 */
;(function ( $ ) {
$.fn.rssGrid = function(options){
	var feed_data =[];
	var entries = [];
	var feed_count = 0;
	var outputHTML = [];
	var _grid  = this;
	var settings = $.extend({
		"sources": [],
		"newsCount": 5,
		
		"total"	: 0,  // limit the total number of articles to be displayed, 0=unlimited
		"containerWidth":"100%",
		"showSource": false
	}, options);
	
	function init(){
		_grid.feed_count = settings.sources.length;
		_grid.isotope({
  		itemSelector: '.rssGrid-item',
  		 layoutMode: 'masonry',
  		 sortBy: 'date'
 		});
		for(var i=0; i<_grid.feed_count; i++){
			parseRSS(settings.sources[i].name,settings.sources[i].icon, settings.sources[i].url);
		}
	}
	
	function parseRSS(feed_title, feed_image, feed_url){
		
		$.ajax({
	  		url: document.location.protocol + '//ajax.googleapis.com/ajax/services/feed/load?v=1.0&num='+settings.newsCount+'&callback=?&q=' + encodeURIComponent(feed_url),
		    dataType: 'json',
		    success: function(data) {
		      	feed_data.push(data.responseData.feed);
				for(var i=0; i<data.responseData.feed.entries.length;i++){
			     	createFeedItem(data.responseData.feed.entries[i], feed_title, feed_image);
			     	
				}
		    }
	  });
	  
	 
	}
	
	function createFeedItem(rssNode, feed_source, source_icon){
		//console.log(rssNode);
		//console.log(settings.total + " length: "+ _grid.children(".rssGrid-item").length);
		if(settings.total == 0 || _grid.children(".rssGrid-item").length < settings.total){
		var nodeHTML = '<div class="rssGrid-item" data-source="'+feed_source+'" data-icon="'+source_icon+'" data-date="'+rssNode["publishedDate"]+'"" data-url="'+rssNode["link"]+'">';
		nodeHTML += '<div class="source_icon_wrapper"><img src="'+source_icon+'" class="source_icon" alt="feed_source" /></div>';
		
		if(typeof(rssNode.mediaGroups) != 'undefined' && parseInt(rssNode.mediaGroups.length) >0){
			for(var i=0; i<rssNode.mediaGroups.length; i++){
				
				var url = rssNode.mediaGroups[i].contents[0].url;
				if(typeof(url) != "undefined" && url !=""){
					nodeHTML += '<div class="news_img" style="background-image:url('+url+')"></div>';
					break;
				}
				 
			}
		}
		
		nodeHTML += '<h3>'+rssNode["title"]+"</h3>";
		nodeHTML += '<div class="contentSnippet">'+rssNode["contentSnippet"].trim()+'</div>';
		nodeHTML += '</div>';
		outputHTML.push(nodeHTML);
		nodeObj = $.parseHTML(nodeHTML);
		_grid.isotope().prepend(nodeObj ).isotope( 'appended', nodeObj ).isotope('layout');
		$(nodeObj).on("click", function(e){
			e.preventDefault();
			var url = $(this).data("url");
			window.open(url,'_blank');
		});
		}
		
	}
	
	
	function debugOutput(msg){
		$("#debug_console").html($("#debug_console").html()+"\n\n&gt;&gt; "+msg);
	}
	
	
	
	init();
	
	return this;	
}

}(jQuery));
