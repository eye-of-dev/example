$( document ).ready(function() {
    $('#form_submit input[type=button]').on('click', function(){
        
        var file = $('#fileName').val();
        //for chrome && opera
        var fakepath = file.search(/C:\\+fakepath\\/ig);
        if(fakepath == 0){
            file = file.replace(/C:\\+fakepath\\/, "") 
        }

        var search = file.search(/^.*\.(?:txt)\s*$/ig);
        
        if(search == 0){
            // prepare Options Object 
            var options = {
                url:        'engine/upload.php',
                beforeSubmit: function() {
                    $('#button_submit').hide();
                    $('#loader').show();
                },
                success:function(data) {
                    $('#loader').hide();
                    $('#button_submit').show();

                    $.ajax({
                        url: 'index.php?route=image/get_images',
                        success: function(data){
                            alert(data);
                        }
                    });

                }
            };

            // submit the form with options
            $('#form_submit').ajaxSubmit(options); 
            // return false to prevent normal browser submit and page navigation 

            return false; 
        }else{

            alert("Неправильный формат файла. Поле будет очищено");
            $('#form_submit input[type=file]').val('');

        }
    });
});