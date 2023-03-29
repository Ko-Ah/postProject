@extends('dashboard.layouts.master')

@section('content')
    <div class="col-12" style="width: 1000px;background: white;margin-right: 140px;padding:30px;margin-top: 100px;">
        <div class="project-list-header">
            <h2 class="text-center border-bottom py-2 pt-4 mb-3">
                لیست پست ها
            </h2>
        </div>

        <div class="user-list">
            <a href="{{route('posts.create')}}" class="add-user" >
                <i class="fa-solid fa-plus align-middle"></i>
                ایجاد پست
            </a>
            <div class="table-responsive">
                <table id="table_id4"  class="display" style="min-width: 845px;">
                    <thead>
                    <tr>
                        <th style="text-align: center">#</th>
                        <th style="text-align: center;">عنوان</th>
                        <th style="text-align: center">عنوان دوم</th>
                        <th style="text-align: center; width: 500px;" >متن</th>
                        <th style="text-align: center">بنر</th>
                        <th style="text-align: center">دسته</th>
                        <th style="text-align: center">برچسب</th>
                        <th style="text-align: center">اقدام</th>
                        <th style="text-align: center"></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($posts as $post)
                        <tr data-column="{{$post->id}}">
                            <td></td>
                            <td>{{$post->title}}</td>
                            <td>{{$post->subtitle}}</td>
                            <td>
                                <div class="form-group py-3">
                                    <div class="w-75 p-0" >
                                        <textarea style="color:black;" name="ckeditor" class="ckeditor" id="ckeditor{{$post->id}}" disabled>{{$post->content}}</textarea>

                                    </div>

                                </div>
                            </td>
                            @if($post->banner_image)
                                <td><img src="{{asset('storage/images/'.$post->banner_image)}}" style="width: 100px;height: 100px" alt=""></td>

                            @else
                                <td>ندارد</td>
                            @endif
                            @if($post->categories)
                            <td>{{$post->categories->name}}</td>
                            @else
                                <td>ندارد</td>
                            @endif

                            @if($post->tags)
                                <td>   <ul>
                                @foreach($post->tags as $tag)
                                    <li>{{$tag->name}}</li>
                                @endforeach
                                    </ul></td>
                            @else

                                <td>ندارد</td>
                            @endif

                            <td>
                              <div class="d-flex">
                                  <a href="{{route('posts.edit',$post->id)}}" class="btn btn-primary shadow btn-xs sharp ml-1 "><i
                                          class="fa fa-pencil"></i></a>
                                  <a  class="btn btn-danger shadow btn-xs sharp delete" data-id="{{$post->id}}"><i
                                          class="fa fa-trash"></i></a>
                              </div>
                          </td>
                            <td>
                                <div class="post">
                                    @include('dashboard.likes', ['model' => $post])
                                </div>
                            </td>
                            <td>
                                <div class="comments">
                                    <button type="button" id="commentBtn" data-post="{{$post->id}}" class="close" data-dismiss="modal" data-toggle='modal' data-target='#modal_comment'>
                                        <i class="fa fa-comments" style="    font-size: 15px;" ></i>
                                    </button>
                                </div>
                            </td>
                      </tr>
                        <tr data-comment="{{$post->id}}">
                            <td></td>
                            <td></td>
                            <td></td>
                            <td id="commentSection{{$post->id}}" style="text-align: right">

                                @if(count($post->comments) > 0)
                                    <a id='MoreLess' data-read="{{$post->id}}" style="font-size: medium;" >مشاهده نظرات</a>
                                @endif
                                <div data-content="{{$post->id}}">

                                    <ul data-commentlist="{{$post->id}}">
                                        @foreach($post->comments as $comment)
                                            @if($comment->parent_id == '0')
                                        <li data-comment="{{$comment->id}}" style="display: flex;flex-direction: column" >
                                            <div style="display: flex;flex-direction:row">
                                                <img style="width: 30px;height: 30px; border-radius: 30px 30px;" src="https://eitrawmaterials.eu/wp-content/uploads/2016/09/person-icon.png" alt="">
                                                <div>
                                                    <span>{{$comment->user->name}}</span>
                                                    <h5>{{$comment->title}}</h5>
                                                    <p>{{$comment->body}}</p>
                                                </div>
                                            </div>
                                            <a data-reply="{{$comment->id}}" data-postid = "{{$post->id}}" class="close" data-dismiss="modal" data-toggle='modal' data-target='#modal_reply' style="align-self: end;font-size: 16px">پاسخ</a>
                                            <ul data-replyitem="{{$comment->id}}">

                                            @foreach($comment->subComments as $subComment)

                                                @if($subComment->parent_id == $comment->id)
                                                            <li>
                                                            <div  style="display: flex;flex-direction:row; padding-right:25px ">
                                                                <img style="width: 30px;height: 30px; border-radius: 30px 30px;" src="https://eitrawmaterials.eu/wp-content/uploads/2016/09/person-icon.png" alt="">
                                                                <div>
                                                                    <span>{{$comment->user->name}}</span>
                                                                    <h5>{{$subComment->title}}</h5>
                                                                    <p>{{$subComment->body}}</p>
                                                                </div>

                                                            </div>
                                                        </li>

                                                         @endif
                                                      @endforeach
                                            </ul>
                                            @endif
                                        </li>
                                                @endforeach
                                    </ul>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>

                </table>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal_comment">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form class="appointment-form" id="appointmentform" method="post">
                    @csrf
                    <div class="modal-header">
                        <h4 class="modal-title">ثبت نظر</h4>
                        <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                        </button>
                    </div>
                    <div class="row columns_padding_5 columns_margin_0">
                        <div class="col-sm-12" style="padding: 30px;">
                            <input type="hidden" id="PostId" value="">
                            <div class="col-sm-12">
                                <div class="form-group bottommargin_10">
                                    <label for="app-author" class="sr-only">عنوان
                                        <span class="required">*</span>
                                    </label>
                                    <input value="" type="text" aria-required="true" size="30" value name="title" id="app-author" class="form-control" placeholder="عنوان">
                                    <div class="text-danger errors fs-6">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group bottommargin_20">
                                    <label for="app-time" class="sr-only">پیام
                                        <span class="required">*</span>
                                    </label>
                                    <textarea aria-required="true" rows="5" cols="45" name="message" id="comment" class="form-control" placeholder="پیام" style="margin: 10px 0"></textarea>
                                    <div class="text-danger errors fs-6"></div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <button type="button" id="addComment" name="app-submit" class="theme_button block_button color2 margin_0">ثبت نظر
                                </button>
                            </div>
                        </div>
                    </div>
                </form>

                <div id="commentError" style="color: red;padding:0 30px 30px 0;"></div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modal_reply">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form class="appointment-form" id="appointmentform" method="post">
                    @csrf
                    <div class="modal-header">
                        <h4 class="modal-title">ثبت نظر</h4>
                        <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                        </button>
                    </div>
                    <div class="row columns_padding_5 columns_margin_0">
                        <div class="col-sm-12" style="padding: 30px;">
                            <input type="hidden" id="commentId" value="">
                            <input type="hidden" id="replyPostId" value="">
                            <div class="col-sm-12">
                                <div class="form-group bottommargin_10">
                                    <label for="app-author" class="sr-only">عنوان
                                        <span class="required">*</span>
                                    </label>
                                    <input value="" type="text" aria-required="true" size="30" value name="replyTitle" id="app-author" class="form-control" placeholder="عنوان">
                                    <div class="text-danger errors fs-6">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group bottommargin_20">
                                    <label for="app-time" class="sr-only">پیام
                                        <span class="required">*</span>
                                    </label>
                                    <textarea aria-required="true" rows="5" cols="45" name="replyMessage" id="reply" class="form-control" placeholder="پیام" style="margin: 10px 0"></textarea>
                                    <div class="text-danger errors fs-6"></div>

                                </div>
                            </div>
                            <div class="col-sm-12">
                                <button type="button" id="addReply" name="app-submit" class="theme_button block_button color2 margin_0">ثبت نظر
                                </button>
                            </div>
                        </div>
                    </div>
                </form>

                <div id="replyError" style="color: red;padding:0 30px 30px 0;"></div>
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
   <script src="{{asset('js/posts.js')}}"></script>
    <script src="{{asset('js/custom-select.js')}}"></script>
   <script src="{{asset('js/darkmode-init.js')}}"></script>
   <script src="{{asset('js/postAjax.js')}}"></script>
   <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.all.min.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
   <script src="https://cdn.ckeditor.com/ckeditor5/27.1.0/classic/ckeditor.js"></script>

@endpush

