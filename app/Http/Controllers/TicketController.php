<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

class TicketController extends Controller
{
    public function index()
    {
        $tickets = Ticket::query()->latest();
        $user = auth()->user();

        if ($user->hasThisPermission('user'))
        {
            $tickets = $tickets->where('user_id',$user->id);
        }

        if ($user->hasThisPermission('ceo'))
        {
            $tickets = $tickets->whereNotNull('supervisor_id');
        }

        $tickets = $tickets->simplePaginate();
        return view('ticket',compact('tickets'));
    }

    public function single($id)
    {
        $ticket = Ticket::findOrFail($id);
        return view('single',compact('ticket'));
    }

    public function store(Request $request)
    {
        $this->getValidate($request);


        $filePath = [];
        $user = auth()->user();
        $data = $request->all();
        $files = $request->file('medias');
        $data['user_id'] = $user->id;

        foreach ($files as $file):
            $filePath[] = $file->store('ticket');
        endforeach;
        $data['medias'] = $filePath;


        if ($user->hasThisPermission('ceo'))
            $data['ceo_id'] = $user->id;
        if ($user->hasThisPermission('supervisor'))
            $data['supervisor_id'] = $user->id;

        $ticket = Ticket::query()->create($data);
        return Redirect::back()->with(['status' => (bool)$ticket,'msg' => 'پیام شما با موفقیت ثبت شد.']);
    }

    public function downloadTicketMedia($path)
    {
        $path = base64_decode($path);
        if (Storage::exists($path))
        {
            return Response()->download(Storage::path($path));
        }
        else
        {
            return Redirect::back()->with(['status' => false ,'msg' => 'چنین فایلی برای دانلود پیدا نشد']);
        }
    }

    public function changeState($id)
    {
        $ticket = Ticket::findOrFail($id);
        $user = auth()->user();

        if ($user->hasThisPermission('ceo'))
        {
            if ($ticket->ceo_id)
                $ticket->ceo_id = null;
            else
                $ticket->ceo_id = $user->id;
        }

        if ($user->hasThisPermission('supervisor'))
        {
            if ($ticket->supervisor_id)
                $ticket->supervisor_id = null;
            else
                $ticket->supervisor_id = $user->id;
        }

        $ticket->save();
        return redirect()->back()->with(['status' => true,'msg' => 'بروز رسانی با موفقیت انجام شد']);
    }

    private function getValidate(Request $request): void
    {
        $request->validate([
            'subject' => 'required|min:5',
            'message' => 'required|min:5',
            'status' => 'required',
        ], [
            'subject.required' => 'موضوع درخواست حتما باید پر شود',
            'message.required' => 'متن درخواست حتما باید پر شود',
            'subject.min' => 'موضوع درخواست حداقل باید 5 کاراکتر باشند',
            'message.min' => 'متن درخواست شما حداقل باید 5 کاراکتر باشند'
        ]);
    }

    public function storeFile(Request $request)
    {
        return $request->file('file')->store('ticket');
    }

}
