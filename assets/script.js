function gotoSubpage(subpage){
  $('#page').attr('data-transitioning','out');
  window.history.pushState("","",updateURLParameter(window.location.href,'s',subpage));
  setTimeout(function(){
    $('#subpage-contain').load('subpages/'+subpage+'.php',function(){
      $('#page').data('subpage',subpage);
      $('#page').attr('data-subpage',subpage);

      if(subpage == 'welcome'){
        $('#subpage-contain').attr('data-width','unregulated');
      }else{
        $('#subpage-contain').attr('data-width','normal');
      }

      setTimeout(function(){
        $('#page').attr('data-transitioning','vis');
      },400);
    });
  },400);
}
function updateURLParameter(url, param, paramVal){
  var newAdditionalURL = "";
  var tempArray = url.split("?");
  var baseURL = tempArray[0];
  var additionalURL = tempArray[1];
  var temp = "";
  if (additionalURL) {
      tempArray = additionalURL.split("&");
      for (i=0; i<tempArray.length; i++){
          if(tempArray[i].split('=')[0] != param){
              newAdditionalURL += temp + tempArray[i];
              temp = "&";
          }
      }
  }

  var rows_txt = temp + "" + param + "=" + paramVal;
  return baseURL + "?" + newAdditionalURL + rows_txt;
}
function getPageParameters(){
  // Taken from "Ates Goral" on StackOverflow: http://stackoverflow.com/a/439578

  qs = document.location.search;

  qs = qs.split("+").join(" ");
  var params = {},
    tokens,
    re = /[?&]?([^=]+)=([^&]*)/g;

  while (tokens = re.exec(qs)){
    params[decodeURIComponent(tokens[1])]
      = decodeURIComponent(tokens[2]);
  }

  return params;
}
$(document).on('click','[data-goto-subpage]',function(){
  var subpage = $(this).data('goto-subpage');
  gotoSubpage(subpage);
});
$(document).ready(function(){
  if($_GET['s'] == '' || $_GET['s'] == undefined){
    gotoSubpage('welcome');
  }else{
    gotoSubpage($_GET['s']);
  }
});

$(document).on("click",".item-grid .item .thumbnail,.item-grid .item .mini-title,.item-grid .item .icon",function(){
  $(".item-grid .item").attr("data-clicked","false");
  $(this).closest(".item").attr("data-clicked","true");
});

$(document).on("click",".item-grid .item .meta-box .close-box",function(){
  $(".item-grid .item").attr("data-clicked","false");
});
