@extends('admin.default')

@section('page-header')
    إدارة الكباتن 
@endsection
{{-- <small>{{ trans('app.manage') }}</small> --}}
@section('content')

    <div class="mB-20">
        <a href="{{ route(ADMIN . '.drivers.create') }}" class="btn btn-info">
       إضافة  جديد 
        </a>

        <a href="{{ route('/drivers/active') }}" class="btn btn-success">
            الكباتن النشطين 
         </a>
    </div>

    {{-- {{ trans('app.add_button') }} --}}
    <div class="bgc-white bd bdrs-3 p-20 mB-20">
        <table id="dataTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>الإسم</th>
                    <th>البريد الإلكتروني</th>
                    <th> رقم الهاتف   </th>
                    <th>    النشاط   </th>
                    <th>التحكم</th>
                </tr>
            </thead>
            
            <tfoot>
                <tr>
                    <th>الإسم</th>
                    <th>البريد الإلكتروني</th>
                    <th> رقم الهاتف   </th>
                    <th>    النشاط   </th>
                    <th>التحكم</th>
                </tr>
            </tfoot>
            
            <tbody>
                @foreach ($items as $item)
                    <tr>
                        <td><a href="{{ route(ADMIN . '.drivers.show', $item->id) }}">{{ $item->User->name  }}</a></td>
                        <td>{{ $item->User->email }}</td>
                        <td>{{ $item->User->phone }}</td>
                        <td>
                            @if($item->is_available ==1)
                              نشط   
                           @elseif($item->is_available ==0)
                            غير نشط
                           @endif
                           </td>

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
                @endforeach
            </tbody>
        
        </table>
    </div>

@endsection