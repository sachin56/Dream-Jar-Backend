<form method="POST" action="{{ route('category.delete', $data->id) }}" class="d-inline"
    onsubmit="return submitDeleteForm(this)">
  @csrf
  @method('delete')
 <button type="submit"
      class="btn shadow-none btn-danger btn-xs btn-icon rounded-circle waves-effect waves-themed">
  <i class="fal fa-trash-alt"></i>
  </button>
</form>

