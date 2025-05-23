@if (auth()->user()?->is_admin)
  <form
    action="{{ route('cats.destroy', $cat->id) }}"
    method="POST"
    onsubmit="return confirm('Are you sure you want to delete this cat?');"
  >
    @method('DELETE')
    @csrf

    <x-button type="submit" variant="danger" value="Delete" />
  </form>
  <a
    href="{{ route('cats.edit', $cat->id) }}"
    class="p-2 px-5 bg-sky-600 hover:bg-sky-700 transition-colors rounded-sm font-medium">
    Edit
  </a>
@elseif (auth()->user()?->checkAdoptionRequest($cat))
  <form action="{{ route('adoption-requests.cancel', $cat->id) }}" method="POST">
    @csrf
    <x-button type="submit" variant="danger" value="Cancel Request" />
  </form>
@else
  <form action="{{ route('adoption-requests.store', $cat->id) }}" method="POST">
    @csrf
    <x-button type="submit" variant="primary" value="Request Adoption" />
  </form>
@endif
