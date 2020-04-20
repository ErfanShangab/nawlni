@extends('admin.default')

@section('page-header')
    إدارة المنتجات 
@endsection
{{-- <small>{{ trans('app.manage') }}</small> --}}
@section('content')

    <div class="mB-20">
        <a href="{{ route(ADMIN . '.products.create') }}" class="btn btn-info">
       إضافة  جديد 
        </a>
    </div>

    {{-- {{ trans('app.add_button') }} --}}
    <div class="bgc-white bd bdrs-3 p-20 mB-20">
        <table id="dataTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>اسم المنتج</th>
                    <th> صاحب المنتج</th>
                    <th>  التصنيف  </th>
                    <th>  مطروح كإعلان  </th>
                    <th>التحكم</th>
                </tr>
            </thead>
            
            <tfoot>
                <tr>
                    <th>اسم المنتج</th>
                    <th> صاحب المنتج</th>
                    <th>  التصنيف  </th>
                    <th>  مطروح كإعلان  </th>

                    <th>التحكم</th>
                </tr>
            </tfoot>
            
            <tbody>
                @foreach ($items as $item)
                    <tr>
                   
                        <td>{{ $item->name }}</a></td>

                        <td><a href="{{ route(ADMIN . '.clients.show', $item->Client->id) }}">{{ $item->Client->User->name}}</a></td>
                        <td>{{ $item->Category->name}}</td>
                        <td>
                            @if($item->is_advetise ==true)
                             اعلان   
                           @elseif($item->is_advetise ==false)
                            ليس اعلانا  
                           @endif
                           </td>


                        <td>
                            <ul class="list-inline">
                                <li class="list-inline-item">
                                    <a href="{{ route(ADMIN . '.products.edit', $item->id) }}" title="{{ trans('app.edit_title') }}" class="btn btn-primary btn-sm"><span class="ti-pencil"></span></a></li>
                                <li class="list-inline-item">
                                    {!! Form::open([
                                        'class'=>'delete',
                                        'url'  => route(ADMIN . '.products.destroy', $item->id), 
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