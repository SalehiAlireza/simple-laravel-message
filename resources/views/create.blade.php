<div class="container">
    <div class="row">
        <div class="col-12 mt-3 mb-3">
            @if($errors->any())
                <div>
                    <ul class="nav-link">
                        @foreach($errors->all() as  $error)
                            <li class="nav-item text-danger">{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if(session()->exists('status'))
                @if(session()->get('status'))
                    <div>
                        <ul class="nav-link">
                            <li class="nav-item text-success">{{ session()->get('msg') }}</li>
                        </ul>
                    </div>
                @else
                    <div>
                        <ul class="nav-link">
                            <li class="nav-item text-danger">{{ session()->get('msg') }}</li>
                        </ul>
                    </div>
                @endif
            @endif

            <a class="btn btn-primary" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                نوشتن پیام جدید
            </a>
            <a class="btn btn-outline-light">
                {{ auth()->user()->name }}
                <span class="badge badge-info">
                سمت شما :
                {{ auth()->user()->permissions()->first()->farsi_name }}
                </span>
            </a>

            <a href="{{ route('logout') }}" class="btn btn-outline-danger" >
                خروج از حساب
            </a>

            <div class="collapse" id="collapseExample">
                <div class="card card-body">
                    <form action="{{ route('ticket.store') }}" enctype="multipart/form-data"  method="POST">


                        @csrf




                        <div id="wrap" class="input">
                            <section class="input-content">
                                <h2>
                                    برای ارسال پیام میتوانید فرم زیر را پرکنید.
                                </h2>
                                <div class="input-content-wrap">

                                    <!-- subject -->

                                    <dl class="inputbox">
                                        <dd class="inputbox-content">
                                            <input id="input0" name="subject" type="text" />
                                            <label for="input0">موضوع درخواست شما</label>
                                            <span class="underline"></span>
                                        </dd>
                                    </dl>

                                    <!-- message -->

                                    <dl class="inputbox">
                                        <dd class="inputbox-content">
                                            <input id="input1"  name="message" type="text" />
                                            <label for="input1" >متن درخواست</label>
                                            <span class="underline"></span>
                                        </dd>
                                    </dl>

                                    <!-- Status -->

                                    <dl class="inputbox">
                                        <dd class="inputbox-content">
                                            <div style="size: 16px">
                                                تعیین فوریت درخواست
                                            </div>
                                            <select name="status" id="input2" class="form-control">
                                                <option value="normal">معمولی</option>
                                                <option value="require">فوری</option>
                                                <option value="emergency">آنی</option>
                                            </select>
                                            <span class="underline"></span>
                                        </dd>
                                    </dl>

                                    <!-- Media -->
                                    <dl class="inputbox">
                                        <dd class="inputbox-content">
                                            <div style="size: 16px">
                                                ارسال رسانه
                                            </div>
                                            <input type="hidden" id="medias" name="medias">
                                            <form action="/file-upload"
                                                  class="dropzone"
                                                  id="my-awesome-dropzone"></form>

                                            <form action="{{ route('dropzone') }}" class="dropzone" id="my-dropzone"></form>

                                            <span class="underline"></span>
                                        </dd>
                                    </dl>

                                    <div class="btns">
                                        <button class="btn btn-confirm" type="submit">ثبت پیام</button>
                                    </div>
                                </div>
                            </section>
                        </div>


                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
