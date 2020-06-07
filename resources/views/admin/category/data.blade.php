<script type="text/javascript">
    $(function () {
          $.ajaxSetup({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
        });
  
        table = $('#tbl-category').DataTable({
                  processing:true,
                  serverSide:true,
                  pageLength: 5,
                  paging: true,
                
                  ajax: '{!! route('category.index') !!}',
                  columns: [
                        {data:'DT_RowIndex',orderable:false, searchable:false, width:'10px'}, 
                        { data: 'name' , name:'name'},
                        { data: 'slug' },
                        { data: 'post',   width : '80px' },
                        { data: 'created_at'},
                        { data: 'action', width : '30px' }
                     ],
                     columnDefs: [{
                            // fungsi untuk merender / mengolah value sebelum ditampilak di datatable
                            "render": function ( data, type, row ) {
                            size = Object.keys(data).length; //hitung data dari kolom post tipe object
                            return size; // mengambalikan data yang sudah dihitung untuk ditampilkan ke datatable
                        },
                        className: 'text-center',
                        "targets": 3 // select kolom post  
                    }],
              }); 
      });
</script>