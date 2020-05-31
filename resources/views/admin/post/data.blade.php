<script type="text/javascript">
    $(function () {
          $.ajaxSetup({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
        });
  
        table = $('#tbl-posts').DataTable({
                  processing:true,
                  serverSide:true,
                  pageLength: 5,
                  paging: true,
                  ajax: '{!! route('post.index') !!}',
                  columns: [
                        {data:'DT_RowIndex',orderable:false, searchable:false, width:'10px'}, 
                        { data: 'title' },
                        { data: 'category.name'},
                        { data: 'thumbnail' },
                        { data: 'komentar' },
                        { data: 'created_at' },
                        { data: 'action', width : '30px' }
                     ]
              }); 
      });
</script>