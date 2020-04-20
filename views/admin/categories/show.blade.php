@extends('admin.default')

@section('page-header')
    التصنيف : {{$item->name}}
@endsection
{{-- <small>{{ trans('app.manage') }}</small> --}}
@section('content')

@if($items->count())
  
<div class="bgc-white bd bdrs-3 p-20 mB-20">
    <table id="dataTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>الإسم</th>
                <th>التحكم</th>
            </tr>
        </thead>
        
        <tfoot>
            <tr>
                <th>الإسم</th>
                <th>التحكم</th>
            </tr>
        </tfoot>
        
        <tbody>
            @foreach ($items as $item)
                <tr>
                    <td><a href="{{ route(ADMIN . '.categories.show', $item->id) }}">{{ $item->name }}</a></td>

                    <td>
                        <ul class="list-inline">
                            <li class="list-inline-item">
                                <a href="{{ route(ADMIN . '.categories.edit', $item->id) }}" title="{{ trans('app.edit_title') }}" class="btn btn-primary btn-sm"><span class="ti-pencil"></span></a></li>
                            <li class="list-inline-item">
                                {!! Form::open([
                                    'class'=>'delete',
                                    'url'  => route(ADMIN . '.categories.destroy', $item->id), 
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
                       
    لايوجد منتجات لهذا الصنف ...
      </p>
    @endif
@endsection