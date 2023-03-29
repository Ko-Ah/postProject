@extends('dashboard.layouts.master')


@section('content')
    <div class="content-body">

        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="row">
                        <div class="col-xl-3 col-xxl-3 col-lg-6 col-sm-6">
                            <div class="card overflow-hidden">
                                <div class="card-body pb-0 px-4 pt-4">
                                    <div class="row">
                                        <div class="col">
                                            <h5 class="mb-1">2000</h5>
                                            <span class="text-success">کل فروش</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="chart-wrapper">
                                    <canvas id="areaChart_2" class="chartjs-render-monitor" height="90"></canvas>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-xxl-3 col-lg-6 col-sm-6">
                            <div class="card bg-success	overflow-hidden">
                                <div class="card-body pb-0 px-4 pt-4">
                                    <div class="row">
                                        <div class="col">
                                            <h5 class="text-white mb-1">$14000</h5>
                                            <span class="text-white">درآمد کل</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="chart-wrapper" style="width:100%;">
                                    <span class="peity-line" data-width="100%">6,2,8,4,3,8,4,3,6,5,9,2</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-xxl-3 col-lg-6 col-sm-6">
                            <div class="card bg-primary overflow-hidden">
                                <div class="card-body pb-0 px-4 pt-4">
                                    <div class="row">
                                        <div class="col text-white">
                                            <h5 class="text-white mb-1">570</h5>
                                            <span>نماهایی از پروژه شما</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="chart-wrapper px-2">
                                    <canvas id="chart_widget_2" height="100"></canvas>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-xxl-3 col-lg-6 col-sm-6">
                            <div class="card overflow-hidden">
                                <div class="card-body px-4 py-4">
                                    <h5 class="mb-3">1700 / <small class="text-primary">وضعیت فروش</small></h5>
                                    <div class="chart-point">
                                        <div class="check-point-area">
                                            <canvas id="ShareProfit2"></canvas>
                                        </div>
                                        <ul class="chart-point-list">
                                            <li><i class="fa fa-circle text-primary mr-1"></i> 40% بلیط</li>
                                            <li><i class="fa fa-circle text-success ml-1"></i> 35% مناسبت ها</li>
                                            <li><i class="fa fa-circle text-warning ml-1"></i> 25% دیگر</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row questionnaire-box justify-content-center mx-0 align-items-center card">

                <!-- ========= summary ========== -->

                <div class="col-12">
                    <div class="summary-header">
                        <h2 class="text-center border-bottom py-2 mb-4">خلاصه وضعیت</h2>
                    </div>
                    <div class="summary">
                        <div class="row mx-0">
                            <div class="col-12 col-md-6 col-lg-3 my-4">
                                <div class="summary-item text-center">
                                    <h2 class="pt-5">کاربران</h2>
                                    <h1 class="py-3">1</h1>
                                    <div class="summary-title">
                                        <i class="fa-solid fa-users align-middle"></i>

                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 col-lg-3 my-4">
                                <div class="summary-item text-center">
                                    <h2 class="pt-5">محققان</h2>
                                    <h1 class="py-3">3</h1>
                                    <div class="summary-title">
                                        <i class="fa-solid fa-book-open-reader align-middle"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 col-lg-3 my-4">
                                <div class="summary-item text-center">
                                    <h2 class="pt-5">ناظران</h2>
                                    <h1 class="py-3">0</h1>
                                    <div class="summary-title">
                                        <i class="fa-solid fa-user-tie align-middle"></i>

                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 col-lg-3 my-4">
                                <div class="summary-item text-center">
                                    <h2 class="pt-5">کارشناسان</h2>
                                    <h1 class="py-3">0</h1>
                                    <div class="summary-title">
                                        <i class="fa-solid fa-user-check align-middle"></i>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12">
                    <div class="project-list-header">
                        <h2 class="text-center border-bottom py-2 pt-4 mb-3">
                            لیست کاربران
                        </h2>
                    </div>

                    <div class="user-list">
                        <a href="#" class="add-user" data-toggle="modal" data-target="#modal_adduser">
                            <i class="fa-solid fa-plus align-middle"></i>
                            ایجاد کاربر جدید
                        </a>
                        <div class="table-responsive">
                            <table id="example3" class="display" style="min-width: 845px;">
                                <thead>
                                <tr>
                                    <th></th>
                                    <th>نام</th>
                                    <th>بخش</th>
                                    <th>جنسیت</th>
                                    <th>تحصیلات</th>
                                    <th>موبایل</th>
                                    <th>ایمیل</th>
                                    <th>تاریخ عضویت</th>
                                    <th>عمل</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td><img class="rounded-circle" width="35" src="images/pic1_1.jpg" alt>
                                    </td>
                                    <td>تایگر نیکسون</td>
                                    <td>معمار</td>
                                    <td>مرد</td>
                                    <td>M.COM., P.H.D.</td>
                                    <td><a href="javascript:void(0);"><strong>123 456 7890</strong></a>
                                    </td>
                                    <td><a href="javascript:void(0);"><strong><span class="__cf_email__"
                                                                                    data-cfemail="670e09010827021f060a170b024904080a">[ایمیل&#160;محافظت
                                                            شده]</span></strong></a>
                                    </td>
                                    <td>2011/04/25</td>
                                    <td>
                                        <div class="d-flex">
                                            <a href="#" class="btn btn-primary shadow btn-xs sharp ml-1"><i
                                                    class="fa fa-pencil"></i></a>
                                            <a href="#" class="btn btn-danger shadow btn-xs sharp"><i
                                                    class="fa fa-trash"></i></a>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td><img class="rounded-circle" width="35" src="images/pic1_1.jpg" alt>
                                    </td>
                                    <td>تایگر نیکسون</td>
                                    <td>معمار</td>
                                    <td>مرد</td>
                                    <td>M.COM., P.H.D.</td>
                                    <td><a href="javascript:void(0);"><strong>123 456 7890</strong></a>
                                    </td>
                                    <td><a href="javascript:void(0);"><strong><span class="__cf_email__"
                                                                                    data-cfemail="670e09010827021f060a170b024904080a">[ایمیل&#160;محافظت
                                                            شده]</span></strong></a>
                                    </td>
                                    <td>2011/04/25</td>
                                    <td>
                                        <div class="d-flex">
                                            <a href="#" class="btn btn-primary shadow btn-xs sharp ml-1"><i
                                                    class="fa fa-pencil"></i></a>
                                            <a href="#" class="btn btn-danger shadow btn-xs sharp"><i
                                                    class="fa fa-trash"></i></a>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td><img class="rounded-circle" width="35" src="images/pic1_1.jpg" alt>
                                    </td>
                                    <td>تایگر نیکسون</td>
                                    <td>معمار</td>
                                    <td>مرد</td>
                                    <td>M.COM., P.H.D.</td>
                                    <td><a href="javascript:void(0);"><strong>123 456 7890</strong></a>
                                    </td>
                                    <td><a href="javascript:void(0);"><strong><span class="__cf_email__"
                                                                                    data-cfemail="670e09010827021f060a170b024904080a">[ایمیل&#160;محافظت
                                                            شده]</span></strong></a>
                                    </td>
                                    <td>2011/04/25</td>
                                    <td>
                                        <div class="d-flex">
                                            <a href="#" class="btn btn-primary shadow btn-xs sharp ml-1"><i
                                                    class="fa fa-pencil"></i></a>
                                            <a href="#" class="btn btn-danger shadow btn-xs sharp"><i
                                                    class="fa fa-trash"></i></a>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td><img class="rounded-circle" width="35" src="images/pic1_1.jpg" alt>
                                    </td>
                                    <td>تایگر نیکسون</td>
                                    <td>معمار</td>
                                    <td>مرد</td>
                                    <td>M.COM., P.H.D.</td>
                                    <td><a href="javascript:void(0);"><strong>123 456 7890</strong></a>
                                    </td>
                                    <td><a href="javascript:void(0);"><strong><span class="__cf_email__"
                                                                                    data-cfemail="670e09010827021f060a170b024904080a">[ایمیل&#160;محافظت
                                                            شده]</span></strong></a>
                                    </td>
                                    <td>2011/04/25</td>
                                    <td>
                                        <div class="d-flex">
                                            <a href="#" class="btn btn-primary shadow btn-xs sharp ml-1"><i
                                                    class="fa fa-pencil"></i></a>
                                            <a href="#" class="btn btn-danger shadow btn-xs sharp"><i
                                                    class="fa fa-trash"></i></a>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td><img class="rounded-circle" width="35" src="images/pic1_1.jpg" alt>
                                    </td>
                                    <td>تایگر نیکسون</td>
                                    <td>معمار</td>
                                    <td>مرد</td>
                                    <td>M.COM., P.H.D.</td>
                                    <td><a href="javascript:void(0);"><strong>123 456 7890</strong></a>
                                    </td>
                                    <td><a href="javascript:void(0);"><strong><span class="__cf_email__"
                                                                                    data-cfemail="670e09010827021f060a170b024904080a">[ایمیل&#160;محافظت
                                                            شده]</span></strong></a>
                                    </td>
                                    <td>2011/04/25</td>
                                    <td>
                                        <div class="d-flex">
                                            <a href="#" class="btn btn-primary shadow btn-xs sharp ml-1"><i
                                                    class="fa fa-pencil"></i></a>
                                            <a href="#" class="btn btn-danger shadow btn-xs sharp"><i
                                                    class="fa fa-trash"></i></a>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td><img class="rounded-circle" width="35" src="images/pic1_1.jpg" alt>
                                    </td>
                                    <td>تایگر نیکسون</td>
                                    <td>معمار</td>
                                    <td>مرد</td>
                                    <td>M.COM., P.H.D.</td>
                                    <td><a href="javascript:void(0);"><strong>123 456 7890</strong></a>
                                    </td>
                                    <td><a href="javascript:void(0);"><strong><span class="__cf_email__"
                                                                                    data-cfemail="670e09010827021f060a170b024904080a">[ایمیل&#160;محافظت
                                                            شده]</span></strong></a>
                                    </td>
                                    <td>2011/04/25</td>
                                    <td>
                                        <div class="d-flex">
                                            <a href="#" class="btn btn-primary shadow btn-xs sharp ml-1"><i
                                                    class="fa fa-pencil"></i></a>
                                            <a href="#" class="btn btn-danger shadow btn-xs sharp"><i
                                                    class="fa fa-trash"></i></a>
                                        </div>
                                    </td>
                                </tr>


                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="modal_adduser">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form>
                    <div class="modal-header">
                        <h4 class="modal-title">ایجاد کاربر</h4>
                        <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form_adduser">
                            <div class="form-group">
                                <label class="mb-1"><strong>نام کاربری</strong></label>
                                <input type="text" class="form-control px-5" id="user-field" name="username"
                                       placeholder="نام کاربری" />
                                <i class="fa-solid fa-user"></i>
                                <div id="user-error" class=" text-danger fs-6">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="mb-1"><strong>تلفن همراه</strong></label>
                                <input type="number" class="form-control px-5" id="phone-field" name="phone"
                                       placeholder="+98 - 9xxxxxxxxx">
                                <i class="fa-solid fa-phone"></i>
                                <div id="phone-error" class=" text-danger fs-6">

                                </div>
                            </div>
                            <div class="form-group">
                                <label class="mb-1"><strong>ایمیل</strong></label>
                                <input type="email" class="form-control px-5" id="email-field" name="email"
                                       placeholder="hello@example.com">
                                <i class="fa-solid fa-envelope"></i>
                                <div id="email-error" class=" text-danger fs-6">

                                </div>
                            </div>
                            <div class="form-group">
                                <label class="mb-1"><strong>رمزعبور</strong></label>
                                <input type="password" class="form-control px-5" id="pass-field"
                                       placeholder="رمزعبور">
                                <i class="fa-solid fa-key"></i>
                                <div id="pass-error" class="pass-error text-danger fs-6">

                                </div>
                            </div>
                            <div class="form-group">
                                <label class="mb-1"><strong>تکرار رمزعبور</strong></label>
                                <input type="password" class="form-control  px-5" id="conf-pass-field"
                                       placeholder=" تکرار رمزعبور">
                                <i class="fa-solid fa-key"></i>
                                <div id="conf-pass-error" class="text-danger fs-6">

                                </div>
                            </div>
                            <div class="text-center mt-4">
                                <button type="submit" class="btn btn-primary btn-block">ثبت نام </button>
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger light" data-dismiss="modal">بستن</button>
                        <button type="submit" class="btn btn-primary">ارسال</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')

    <script src="{{asset('js/global.min.js')}}"></script>
    <script src="{{asset('js/Chart.bundle.min.js')}}"></script>
    <script src="{{asset('js/custom.min.js')}}"></script>
    <script src="{{asset('js/deznav-init.js')}}"></script>
    <script src="{{asset('js/apexchart.js')}}"></script>
    <script src="{{asset('js/jquery.peity.min.js')}}"></script>

    <script src="{{asset('js/chartist.min.js')}}"></script>

    <script src="{{asset('js/dashboard-1.js')}}"></script>

    <script src="{{asset('js/vivus.min.js')}}"></script>
    <script src="{{asset('js/svg.animation.js')}}"></script>
    <script src="{{asset('js/dataTables.js')}}"></script>
    <script src="{{asset('js/datatables.init.js')}}"></script>
    <script src="{{asset('js/custom-select.js')}}"></script>
    <script src="{{asset('js/darkmode-init.js')}}"></script>
@endpush
