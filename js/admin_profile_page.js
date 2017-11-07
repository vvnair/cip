$(document).ready(function(){
    $('.status_select').change(function(){

        var status = $(this).val();
        var id = $(this).attr("data-id");
        if(status == 'feasible'){
            $('.file_upload'+id).show();
        }else{
            $('.file_upload'+id).hide();
        }
    });
});

$(document).ready(function(){
    $('.admin_table').DataTable();
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
              $('.admin_table').tableToCSV();
              swal(
                'Success!',
                'Your file has been downloaded.',
                'success'
              )
            });

        });
    });
