@extends('layout')

@section('title','مدیریت پیام ها')

@section('content')

<!-- write new Message -->
@include('create')

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
                    @foreach($tickets as $ticket)
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
                                <a href="{{ route('ticket.single',['id' => $ticket->id]) }}" type="button" class="btn btn-primary">
                                    مشاهده
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="Page navigation example">
                {{ $tickets->links() }}
            </div>
        </div>
    </div>
</div>


@endsection
