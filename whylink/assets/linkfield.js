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
              jQuery('.modal-body').html('');
              jQuery('#fileModal').modal('hide');
            }
          })
        }
      });
  });

  const types = ['menu','articles'];

  types.map(function(type) {
    jQuery('#' + type + 'Modal').on('show', function (e) {
      var link = jQuery('#' + type + 'Modal .modal-body').data('link');
      jQuery('#' + type + 'Modal .modal-body').html('');
      jQuery('#' + type + 'Modal .modal-body').html('<iframe id="' + type + 'Frame" src="' + link + '"></iframe>');
    })

    jQuery('#' + type + 'Modal').on('shown', function (e) {
      var iframe = jQuery('#' + type + 'Frame');
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
          jQuery('.modal-body').html('');
          jQuery('#' + type + 'Modal').modal('hide');
        }
      });

    })
  });

});
