jQuery( document ).ready(function() {

  // Files Modal

  jQuery('#fileModalBtn').on('click', function(){
    jQuery.ajax(
      {
        type: "POST",
        url: "index.php?option=com_ajax&group=fields&plugin=whylinkGetFiles&format=raw",
        success: function(data)
        {
          //var response = jQuery.parseJSON(data);
          var dataAttribute = jQuery('#fileModal .modal-body').data('fieldid');

          jQuery('#fileModal .modal-body').html(data);

          jQuery('.why-file-tree-label').on('click',function(){

            var filename = jQuery(this).data('filepath');
            console.log('file', dataAttribute)
            jQuery('#' + dataAttribute).val('');
            jQuery('#' + dataAttribute).val(filename);
            if(filename != '' && filename != undefined){
              jQuery('#fileModal').modal('hide');
            }
          })
        }
      });
  });

  // Articles Modal

  const types = ['menu','articles', 'contact'];

  function checkIframeLoaded(type) {
    // Get a handle to the iframe element
    var iframe = document.getElementById(type + 'Frame');
    if(iframe != null){
      var iframeDoc = iframe.contentDocument || iframe.contentWindow.document;

      // Check if loading is complete
      if (  iframeDoc.readyState  == 'complete' ) {
        //iframe.contentWindow.alert("Hello");
        iframe.contentWindow.onload = function(){
          alert("I am loaded");
        };
        // The loading is complete, call the function we want executed once the iframe is loaded
        var afterload = afterLoading();
        if(afterload){
          return true;
        }
        else{
          return false;
        }
    }

    }

    // If we are here, it is not loaded. Set things up so we check   the status again in 100 milliseconds
    window.setTimeout(checkIframeLoaded, 100);
  }

  function afterLoading(){
    return true;
  }

  types.map(function(type) {

    jQuery('#' + type + 'Modal').on('shown', function (e) {
      var iframe = jQuery('#' + type + 'Frame');
      var iframeLoaded = checkIframeLoaded(type);
      console.log(iframeLoaded);
      if(iframeLoaded){
          console.log('loaded', type + 'loaded');
          console.log('links', jQuery(iframe).contents().find('.select-link'));
          jQuery(iframe).contents().find('.select-link').removeAttr('href');
          jQuery(iframe).contents().find('.select-link').css('pointer-events', 'none');
          jQuery(iframe).contents().find('form').removeAttr('action');

          var dataAttribute = jQuery('#' + type + 'Modal .modal-body').data('fieldid');
          var tableRow =  jQuery(iframe).contents().find('tr');

          jQuery(iframe).contents().find('tr').click(function(){
            console.log(this);
            var id = jQuery(this).find('.select-link').data('id');
            var uri = jQuery(this).find('.select-link').data('uri');
            console.log(uri);
            jQuery('#' + dataAttribute).val('');
            jQuery('#' + dataAttribute).val(uri);
            if(uri != '' && uri != undefined){
              //jQuery('.modal-body').html('');
              jQuery('#' + type + 'Modal').modal('hide');
            }
          });
      }
    })
  });

});
