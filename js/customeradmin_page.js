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
          $('#customeradmintable').tableToCSV();
          swal(
            'Success!',
            'Your file has been downloaded.',
            'success'
          )
        });

    });
});
$(document).ready(function(){
    $('#customeradmintable').DataTable();
});
