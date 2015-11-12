
(function($){

  /*---------------- Format RSS Feed ------------------*/
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

  $(document).on("click", ".open-ComicDetails", function () {
      var selectedComicTitle = $(this).data('title');
      var selectedComicNumber = $(this).data('number');
      var selectedComicDesc = $(this).data('description');
      var selectedComicPic = $(this).data('image');
      var url = 'images/comics/' + selectedComicPic;
      var selectedComicCreators = $(this).data('creators');
      var selectedComicCond = $(this).data('condition') + '<br/>';
      var selectedComicPrice = $(this).data('price');
      var selectedComicVariation = $(this).data('variation');

      $("#title").html(selectedComicTitle + ' #' + selectedComicNumber + ' ' + selectedComicVariation);
      $("#description").html(selectedComicDesc);
      $("#modalImage").attr('src', url);
      $("#modalImage").attr('alt', selectedComicTitle + ' #' + selectedComicNumber + ' ' + selectedComicVariation);
      $("#creators").html(selectedComicCreators);
      $("#condition").html(selectedComicCond);
      $("#price").html(selectedComicPrice);
  });    

})(jQuery); // end jQuery document ready function