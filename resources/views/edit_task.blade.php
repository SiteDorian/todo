@extends("layouts.app")
@section("content")
    {{-- <div class="container"> --}}
            @if(session()->has('message'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong> </strong>{{ session()->get('message') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif

            <form method="POST" enctype="multipart/form-data" action="/task/{{$task->id}} ">
                {{csrf_field()}}
                @method('PATCH')

                <div class="row">
                    <div class="col-8 offset-2">
                        <div class="row">
                            <h1>Edit Task</h1>
                        </div>

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label">Name</label>
                            <input type="text" 
                                    class="form-control {{ $errors->has('name') ? ' is-invalid' : ''}}" 
                                    id="name" 
                                    name="name" 
                                    value=" {{old('name') ?? $task->name}} "
                                    autocomplete="name" autofocus>
        
                            @if ($errors->has('name'))
                                <span class="invalid-feedback" role="alert">
                                    <strong> error:  {{ $errors->first('name')}} </strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group row">
                                <label for="url" class="col-md-6 col-form-label">Change Task Image</label>
                                <input type="file" class="form-control-file" id="url" name="url">
            
                                @if ($errors->has('url'))
                                   <strong>
                                        {{ $errors->first('url')}}
                                   </strong>
                                @endif
                        </div>

                        <div class="row">
                            <label for="tags" class="col-md-6">Tags</label>
                            
                        </div>

                        <div class="row pb-4">
                            @foreach($task->taskTags as $tag)
                                <h3>
                                    <span class="badge badge-secondary m-1">
                                        {{ $tag->tag->name }}
                                        <button type="button" 
                                                class="close pl-2" 
                                                aria-label="Close" 
                                                onclick="window.location='{{url('/task/'.$task->id .'/tag/'.$tag->tag->id.'/delete')}}';">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                     </span> 
                                </h3>
                            @endforeach
                   
                        </div>

                        <div class="row">
                            <label for="add_tag" class="col-md-6">Add Tag</label>
                        </div>

                        

                        <div class="form-group row">
                            <select class="form-control" 
                                    id="add_tag" 
                                    name="add_tag" 
                                    onchange="window.location='{{url('/task/'.$task->id.'/tag')}}'+'/'+this.value;" >

                                <option selected="true" disabled="disabled">Choose Tag</option>  

                                @foreach($tags as $tag)
                                    <option value="{{$tag->id}}">{{$tag->name}}</option>
                                @endforeach
                            </select>
                        </div>
        
                        <div class="form-group row pt-4">
                            <button type="submit" class="btn btn-success">Save Task</button>
                        </div>
                    </div>
    
                </div>

                
            </form>

    {{-- </div> --}}
@endsection