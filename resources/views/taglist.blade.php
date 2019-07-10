@extends("layouts.app")
@section("content")
    <div class="container">
        @if(session()->has('message'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Done !!! </strong>{{ session()->get('message') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif
        
        <div class="col-md-8 pt-4">
            <h1 class="pb-4">Tag List</h1>

            <form method="POST" action={{url('/tag')}}>
                {{csrf_field()}}
                <div class="form-group">
                    <input type="text" 
                           class="form-control {{ $errors->has('name') ? ' is-invalid' : ''}}" 
                           id="name" 
                           name="name" 
                           value=" {{old('name')}} "
                           autocomplete="name" autofocus>

                    @if ($errors->has('name'))
                        <span class="invalid-feedback" role="alert">
                            <strong> error:  {{ $errors->first('name')}} </strong>
                        </span>
                    @endif
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-success">Add New Tag</button>
                </div>
            </form>

            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID.</th>
                        <th>Tag</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tags as $tag)
                        <tr>
                            <td> {{$tag->id}} </td>
                            <td> 
                                <span class="badge badge-secondary">{{$tag->name }}</span> 
                            </td>
                            <td>
                                <a href="{{url('/tag/'.$tag->id.'/edit')}}" class="btn btn-light">
                                    Edit
                                </a>
                                <a href="{{url('/tag/'.$tag->id.'/delete')}}" class="btn btn-danger">
                                    Delete
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            
        </div>
    </div>
@endsection