@extends('dashboard.layouts.master')

@section('content')
    <div class="col-12" style="width: 1000px;background: white;margin-right: 140px;padding:30px;margin-top: 100px;">
        <div class="project-list-header">
            <h2 class="text-center border-bottom py-2 pt-4 mb-3">
                لیست دسته بندی ها
            </h2>
        </div>

        <div class="user-list">
            <button href="#" type="button" class="add-user" data-toggle="modal" data-target="#modal_adduser" id="addButton">
                <i class="fa-solid fa-plus align-middle"></i>
                ایجاد دسته جدید
            </button>
            <div class="table-responsive">
                <table id="table_id" class="display" cellspacing="0" style="min-width: 845px;">
                    <thead style="margin: 20px;">
                    <tr >
                        <th style="padding: 10px">#</th>
                        <th style="padding: 10px">نام دسته</th>
                        <th style="padding: 10px">نام زیر دسته</th>
                        <th style="padding: 10px">اقدام</th>
                    </tr>
                    </thead>
                        <tbody></tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modal_adduser">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form>
                    @csrf
                    <div class="modal-header">
                        <h4 class="modal-title">ایجاد دسته بندی</h4>
                        <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form_adduser">
                            <div class="form-group">
                                <select name="category" value="{{old('category')}}" id="categorySelect"  class="form-control">
                                    <option value="" >انتخاب کنید</option>
                                </select>
                            </div>
                       {{--     <div class="form-group">
                                <label class="mb-1"><strong>نام</strong></label>
                                <input type="text" class="form-control px-5 addName"  id="user-field" name="name"
                                       value="{{old('name')}}" >
                                <div id="name-error" class=" text-danger fs-6">

                                </div>
                            </div>--}}
                            <input type="hidden" class="form-control px-5 addName"  id="categoryVal" name="name"
                                 >
                            <div class="form-group position-relative py-3">
                                <label><strong>نام</strong></label>
                                <input class="post-tags form-control" id="post_tag" name="post_tag"/>
                                <i class="fa-solid fa-plus " style="right: 90%"></i>
                                <div id="suggest"></div>
                                <div class="text-danger errors"></div>

                                <div class="tags-container w-100">

                                </div>
                                  @if($errors->has('post_tag'))
                                      <div class="errors text-danger">
                                          <strong>{{ $errors->first('post_tag') }}</strong>
                                      </div>
                                  @endif
                            </div>
                            <div id="addError"></div>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit"  class="btn btn-danger light"  id='closeBtnAjax' >بستن</button>
                        <button   id="ajaxAddButton" type="submit"  class="btn btn-primary">ارسال</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modal_update_adduser">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form>
                    @csrf
                    <div class="modal-header">
                        <h4 class="modal-title">آپدیت</h4>
                        <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                        </button>
                    </div>
                    <input type="hidden" id="id" >
                    <div class="modal-body">
                        <div class="form_adduser">
                            <div class="form-group">
                                <label for="updateCategorySelect">دسته</label>
                                <input name="category" value="{{old('category')}}" id="updateCategorySelect"  class="form-control">

                            </div>
                            <div class="catError"></div>
                            <input type="hidden" class="form-control px-5 addName" id="updateCategoryVal" name="updateNname"
                            >
                            <div class="form-group position-relative py-3">
                                <label><strong>زیردسته</strong></label>
                                <input class="update-post-tags form-control" id="update-post-tags" name="update-post-tags"/>
                                <i class="fa-solid fa-plus update"></i>
                                <div id="suggest"></div>
                                <div class="text-danger errors"></div>

                                <div class="update-tags-container w-100">

                                </div>
                                  @if($errors->has('post_tag'))
                                      <div class="errors text-danger">
                                          <strong>{{ $errors->first('post_tag') }}</strong>
                                      </div>
                                  @endif
                            </div>
                            <div id="updateError"></div>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit"  class="btn btn-danger light" id="closeBtnUpdate">بستن</button>
                        <button type="submit"  id="updateButton" data-dismiss="modal" class="btn btn-primary">ارسال</button>
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.all.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>

    <script>

    </script>
@endpush

