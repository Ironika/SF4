$(document).ready(function() {
	//fix bug on blog-detail + sidebar
	$(".blog-side-menu").appendTo(".layout-blog");
	tinymce.init({
	  selector: 'textarea',
	  theme: 'modern',
	  plugins: 'image lists textcolor link',
	  toolbar1: 'formatselect | bold italic strikethrough forecolor backcolor | alignleft aligncenter alignright alignjustify  | numlist bullist outdent indent  | removeformat | link | image',
	  file_browser_callback: MyFileBrowser
	});
	function MyFileBrowser(field_name, url, type, win) {
	  var pathname = window.location.pathname;
	  var tmp      = window.location.href;
	  var url = tmp.replace(pathname,'');
	  tinyMCE.activeEditor.windowManager.open({
	      file : url + '/admin/sonata/media/media/list',
	      title : 'Gestionnaire de média',
	      width : 500,
	      height : 350,
	      resizable : "no",
	      inline : "yes",
	      close_previous : "no"
	  }, {
	      window : win,
	      input : field_name
	  });
	  return false;
	}
	// $("textarea").attr('required', 'required');
});

$(window).on('load', function(){
	$.instagramFeed({
		'username': 'the.ineluctable',
		'container': "#instagram-feed1",
		'display_profile': false,
		'display_biography': false,
		'display_gallery': true,
		'get_raw_json': false,
		'callback': null,
		'styling': true,
		'items': 12,
		'items_per_row': 4,
		'margin': 1 
	});
});
