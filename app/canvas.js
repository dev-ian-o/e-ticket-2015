var filesToUpload = null;

function handleFileSelect(event)
{
    var files = event.target.files || event.originalEvent.dataTransfer.files;
    // Itterate thru files (here I user Underscore.js function to do so).
    // Simply user 'for loop'.
    _.each(files, function(file) {
        filesToUpload.push(file);
    });
}

/**
 * Form submit
 */
function handleFormSubmit(event)
{
    event.preventDefault();

    var form = this,
        formData = new FormData(form);  // This will take all the data from current form and turn then into FormData

    // Prevent multiple submisions
    if ($(form).data('loading') === true) {
        return;
    }
    $(form).data('loading', true);

    // Add selected files to FormData which will be sent
    if (filesToUpload) {
        _.each(filesToUpload, function(file){
            formData.append('cover[]', file);
        });        
    }

    $.ajax({
        type: "POST",
        url: 'url/to/controller/action',
        data: formData,
        processData: false,
        contentType: false,
        success: function(response)
        {
            // handle response
        },
        complete: function()
        {
            // Allow form to be submited again
            $(form).data('loading', false);
        },
        dataType: 'json'
    });
}

/**
 * Register events
 */
$('#file-input').on('change', handleFileSelect);
$('#imgLoader').on('change', function(event){
    var file = event.target.files || event.originalEvent.dataTransfer.files;
     formData = new FormData(form); 
    formData.append('cover[]', file);
     $.ajax({
        type: "POST",
        url: '/upload/photos',
        data: formData,
        processData: false,
        contentType: false,
        success: function(response)
        {
            // handle response
            console.log(response);
        },
        complete: function()
        {
            // Allow form to be submited again
            
        },
        dataType: 'json'
    });
});
