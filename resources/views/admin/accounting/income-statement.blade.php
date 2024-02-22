
@extends('layouts.admin.master')
@section('styles')
<link rel="stylesheet"
    href="{{ asset('admin/assets/plugin/datatable/datatables.min.css') }}" />
@endsection
@section('body-content')
<div class="page-wrapper">
    <div class="page-body">
      {{--  <h4>Income Statement</h4> --}}

        <div class="row white-box-div">
            <div class="table-responsive accounting-tb">
                <table class="table" border="1">
                    <tr>
                        <th></th>
                        <th>£</th>
                        <th>£</th>
                    </tr>
                    <tr>
                        <th style="padding-bottom: 0% !important;">
                            <a href="#">Revenue</a>
                        </th>
                        <td style="padding-bottom: 0% !important;">{{number_format($data["total_revenue"], 2)}}<td> 
                        
                    </tr>
                    <tr class="min-padding">
                        <th>
                            <a href="#">(Returns in)</a>
                        </th>
                        <td>({{number_format($data["returns_in"], 2)    }})</td> 
                           
                            
                       
                    </tr>
                    <tr class="empty-tr">
                        <th></th>
                        <td></td>
                        <td>{{  number_format($data["total_revenue"] - $data["returns_in"], 2)   }}</td> 
                    </tr>
                    <tr class="min-padding">
                        <th style="padding-top: 20px !important;">
                            <a href="#">Cost of Sales</a>
                        </th>
                        <td style="padding-top: 20px !important;"></td>
                        <td style="padding-top: 20px !important;"></td>
                    </tr>
                    <tr class="min-padding">
                        <th>
                            <a href="{{route('finantial_form',["id"=>"opening_inventory"])}}">Opening Inventory</a>
                        </th>
                        <td>{{number_format($data["opening_inventory"], 2)}}</td>
                        <td></td>
                    </tr>
                    <tr class="min-padding">
                        <th>
                            <a href="{{route('finantial_form',["id"=>"purchases"])}}">Purchases</a>
                        </th>
                        <td>{{ number_format($data["purchases"], 2)   }}</td>
                        <td></td>
                    </tr>
                    <tr class="min-padding">
                        <th>
                            <a href="{{route('finantial_form',["id"=>"carrige_in"])}}">Carriage In</a>
                        </th>
                        <td>{{ number_format($data["carrige_in"], 2)   }}</td>
                        <td></td>
                    </tr>
                    <tr class="min-padding">
                        <th>
                            <a href="{{route('finantial_form',["id"=>"returns_out"])}}">(Returns Out)</a>
                        </th>
                        <td>({{number_format($data["returns_out"], 2)   }})</td>
                        <td></td>
                    </tr>
                    <tr class="min-padding">
                        <th style="padding-bottom: 20px !important;">
                            <a href="{{route('finantial_form',["id"=>"closing_inventory"])}}">(Closing Inventory)</a>
                        </th>
                        <td style="padding-bottom: 20px !important;"> ({{number_format($data["closing_inventory"], 2)   }})  </td>
                        <td style="padding-bottom: 20px !important;"></td>
                    </tr>
                    <tr class="empty-tr">
                        <th ></th>
                        <td></td>
                        <td>{{ number_format($data["cost"], 2)  }}</td>
                    </tr>
                    <tr>
                        <th>
                            <a href="#">Gross Profit</a>
                        </th>
                        <td>{{  number_format( $data["gross_profit"], 2)     }}</td>
                        <td></td>
                    </tr>
                    <tr class="empty-tr">
                        <th></th>
                        <td></td>
                    </tr>
                    <tr>
                        <th>
                            <a href="{{route('finantial_form',["id"=>"incomes"])}}">Incomes</a>
                        </th>
                        <td>{{number_format($data["incomes"], 2)   }}</td>
                        <td></td>
                    </tr>
                    <tr class="empty-tr">
                        <th></th>
                        <td></td>
                    </tr>
                    <tr>
                        <th>
                            <a href="{{route('finantial_form',["id"=>"expenses"])}}">Expenses</a>
                        </th>
                        <td>({{ number_format($data["expenses"], 2)  }})</td>
                        <td></td>
                    </tr>
                    <tr class="empty-tr">
                        <th></th>
                        <td></td>
                    </tr>
                    <tr>
                        <th>
                            <a href="#">Net Profit</a>
                        </th>
                        <td>{{ number_format($data["net_profit"], 2)    }}</td>
                        <td></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')