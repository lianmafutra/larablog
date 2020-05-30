<div class="modal fade" id="{{ $id}}" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">{{ $title ?? null}}</h5>
      </div>
      <div class="modal-body">
        <form id="{{ $idForm}}" name="productForm" class="form-horizontal">
          <div class="content">
            {{ $content ?? null }}
          </div>
        </form>
        <div class="modal-footer">
          {{ $footer ?? null }}
        </div>
      </div>
    </div>
  </div>
</div>