
<!-- Modal -->
<div class="modal fade" id="delete{{ $payment->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    {{ __('delete client') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('payments.destroy', 'test') }}" method="post">
                {{ method_field('delete') }}
                {{ csrf_field() }}
                <div class="modal-body">
                   <h5> {{ __('are sure of the deleting employee ?') }}</h5>
                    <input type="hidden" name="id" value="{{ $payment->id }}">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Close') }}</button>
                    <button type="submit" class="btn btn-danger">{{ __('submit') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>
