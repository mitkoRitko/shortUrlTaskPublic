<?php

namespace App\Http\Requests;

use App\Facades\GoogleSafeBrowsingFacade;
use App\Services\UrlService;
use Illuminate\Foundation\Http\FormRequest;


class UrlStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'destination_url' => [ 
                'required', 
                'url',
            ]
        ];
    }

    public function messages()
    {
        return [
            'destination_url.required' => 'The :attribute is required'
        ];
    }

    public function handle(UrlService $urlService)
    {
        // if(GoogleSafeBrowsingFacade::isSafeUrl($this->get('destination_url'))) {
        //     return response('The Destination Url is not valid', 422);    
        // }

        return $urlService->createShortUrl($this->get('destination_url'));
    }
}
