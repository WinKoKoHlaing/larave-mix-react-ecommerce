@extends('admin.layout.master')
@section('content')
   <div>
      <a href="{{ route('outcome.create') }}" class="btn btn-md btn-dark">
         <i class="fas fa-plus-circle"></i>
         Create Outcome
      </a>
      <a href="#" class="btn btn-md btn-outline-danger">Today Outcome : {{ $todayOutcome }} Ks</a>
   </div>
    <table class="table table-striped mt-3">
      <thead>
         <tr>
            <th>Title</th>
            <th>Amount</th>
            <th>Description</th>
            <th>Action</th>
         </tr>
      </thead>
      <tbody>
         @foreach ($outcomes as $outcome)
            <tr>
               <td>{{ $outcome->title }}</td>
               <td>{{ $outcome->amount }}</td>
               <td>{{ $outcome->description }}</td>
               <td>
                  <a href="{{route('outcome.edit',$outcome->id)}}" class="btn btn-md btn-primary">
                     <i class="fas fa-edit"></i>
                     Edit
                  </a>
                  <form action="{{route('outcome.destroy',$outcome->id)}}" class="d-inline" method="post">
                     @csrf
                     @method('DELETE')
                     <button type="submit" class="btn btn-md btn-danger dele-confirm">
                        <i class="fas fa-trash"></i>
                        Delete
                     </button>
                  </form>
               </td>
            </tr>            
         @endforeach
      </tbody>
    </table>
    {{ $outcomes->links() }}
@endsection