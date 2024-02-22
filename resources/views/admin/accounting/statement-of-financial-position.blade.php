
@extends('layouts.admin.master')
@section('styles')
<link rel="stylesheet"
    href="{{ asset('admin/assets/plugin/datatable/datatables.min.css') }}" />
@endsection
@section('body-content')
<div class="page-wrapper">

    <div class="page-body">
        
   {{-- <h4>Statement of Financial Position</h4>  --}}

    <div class="row white-box-div">
        <div class="table-responsive accounting-tb">
            <table class="table">
                <tr>
                    <th></th>
                    <th>£</th>
                    <th>£</th>
                </tr>
                <tr>
                    <th>
                        <a href="{{route('finantial_form',["id"=>"non_current_assets"])}}">Non-Current Assets</a>
                    </th>
                    <td>{{number_format($data["non_current_assets"], 2) }}</td>
                    <td></td>
                </tr>
                <tr>
                    <th>
                        <a href="{{route('finantial_form',["id"=>"current_assets"])}}">Current Assets</a>
                    </th>
                    <td>{{number_format($data["current_assets"], 2) }}  </td>
                    <td></td>
                </tr>
                <tr>
                    <th>
                        <a href="{{route('finantial_form',["id"=>"current_liablities"])}}">Current Liabilities</a>
                    </th>
                    <td>{{number_format($data["current_liablities"], 2) }} </td>
                    <td></td>
                </tr>
                <tr>
                    <th>
                        <a href="{{route('finantial_form',["id"=>"non_current_liablities"])}}">Non-Current Liabilities</a>
                    </th>
                    <td>{{number_format($data["non_current_liablities"], 2) }} </td>
                    <td></td>
                </tr>   


             {{--   <tr>
                    <th>
                        <a href="{{route('finantial_form',["id"=>"long_term_liablities"])}}">Long Term Liabilities</a>
                    </th>
                    <td>{{$data["long_term_liablities"]}}</td>
                    <td></td>
                </tr>  --}}
                <tr>
                <th >
                    <a href="">Value</a>
                    </th>
                    <td></td>
                    <td>{{number_format($data["value1"], 2) }} </td>
                </tr>
                <tr>
                    <th   style="padding-bottom: 0px !important;padding-top: 0px !important; padding-top: 70px !important;">
                        <a href="{{route('finantial_form',["id"=>"capital"])}}">Capital</a>
                    </th>
                    <td style="padding-bottom: 0px !important;padding-top: 0px !important; padding-top: 80px !important;"  >{{$data["capital"]}}</td>
                    <td></td>
                </tr>
                <tr>
                     
                    <th >
                        <a href="">Net Profit</a>
                    </th>
                    <td >{{ number_format($data["net_profit"], 2)    }}</td>
                    <td></td>
                </tr>
                <tr>
                    <th >
                        <a href="{{route('finantial_form',["id"=>"drawings"])}}">(Drawings) </a>
                    </th>
                    <td >{{number_format($data["drawings"], 2) }} </td>
                    <td></td>
                </tr>    


                <tr>
                    <th >
                    <a href="">Value</a>
                    </th>
                    <td ></td>
                    <td >{{number_format($data["value2"], 2) }} </td>
                </tr>
               

            </table>
        </div>
    </div>

    </div>
    
</div>
@endsection
@section('scripts')