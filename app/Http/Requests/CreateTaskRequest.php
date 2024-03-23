<?php

namespace App\Http\Requests;

use App\Models\Status;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class CreateTaskRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Auth::check();
    }

    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'address' => 'required|string',
            'description' => 'required|string',
            'status_id' => 'required|in:' . implode(',', [Status::OPEN,Status::IN_PROGRESS,Status::COMPLETED,Status::REJECTED]),
            'user_id' => 'required|exists:users,id',
            'building_id' => 'required|exists:buildings,id',
        ];
    }
}
