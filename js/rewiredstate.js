// Place your application-specific JavaScript functions and classes here
// This file is automatically included by javascript_include_tag :defaults
	
FlickrTag = jQuery.klass({
  initialize: function(tag, size) {
    var element = jQuery('<ul class="flickr_tag_photos" id="flickr_tag_photos_for_'+tag+'"></ul>');
    this.element.after(element);
    jQuery.getJSON("http://api.flickr.com/services/feeds/photos_public.gne?tags="+tag+"&format=json&jsoncallback=?", function(data){ 
      jQuery.each(data.items.slice(0,10), function(i, item) {
        element.append(
          '<li>'+
            '<a href="'+item.link+'">'+
              '<img src="'+item.media.m.replace(/_m.jpg$/, "_s.jpg")+'" alt="'+item.title+'" />' +
            '</a>'+
          '</li>'
        );
      });
    });
  }
});

FirstFlickrTag = jQuery.klass({
  initialize: function(tag) {
    var element = this.element;
    jQuery.getJSON("http://api.flickr.com/services/feeds/photos_public.gne?tags="+tag+"&format=json&jsoncallback=?", function(data){ 
      item = data.items[0];
      element.attr('src', item.media.m.replace(/_m.jpg$/, "_s.jpg") );
    });
  }
});

RewiredStatePhotos = jQuery.klass({
  initialize: function() {
    var element = jQuery('<ul class="flickr_tag_photos" id="flickr_tag_photos_for_rewiredstate"></ul>');
    this.element.before(element);
    jQuery.getJSON("http://api.flickr.com/services/feeds/photos_public.gne?tags=rewiredstate&format=json&jsoncallback=?", function(data){ 
      jQuery.each(data.items.slice(0,18), function(i, item) {
        element.append(
          '<li>'+
            '<a href="'+item.link+'">'+
              '<img src="'+item.media.m.replace(/_m.jpg$/, "_s.jpg")+'" alt="'+item.title+'" />' +
            '</a>'+
          '</li>'
        );
      });
    });
  }
});

GithubProjectCommits = jQuery.klass({
  initialize: function(user_id, repo) {
    var element = jQuery('<ul class="github_repositories" id="github_repositories_from_'+user_id+'"></ul>');
    this.element.after(element);
    element.before('<h4>Recent commits to github:</h4>');
    jQuery.getJSON("http://github.com/api/v1/json/"+user_id+"/"+repo+"/commits/master?callback=?", function(data){ 
      jQuery.each(data.commits.slice(0,10), function(i, item) { 
        element.append(
          '<li>'+
             '<a href="'+item.url+'">'+
               item.message+
             '</a>'+
           '</li>'
        );
      });
    });
  }
});

TwitterSearch = jQuery.klass({
  initialize: function(query) {
    var element = jQuery('<ul class="twitter_search" id="twitter_search_for_'+query+'"></ul>');
    this.element.after(element);
    jQuery.getJSON("http://search.twitter.com/search.json?q="+query+"&callback=?", function(data){ 
      jQuery.each(data.results.slice(0,6), function(i, item) { 
        element.append(
          '<li class='+item.from_user+'>'+
             '<a href="http://twitter.com/'+item.from_user+'">'+
              item.from_user+
              '</a>: '+
               item.text+
           '</li>'
        );
      });
    });
  }
});

Twitter = jQuery.klass({
  initialize: function(user_id) {
    var element = jQuery('<ul class="tweets" id="tweets_from_'+user_id+'"></ul>');
    this.element.after(element);
    jQuery.getJSON("http://twitter.com/status/user_timeline/"+user_id+".json?count=5&callback=?", function(data){ 
      jQuery.each(data, function(i, item) { 
        element.append("<li>"+item.text+"</li>");
      });
    });
  }
});

