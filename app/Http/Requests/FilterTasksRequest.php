<?php

namespace App\Http\Requests;

use App\Models\Status;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class FilterTasksRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Auth::check();
    }

    public function rules(): array
    {
        return [
            'date_from' => 'sometimes|required|date',
            'date_to' => 'sometimes|required|date|after_or_equal:date_from',
            'user_id' => 'sometimes|required|integer|exists:users,id',
            'status_id' => 'sometimes|required|in:' . implode(',', [Status::OPEN,Status::IN_PROGRESS,Status::COMPLETED,Status::REJECTED]),
            'building_id' => 'sometimes|required|integer|exists:buildings,id',
        ];
    }
}
