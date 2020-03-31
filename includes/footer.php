                </div>
             </div>
           </div>
        </div>
    </div>

    <script
        src="https://code.jquery.com/jquery-3.3.1.js"
        integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
        crossorigin="anonymous">
    </script>

    <script>
        $(document).ready(function() {
            $('form').on('submit', function(event) {
                event.preventDefault();
                if ($('#file').val() !== '') {
                    var fd = new FormData($('form')[0]);
                    $.ajax({
                        xhr: function() {
                            var request = new window.XMLHttpRequest();
                            request.upload.addEventListener('progress', function(e) {
                                if (e.lengthComputable) {
                                    var percent = Math.round((e.loaded / e.total) * 100);
                                    $('.progress-bar').attr('aria-valuenow', percent).css('width', percent + '%')
                                    .text(percent + '%');
                                } 
                            });
                            return request;
                        },
                        type: 'POST',
                        url: '../public/upload.php',
                        data: fd,
                        processData: false,
                        contentType: false,
                        success: function(){
                            $('#file').val('');
                        }
                    });
                }
            });
        });
    </script>
</body>
</html>