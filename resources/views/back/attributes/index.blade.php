@extends('back.layouts.master')

@section('content')

    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <div class="breadcrumb-wrapper col-12">
                                <ol class="breadcrumb no-border">
                                    <li class="breadcrumb-item">مدیریت
                                    </li>
                                    <li class="breadcrumb-item">مدیریت ویژگی ها
                                    </li>
                                    <li class="breadcrumb-item active">لیست ویژگی ها
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">

                @if($attributes->count())
                    <section class="card">
                        <div class="card-header">
                            <h4 class="card-title">لیست ویژگی ها</h4>
                        </div>
                        <div class="card-content" id="main-card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped mb-0">
                                        <thead>
                                            <tr>
                                                <th>عنوان</th>
                                                <th class="text-center">عملیات</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($attributes as $attribute)

                                                <tr id="attribute-{{ $attribute->id }}-tr">

                                                    <td>
                                                        @if ($attribute->group->type == 'color')
                                                            @if ($attribute->value2)

                                                                <button type="button" class="btn btn-icon btn-icon rounded-circle waves-effect waves-light" style="background:linear-gradient( 90deg, {{ $attribute->value }} 50%,{{ $attribute->value2 }} 50% ) "></button>
                                                            @else

                                                                <button type="button" class="btn btn-icon btn-icon rounded-circle waves-effect waves-light" style="background-color: {{ $attribute->value }}"></button>
                                                            @endif
                                                        @endif
                                                        {{ $attribute->name }}
                                                    </td>

                                                    <td class="text-center">
                                                        <a href="{{ route('admin.attributes.edit', ['attribute' => $attribute]) }}" class="btn btn-success mr-1 waves-effect waves-light">ویرایش</a>

                                                        <button type="button" data-attribute="{{ $attribute->id }}" data-id="{{ $attribute->id }}" class="btn btn-danger mr-1 waves-effect waves-light btn-delete"  data-toggle="modal" data-target="#delete-modal">حذف</button>
                                                    </td>
                                                </tr>
                                            @endforeach

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </section>

                @else
                    <section class="card">
                        <div class="card-header">
                            <h4 class="card-title">لیست ویژگی ها</h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <div class="card-text">
                                    <p>چیزی برای نمایش وجود ندارد!</p>
                                </div>
                            </div>
                        </div>
                    </section>
                @endif
                {{ $attributes->links() }}

            </div>
        </div>
    </div>

    {{-- delete attribute modal --}}
    <div class="modal fade text-left" id="delete-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel19" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel19">آیا مطمئن هستید؟</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    با حذف ویژگی دیگر قادر به بازیابی آن نخواهید بود
                </div>
                <div class="modal-footer">
                    <form action="#" id="attribute-delete-form">
                        @csrf
                        @method('delete')
                        <button type="button" class="btn btn-success waves-effect waves-light" data-dismiss="modal">خیر</button>
                        <button type="submit" class="btn btn-danger waves-effect waves-light">بله حذف شود</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <script src="{{ asset('back/assets/js/pages/attributes/index.js') }}"></script>
@endpush
