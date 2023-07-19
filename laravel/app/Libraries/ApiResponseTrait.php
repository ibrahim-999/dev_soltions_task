<?php

namespace App\Libraries;


use App\Enums\HttpRequestStatusEnum;
use Illuminate\Http\Resources\Json\JsonResource;

trait ApiResponseTrait
{
    public function failPermissionMessage($errors)
    {
        return [
            'success' => false,
            'type' => 'error',
            'code' => $this->status_code_401,
            'reason' => 'Permissions',
            'message' => trans('messages.permission_denied'),
            'errors' => $errors,
        ];
    }

    public function failExceptionMessage($error_code, $file, $line, $message)
    {
        $data = [
            'success' => false,
            'type' => 'error',
            'code' => HttpRequestStatusEnum::STATUS_BAD_REQUEST->value,
            'reason' => 'Exceptions',
            'message' => $message,
            'error_code' => $error_code,
            'file' => $file,
            'line' => $line,
        ];

        info(implode(', ', $message));

        return $msg;
        return response()->json($data, HttpRequestStatusEnum::STATUS_BAD_REQUEST->value);
    }

    public function failResourceNotFoundMessage($resource_name = null,$message = null)
    {
        $data = [
            'success' => false,
            'type' => 'error',
            'code' => HttpRequestStatusEnum::STATUS_NOT_FOUND->value,
            'reason' => 'Record',
            'message' => empty($message) ? (is_null($resource_name)) ? trans('messages.Resource_not_found') : $resource_name . ' ' . trans('messages.not_found') : $message,
        ];
        return response()->json($data, HttpRequestStatusEnum::STATUS_NOT_FOUND->value);

    }

    public function successShowDataResponse($data=[], $reason = 'Show',$message=null)
    {
        $data = [
            'success' => true,
            'type' => 'success',
            'code' => HttpRequestStatusEnum::STATUS_OK->value,
            'data' => (object)$data,
            'reason' => $reason,
            'message' => $message ?? trans('messages.resource_details'),
        ];
        return response()->json($data, HttpRequestStatusEnum::STATUS_OK->value);

    }
    public function successShowPaginationResponse($data=[],$meta, $reason = 'Show')
    {
        $data = [
            'success' => true,
            'type' => 'success',
            'code' => HttpRequestStatusEnum::STATUS_OK->value,
            'data' => (object)$data,
            'meta' => $meta,
            'reason' => $reason,
            'message' => trans('messages.resource_details'),
        ];
        return response()->json($data, HttpRequestStatusEnum::STATUS_OK->value);

    }
    public function successShowPaginatedDataResponse(JsonResource $data, $reason = 'Show')
    {
//        $body = [
//            'success' => true,
//            'type' => 'success',
//            'code' => HttpRequestStatusEnum::STATUS_OK->value,
//            'data' => $data,
//            'count' => $data->count(),
//            'reason' => $reason,
//            'message' => trans('messages.resource_details'),
//        ];
        return response()->json($data,HttpRequestStatusEnum::STATUS_OK->value);

    }

    public function successShowMessage()
    {
        return [
            'success' => true,
            'type' => 'success',
            'code' => $this->status_code_200,
            'reason' => 'Show',
            'message' => trans('messages.resource_details'),
        ];
    }

    public function successListMessage($data)
    {
        return [
            'success' => true,
            'type' => 'success',
            'reason' => 'List',
            'data' => $data,
            'code' => HttpRequestStatusEnum::STATUS_OK->value,
            'message' => 'Resources listed successfully',
        ];
    }

    public function successCreateMessage()
    {
        return [
            'success' => true,
            'type' => 'success',
            'code' => HttpRequestStatusEnum::STATUS_CREATED->value,
            'reason' => 'Create',
            'message' => trans('messages.Resource_created_successfully'),
        ];
    }

    public function failCreateMessage()
    {
        return [
            'success' => false,
            'type' => 'error',
            'code' => $this->status_code_304,
            'reason' => 'Failure',
            'message' => trans('messages.Resource_not_created'),
        ];
    }

    public function successUpdateNoContentResponse()
    {
        return response()->json([], HttpRequestStatusEnum::STATUS_SUCCESS_WITH_NO_CONTENT->value);
    }
    public function successUpdateWithContentResponse($data)
    {
        $data= [
            'success' => true,
            'type' => 'success',
            'code' => HttpRequestStatusEnum::STATUS_OK->value,
            'reason' => 'Update',
            'data' => $data,
            'message' => trans('messages.Resource_updated_successfully'),
        ];
        return response()->json($data, HttpRequestStatusEnum::STATUS_OK->value);

    }

    public function failUpdateMessage()
    {
        return [
            'success' => false,
            'type' => 'error',
            'code' => HttpRequestStatusEnum::STATUS_NOT_MODIFIED->value,
            'reason' => 'Failure',
            'message' => trans('messages.Resource_not_updated'),
        ];
    }

    public function successDeleteMessage($message=null)
    {
        return [
            'success' => true,
            'type' => 'success',
            'code' => HttpRequestStatusEnum::STATUS_OK->value,
            'reason' => 'Delete',
            'message' => $message ?? trans('messages.Resource_deleted_successfully'),
        ];
    }

    public function failDeleteMessage()
    {
        return [
            'success' => false,
            'type' => 'error',
            'code' => HttpRequestStatusEnum::STATUS_NOT_MODIFIED->value,
            'reason' => 'Failure',
            'message' => trans('messages.Resource_not_deleted'),
        ];
    }

    public function failValidationMessage($errors,$message=null)
    {
        $data = [
            'success' => false,
            'type' => 'error',
            'code' => HttpRequestStatusEnum::STATUS_Validation_Error->value,
            'reason' => 'Validation',
            'message' => $message ?? trans('messages.Inputs_not_valid'),
            'errors' => $errors,
        ];
        return response()->json($data, HttpRequestStatusEnum::STATUS_Validation_Error->value);
    }
    public function failAuthMessage()
    {
        $data = [
            'success' => false,
            'type' => 'error',
            'code' => HttpRequestStatusEnum::STATUS_UNAUTHORIZED->value,
            'reason' => 'Authentication',
            'message' => __('messages.unauthenticated'),
        ];
        return response()->json($data, HttpRequestStatusEnum::STATUS_UNAUTHORIZED->value);
    }

    public function successGeneralMessage($message = '')
    {
        $data= [
            'success' => true,
            'type' => 'success',
            'code' => HttpRequestStatusEnum::STATUS_OK->value,
            'reason' => 'General',
            'message' => $message,
        ];
        return response()->json($data, HttpRequestStatusEnum::STATUS_OK->value);

    }

    public function failGeneralMessage($message = '')
    {
        $data = [
            'success' => false,
            'type' => 'error',
            'code' => HttpRequestStatusEnum::STATUS_BAD_REQUEST,
            'reason' => 'General',
            'message' => $message,
        ];
        return response()->json($data, HttpRequestStatusEnum::STATUS_BAD_REQUEST->value);
    }

    public function successًwithActionMessage($message = '')
    {
        $data= [
            'success' => true,
            'type' => 'success',
            'code' => HttpRequestStatusEnum::STATUS_HTTP_FOUND->value,
            'reason' => 'General',
            'message' => $message,
        ];
        return response()->json($data, HttpRequestStatusEnum::STATUS_HTTP_FOUND->value);

    }
}
