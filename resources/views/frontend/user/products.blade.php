@extends('frontend.user.user-masters')
@section('user-content')
<div class="column content">
                <div class="my-listings-page table-responsive">
                    <table class="table table-borderless">
                        <thead>
                            <tr>
                                <th>
                                    <p>ID</p>
                                </th>
                                <th>
                                    <p>Image</p>
                                </th>
                                <th>
                                    <p>Product Name</p>
                                </th>
                                <th>
                                    <p>Status</p>
                                </th>
                                <th>
                                    <p>Price</p>
                                </th>
                                <th>
                                    <p>Categories</p>
                                </th>
                                <th>
                                    <p>New / Pre-Loved</p>
                                </th>
                                <th>
                                    <p>Options</p>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <p>01234</p>
                                </td>
                                <td><img src="{{asset('/')}}assets/images/childern-product-5.jpg" alt=""></td>
                                <td>
                                    <a href="#">01234</a>
                                </td>
                                <td>
                                    <p>Publish</p>
                                </td>
                                <td>
                                    <p>-£</p>
                                    <p>-£</p>
                                </td>
                                <td>
                                    <p>-</p>
                                </td>
                                <td>
                                    <p>New</p>
                                </td>
                                <td><button class="blue-button mb-1">Edit</button>
                                    <button class="blue-button">Delete</button>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p>01234</p>
                                </td>
                                <td><img src="{{asset('/')}}assets/images/childern-product-5.jpg" alt=""></td>
                                <td>
                                    <a href="#">01234</a>
                                </td>
                                <td>
                                    <p>Publish</p>
                                </td>
                                <td>
                                    <p>-£</p>
                                    <p>250£</p>
                                </td>
                                <td>
                                    <p>-</p>
                                </td>
                                <td>
                                    <p>New</p>
                                </td>
                                <td><button class="blue-button mb-1">Edit</button>
                                    <button class="blue-button">Delete</button>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p>01234</p>
                                </td>
                                <td><img src="{{asset('/')}}assets/images/childern-product-2.jpg" alt=""></td>
                                <td>
                                    <a href="#">01234</a>
                                </td>
                                <td>
                                    <p>Publish</p>
                                </td>
                                <td>
                                    <p>-£</p>
                                    <p>-£</p>
                                </td>
                                <td>
                                    <p>-</p>
                                </td>
                                <td>
                                    <p>New</p>
                                </td>
                                <td><button class="blue-button mb-1">Edit</button>
                                    <button class="blue-button">Delete</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            @endsection
  