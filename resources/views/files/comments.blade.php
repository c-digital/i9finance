<!-- Modal -->
<div class="modal fade" id="{{ 'comments' . $file->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content" style="background-color: white !important">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">{{ __('Comments') }}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body p-4">
        @foreach($file->comments as $comment)
            <p><b>{{ $comment->user->name }} ({{ $comment->date }})</b>: {{ $comment->comment }}</p>
        @endforeach
      </div>
      <div class="modal-footer">
        <input type="text" class="form-control" name="comment">

        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Close') }}</button>
        <button type="button" class="btn btn-primary">{{ __('Send comment') }}</button>
      </div>
    </div>
  </div>
</div>
