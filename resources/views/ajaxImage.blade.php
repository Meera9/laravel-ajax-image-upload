<!DOCTYPE html>
<html>
<head>
    <title>Laravel Ajax Image Upload - <a href="https://www.mtitsolutions.in/">MTitsolutions</a></title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
</head>
<body>

<div class="container">
    <div class="card">
        <div class="card-header">
            Laravel Ajax Image Upload - <a href="https://www.mtitsolutions.in/">MTitsolutions</a>
        </div>
        <div class="card-body">
            <div class="alert alert-success" style="display: none;">
              <strong>Success!</strong> <p></p>
            </div>
            <div class="alert alert-danger" style="display: none;">
              <strong>Error!</strong> <p></p>
            </div>
            <form action="{{ route('ajax_image') }}" method="POST" class="ajax_image_upload" enctype="multipart/form-data">
                @csrf
                <input type="file" name="ajax_images" class="form-control" required>
                <br>
                <button class="btn btn-primary">Upload File</button>
            </form>
        </div>
    </div>
</div>

<script type="text/jscript">
  $(document).ready(function(){
    $(document).on("submit", "form.ajax_image_upload" , function(e){
            e.preventDefault();
            var formData = new FormData(this);
            var url = $(this).attr('action');
            $.ajax({
                type: 'POST',
                url:url,
                data:formData,
                success: function (data) {
                  if(data.status == 1){
                    $('.alert-success p').text(data.msg);
                    $('.alert-success').show();
                    $('.alert-danger').hide();
                  }
                  else{
                    $('.alert-danger p').text(data.msg);
                    $('.alert-danger').show();
                    $('.alert-success').hide();
                  }
                },
                cache: false,
                contentType: false,
                processData: false
            });
        return false;
    });
  });
</script>
</body>
</html>
