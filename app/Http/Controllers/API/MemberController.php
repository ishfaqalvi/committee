<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use App\Models\Member;
use App\Models\User;

class MemberController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $members = Member::createdByUser()->with('user.createdBy','createdBy')->get();
        return $this->sendResponse($members, 'Members data get successfully.');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name'             => 'required|string|max:50',
                'mobile_number'    => 'required|string|unique:users',
                'email'            => 'required|string|email|unique:users',
                'password'         => 'required|min:8|max:16',
                'confirm_password' => 'required|min:8|max:16|same:password',
            ]);
            if ($validator->fails()) {
                return $this->sendError('Validation Error.', $validator->errors());
            }
            $input = $request->all();
            $input['created_by'] = auth()->user()->id;
            $user = User::create($input);
            $user->assignRole(3);
            Member::create(['user_id' => $user->id, 'created_by' => $input['created_by']]);
            return $this->sendResponse($user, 'Member created successfully.');
        } catch (\Throwable $th) {
            return $this->sendException($th->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function add(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'user_id' => 'required'
            ]);
            if ($validator->fails()) {
                return $this->sendError('Validation Error.', $validator->errors());
            }
            $manager = auth()->user()->id;
            if(Member::where([['user_id',$request->user_id],['created_by', $manager]])->first()){
                return $this->sendError('Duplicate Record', ['error' => 'Member already exist.']);   
            }
            $member = Member::create(['user_id' => $request->user_id, 'created_by' => $manager]);
            return $this->sendResponse($member, 'Member added successfully.');
        } catch (\Throwable $th) {
            return $this->sendException($th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $member = Member::find($id);

        return view('admin.member.show', compact('member'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  User $member
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name'            => 'required',
                'email'           => 'required|email|unique:users,email,'.$user->id.',id',
                'password'        => 'nullable|min:8|max:12',
                'confirm_password'=> 'nullable|min:8|max:12|required_with:password|same:password',
                'mobile_number'   => 'required|unique:users,mobile_number,'.$user->id.',id',
            ]);
            if ($validator->fails()) {
                return $this->sendError('Validation Error.', $validator->errors());
            }
            $input = $request->all();
            if(empty($input['password'])){
                $input = Arr::except($input,array('password'));    
            }
            $user->update($input);
            return $this->sendResponse($user, 'Member updated successfully.');
        } catch (\Throwable $th) {
            return $this->sendException($th->getMessage());
        }
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $member = Member::find($id)->delete();
        return $this->sendResponse('', 'Member removed successfully.');
    }

    /**
     * Validate a resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'keyword' => 'required',
                'page'    => 'nullable'
            ]);
            if ($validator->fails()) {
                return $this->sendError('Validation Error.', $validator->errors());
            }
            $parameter = $request->keyword;
            $page      = $request->page;
            $users     = User::where('name', 'LIKE', '%' . $parameter . '%')
                        ->orWhere('email', 'LIKE', '%' . $parameter . '%')
                        ->orWhere('mobile_number', 'LIKE', '%' . $parameter . '%')
                        ->paginate(10, ['*'], 'page', $page)->toArray();
            return $this->sendResponse($users, 'Users list get successfully.');
        } catch (\Throwable $th) {
            return $this->sendException($th->getMessage());
        }
    }
}
