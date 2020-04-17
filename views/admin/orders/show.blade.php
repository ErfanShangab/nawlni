@extends('admin.default')

@section('page-header')
   طلبية رقم :  {{$item->id}}

   {{-- <ul class="list-inline">
                                {{-- <li class="list-inline-item">
                                    <a href="{{ route(ADMIN . '.customers.edit', $item->id) }}" title="{{ trans('app.edit_title') }}" class="btn btn-primary btn-sm"><span class="ti-pencil"></span></a></li> --}}
                                <li class="list-inline-item" style='float:left'>
                                    {!! Form::open([
                                        'class'=>'delete',
                                        'url'  => route(ADMIN . '.orders.destroy', $item->id), 
                                        'method' => 'DELETE',
                                        ]) 
                                    !!}

                                        <button class="btn btn-danger btn-sm" title="{{ trans('app.delete_title') }}"><i class="ti-trash"></i></button>
                                        
                                    {!! Form::close() !!}
                                </li>
                            </ul> 
@endsection
{{-- <small>{{ trans('app.manage') }}</small> --}}
@section('content')


    {{-- {{ trans('app.add_button') }} --}}
    <div class="bgc-white bd bdrs-3 p-20 mB-20">
        <table id="dataTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <tbody>

                <tr>
                    <th> رقم الطلبية  </th>
                    <td><a href="{{ route(ADMIN . '.orders.show', $item->id) }}">{{ $item->id  }}</a></td>
                    <th>اسم الزبون</th>
                    <td>{{ $item->Customer->User->name }}</td>
                    <th> رقم الهاتف   </th>
                    <td>{{ $item->Customer->User->phone }}</td>
                </tr>
                <tr>
                    <th> اسم العميل   </th>
                    <td>{{ $item->Client->User->name }}</td>
                    <th> نوع العميل     </th>
                    <td>{{ $item->type }}</td>
                    <th> التكلفة     </th>
                    <td>{{ $item->cost }}</td>

                </tr>
                <tr>
                    <th> اسم الكابتن     </th>
                    <td>{{ $item->Driver->User->name }}</td>
                    <th> رقم هاتف الكابتن     </th>
                    <td>{{ $item->Driver->User->phone }}</td>
                    <th> الحالة     </th>
                    <td>{{ $item->status }}</td>
                
                </tr>
                <tr>
                
                <th> التاريخ     </th>
                <td>{{ $item->created_at }}</td>
                <th>  الطلبية  </th>
                <td>{{ $item->order }}</td>
                <tr>
              
                   
                   
                </tr>
                    
            </tbody>
           
           
        
        </table>
    </div>

@endsection