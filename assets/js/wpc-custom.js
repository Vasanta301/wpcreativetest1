(function () {
'use strict';
               
  document.addEventListener('DOMContentLoaded', documentIsready);
  function documentIsready() {
    wpc_lazyload_images();
    document.addEventListener('scroll', wpc_lazyload_images);
    window.addEventListener('resize', wpc_lazyload_images);
    window.addEventListener('orientationChange', wpc_lazyload_images);
  }

  function wpc_lazyload_images() {
    let images = document.querySelectorAll('img[data-src]');
    for( let i of images ) {
      if( i.getAttribute('src') ) { 
        continue;
    }
      let bounding = i.getBoundingClientRect();
      let isOnView = 
      bounding.top <= (window.innerHeight || document.documentElement.clientHeight);
      
      if( isOnView ) {
        i.setAttribute( 'src', i.dataset.src );
        if( i.getAttribute('data-srcset') ) {
          i.setAttribute( 'srcset', i.dataset.srcset );
        }
      }
    }
  }
  
  jQuery(document).on('click', '.wpc-filter-apply', function(e) {
    jQuery('.filerForm').submit();
  });

  jQuery(document).on('submit', '.filerForm', function(e) {
    e.preventDefault();
    var container = jQuery('.outer-container');
    container.text('');
    jQuery('.loader').removeClass('hidden');
    let data = jQuery(this).serialize();
    jQuery.ajax({
        type: 'POST',
        url: wpcAjaxObject.ajaxurl,
        data: {
            'action': 'wpc_filter',
            data: data,
            security: wpcAjaxObject.ajaxnonce
        },
        beforeSend: function () {
          jQuery('.loader').show();
        },
        success: function (response) {
            let obj = jQuery.parseJSON(response);
            container.append(obj.content);
            /** Because lazy load need to run for filtered ajax content */
            wpc_lazyload_images();
            document.addEventListener('scroll', wpc_lazyload_images);
        },
        complete: function() {
          jQuery('.loader').hide();
      },
    });
});
              
})();