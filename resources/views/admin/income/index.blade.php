@extends('admin.layout.master')
@section('content')
   <div>
      <a href="{{ route('income.create') }}" class="btn btn-md btn-dark">
         <i class="fas fa-plus-circle"></i>
         Create Income
      </a>
      <a href="#" class="btn btn-md btn-outline-success">Today Income : {{ $todayIncome }} Ks</a>
   </div>
    <table class="table table-striped mt-3">
      <thead>
         <tr>
            <th>Title</th>
            <th>Amount</th>
            <th>Date</th>
            <th>Description</th>
            <th>Action</th>
         </tr>
      </thead>
      <tbody>
         @foreach ($incomes as $income)
            <tr>
               <td>{{ $income->title }}</td>
               <td>{{ $income->amount }}</td>
               <td>{{ $income->created_at }}</td>
               <td>{{ $income->description }}</td>
               <td>
                  <a href="{{route('income.edit',$income->id)}}" class="btn btn-md btn-primary">
                     <i class="fas fa-edit"></i>
                     Edit
                  </a>
                  <form action="{{route('income.destroy',$income->id)}}" class="d-inline" method="post">
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
    {{ $incomes->links() }}
@endsection