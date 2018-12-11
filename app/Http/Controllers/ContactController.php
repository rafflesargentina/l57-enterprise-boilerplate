<?php

namespace Raffles\Http\Controllers;

use Raffles\Mail\ContactMessage;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use RafflesArgentina\ResourceController\Traits\FormatsValidJsonResponses;

class ContactController extends Controller
{
    use FormatsValidJsonResponses;

    /**
     * Where to redirect users after submitting the contact form.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $this->validate(
            $request, [
            'name' => 'required|max:100',
            'email' => 'required|email',
            'phone' => 'max:50',
            'message' => 'required',
            ]
        );

        try {
            Mail::to($request->email)->send(new ContactMessage($request->all()));
        }  catch(\Exception $e) {
            return $this->validInternalServerErrorJsonResponse($e, $e->getMessage());
        }

        return $this->validSuccessJsonResponse('Success', [], $this->redirectPath());
    }
}
