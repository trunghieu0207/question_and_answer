<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
 <script>
        $('#fuMain').fileinput({
            theme: 'fa',
            allowedFileExtensions: ['png', 'jpg'],
            //uploadUrl: '/upload_article_poster',
            uploadAsync: false,
            showUpload: false,
            maxFileSize: 1024,
            removeClass: 'btn btn-warning'
        });
    </script>