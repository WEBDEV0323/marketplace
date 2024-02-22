    @extends('layouts.admin.master')



    @section('body-content')
    <div class="page-wrapper">
        <!-- Page Title -->
        <div class="page-title">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h2 class="page-title-text"></h2>
                </div>
                <div class="col-sm-6 text-right">
                    <div class="breadcrumbs">
                        <ul>
                            <li><a href="#">Home</a></li>
                            <li>Dashboard</li>
                            <li>Weight</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- Page Body -->
        <div class="page-body">
            @if ( session()->has('message') )
            <div class="alert alert-icon alert-success alert-dismissible fade show">
                <div class="alert--icon">
                    <i class="fa fa-check"></i>
                </div>
                <div class="alert-text">
                    <strong>Well done!</strong> {{ session('message') }}
                </div>
                <button type="button" class="close" data-dismiss="alert">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            @elseif(session()->has('error'))
            <div class="alert alert-icon alert-danger alert-dismissible fade show">
                <div class="alert--icon">
                    <i class="fa fa-thermometer"></i>
                </div>
                <div class="alert-text">
                    <strong>Oh snap!</strong> {{ session('error') }}
                </div>
                <button type="button" class="close" data-dismiss="alert">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif
            <form action="{{route('setting.weight.process')}}" method="post">
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-head">
                                <div class="panel-title">
                                    {{-- <span class="panel-title-text">Commission Fee</span>  --}}
                                </div>
                            </div>
                            <div class="panel-body">
                                <div class="row white-box-div">

                                    <div class="col-md-12">
                                        <div class="form-group ">
                                            <label for="" class="form-control-label">Commission Fee %</label>
                                            <input type="text" value="<?php echo (!empty($fixed_shipping) ? $fixed_shipping : ''); ?>" name="fixed_price" placeholder="Enter Fixed amout of Fee" class="form-control">
                                        </div>
                                    </div>
                                   {{-- <div class="col-md-6">
                                        <div class="form-group ">
                                            <label for="" class="form-control-label">Commission Fee</label>
                                            <input type="text" value="<?php echo (!empty($commission) ? $commission : ''); ?>" name="commission" placeholder="Commission" class="form-control">
                                        </div> --}}
                                    </div>
                                    <div class="col-md-12">
                                        <div class="buttons text-center mb-0">
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                            <button type="reset" class="btn btn-danger">Cancel</button>
                                        </div>
                                    </div>



                                </div>
                            </div>
                        </div>
                    </div>
            </form>


            <div class="table-responsive">
        <table class="table table-head-bg table-head-primary table table-striped table-bordered basic-datatable" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Gender</th>
                    <th>Shippping Fee</th>

                    <th>Action</th>
                </tr>
            </thead>
            <tbody>

                @if(isset($categories))
                @foreach($categories as $category)

                <tr>
                    <td>{{ $category->id}}</td>
                    <td>{{$category->shop_cat_name}}</td>
                    <td>
                        @if($category->parent_id == 1)
                            Menswear
                        @elseif($category->parent_id == 2)
                            Womenswear
                        @elseif($category->parent_id == 3)
                            Children
                        @endif
                    </td>

                    <td>{{number_format($category->shipping,2)}}</td>
                    
                    <td><a href = "{{route('edit_commission',["id"=>$category->id])}}" class="btn btn-primary btn-sm m-1">Edit</a> </td>
                    {{-- <td>
                        
                        <a href = "{{ route('edit.category', ['id' => $shop_category['id']]) }}" class="btn btn-primary btn-sm m-1">Edit</a>
                    <a href="{{ route('delete.category', ['id' => $shop_category['id']]) }}" class="btn btn-primary btn-sm m-1">Delete</a> --}}

                    </td>

                </tr>
                @endforeach
                @endif

            </tbody>
      
        </table>
    </div>



        </div>
    </div>
    </div>

    

    @endsection