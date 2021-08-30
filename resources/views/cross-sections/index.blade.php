@extends('layouts.app')

@section('content')
<div class="container">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        Here should be creation form
                    </div>
                </div>
            </div>
        </div>

        <h2 align="center" class="py-2">{{__('cross-country.cross-section.index.title')}}</h2>



    <div class="row justify-content-center">
        <div class="col-md-12">


            <section class="intro">
                <div class="bg-image h-100" style="background-color: #6095F0;">
                    <div class="mask d-flex align-items-center h-100">
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-12">
                                    <div class="card shadow-2-strong" style="background-color: #f5f7fa;">
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table class="table table-borderless mb-0">
                                                    <thead class="border-bottom text-sm-center">
                                                    <tr>
                                                        <th scope="col">{{__('cross-country.cross-section.number')}}</th>
                                                        <th scope="col">{{__('cross-country.cross-section.created_at')}}</th>
                                                        <th scope="col">{{__('cross-country.cross-section.name')}}</th>
                                                        <th scope="col">{{__('cross-country.cross-section.position')}}<br/>{{__('cross-country.cross-section.mileage')}}</th>
                                                        <th scope="col">{{__('cross-country.cross-section.points')}}</th>
                                                        <th scope="col">{{__('cross-country.cross-section.scale')}}</th>
                                                        <th scope="col">{{__('cross-country.cross-section.font-size')}}</th>
                                                        <th scope="col">{{__('cross-country.cross-section.options')}}</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody class="text-sm-center">
                                                    @foreach($cross_sections as $cross_section)
                                                        <tr class="border-bottom">
                                                            <td>{{$loop->index+1}}</td>
                                                            <td>{{$cross_section->created_at->format("Y-m-d")}}</td>
                                                            <td>{{$cross_section->name}}</td>
                                                            <td>{{$cross_section->position}}</td>
                                                            <td>
                                                                <table class="text-sm-center">
                                                                    <thead class="border">
                                                                    <tr>
                                                                        <th class="py-0 my-0">D:</th>
                                                                        <th class="py-0 my-0">H:</th>
                                                                    </tr>
                                                                    <tr class="border-bottom">
                                                                        <th class="m-0 p-0 border-right"><i class="bi bi-arrow-left-right"></i></th>
                                                                        <th class="m-0 p-0"><i class="bi bi-arrow-down-up"></i></th>
                                                                    </tr>
                                                                    </thead>

                                                                    <tbody class="border">
                                                                    @foreach($cross_section->points as $point)
                                                                        <tr class="border-bottom">
                                                                            <td class="m-0 p-0 border-right">{{$point->x}}</td>
                                                                            <td class="m-0 p-0">{{$point->y}}</td>
                                                                        </tr>
                                                                    @endforeach
                                                                    </tbody>
                                                                </table>
                                                            </td>
                                                            <td>{{__('cross-country.scale.vertical')}} - {{$cross_section->v_scale}}<br />
                                                            {{__('cross-country.scale.horizontal')}} - {{$cross_section->h_scale}}</td>
                                                            <td>{{$cross_section->font_size}}</td>
                                                            <td>

                                                                <a href="{{ route('cross_sections.edit',$cross_section->id) }}" class="edit  btn-outline-primary font-thin border-0">
                                                                    <i class="bi bi-pencil-square"></i>
                                                                </a>
                                                                <button class="delete btn-outline-danger border-0" data-id="{{$cross_section->id}}" data-class="cross-sections" >
                                                                    <i class="bi bi-trash"></i>
                                                                </button>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>
<script>
    const deleteUrl = "{{asset('')}}" ;


</script>
@section('js-files')
    <script src="{{ asset('js/delete.js') }}" ></script>
@endsection
@endsection


