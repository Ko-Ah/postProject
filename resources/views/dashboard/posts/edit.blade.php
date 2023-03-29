@extends('dashboard.layouts.master')

@section('content')
    <div class="content-body">

        <div class="container-fluid">
            <div class="row mx-0">

                <div class="create-post d-flex">
                    <div class="col-12 col-lg-8">
                        <form method="POST" action="{{route('posts.update',$post->id)}}" enctype="multipart/form-data">

                            @csrf
                            @method('PATCH')
                            <div class="form-group py-3">
                                <label><strong>عنوان پست :</strong></label>
                                <input type="text" name="title"  class="form-control" value="{{$post->title}}" class="form-control @error("title") is-invalid @enderror;" />
                                @if($errors->has('title'))
                                    <div class="errors text-danger">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </div>
                                @endif
                            </div>
                            <div class="form-group py-3">
                                <label><strong>عنوان دوم :</strong></label>
                                <input type="text" name="subtitle" value="{{$post->subtitle}}" class="form-control @error("subtitle") is-invalid @enderror;" />
                                @if($errors->has('subtitle'))
                                    <div class="errors text-danger">
                                        <strong>{{ $errors->first('subtitle') }}</strong>
                                    </div>
                                @endif
                            </div>
                            <div class="form-group py-3">
                                <label><strong>بنر پست :</strong></label>
                                <input type="file" name="img" value="{{old('img')}}" class="form-control @error("img") is-invalid @enderror;"  />
                                @if($errors->has('img'))
                                    <div class="errors text-danger">
                                        <strong>{{ $errors->first('img') }}</strong>
                                    </div>
                                @endif
                            </div>
                            <div>
                                <img src="{{asset('storage/images/'.$post->banner_image)}}" style="width:150px; height: 150px" alt="">
                            </div>
                            <div class="form-group py-3">
                                <label><strong>بدنه پست :</strong></label>
                                <div class="w-100 p-0">
                                    <div >
                                        <textarea  name="ckeditor" class="ckeditor" id="ckeditor1" >{{$post->content}}</textarea>

                                    </div>
                                    @if($errors->has('body'))
                                        <div class="errors text-danger">
                                            <strong>{{ $errors->first('body') }}</strong>
                                        </div>
                                    @endif
                                </div>

                            </div>
                            <div class="col-12 col-lg-4 py-4">
                                <div class="post-cats">
                                    <div class="cats-head p-2"><strong>دسته بندی ها</strong></div>
                                    <select name="category" id="categorySelect"  class="form-control">
                                        <option value="" >انتخاب کنید</option>
                                        @foreach($categories as $category)
                                            <option value="{{$category->id}}" @if($post->cat_id == $category->id)selected @endif >{{$category->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            {{--tags--}}

                            <div class="form-group position-relative py-3">
                                <label><strong>برچسب ها :</strong></label>
                                <input class="post-tags form-control" id="post_tag" name="post_tag"/>
                                <i class="fa-solid fa-plus"></i>
                                <div id="suggest"></div>
                                <div class="text-danger errors"></div>

                                <div class="tags-container w-100">
                                    @foreach($post->tags as $tag)
                                        <a class="tag-item">
                                            <i class="fa-solid fa-xmark align-middle"></i>
                                            {{$tag->name}}
                                        </a>
                                    @endforeach
                                </div>
                                {{--  @if($errors->has('post_tag'))
                                      <div class="errors text-danger">
                                          <strong>{{ $errors->first('post_tag') }}</strong>
                                      </div>
                                  @endif--}}
                            </div>
                            <button class="btn btn-primary waves-effect" type="submit">ارسال</button>
                        </form>

                    </div>
                </div>
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
    <script src="{{asset('js/custom-select.js')}}"></script>
    <script src="{{asset('js/darkmode-init.js')}}"></script>
    <script src="{{asset('js/ckeditor.js')}}"></script>
    <script src="{{asset('js/edit-posts.js')}}"></script>
    <script>
        //Define an adapter to upload the files
        class MyUploadAdapter {
            constructor(loader) {
                this.loader = loader;
                this.url = '{{ route('ckeditor.upload') }}';

            }
            upload() {
                return this.loader.file.then(
                    (file) =>
                        new Promise((resolve, reject) => {
                            this._initRequest();
                            this._initListeners(resolve, reject, file);
                            this._sendRequest(file);
                        })
                );
            }
            // Aborts the upload process.
            abort() {
                if (this.xhr) {
                    this.xhr.abort();
                }
            }
            _initRequest() {
                const xhr = (this.xhr = new XMLHttpRequest());
                xhr.open("POST", this.url, true);
                xhr.setRequestHeader("x-csrf-token", "{{ csrf_token() }}");
                xhr.responseType = "json";
            }
            // Initializes XMLHttpRequest listeners.
            _initListeners(resolve, reject, file) {
                const xhr = this.xhr;
                const loader = this.loader;
                const genericErrorText = `Couldn't upload file: ${file.name}.`;
                xhr.addEventListener("error", () => reject(genericErrorText));
                xhr.addEventListener("abort", () => reject());
                xhr.addEventListener("load", () => {
                    const response = xhr.response;
                    if (!response || response.error) {
                        return reject(response && response.error ? response.error.message : genericErrorText);
                    }
                    resolve({
                        default: response.url,
                    });
                });

                if (xhr.upload) {
                    xhr.upload.addEventListener("progress", (evt) => {
                        if (evt.lengthComputable) {
                            loader.uploadTotal = evt.total;
                            loader.uploaded = evt.loaded;
                        }
                    });
                }
            }
            _sendRequest(file) {
                const data = new FormData();
                data.append("upload", file);
                this.xhr.send(data);
            }
            // ...
        }

        function SimpleUploadAdapterPlugin(editor) {
            editor.plugins.get("FileRepository").createUploadAdapter = (loader) => {
                // Configure the URL to the upload script in your back-end here!
                return new MyUploadAdapter(loader);
            };
        }

        //Initialize the ckeditor
        ClassicEditor.create(document.querySelector("#ckeditor"), {
            extraPlugins: [SimpleUploadAdapterPlugin],
        }).catch((error) => {
            console.error(error);
        });

    </script>
    <script>
        $('.tag-item i').css('cursor','pointer')
        $('.post-tags').on('keyup',function () {

            var val =$(this).val();
            $.ajax({
                url: "{{ url('/dashboard/posts-search') }}",
                type: 'get',
                data: {
                    _token: '{{csrf_token()}}',
                    tagVal:val,
                },
                success: function (data) {
                    $('#suggest').html(data);
                },
                error: function ($response) {
                }
            })

        })
        $(document).on('click', 'li', function(){
            var value = $(this).text();
            $('.post-tags').val(value);
            $('#suggest').html("");

        });
        $('.tags-container').change(function (){
            var div=document.querySelectorAll('.tag-item i');
            console.log(div.length)

        })
    </script>
@endpush
