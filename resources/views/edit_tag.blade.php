@extends("layouts.app")
@section("content")
    <div class="container">
        
        <form method="POST" action="/tag/{{ $tag->id }}">
            {{csrf_field()}}
            @method('PATCH')

            <div class="row">
                <div class="col-8 offset-2">
                    <div class="row">
                        <h1>Edit Tag Name</h1>
                    </div>
                    <div class="form-group row">
                        <label for="name" class="col-md-4 col-form-label">Name</label>
                        <input type="text" 
                                class="form-control {{ $errors->has('name') ? ' is-invalid' : ''}}" 
                                id="name" 
                                name="name" 
                                value=" {{old('name') ?? $tag->name}} "
                                autocomplete="name" autofocus>
    
                        @if ($errors->has('name'))
                            <span class="invalid-feedback" role="alert">
                                <strong> error:  {{ $errors->first('name')}} </strong>
                            </span>
                        @endif
                    </div>
    
                    <div class="form-group row">
                        <button type="submit" class="btn btn-success">Save</button>
                    </div>
                </div>

            </div>
        </form>
 
    </div>
@endsection