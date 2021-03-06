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

    <h2 align="center" class="py-2">{{__('cross-country.cross-section.create.title')}}</h2>


    <div class="row justify-content-center">
        <div class="col-md-12">
                <form action="{{route('cross_sections.store')}}" method="POST">

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

                            <th><div class="bg-white p-2 text-xl-center" style="border-radius: 2px;">Name</div></th>

                            <th><div class="bg-white p-2 text-xl-center" style="border-radius: 2px;">Position</div></th>

                            <th><div class="bg-white p-2 text-xl-center" style="border-radius: 2px;">V scale</div></th>

                            <th><div class="bg-white p-2 text-xl-center" style="border-radius: 2px;">H scale</div></th>

                            <th><div class="bg-white p-2 text-xl-center" style="border-radius: 2px;">L Bank</div></th>

                            <th><div class="bg-white p-2 text-xl-center" style="border-radius: 2px;">R Bank</div></th>

                            <th><div class="bg-white p-2 text-xl-center" style="border-radius: 2px;">Ref. Lvl</div></th>

                            <th><div class="bg-white p-2 text-xl-center" style="border-radius: 2px;">Water lvl.</div></th>

                            <th><div class="bg-white p-2 text-xl-center" style="border-radius: 2px;">Bottom</div></th>

                            <th><div class="bg-white p-2 text-xl-center" style="border-radius: 2px;">Font size</div></th>

                        </tr>

                        <tr class="m-0 p-0">

                            <td><input type="text" name="name" placeholder="Enter cross-section name" class="form-control" value="Name" /></td>

                            <td><input type="number" name="position" placeholder="Enter c-s position" class="form-control" value="0.00" /></td>

                            <td><input type="number" name="v_scale" placeholder="" class="form-control" value="100"/></td>

                            <td><input type="number" name="h_scale" placeholder="" class="form-control" value="100" /></td>

                            <td><input type="number" name="bank_l" placeholder="left bank" class="form-control" value="" /></td>

                            <td><input type="number" name="bank_r" placeholder="right bank" class="form-control" value="" /></td>

                            <td><input type="number" id="ref_lvl" name="reference_level" placeholder="" class="form-control" value="0" /></td>

                            <td><input type="number" name="water_lvl" placeholder="right bank" class="form-control" value="" /></td>

                            <td><input type="number" name="bottom" placeholder="right bank" class="form-control" value="" /></td>

                            <td><input type="number" name="font_size" placeholder="" class="form-control" value="12" /></td>

                        </tr>

                    </table>
            <div class="d-inline-flex w-100">

                <div class="w-75 d-inline-block bg-dark">
                    <canvas id="canvas" class="bg-info w-100 h-100" >

                    </canvas>
                </div>

                <div class="w-25 d-inline-block bg-transparent">

                    <table class="table table-bordered p-0 m-0" id="dynamicTable" style="border-spacing: 0px !important;">

                        <tr>

                            <th class="text-sm-center align-middle p-0">No</th>

                            <th class="text-sm-center align-middle p-0">Distance</th>

                            <th class="text-sm-center align-middle p-0">Height</th>

                            <th class="text-sm-center align-middle p-0">Action</th>

                        </tr>

                        <tr class="cs-p p-0 m-0" data-id="0">

                            <td class="p-0 m-0">
                                <input id="cs-i-0" type="number" name="point[0][number]" class="form-control p-0 m-0 text-sm-center" value="1" readonly />
                            </td>

                            <td class="p-0 m-0">
                                <input id="cs-x-0" data-id="0" type="number" name="point[0][x]" class="cs-x form-control p-0 m-0 text-sm-center" step="0.01" value="0.00" />
                            </td>

                            <td class="p-0 m-0">
                                <input id="cs-y-0" data-id="0" type="number" name="point[0][y]" class="cs-y form-control p-0 m-0 text-sm-center" step="0.01"  value="0.00"/>
                            </td>

                            <td class="p-0 m-0">
                                <button type="button" name="add" id="add" class="btn btn-success w-100">+</button>
                            </td>

                        </tr>

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


