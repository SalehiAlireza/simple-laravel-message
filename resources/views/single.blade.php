@extends('layout')

@section('title','مشاهده پیام')

@section('content')

    <!-- write new Message -->
    @include('create')

    <div class="container">
        <div class="row">
            <div class="col-12">
                <a href="{{ route('ticket.index') }}" class="btn btn-info">رفتن به صفحه اصلی</a>
            </div>
        </div>
    </div>

    <div class="limiter">
        <div class="container-table100">
            <div class="wrap-table100">

                <div class="table100">
                    <table class="text-center">
                        <thead>
                        <tr class="table100-head text-center">
                            <th class="column1 pr-5 pl-0 text-center">#</th>
                            <th class="column2 text-center">تاریخ ثبت</th>
                            <th class="column3 text-center">درخواست کننده</th>
                            <th class="column4 text-center">موضوع درخواست</th>
                            <th class="column5 text-center">فوریت</th>
                            <th class="column6 text-center">سرپرست</th>
                            <th class="column6 text-center">مدیرعامل</th>
                            <th class="column6 text-center">عملیات</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td class="pr-5 pl-0 text-center">{{ $ticket->id }}</td>

                            <td class="column1 text-center">{{ jdate($ticket->created_at)->format('Y-m-d') }}</td>
                            <td class="column2 text-center">{{ $ticket->senderName }}</td>
                            <td class="column3 text-center">{{ $ticket->subject }}</td>
                            <td class="column4 text-center {{ $ticket->statusAsText['status'] }}">{{ $ticket->statusAsText['text'] }}</td>
                            <td class="column5 text-center">
                                @if($ticket->supervisor_id)
                                    {{ $ticket->user('supervisor_id')->first()->name }}
                                    <img src="{{ asset('/tick.webp') }}" width="24" alt="">
                                @else
                                    <img src="{{ asset('/waiting.png') }}" width="24" alt="">
                                @endif
                            </td>
                            <td class="column6 text-center">
                                @if($ticket->ceo_id)
                                    {{ $ticket->user('ceo_id')->first()->name }}
                                    <img src="{{ asset('/tick.webp') }}" width="24" alt="">
                                @else
                                    <img src="{{ asset('/waiting.png') }}" width="24" alt="">
                                @endif
                            </td>
                            <td class="column6 text-center">
                                <form action="{{ route('ticket.change.state',['id' => $ticket->id]) }}"
                                method="POST"
                                >
                                    @csrf
                                @php($btn = $ticket->acceptButton())
                                @if(isset($btn['accept']) && $btn['accept'])
                                    <button class="btn btn-outline-success">
                                        تایید کردن(
                                        {{ $btn['type'] }}
                                        )
                                    </button>
                                @endif

                                @if(isset($btn['accept']) && !$btn['accept'])
                                    <button class="btn btn-outline-secondary">
                                        عدم تایید (
                                        {{ $btn['type'] }}
                                        )
                                    </button>
                                @endif
                                </form>
                            </td>
                        </tr>

                        <tr>
                            <td colspan="8">
                                <div class="p-2 text-right" style="direction: rtl;">
                                    {{ $ticket->message }}
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <td colspan="8">
                                <div class="p-2 text-right" style="direction: rtl;">
                                    <h6>دانلود فایل های پیوست : </h6>
                                    <ul>
                                        @if($ticket->medias)
                                            @php($i = 1)
                                            @foreach($ticket->medias as $media)
                                                <li>
                                                    <a  class="btn btn-link" href="{{ route('download',['path' => base64_encode($media)]) }}">
                                                        دانلود فایل شماره {{ $i }}
                                                    </a>
                                                </li>
                                                @php($i++)
                                            @endforeach
                                        @else
                                            <li>
                                                پیوستی آپلود نشده است
                                            </li>
                                        @endif
                                    </ul>
                                </div>
                            </td>
                        </tr>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


@endsection
