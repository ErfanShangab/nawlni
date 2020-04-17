@extends('admin.default')

@section('page-header')
  الكابتن :   {{$item->User->name}}
@endsection
{{-- <small>{{ trans('app.manage') }}</small> --}}
@section('content')

  
    {{-- {{ trans('app.add_button') }} --}}
    <div class="bgc-white bd bdrs-3 p-20 mB-20">
        <table id="dataTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
          
            
            <tbody>
                <tr>
                    <th>الصورة الشخصية</th>
                    <th>البريد الإلكتروني</th>
                    <th> رقم الهاتف   </th>
                    <th> رقم اللوحة   </th>
                    <th> النشاط     </th>
                    <th>التحكم</th>
                </tr>
                    <tr>
                        <th class="text-center">    
    
                            <img src="{{ asset( $item->User->avatar) }}" height="150px" width="150px" style=" border: 1px solid #ddd;
                            border-radius: 4px;
                            margin: 2%;
                            width: 150px;">
                    </th>
                        <td>{{ $item->User->email }}</td>
                        <td>{{ $item->User->phone }}</td>
                        <td>{{ $item->vehicle_id }}</td>
                        <td> 

                        @if($item->is_available ==0)
                        تحت الخدمة   
                       @elseif($item->is_available ==1)
                       خارج  الخدمة
                       @endif</td>
                        <td>
                            <ul class="list-inline">
                                <li class="list-inline-item">
                                    <a href="{{ route(ADMIN . '.drivers.edit', $item->id) }}" title="{{ trans('app.edit_title') }}" class="btn btn-primary btn-sm"><span class="ti-pencil"></span></a></li> 
                                <li class="list-inline-item">
                                    {!! Form::open([
                                        'class'=>'delete',
                                        'url'  => route(ADMIN . '.drivers.destroy', $item->id), 
                                        'method' => 'DELETE',
                                        ]) 
                                    !!}

                                        <button class="btn btn-danger btn-sm" title="{{ trans('app.delete_title') }}"><i class="ti-trash"></i></button>
                                        
                                    {!! Form::close() !!}
                                </li>
                            </ul>
                        </td>
                    </tr>
            </tbody>
        
        </table>
    </div>
   

@if($items->count())
    <div class="bgc-white bd bdrs-3 p-20 mB-20">
        <table id="dataTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th> رقم الطلبية  </th>
                    <th>اسم الزبون</th>
                    <th> رقم الهاتف   </th>
                    <th> اسم العميل   </th>
                    <th> التكلفة     </th>
                    <th> الحالة     </th>
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
                    <th> الحالة     </th>
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
                        <td>
                            
                            @if($item->status ==0)
                             جاري التوصيل 
                            @elseif($item->status ==1)
                            تم التسليم
                            @endif
                       </td>
                       
                       </td>
                        <td>{{ $item->created_at }}</td>

                        <td>
                            <ul class="list-inline">
                                 <li class="list-inline-item">
                                    {{-- <a href="{{ route(ADMIN . '.customers.edit', $item->id) }}" title="{{ trans('app.edit_title') }}" class="btn btn-primary btn-sm"><span class="ti-pencil"></span></a></li> --}} --}}
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

    @else
      <p class="text-center">
                       
    لايوجد طلبيات لهذا الكابتن ...
      </p>
    @endif
@endsection