@extends('admin.default')

@section('page-header')
    العميل : {{$item->User->name}}
@endsection
{{-- <small>{{ trans('app.manage') }}</small> --}}
@section('content')

  

    {{-- {{ trans('app.add_button') }} --}}
    <div class="bgc-white bd bdrs-3 p-20 mB-20">
        <table id="dataTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                <tr>
                    <th>الإسم</th>
                    <th>البريد الإلكتروني</th>
                    <th> رقم الهاتف   </th>
                    <th> النوع     </th>
                    <th>التحكم</th>
                </tr>
            
         
            
            <tbody>
               
                        <td> {{ $item->User->name  }} </td>
                        <td>{{ $item->User->email }}</td>
                        <td>{{ $item->User->phone }}</td>
                        <td>
                            @if($item->type =="pharmacy")
                            صيدلية   
                           @elseif($item->type =="resturant")
                            مطعم  
                           @elseif($item->type =="merchant")
                           تاجر  
                           @endif
                           </td>

                        <td>
                            <ul class="list-inline">
                               <li class="list-inline-item">
                                    <a href="{{ route(ADMIN . '.clients.edit', $item->id) }}" title="{{ trans('app.edit_title') }}" class="btn btn-primary btn-sm"><span class="ti-pencil"></span></a></li> 
                                <li class="list-inline-item">
                                    {!! Form::open([
                                        'class'=>'delete',
                                        'url'  => route(ADMIN . '.clients.destroy', $item->id), 
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
                    <th>اسم الكابتن</th>
                    <th> رقم الهاتف   </th>
                    <th> اسم الزبون   </th>
                    <th> التكلفة     </th>
                    <th> الحالة     </th>
                    <th> التاريخ     </th>
                    <th>التحكم</th>
                </tr>
            </thead>
            
            <tfoot>
                <tr>
                    <th> رقم الطلبية  </th>
                    <th>اسم الكابتن</th>
                    <th> رقم الهاتف   </th>
                    <th> اسم الزبون   </th>
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
                        <td>{{ $item->Driver->User->name }}</td>
                        <td>{{ $item->Driver->User->phone }}</td>
                        <td>{{ $item->Customer->User->name }}</td>
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
                                    {{-- <a href="{{ route(ADMIN . '.customers.edit', $item->id) }}" title="{{ trans('app.edit_title') }}" class="btn btn-primary btn-sm"><span class="ti-pencil"></span></a></li> --}} 
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
                       
    لايوجد طلبيات لهذا الزبون ...
      </p>
    @endif
@endsection