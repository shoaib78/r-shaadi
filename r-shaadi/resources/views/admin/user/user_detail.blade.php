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

                User Details

            </h1>

            <ol class="breadcrumb">

                <li><a href="{!! url('admin') !!}"><i class="fa fa-dashboard"></i> Home</a></li>

                <li class="active">User Details</li>

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

                        <div class="box-body user_detail">

                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <th>User Profile Pictures</th>
                                        <td>
                                            <ul class="list-unstyled list-inline text-justify">                           
                                                <li class="pad-btm">
                                                    @if (!empty($user_detail['profile_pic']))
                                                        <img src="{{ url('public/uploads/profile').'/'.$user_detail['profile_pic'] }}" class="img-thumbnail user-image" alt="Admin Image" height="100" width="100">
                                                    @else
                                                        <img src="//placehold.it/100" class="user-image" alt="Admin Image">
                                                    @endif
                                                </li>
                                            </ul>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Email</th>
                                        <td>{{ $user_detail['email'] }}</td>              
                                    </tr>
                                    <tr>
                                        <th>Name</th>
                                        <td>
                                            @if ($user_detail['firstname'] && $user_detail['lastname'])
                                                {{ ucwords($user_detail['firstname']." ".$user_detail['lastname']) }}
                                            @else
                                                Admin
                                            @endif
                                        </td>                           
                                    </tr>
                                    <tr>
                                        <th>Gender</th>
                                        <td>
                                            @if($user_detail['gender'] == 1)
                                                Male
                                            @elseif($user_detail['gender'] == 2)
                                                Female
                                            @else
                                               Other
                                            @endif
                                        </td>                           
                                    </tr> 
                                    <tr>
                                        <th>Birthdate</th>
                                        <td>
                                            @if (!empty($user_detail['birthdate']))
                                                {{ date("d F, Y", strtotime($user_detail['birthdate'])) }}
                                            @endif
                                        </td>                           
                                    </tr>                
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