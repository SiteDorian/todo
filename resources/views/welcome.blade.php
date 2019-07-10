@extends("layouts.app")
@section("content")
    
        @if(session()->has('message'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Done !!! </strong>{{ session()->get('message') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif
        
        <div class="row">
                <div class="col-10 pt-4">
                        <h1>Todo List</h1>
            
                        <form method="POST" enctype="multipart/form-data" action={{url('/task')}}>
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
                                <label for="url" class="col-md-6 col-form-label">Add an Image to Task</label>
                                <input type="file" class="form-control-file" id="url" name="url">
            
                                @if ($errors->has('url'))
                                   <strong>
                                        {{ $errors->first('url')}}
                                   </strong>
                                @endif
                            </div>
            
                            <div class="form-group">
                                <button type="submit" class="btn btn-success">Add New Task</button>
                            </div>
                        </form>
            
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Task</th>
                                    <th>Tags</th>
                                    <th>Created at</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($tasks as $task)
                                    <tr>
                                    <td> <img src="/storage/{{$task->url ? $task->url : 'uploads/no_image.png'}}" alt="Not found" height="40px"> {{$task->name}} </td>
                                        <td> 
                                            {{-- <span class="badge badge-secondary">New</span>  --}}
                                            @if($task->taskTags->count())
                                                @foreach($task->taskTags as $tag)
                                                    <span class="badge badge-secondary">{{$tag->tag->name }}</span> 
                                                @endforeach
                                            @endif
                                        </td>
                                        <td> {{$task->created_at}} </td>
                                        <td>
                                            <a href="{{url('/task/'.$task->id.'/edit')}}" class="btn btn-light">
                                                Edit
                                            </a>
                                            <a href="{{url('/task/'.$task->id.'/delete')}}" class="btn btn-danger">
                                                Delete
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                     
                    </div>
            
                    <div class="col-2 pt-3 border" style="margin-top: 260px;">
                            
                            <p><b>Filter by: </b></p>
                            <form method="GET" action={{url('/')}}>
                                
                                <div class="form-group">
                                    <label for="start">Start date:</label>
                                    <input type="date" id="start" name="trip-start"
                                            value="{{request('trip-start') ?? '2019-07-01'}}"
                                            min="2018-01-01" max="2019-12-31">

                                    <label for="end">End date:</label>
                                    <input type="date" id="end" name="trip-end"
                                            value="{{request('trip-end') ?? '2019-12-31'}}"
                                            min="2018-01-01" max="2019-12-31">
                                </div>
                                <div class="form-group">
                                    <select class="form-control" 
                                            id="tag" 
                                            name="tag">
        
                                        <option selected="true" disabled="disabled">Choose Tag</option>
                                    
        
                                        @foreach($tags as $tag)
                                            <option value="{{$tag->id}}" @if(request('tag')==$tag->id) selected="selected" @endif>
                                                {{$tag->name}}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>   
                                <div class="form-group">
                                    <button type="submit" class="btn btn-secondary">Filter</button>
                                </div>
                            </form>
                    </div>
        </div>
    
@endsection