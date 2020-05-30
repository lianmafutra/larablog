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
                        { data: 'name', name: 'name' },
                        { data: 'id', name: 'id' },
                        { data: 'created_at', name: 'created_at' },
                        { data: 'action', name: 'action', width : '30px' }
                     ]
              }); 
      });
</script>