Delicious = jQuery.klass({
  initialize: function(user_id) {
    var element = jQuery('<ul class="delicious_bookmarks" id="delicious_bookmarks_from_'+user_id+'"></ul>');
    this.element.before(element);
    jQuery.getJSON("http://feeds.delicious.com/v2/json/"+user_id+"?count=15&callback=?", function(data){ 
      jQuery.each(data, function(i, item) { 
        element.append(
          '<li>'+
            '<a href="'+item.u+'">'+
              item.d+
            '</a>'+
          '</li>'
        );
      });
    });
  }
});

SlideShow = jQuery.klass({
  initialize: function() {
    // TODO: Quote slideshow
    this.element.children().hide();
    this.element.children(":first").show();
  }
});

ShowHideSection = jQuery.klass({
  initialize: function() {
    this.element.find(".show_content").hide();
  },
  onclick: jQuery.delegate({
    ".show_link": function() {
      this.element.find(".show_content").toggle();
      return false;
    }
  })
});

SignUpChooser = jQuery.klass({
  initialize: function() {
    $('.sign_up_forms').children().hide();
  },
  onchange: function() {
    var current_section = this.element.attr("value");
    $('.sign_up_forms').slideUp(600, function() {
      $('.sign_up_forms').children().hide();
      $("#"+current_section).show();
      $('.sign_up_forms').slideDown(600);
    })
  }
});

jQuery(function($) {
  $(".slide_quote").attach(SlideShow);
  $(".show_hide_section").attach(ShowHideSection);
  $('.signup_chooser').attach(SignUpChooser);
  $('.slide_show').cycle({});
});

///////////////////
// Markdown info //
///////////////////
var markdown_info = {
  text: "<pre><a href='http://daringfireball.net/projects/markdown/syntax' target='_blank'>http://daringfireball.net/projects/markdown/syntax</a>\n\ncheat markdown:\n  *italic*   **bold**\n  _italic_   __bold__\n  \n  Links and images include the text or alternate text in preceding brackets:\n  An [Inline URL](http://url.com/ \"With a title\")\n  A [reference to example link][id]. This would be followed later by:\n  [id]: http://example.com/  \"Title\"\n  \n  Inline (titles are optional):\n  \n  ![an inline image](/path/img.jpg \"Title\")\n  ![a referenced image][id] would be followed later by:\n  [id]: /url/to/img.jpg \"Title\"\n  \n  Header 1\n  ========\n  Header 2\n  --------\n  or\n  # Header 1 #\n  ## Header 2 ##\n  (closing #'s are optional)\n  \n  1.  First ordered list item\n  2.  Second item\n  \n  *   An unordered list item.\n  \n      With multiple paragraphs.\n  \n  *   Another unordered list item\n      1. With a nested item below it\n  \n  > Email-style angle brackets\n  > are used for blockquotes.\n  \n  > > And, they can be nested.\n  \n  > #### Headers in blockquotes\n  > \n  > * You can quote a list.\n  > * Etc.\n  \n  `<code>` spans are delimited by backticks.  You can include literal\n  backticks like `` `this` ``.\n  \n  This is a normal paragraph.\n  \n      This is a preformatted code block. It must be indented\n      either by at least four spaces or a tab\n  \n  Three or more dashes or asterisks make a horizontal rule:\n  ---\n  * * *\n  - - - -\n  \n  Finally, end a line with two or more spaces to do a manual line break\n</pre>",
  show: function() {
    $(this).after("<div class='markdown_help'>" + markdown_info.text + "</div>");
  },
  hide: function() {
    $(this).next('.markdown_help').remove();
  }
}                                   
            

// Twitter
jQuery( document ).ready( function($) {
	$('.twitter').tweet({
		username: "rewiredstate",
		join_text: null,
        avatar_size: null,
        count: 1,
		loading_text: "loading tweets..."
    });

	$('#image_rotate ul').innerfade({
		speed: 'slow',
		timeout: 6000,
		type: 'sequence',
		containerheight: '308px'
	});  
});