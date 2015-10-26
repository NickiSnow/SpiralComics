
(function($){

	//Format rss feed
  $('#marvel').rssfeed('http://marvel.com/feeds/rss/comics_news', {
    limit: 3,
		header: false,
		dateformat: 'date',
		linktarget: '_blank'
  });
	$('#dc').rssfeed('http://www.dccomics.com/feed', {
    limit: 3,
		header: false,
		dateformat: 'date',
		linktarget: '_blank'
  });
    $('#movie').rssfeed('http://www.comicbookmovie.com/rss/', {
    limit: 3,
    header: false,
    dateformat: 'date',
    linktarget: '_blank'
  });

})(jQuery); // end jQuery document ready function