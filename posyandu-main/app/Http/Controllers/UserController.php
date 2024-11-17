<?php

namespace App\Http\Controllers;

use App\Repositories\KeluargaRepository;
use App\Repositories\PoskoRepository;
use App\Repositories\RoleRepository;
use App\Repositories\UserRepository;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class UserController extends Controller
{

    public function __construct(
        UserRepository $userRepository,
        RoleRepository $roleRepository,
        KeluargaRepository $keluargaRepository,
        PoskoRepository $poskoRepository
    ) {
        $this->userRepository = $userRepository;
        $this->roleRepository = $roleRepository;
        $this->keluargaRepository = $keluargaRepository;
        $this->poskoRepository = $poskoRepository;
    }

    public function index(): View
    {

        $where = array(
            'id' => 4
        );
        $wherep = array(
            'id' => Auth::user()->posko_id
        );

        $whereu = array(
            'posko_id' => Auth::user()->posko_id,
            'role_id' => 4
        );
        $no = 1;
        if (Auth::user()->role_id == 2) {
            $role = $this->roleRepository->whereData($where)->get();
            $posko = $this->poskoRepository->whereData($wherep)->get();
            $data = $this->userRepository->whereData($whereu)->get();
        } else {
            $data = $this->userRepository->getData();
            $posko = $this->poskoRepository->getData();
            $role = $this->roleRepository->getData();
        }
        $keluarga = $this->keluargaRepository->getData();

        return view('user.index', compact('data', 'no', 'role', 'keluarga', 'posko'));
    }

    public function storeAndUpdate(Request $request)
    {

        $id = (int)$request->id > 0 ? (int)$request->id : 0;
        $validator = Validator::make($request->all(), $this->rules($id));

        if ($validator->fails()) {
            // dd($validator->errors()->get('*'));
            return redirect(route('user'))->with('danger', $validator->errors()->first('*'));
        }

        $request->request->add(['password' => Hash::make(12345678)]);
        $data = $this->userRepository->CreateOrUpdate($request->all(), $id);

        if ($id == 0) {
            return redirect(route('user'))->with('success', 'data akun berhasil di tambahkan');
        } else {
            return redirect(route('user'))->with('warning', 'data akun berhasil di edit');
        }
        return redirect();
    }

    public function updateStatus($id)
    {
        $user = $this->userRepository->find($id);
        $where = array(
            'id' => $id
        );
        if ($user->is_active == 0) {
            $data = [

                'is_active' => '1'
            ];
        } else {

            $data = [

                'is_active' => '0'
            ];
        }
        $data = $this->userRepository->updateWhere($where, $data);

        return redirect(route('user'))->with('warning', 'data status akun berhasil di edit');
    }


    public function resetPassword($id)
    {
        $user = $this->userRepository->find($id);
        $where = array(
            'id' => $id
        );

        $data = [

            'password' => Hash::make(12345678)
        ];

        $data = $this->userRepository->updateWhere($where, $data);

        return redirect(route('user'))->with('warning', 'data status akun berhasil di edit');
    }


    private function rules($id)
    {
        return [
            'username' => ['required', Rule::unique('users')->ignore($id)],
            'email' => ['required', Rule::unique('users')->ignore($id)],
            'role_id' => ['required']
        ];
    }
}
