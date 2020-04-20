@extends('admin.default')

@section('page-header')
   الطلبيات    تحت التوصيل   
@endsection
{{-- <small>{{ trans('app.manage') }}</small> --}}
@section('content')

<div class="mB-20">
    <a href="{{ route(ADMIN . '.orders.create') }}" class="btn btn-info">
   إضافة  جديد 
    </a>
  
    <a href="{{ route('/orders/delivered') }}" class="btn btn-success">
        الطلبات  الموصلة       
     </a>
  
    <a href="{{ route('/orders/inprogress') }}" class="btn btn-warning">
        الطلبات تحت التوصيل     
     </a>
</div>
 
 
    {{-- {{ trans('app.add_button') }} --}}
    <div class="bgc-white bd bdrs-3 p-20 mB-20">
        <table id="dataTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th> رقم الطلبية  </th>
                    <th>اسم الزبون</th>
                    <th> رقم الهاتف   </th>
                    <th> اسم العميل   </th>
                    <th> التكلفة     </th>
                    <th> اسم الكابتن     </th>
                    <th> التاريخ     </th>
                    <th>التحكم</th>
                </tr>
            </thead>
            
            <tfoot>
                <tr>
                    <th> رقم الطلبية  </th>
                    <th>اسم الزبون</th>
                    <th> رقم الهاتف   </th>
                    <th> اسم العميل   </th>
                    <th> التكلفة     </th>
                    <th> اسم الكابتن     </th>
                    <th> التاريخ     </th>
                    <th>التحكم</th>
                </tr>
            </tfoot>
            
            <tbody>
                @foreach ($items as $item)
                    <tr>
                        <td><a href="{{ route(ADMIN . '.orders.show', $item->id) }}">{{ $item->id  }}</a></td>
                        <td>{{ $item->Customer->User->name }}</td>
                        <td>{{ $item->Customer->User->phone }}</td>
                        <td>{{ $item->Client->User->name }}</td>
                        <td>{{ $item->cost }}</td>
                        <td>{{ $item->Driver->User->name }}</td>
                        <td>{{ $item->created_at }}</td>

                        <td>
                            <ul class="list-inline">
                                {{-- <li class="list-inline-item">
                                    <a href="{{ route(ADMIN . '.customers.edit', $item->id) }}" title="{{ trans('app.edit_title') }}" class="btn btn-primary btn-sm"><span class="ti-pencil"></span></a></li> --}}
                                <li class="list-inline-item">
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
                        </td>
                    </tr>
                @endforeach
            </tbody>
        
        </table>
    </div>

@endsection