  jQuery.ajax({
    type: 'GET',
    url: 'https://script.google.com/macros/s/AKfycbwUJRQF4zC0HQF5L2HauF1wh_Jn4SJtagdt3mqGRjLWg6fmq28/exec',
    success: function(res) {
      console.log(res);
      eventsTemplateHTML = $.trim($('.events-template').html());
      $.each(res, function(index, obj) {
        var x = eventsTemplateHTML
          .replace(/etr/ig, 'tr')
          .replace(/eth/ig, 'th')
          .replace(/etd/ig, 'td')
          .replace(/{{id}}/ig, (index+1))
          .replace(/{{eventName}}/ig, obj.eventName)
          .replace(/{{date}}/ig, obj.date)
        $('.events').append(x);
      });
    },
    error: function(xhr, ajaxOptions, thrownError) {
      console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
    }
  });
