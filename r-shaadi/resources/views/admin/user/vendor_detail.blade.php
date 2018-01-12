@extends('layouts.admin')

{{-- Web site Title --}}

@section('title') {!! $title !!} :: @parent @endsection
<style>.user_detail table tr th {border-width: 1px !important;}.trip_detail ul.list-inline.mar-hor {    margin: 0;}</style>
{{-- Content --}}

@section('content')
    <!-- Content Wrapper. Contains page content -->

    <div class="content-wrapper">

        <!-- Content Header (Page header) -->

        <section class="content-header">

            <h1>

              Vendor Details

            </h1>

            <ol class="breadcrumb">

                <li><a href="{!! url('admin') !!}"><i class="fa fa-dashboard"></i> Home</a></li>

                <li class="active">Vendor Details</li>

            </ol>

        </section>



        <!-- Main content -->

        <section class="content">

            <div class="row">

                <div class="col-xs-12">

                    <div class="box">

                        <div class="box-header">

                            {{-- <h3 class="box-title">Vendors Categories</h3>--}}

                            

                        </div>

                        <!-- /.box-header -->

                        <div class="box-body user_detail"><?php //echo '<pre>'; print_r($vendor['profile_pic']);exit; ?>
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <th>User Profile Pictures</th>
                                        <td>
                                            <ul class="list-unstyled list-inline text-justify">                           
                                                <li class="pad-btm">
                                                    @if (!empty($vendor['profile_pic']))
                                                        <img src="{{ url('public/uploads/profile').'/'.$vendor['profile_pic'] }}" class="img-thumbnail user-image" alt="Admin Image" height="100" width="100">
                                                    @else
                                                        <img src="//placehold.it/100" class="user-image" alt="Admin Image">
                                                    @endif
                                                </li>
                                            </ul>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Email</th>
                                        <td>{{ $vendor['email'] }}</td>              
                                    </tr>

                                    @if (!empty($vendor['city']))
                                    <tr>
                                        <th>City</th>
                                        <td>
                                            {{ ucwords($vendor['city']) }}
                                        </td>                           
                                    </tr>
                                    @endif

                                    @if (!empty($vendor['state']))
                                    <tr>
                                        <th>State</th>
                                        <td>
                                            {{ ucwords($vendor['state']) }}
                                        </td>                        
                                    </tr> 
                                    @endif

                                    @if (!empty($vendor['country']))
                                    <tr>
                                        <th>Country</th>
                                        <td>
                                            {{ ucwords($vendor['country']) }}
                                        </td>                        
                                    </tr> 
                                    @endif  

                                    @if (!empty($vendor['area_code']))
                                    <tr>
                                        <th>Area Code</th>
                                        <td>
                                            {{ ucwords($vendor['area_code']) }}
                                        </td>                        
                                    </tr> 
                                    @endif  

                                    @if (!empty($vendor['phone_number']))
                                    <tr>
                                        <th>Mobile Number</th>
                                        <td>
                                            {{ ucwords($vendor['phone_number']) }}
                                        </td>                        
                                    </tr> 
                                    @endif   

                                    @if (!empty($vendor['about_me']))
                                    <tr>
                                        <th>About Me</th>
                                        <td>
                                            {{ ucwords($vendor['about_me']) }}
                                        </td>                        
                                    </tr> 
                                    @endif   

                                    @if (!empty($vendor['address1']))
                                    <tr>
                                        <th>Street Address1</th>
                                        <td>
                                            {{ ucwords($vendor['address1']) }}
                                        </td>                        
                                    </tr> 
                                    @endif   

                                    @if (!empty($vendor['address2']))
                                    <tr>
                                        <th>Street Address2</th>
                                        <td>
                                            {{ ucwords($vendor['address1']) }}
                                        </td>                        
                                    </tr> 
                                    @endif   

                                    @if (!empty($vendor['category_name']))
                                    <tr>
                                        <th>Category Name</th>
                                        <td>
                                            {{ ucwords($vendor['category_name']) }}
                                        </td>                        
                                    </tr> 
                                    @endif   

                                    @if (!empty($vendor['website_url']))
                                    <tr>
                                        <th>Website Url</th>
                                        <td>
                                            {{ ucwords($vendor['website_url']) }}
                                        </td>                        
                                    </tr> 
                                    @endif   

                                    @if (!empty($vendor['facebook_url']))
                                    <tr>
                                        <th>Facebook Url</th>
                                        <td>
                                            {{ ucwords($vendor['facebook_url']) }}
                                        </td>                        
                                    </tr> 
                                    @endif   

                                    @if (!empty($vendor['instagram_url']))
                                    <tr>
                                        <th>Instagram Url</th>
                                        <td>
                                            {{ ucwords($vendor['instagram_url']) }}
                                        </td>                        
                                    </tr> 
                                    @endif   

                                    @if (!empty($vendor['twitter_url']))
                                    <tr>
                                        <th>Twitter Url</th>
                                        <td>
                                            {{ ucwords($vendor['twitter_url']) }}
                                        </td>                        
                                    </tr> 
                                    @endif   

                                    @if (!empty($vendor['youtube_url']))
                                    <tr>
                                        <th>Youtube Url</th>
                                        <td>
                                            {{ ucwords($vendor['youtube_url']) }}
                                        </td>                        
                                    </tr> 
                                    @endif              
                                </tbody>
                            </table>    
                        </div>

                        <!-- /.box-body -->

                    </div>

                    <!-- /.box -->

                </div>

                <!-- /.col -->

            </div>

            <!-- /.row -->

        </section>

        <!-- /.content -->

    </div>

    <!-- /.content-wrapper -->
@endsection