<script type="text/javascript">
    $(function () {
          $.ajaxSetup({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
        });
  
        table = $('#tbl-users').DataTable({
            
                  processing:true,
                  serverSide:true,
                  pageLength: 5,
                  paging: true,
                  ajax: '{!! route('user.index') !!}',
                  columns: [
                        {data:'DT_RowIndex',orderable:false, searchable:false, width:'10px'}, 
                        { data: 'name' },
                        { data: 'email', name:'category'},
                        { data: 'name' },
                        { data: 'name' },
                        { data: 'name' },
                        { data: 'name' },
                        { data: 'name' },
                        { data: 'created_at' },
                        { data: 'action', width : '30px' }
                  ]  
              }); 
      });



</script>