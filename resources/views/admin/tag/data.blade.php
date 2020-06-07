<script type="text/javascript">
    $(function () {
          $.ajaxSetup({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
        });
  
        table = $('#tbl-tag').DataTable({
                  processing:true,
                  serverSide:true,
                  pageLength: 5,
                  paging: true,
                
                  ajax: '{!! route('tag.index') !!}',
                  columns: [
                        {data:'DT_RowIndex',orderable:false, searchable:false, width:'10px'}, 
                        { data: 'name' , name:'name'},
                        { data: 'created_at'},
                        { data: 'created_at'},
                        { data: 'action', width : '30px' }
                     ]
              }); 
      });
</script>