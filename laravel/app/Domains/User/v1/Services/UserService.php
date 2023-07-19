<?php

namespace App\Domains\User\v1\Services;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;

class UserService
{
    private Model $userModel;

    public function __construct()
    {
        $this->userModel = new User();
    }
    public function registerUser($request): ?Model
    {
        try {
            return $this->userModel->create(
                [
                    'phone' => $this->getRequestPhone($request),
                    'name' => $request->name ?? null,
                    'email' => $request->email ?? null,
                    'password'=>bcrypt($request->password) ?? null,
                    'salary' => $request->salary ?? null,
                    'department' => $request->department ?? null,
                    'job_title' => $request->job_title ?? null,
                ]
            );
        } catch (\Throwable $exception) {
            throw $exception;
        }

    }
    public function getRequestPhone($request): ?string
    {
        try {
            if (is_array($request->phone)) {
                return phone($request->phone['number'], $request->phone['code'])->formatE164();
            }
            return phone($request->phone_number, $request->phone_code)->formatE164();
        } catch (\Throwable $exception) {
            throw $exception;
        }

    }
    public function search(Request $request): ?UserService
    {
        try {
            $this->userModel->when($request->email,function ($q) use ($request){
                $q->where(function ($q) use ($request) {
                    $q->where('email', "%{$request->email}%");
                });
            });
            return $this;
        } catch (\Throwable $exception) {
            throw $exception;
        }

    }
    public function index(): Collection
    {
        try {
            return $this->userModel->get();
        } catch (\Throwable $exception) {
            throw $exception;
        }
    }
    public function paginate(int $itemsPerPage): LengthAwarePaginator
    {
        try {
            return $this->userModel->paginate($itemsPerPage);
        } catch (\Throwable $exception) {
            throw $exception;
        }
    }
    public function paginate_simple(int $itemsPerPage): Paginator
    {
        try {
            return $this->userModel->simplePaginate($itemsPerPage);
        } catch (\Throwable $exception) {
            throw $exception;
        }
    }
    public function getCollection(): ?Model
    {
        try {
            return $this->userModel;
        } catch (\Throwable $exception) {
            throw $exception;
        }

    }
    public function count():int
    {
        try {
            return $this->userModel->count();
        } catch (\Throwable $exception) {
            throw $exception;
        }
    }

    public function update(Request $request, int $user_id): bool
    {
        try {
            $data = $request->validated();

            // TODO: if has any active cart throw exception
            return $this->userModel->where('id', $user_id)->update($data);
        } catch (\Throwable $exception) {
            throw $exception;
        }

    }

    public function find(string $key, string|null $value): ?Model
    {
        try {
            return $this->userModel->where('id', request()->user()->id)->where($key, $value)->first();
        } catch (\Throwable $exception) {
            throw $exception;
        }

    }

    public function delete(Model $item): bool
    {
        try {
            return $item->delete();
        } catch (\Throwable $exception) {
            throw $exception;
        }
    }

}
