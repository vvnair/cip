$(document).ready(function(){
    $('.select_action').change(function(){

        var status = $(this).val();
        var id = $(this).attr("data-id");
        if(status == 'Proposal Accepted'){
            $('.file_upload'+id).show();
        }else{
            $('.file_upload'+id).hide();
        }
    });
});

$(document).ready(function(){
    $('.customer_table').DataTable();
});

$(document).ready(function(){
    $("#print").on("click", function(){
        swal({
          title: 'Are you sure?',
          text: "Download table in CSV!",
          type: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, Download!'
        }).then(function () {
          $('.customer_table').tableToCSV();
          swal(
            'Success!',
            'Your file has been downloaded.',
            'success'
          )
        });
    });
});


$(document).ready(function(){
    var name = $('#comp_name option:selected').text();
    $('#comp_text').html(name);
    $( "#comp_name" ).change(function() {
        var name = $('#comp_name option:selected').text();
        $('#comp_text').html(name);
    });
});
