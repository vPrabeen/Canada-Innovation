/**handles:post_grid_scripts**/
jQuery(document).ready(function(t){t(window).resize(function(){}),t(document).on("keyup",".post-grid .nav-search .search",function(){var a=t(this).val(),i=t(this).attr("grid_id");a.length>3&&(t(this).addClass("loading"),t(".pagination").fadeOut(),t.ajax({type:"POST",context:this,url:post_grid_ajax.post_grid_ajaxurl,data:{action:"post_grid_ajax_search",grid_id:i,keyword:a},success:function(a){t(".post-grid .grid-items").html(a),t(this).removeClass("loading")}}))}),t(document).on("click",".post-grid .nav-filter .filter",function(){t(".post-grid .nav-filter .filter").removeClass("active"),t(this).hasClass("active")||t(this).addClass("active")}),t(document).on("click",".post-grid .load-more",function(){var a=parseInt(t(this).attr("paged")),i=parseInt(t(this).attr("per_page")),s=parseInt(t(this).attr("grid_id")),r=t("#post-grid-"+s+" .nav-filter .filter.active").attr("terms-id");null!=r&&""!=r||(r=""),t(this).addClass("loading"),t.ajax({type:"POST",context:this,url:post_grid_ajax.post_grid_ajaxurl,data:{action:"post_grid_ajax_load_more",grid_id:s,per_page:i,paged:a,terms:r},success:function(i){var r=t("#post-grid-"+s+" .grid-items").masonry({});r.append(i).masonry("appended",i,!0),r.masonry("reloadItems"),r.masonry("layout"),r.masonry("destroy"),t("#post-grid-"+s+" .grid-items").masonry({}),t(this).attr("paged",a+1),t(this).hasClass("loading")&&t(this).removeClass("loading")}})})});