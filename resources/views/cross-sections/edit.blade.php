@extends('layouts.app')
<style>
    /* Chrome, Safari, Edge, Opera */
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    /* Firefox */
    input[type=number] {
        -moz-appearance: textfield;
    }
</style>
@section('content')
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

        <h2 align="center" class="py-2">{{__('cross-country.cross-section.edit.title')}}</h2>


        <div class="row justify-content-center">
            <div class="col-md-12">
                <form action="{{route('cross_sections.update',$crossSection)}}" method="POST">

                    @csrf



                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @if (Session::has('success'))

                        <div class="alert alert-success text-center">

                            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>

                            <p>{{ Session::get('success') }}</p>

                        </div>

                    @endif

                    <table class="table table-bordered p-0 m-0" id="meta-info">

                        <tr class="m-0 p-0">

                            <th>Name</th>

                            <th>Position</th>

                            <th>Vertical scale</th>

                            <th>Horizontal scale</th>

                            <th>Comp. Lvl</th>

                            <th>Font size</th>

                        </tr>

                        <tr class="m-0 p-0">

                            <td><input type="text" name="name" placeholder="Enter cross-section name" class="form-control" value="{{$crossSection->name}}" /></td>

                            <td><input type="number" name="position" placeholder="Enter c-s position" class="form-control" value="{{$crossSection->position}}" /></td>

                            <td><input type="number" name="v_scale" placeholder="" class="form-control" value="{{$crossSection->v_scale}}"/></td>

                            <td><input type="number" name="h_scale" placeholder="" class="form-control" value="{{$crossSection->h_scale}}" /></td>

                            <td><input type="number" id="comp_lvl" name="comparison_level" placeholder="" class="form-control" value="{{$crossSection->comparison_level}}" /></td>

                            <td><input type="number" name="font_size" placeholder="" class="form-control" value="{{$crossSection->font_size}}" /></td>

                        </tr>

                    </table>
                    <div class="d-inline-flex w-100">

                        <div class="w-75 d-inline-block bg-dark">
                            <canvas id="canvas" class="bg-secondary w-100 h-100" >

                            </canvas>
                        </div>

                        <div class="w-25 d-inline-block bg-primary">

                            <table class="table table-bordered p-0 m-0" id="dynamicTable" style="border-spacing: 0px !important;">

                                <tr>

                                    <th class="text-sm-center align-middle p-0">No</th>

                                    <th class="text-sm-center align-middle p-0">Distance</th>

                                    <th class="text-sm-center align-middle p-0">Height</th>

                                    <th class="text-sm-center align-middle p-0">Action</th>

                                </tr>
                                @foreach($crossSection->points as $point)
                                    <tr class="cs-p p-0 m-0" data-id="{{$loop->index}}">

                                        <td class="p-0 m-0">
                                            <input id="cs-i-{{$loop->index}}" type="number" name="point[{{$loop->index}}][number]" class="cs-i form-control p-0 m-0 text-sm-center" value="{{ $loop->index+1 }}" readonly />
                                        </td>

                                        <td class="p-0 m-0">
                                            <input id="cs-x-{{$loop->index}}" data-id="{{$loop->index}}" type="number" name="point[{{$loop->index}}][x]" placeholder="0.0" class="cs-x form-control p-0 m-0 text-sm-center" step="0.01" value="{{$point->x}}" />
                                        </td>

                                        <td class="p-0 m-0">
                                            <input id="cs-y-{{$loop->index}}" data-id="{{$loop->index}}" type="number" name="point[{{$loop->index}}][y]" placeholder="0.0" class="cs-y form-control p-0 m-0 text-sm-center" step="0.01"  value="{{$point->y}}"/>
                                        </td>

                                        @if($loop->index == 0)
                                            <td class="p-0 m-0"><button type="button" name="add" id="add" class="btn btn-success w-100">+</button></td>
                                        @else
                                            <td class="p-0 m-0"><button type="button" class="btn btn-danger remove-tr w-100">-</button></td>
                                        @endif

                                    </tr>
                                @endforeach

                            </table>
                            <button type="submit" class="btn btn-success w-50 d-inline p-0 m-0">Save</button>
                            <button id="draw-button" type="button" class="btn btn-secondary w-25 d-inline p-0 m-0">Draw</button>
                        </div>


                    </div>





                </form>
            </div>
        </div>


    </div>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script type="text/javascript">


    </script>

@section('js-files')
    <script src="{{ asset('js/cs-draw.js') }}" ></script>
@endsection

@endsection

