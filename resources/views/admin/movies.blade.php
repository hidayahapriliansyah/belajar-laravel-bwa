@extends('admin.layouts.base')

@section('title', 'Movies')

@section('content')
  @if(session()->has('success'))
  <div class="class-alert alert-success">
    {{ session('success') }}
  </div>
  @endif
  <div class="row">
    <div class="col-md-12">
      <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title">Movies</h3>
        </div>

        <div class="card-body">
          <div class="row">
            <div class="col-md-12">
              <a href="{{ route('admin.movie.create') }}" class="btn btn-warning">Create Movie</a>
            </div>
          </div>

          <div class="row">
            <div class="col-md-12">
              <table id="movies" class="table table-bordered table-hover">
                <thead>
                  <tr>
                    <th>Id</th>
                    <th>Title</th>
                    <th>Thumbnail</th>
                    <th>Big Thumbnail</th>
                    <th>Categories</th>
                    <th>Casts</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                      @foreach ($movies as $movie)
                      <td></td>
                      <td>{{ $movie->title }}</td>
                      <td>
                        <img src="{{ asset('storage/thumbnail/'.$movie->small_thumbnail) }}" alt="{{ $movie->small_thumbnail }}" width="90%">
                      </td>
                      <td>
                        <img src="{{ asset('storage/thumbnail/'.$movie->large_thumbnail) }}" alt="{{ $movie->large_thumbnail }}" width="90%">
                      </td>
                      <td>{{ $movie->categories }}</td>
                      <td>{{ $movie->casts }}</td>
                      <td>
                        <a href="{{ route('admin.movie.edit', $movie->id) }}" class="btn btn-secondary">
                          <i class="fas fa-edit"></i>
                        </a>
                        <form method="post" action="{{ route('admin.movie.destroy', $movie->id) }}" class="mt-2">
                          @csrf
                          @method('DELETE')
                          <button type="submit" class="btn btn-danger">
                            <i class="fas fa-trash-alt"></i>
                          </button>
                        </form>
                      </td>
                      @endforeach
                    </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('js')
<script>
  $('#movies').dataTable();
</script>
@endsection