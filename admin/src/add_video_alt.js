 $(document).ready(function (e) {
        $("#form").on('submit',(function(e) {
            e.preventDefault();
            $.ajax({
                url: "src/add_video_model_alt.php",
                type: "POST",
                data:  new FormData(this),
                contentType: false,
                cache: false,
                processData:false,
                beforeSend : function()
                {
                 $("#uploadStatus").html('Please wait....');
                },
                success: function(data)
                   {
                        if(data=='invalid')
                        {
                         // invalid file format.
                         $("#uploadStatus").html("Invalid File !");
                        }
                        else
                        {
                         // view uploaded file.
                         $("#uploadStatus").html(data);
                         $("#form").hide();
                        }
                   },
                error: function(e)
                   {
                        $("#uploadStatus").html(e);
                   }
            });
        }));
    });