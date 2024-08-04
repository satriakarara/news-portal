jQuery(document).ready(function ($) {
  $("#trigger-sindonews").click(function () {
    $.ajax({
      url: ajax_object.ajax_url,
      type: "GET",
      data: {
        action: "handle_request",
        // Add any additional data you want to send to the server here
      },
      success: function (response) {
        alert("Action triggered successfully!");
      },
      error: function (response) {
        // Handle any errors
        alert("There was an error.");
      },
    });
  });
});
