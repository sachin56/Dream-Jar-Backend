<form method="POST" action="{{ route('city.change-status', $data->id) }}" class="d-inline" onsubmit="return confirmStatusChange(this)">
  @csrf
  @method('put')
  @if( $data->status == 'Y')
  <button type="submit" class="btn shadow-none btn-success btn-xs btn-icon rounded-circle waves-effect waves-themed">
      <i class="fal fa-check"></i>
  </button>
  @else
    <button type="submit" class="btn shadow-none btn-info btn-xs btn-icon rounded-circle waves-effect waves-themed">
      <i class="fal fa-backspace"></i>
  </button>
  @endif
</form>
